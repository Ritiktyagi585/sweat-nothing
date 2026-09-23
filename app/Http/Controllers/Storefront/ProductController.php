<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display products that customers can buy on the website.
     */
    public function index(): View
    {
        $products = Product::query()
            ->where('status', true)
            ->where('stock', '>', 0)
            ->latest()
            ->get();

        return view('frontend.products', compact('products'));
    }
}
