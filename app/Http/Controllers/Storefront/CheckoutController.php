<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCheckoutAddressRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

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

        return view('frontend.payment', compact('address', 'cartItems', 'cartTotal'));
    }

    /**
     * Place a cash-on-delivery order and reduce available product stock.
     */
    public function placeOrder(Request $request): RedirectResponse
    {
        $request->validate([
            'payment_method' => ['required', 'in:cod'],
        ]);

        $cart = $request->session()->get('cart', []);
        $address = $request->session()->get('checkout_address');

        if (empty($cart) || ! $address) {
            return redirect()->route('cart.index')->with('error', 'Your checkout session has expired. Please try again.');
        }

        $order = DB::transaction(function () use ($cart, $address): Order {
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
                'payment_method' => 'cod',
                'payment_status' => 'pending',
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

        $request->session()->forget(['cart', 'checkout_address']);
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
}
