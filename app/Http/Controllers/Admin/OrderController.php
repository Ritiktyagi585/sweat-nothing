<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display orders received from the website checkout.
     */
    public function index(): View
    {
        $orders = Order::query()
            ->with('items:id,order_id,product_name,quantity')
            ->withCount('items')
            ->latest()
            ->get();

        $orderStats = [
            'total' => $orders->count(),
            'pending' => $orders->where('order_status', 'pending')->count(),
            'cod' => $orders->where('payment_method', 'cod')->count(),
            'revenue' => $orders->sum('total'),
        ];

        return view('orders.index', compact('orders', 'orderStats'));
    }
}
