<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCheckoutAddressRequest;
use App\Http\Requests\VerifyRazorpayPaymentRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Razorpay\Api\Api;
use Throwable;

class CheckoutController extends Controller
{
    /**
     * Show the checkout address form for the current cart.
     */
    public function index(Request $request): View|RedirectResponse
    {
        $cartItems = collect($request->session()->get('cart', []));

        if ($cartItems->isEmpty()) {
            return redirect()
                ->route('products')
                ->with('error', 'Add a product to your cart before checkout.');
        }

        $cartTotal = $cartItems->sum(fn (array $item): float => $item['price'] * $item['quantity']);
        $address = $request->session()->get('checkout_address', []);

        return view('frontend.checkout', compact('cartItems', 'cartTotal', 'address'));
    }

    /**
     * Save the delivery address for the next payment step.
     */
    public function store(StoreCheckoutAddressRequest $request): RedirectResponse
    {
        $request->session()->put('checkout_address', $request->validated());

        return redirect()
            ->route('checkout.payment')
            ->with('success', 'Delivery address saved. Choose a payment method.');
    }

    /**
     * Show available payment methods after the address has been saved.
     */
    public function payment(Request $request): View|RedirectResponse
    {
        $cartItems = collect($request->session()->get('cart', []));
        $address = $request->session()->get('checkout_address');

        if ($cartItems->isEmpty()) {
            return redirect()->route('products')->with('error', 'Your cart is empty.');
        }

        if (! $address) {
            return redirect()->route('checkout.index')->with('error', 'Please add your delivery address first.');
        }

        $cartTotal = $cartItems->sum(fn (array $item): float => $item['price'] * $item['quantity']);
        $amountInPaise = (int) round($cartTotal * 100);

        try {
            $razorpayOrder = $this->razorpay()->order->create([
                'amount' => $amountInPaise,
                'currency' => 'INR',
                'receipt' => 'SN-'.Str::upper(Str::random(12)),
            ]);
        } catch (Throwable $exception) {
            report($exception);

            return redirect()
                ->route('checkout.index')
                ->with('error', 'We could not start the online payment. Please try again.');
        }

        $razorpayOrderId = (string) $razorpayOrder->id;
        $request->session()->put('razorpay_checkout', [
            'order_id' => $razorpayOrderId,
            'amount' => $amountInPaise,
        ]);
        $razorpayKeyId = (string) config('services.razorpay.key_id');

        return view('frontend.payment', compact('address', 'cartItems', 'cartTotal', 'razorpayOrderId', 'razorpayKeyId', 'amountInPaise'));
    }

    /**
     * Verify Razorpay's signed payment response before placing an online order.
     */
    public function verifyRazorpayPayment(VerifyRazorpayPaymentRequest $request): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);
        $address = $request->session()->get('checkout_address');
        $checkout = $request->session()->get('razorpay_checkout');
        $payment = $request->validated();

        if (empty($cart) || ! $address || ! is_array($checkout) || ! isset($checkout['order_id'])) {
            return redirect()->route('cart.index')->with('error', 'Your checkout session has expired. Please try again.');
        }

        if (! hash_equals((string) $checkout['order_id'], $payment['razorpay_order_id'])) {
            return redirect()->route('checkout.payment')->with('error', 'The payment order could not be verified. Please try again.');
        }

        $existingOrder = Order::query()->where('gateway_payment_id', $payment['razorpay_payment_id'])->first();

        if ($existingOrder) {
            $request->session()->put('last_order_id', $existingOrder->id);

            return redirect()->route('checkout.success');
        }

        try {
            $this->razorpay()->utility->verifyPaymentSignature([
                'razorpay_order_id' => $checkout['order_id'],
                'razorpay_payment_id' => $payment['razorpay_payment_id'],
                'razorpay_signature' => $payment['razorpay_signature'],
            ]);
        } catch (Throwable $exception) {
            report($exception);

            return redirect()->route('checkout.payment')->with('error', 'We could not verify your payment. Please contact support if an amount was deducted.');
        }

        $request->session()->put('verified_razorpay_payment', [
            'order_id' => $checkout['order_id'],
            'payment_id' => $payment['razorpay_payment_id'],
        ]);
        $request->merge(['payment_method' => 'razorpay']);

        return $this->placeOrder($request);
    }

    /**
     * Place a cash-on-delivery order and reduce available product stock.
     */
    public function placeOrder(Request $request): RedirectResponse
    {
        $request->validate([
            'payment_method' => ['required', 'in:cod,razorpay'],
        ]);

        $cart = $request->session()->get('cart', []);
        $address = $request->session()->get('checkout_address');

        if (empty($cart) || ! $address) {
            return redirect()->route('cart.index')->with('error', 'Your checkout session has expired. Please try again.');
        }

        $paymentMethod = $request->string('payment_method')->toString();
        $verifiedRazorpayPayment = $request->session()->get('verified_razorpay_payment');

        if ($paymentMethod === 'razorpay' && ! is_array($verifiedRazorpayPayment)) {
            return redirect()->route('checkout.payment')->with('error', 'Please complete the online payment before placing your order.');
        }

        $order = DB::transaction(function () use ($cart, $address, $paymentMethod, $verifiedRazorpayPayment): Order {
            $products = Product::query()
                ->whereKey(array_keys($cart))
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            $orderItems = collect($cart)->map(function (array $cartItem, int|string $productId) use ($products): array {
                $product = $products->get($productId);
                $quantity = (int) ($cartItem['quantity'] ?? 0);

                if (! $product || ! $product->status || $quantity < 1 || $quantity > $product->stock) {
                    throw ValidationException::withMessages([
                        'cart' => 'One or more products are no longer available in the requested quantity.',
                    ]);
                }

                $price = (float) ($product->sale_price ?: $product->price);

                return [
                    'product' => $product,
                    'quantity' => $quantity,
                    'price' => $price,
                    'line_total' => $price * $quantity,
                ];
            });

            $subtotal = $orderItems->sum('line_total');
            $order = Order::create([
                'order_number' => 'SN-'.now()->format('Ymd').'-'.Str::upper(Str::random(6)),
                'customer_name' => $address['name'],
                'phone' => $address['phone'],
                'email' => $address['email'],
                'address_line_1' => $address['address_line_1'],
                'address_line_2' => $address['address_line_2'] ?? null,
                'city' => $address['city'],
                'state' => $address['state'],
                'pincode' => $address['pincode'],
                'address_type' => $address['address_type'],
                'subtotal' => $subtotal,
                'total' => $subtotal,
                'payment_method' => $paymentMethod,
                'gateway_order_id' => $verifiedRazorpayPayment['order_id'] ?? null,
                'gateway_payment_id' => $verifiedRazorpayPayment['payment_id'] ?? null,
                'payment_status' => $paymentMethod === 'razorpay' ? 'paid' : 'pending',
                'order_status' => 'pending',
            ]);

            foreach ($orderItems as $orderItem) {
                $orderItem['product']->decrement('stock', $orderItem['quantity']);

                if ($orderItem['product']->fresh()->stock === 0) {
                    $orderItem['product']->update(['status' => false]);
                }

                $order->items()->create([
                    'product_id' => $orderItem['product']->id,
                    'product_name' => $orderItem['product']->name,
                    'sku' => $orderItem['product']->sku,
                    'price' => $orderItem['price'],
                    'quantity' => $orderItem['quantity'],
                    'line_total' => $orderItem['line_total'],
                ]);
            }

            return $order;
        });

        $request->session()->forget(['cart', 'checkout_address', 'razorpay_checkout', 'verified_razorpay_payment']);
        $request->session()->put('last_order_id', $order->id);

        return redirect()->route('checkout.success');
    }

    /**
     * Display the success message for the latest order in this browser session.
     */
    public function success(Request $request): View|RedirectResponse
    {
        $orderId = $request->session()->get('last_order_id');

        if (! $orderId) {
            return redirect()->route('products');
        }

        $order = Order::with('items')->findOrFail($orderId);

        return view('frontend.order-success', compact('order'));
    }

    /**
     * Build an authenticated Razorpay client from configured server-side credentials.
     */
    private function razorpay(): Api
    {
        $keyId = (string) config('services.razorpay.key_id');
        $keySecret = (string) config('services.razorpay.key_secret');

        if ($keyId === '' || $keySecret === '') {
            throw new \RuntimeException('Razorpay credentials are not configured.');
        }

        return new Api($keyId, $keySecret);
    }
}
