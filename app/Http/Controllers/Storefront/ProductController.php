<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display products that customers can buy on the website.
     */
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $products = Product::query()
            ->where('status', true)
            ->where('stock', '>', 0)
            ->when($search !== '', function ($query) use ($search): void {
                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhere('category', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->get();

        return view('frontend.products', compact('products', 'search'));
    }
}
