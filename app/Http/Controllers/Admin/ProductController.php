<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display all products.
     */
    public function index(): View
    {
        $products = Product::latest()->get();

        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        return view('product.show', ['product' => null]);
    }

    /**
     * Store a newly created product in the database.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $productData = $request->validated();

        $productData['slug'] = Str::slug($productData['name']).'-'.Str::lower(Str::random(6));

        if ($request->hasFile('image')) {
            $productData['image'] = $request->file('image')
                ->store('products', 'public');
        }

        $productData['status'] = $request->boolean('status');

        Product::create($productData);

        return redirect()
            ->route('dashboard.products')
            ->with('success', 'Product added successfully.');
    }

    /**
     * Display one product.
     */
    public function show(Product $product): View
    {
        return view('product.details', compact('product'));
    }

    /**
     * Show the product edit form.
     */
    public function edit(Product $product): View
    {
        return view('product.show', compact('product'));
    }

    /**
     * Update an existing product.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $productData = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $productData['image'] = $request->file('image')->store('products', 'public');
        }

        $productData['status'] = $request->boolean('status');

        $product->update($productData);

        return redirect()
            ->route('dashboard.products')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove a product and its uploaded image.
     */
    public function destroy(Product $product): RedirectResponse
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('dashboard.products')
            ->with('success', 'Product deleted successfully.');
    }
}
