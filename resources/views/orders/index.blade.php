@extends('layout.dashboard')

@section('title', 'Orders | Sweat Nothing')

@section('content')
    <main class="orders-dashboard mx-auto max-w-[1500px] p-5 lg:p-7">
        <section class="orders-page-head flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <h1 class="orders-title">Orders</h1>
                <p class="orders-subtitle mt-1 text-slate-500">Website checkout orders appear here automatically.</p>
            </div>
            <nav class="flex items-center gap-2 text-sm text-slate-500" aria-label="Breadcrumb">
                <a href="{{ route('dashboard') }}" class="hover:text-black">Dashboard</a><span>›</span><span>Orders</span>
            </nav>
        </section>

        @if (session('success'))
            <p class="mt-4 rounded-xl bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('success') }}</p>
        @endif

        <section class="order-stats-grid mt-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <article class="order-stat-card rounded-xl bg-white p-4">
                <div class="flex items-center gap-4">
                    <span class="order-stat-icon bg-[#fff3cf]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M5 8h14l1 12H4L5 8Z"/><path d="M9 9V6a3 3 0 0 1 6 0v3"/></svg></span>
                    <div><p class="order-stat-label">Total Orders</p><p class="order-stat-count">{{ $orderStats['total'] }}</p><p class="order-stat-caption">From website checkout</p></div>
                </div>
            </article>
            <article class="order-stat-card rounded-xl bg-white p-4">
                <div class="flex items-center gap-4">
                    <span class="order-stat-icon bg-[#fff3cf]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span>
                    <div><p class="order-stat-label">Pending Orders</p><p class="order-stat-count">{{ $orderStats['pending'] }}</p><p class="order-stat-caption text-amber-700">Needs processing</p></div>
                </div>
            </article>
            <article class="order-stat-card rounded-xl bg-white p-4">
                <div class="flex items-center gap-4">
                    <span class="order-stat-icon bg-[#dff7e6]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M8 5h8M8 9h8M9 5c5 0 7 2 7 5s-2 5-7 5l7 5"/></svg></span>
                    <div><p class="order-stat-label">COD Orders</p><p class="order-stat-count">{{ $orderStats['cod'] }}</p><p class="order-stat-caption text-emerald-700">Cash on delivery</p></div>
                </div>
            </article>
            <article class="order-stat-card rounded-xl bg-white p-4">
                <div class="flex items-center gap-4">
                    <span class="order-stat-icon bg-[#e2efff]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 3v18m5-14H9a3 3 0 0 0 0 6h6a3 3 0 0 1 0 6H7"/></svg></span>
                    <div><p class="order-stat-label">Order Value</p><p class="order-stat-count">₹{{ number_format((float) $orderStats['revenue'], 2) }}</p><p class="order-stat-caption">All placed orders</p></div>
                </div>
            </article>
        </section>

        <section class="order-filter-panel mt-5 rounded-xl bg-white p-4">
            <form method="GET" action="{{ route('dashboard.orders') }}" class="order-filter-form flex flex-col gap-3 xl:flex-row xl:items-center xl:justify-between">
                <div class="grid gap-3 sm:grid-cols-3">
                    <select name="status" class="order-filter-control rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm" aria-label="Filter by order status">
                        <option value="">All Order Status</option>
                        @foreach (['pending' => 'Pending', 'confirmed' => 'Confirmed', 'packed' => 'Packed', 'shipped' => 'Shipped', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled'] as $value => $label)
                            <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <select name="payment" class="order-filter-control rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm" aria-label="Filter by payment status">
                        <option value="">All Payment Status</option>
                        @foreach (['pending' => 'Pending', 'paid' => 'Paid', 'failed' => 'Failed', 'refunded' => 'Refunded'] as $value => $label)
                            <option value="{{ $value }}" @selected(request('payment') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <input name="date" value="{{ request('date') }}" class="order-filter-control rounded-lg border border-slate-200 px-3 py-2.5 text-sm" type="date" aria-label="Filter by order date">
                </div>
                <div class="flex gap-3">
                    <button class="order-filter-submit rounded-lg border border-slate-200 px-4 py-2.5 text-sm font-medium" type="submit">Filter</button>
                    @if (request()->hasAny(['status', 'payment', 'date']))
                        <a href="{{ route('dashboard.orders') }}" class="order-filter-reset rounded-lg px-4 py-2.5 text-sm font-medium">Clear</a>
                    @endif
                </div>
            </form>
        </section>

        <section class="order-table-card mt-4 overflow-hidden rounded-xl bg-white">
            <div class="space-y-3 p-3 sm:hidden">
                @forelse ($orders as $order)
                    @php($orderStatusStyles = ['pending' => 'bg-amber-100 text-amber-800', 'confirmed' => 'bg-blue-100 text-blue-800', 'packed' => 'bg-indigo-100 text-indigo-800', 'shipped' => 'bg-violet-100 text-violet-800', 'delivered' => 'bg-emerald-100 text-emerald-800', 'cancelled' => 'bg-rose-100 text-rose-800'])
                    <article class="order-mobile-card rounded-lg border border-slate-100 p-4">
                        <div class="flex items-start justify-between gap-3"><div class="min-w-0"><p class="text-xs text-slate-500">{{ $order->order_number }}</p><p class="font-semibold">{{ $order->customer_name }}</p><p class="truncate text-xs text-slate-500">{{ $order->email }}</p></div><span class="order-status-badge {{ $orderStatusStyles[$order->order_status] ?? 'bg-slate-100 text-slate-700' }}">{{ ucfirst($order->order_status) }}</span></div>
                        <div class="mt-3 grid gap-2 text-sm">
                            <p><span class="text-slate-500">Product:</span> {{ $order->items->first()?->product_name ?? 'Product unavailable' }}@if ($order->items_count > 1) <span class="text-xs text-slate-500">+{{ $order->items_count - 1 }} more</span>@endif</p>
                            <p><span class="text-slate-500">Total:</span> <strong>₹{{ number_format((float) $order->total, 2) }}</strong></p>
                            <p><span class="text-slate-500">Payment:</span> {{ strtoupper($order->payment_method) }} · {{ ucfirst($order->payment_status) }}</p>
                            <p class="text-xs text-slate-500">{{ $order->created_at->format('d M Y, h:i A') }}</p>
                        </div>
                        <form action="{{ route('dashboard.orders.update', $order) }}" method="POST" class="order-update-form mt-4 grid gap-2">
                            @csrf @method('PATCH')
                            <select name="order_status" class="order-action-control rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs" aria-label="Order status">
                                @foreach (['pending' => 'Pending', 'confirmed' => 'Confirmed', 'packed' => 'Packed', 'shipped' => 'Shipped', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled'] as $value => $label)<option value="{{ $value }}" @selected($order->order_status === $value)>{{ $label }}</option>@endforeach
                            </select>
                            <select name="payment_status" class="order-action-control rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs" aria-label="Payment status">
                                @foreach (['pending' => 'Payment Pending', 'paid' => 'Paid', 'failed' => 'Failed', 'refunded' => 'Refunded'] as $value => $label)<option value="{{ $value }}" @selected($order->payment_status === $value)>{{ $label }}</option>@endforeach
                            </select>
                            <button class="order-update-button rounded-lg px-3 py-2 text-xs font-semibold" type="submit">Update Order</button>
                        </form>
                    </article>
                @empty
                    <div class="order-empty-state"><span class="order-empty-icon"><svg viewBox="0 0 48 48" fill="none" aria-hidden="true"><path d="M8 12h4l4 21h20l5-15H15"/><circle cx="20" cy="39" r="2"/><circle cx="34" cy="39" r="2"/><path d="M22 22h10m-5-5v10"/></svg></span><strong>No orders yet</strong><span>Completed customer checkout orders will show here automatically.</span></div>
                @endforelse
            </div>

            <div class="hidden overflow-x-auto sm:block">
                <table class="order-table min-w-[1120px] w-full text-left text-sm">
                    <thead><tr><th class="px-4 py-3">#</th><th class="px-4 py-3">Order ID</th><th class="px-4 py-3">Customer</th><th class="px-4 py-3">Products</th><th class="px-4 py-3">Total</th><th class="px-4 py-3">Payment</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Date</th><th class="px-4 py-3">Action</th></tr></thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse ($orders as $order)
                            @php($orderStatusStyles = ['pending' => 'bg-amber-100 text-amber-800', 'confirmed' => 'bg-blue-100 text-blue-800', 'packed' => 'bg-indigo-100 text-indigo-800', 'shipped' => 'bg-violet-100 text-violet-800', 'delivered' => 'bg-emerald-100 text-emerald-800', 'cancelled' => 'bg-rose-100 text-rose-800'])
                            <tr>
                                <td class="px-4 py-3">{{ $orders->firstItem() + $loop->index }}</td>
                                <td class="px-4 py-3 font-semibold">{{ $order->order_number }}</td>
                                <td class="px-4 py-3"><p class="font-medium">{{ $order->customer_name }}</p><p class="text-xs text-slate-500">{{ $order->email }}</p></td>
                                <td class="px-4 py-3"><p>{{ $order->items->first()?->product_name ?? 'Product unavailable' }}</p>@if ($order->items_count > 1)<p class="mt-1 text-xs text-slate-500">+{{ $order->items_count - 1 }} more item(s)</p>@endif</td>
                                <td class="px-4 py-3 font-semibold">₹{{ number_format((float) $order->total, 2) }}</td>
                                <td class="px-4 py-3">{{ strtoupper($order->payment_method) }}<p class="mt-1 text-xs text-slate-500">{{ ucfirst($order->payment_status) }}</p></td>
                                <td class="px-4 py-3"><span class="order-status-badge {{ $orderStatusStyles[$order->order_status] ?? 'bg-slate-100 text-slate-700' }}">{{ ucfirst($order->order_status) }}</span></td>
                                <td class="px-4 py-3 text-xs">{{ $order->created_at->format('d M Y') }}<br><span class="text-slate-500">{{ $order->created_at->format('h:i A') }}</span></td>
                                <td class="px-4 py-3"><form action="{{ route('dashboard.orders.update', $order) }}" method="POST" class="order-update-form flex items-center gap-2">@csrf @method('PATCH')
                                    <select name="order_status" class="order-action-control rounded-lg border border-slate-200 bg-white px-2 py-2 text-xs" aria-label="Order status">@foreach (['pending' => 'Pending', 'confirmed' => 'Confirmed', 'packed' => 'Packed', 'shipped' => 'Shipped', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled'] as $value => $label)<option value="{{ $value }}" @selected($order->order_status === $value)>{{ $label }}</option>@endforeach</select>
                                    <select name="payment_status" class="order-action-control rounded-lg border border-slate-200 bg-white px-2 py-2 text-xs" aria-label="Payment status">@foreach (['pending' => 'Payment Pending', 'paid' => 'Paid', 'failed' => 'Failed', 'refunded' => 'Refunded'] as $value => $label)<option value="{{ $value }}" @selected($order->payment_status === $value)>{{ $label }}</option>@endforeach</select>
                                    <button class="order-update-button rounded-lg px-3 py-2 text-xs font-semibold" type="submit">Update</button>
                                </form></td>
                            </tr>
                        @empty
                            <tr><td colspan="9" class="px-4 py-3"><div class="order-empty-state"><span class="order-empty-icon"><svg viewBox="0 0 48 48" fill="none" aria-hidden="true"><path d="M8 12h4l4 21h20l5-15H15"/><circle cx="20" cy="39" r="2"/><circle cx="34" cy="39" r="2"/><path d="M22 22h10m-5-5v10"/></svg></span><strong>No orders yet</strong><span>Completed customer checkout orders will show here automatically.</span></div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="order-table-footer flex flex-col gap-3 border-t border-slate-100 px-4 py-3 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                <p>Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of {{ $orders->total() }} orders</p>{{ $orders->onEachSide(1)->links() }}
            </div>
        </section>
    </main>
@endsection
