<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display orders received from the website checkout.
     */
    public function index(Request $request): View
    {
        $orders = Order::query()
            ->when($request->filled('status'), fn ($query) => $query->where('order_status', $request->string('status')->toString()))
            ->when($request->filled('payment'), fn ($query) => $query->where('payment_status', $request->string('payment')->toString()))
            ->when($request->filled('date'), fn ($query) => $query->whereDate('created_at', $request->date('date')))
            ->with('items:id,order_id,product_name,quantity')
            ->withCount('items')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $orderStats = [
            'total' => Order::count(),
            'pending' => Order::where('order_status', 'pending')->count(),
            'cod' => Order::where('payment_method', 'cod')->count(),
            'revenue' => Order::sum('total'),
        ];

        return view('orders.index', compact('orders', 'orderStats'));
    }

    /**
     * Update the delivery and payment status of an order.
     */
    public function update(UpdateOrderStatusRequest $request, Order $order): RedirectResponse
    {
        $order->update($request->validated());

        return redirect()
            ->route('dashboard.orders')
            ->with('success', 'Order status updated successfully.');
    }
}
