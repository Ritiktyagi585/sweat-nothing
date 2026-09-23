<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Display the cart saved in the current browser session.
     */
    public function index(Request $request): View
    {
        $cart = $request->session()->get('cart', []);
        $products = Product::query()
            ->whereKey(array_keys($cart))
            ->get()
            ->keyBy('id');

        $cartItems = collect($cart)
            ->map(function (array $cartItem, int|string $productId) use ($products): ?array {
                $product = $products->get($productId);

                if (! $product || ! $product->status || $product->stock < 1) {
                    return null;
                }

                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => (float) ($product->sale_price ?: $product->price),
                    'quantity' => min(max((int) ($cartItem['quantity'] ?? 1), 1), $product->stock),
                    'image' => $product->image,
                    'stock' => $product->stock,
                ];
            })
            ->filter()
            ->values();

        $request->session()->put('cart', $cartItems->keyBy('id')->all());
        $cartTotal = $cartItems->sum(fn (array $item): float => $item['price'] * $item['quantity']);

        return view('frontend.cart', compact('cartItems', 'cartTotal'));
    }

    /**
     * Add one product to the current browser cart.
     */
    public function store(Request $request, Product $product): RedirectResponse
    {
        if (! $product->status || $product->stock < 1) {
            return back()->with('error', 'This product is currently out of stock.');
        }

        $cart = $request->session()->get('cart', []);
        $cartItem = $cart[$product->id] ?? null;
        $quantity = min(($cartItem['quantity'] ?? 0) + 1, $product->stock);

        $cart[$product->id] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => (float) ($product->sale_price ?: $product->price),
            'quantity' => $quantity,
            'image' => $product->image,
            'stock' => $product->stock,
        ];

        $request->session()->put('cart', $cart);

        return back()->with('success', $product->name.' added to your cart.');
    }

    /**
     * Change a cart item's quantity without exceeding available stock.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validatedData = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = $request->session()->get('cart', []);

        if (! isset($cart[$product->id])) {
            return redirect()->route('cart.index');
        }

        $cart[$product->id]['quantity'] = min($validatedData['quantity'], $product->stock);
        $cart[$product->id]['stock'] = $product->stock;
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Cart quantity updated.');
    }

    /**
     * Remove one product from the current cart.
     */
    public function destroy(Request $request, Product $product): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$product->id]);
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product removed from your cart.');
    }
}
