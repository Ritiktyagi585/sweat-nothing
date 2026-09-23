@extends('layout.dashboard')

@section('title', 'Orders | Sweat Nothing')

@section('content')
    <main class="mx-auto max-w-[1500px] p-5 lg:p-7">
        <section class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <h1 class="text-2xl font-bold tracking-[-.03em]">Orders</h1>
                <p class="mt-1 text-slate-500">Website checkout orders appear here automatically.</p>
            </div>
            <nav class="flex items-center gap-2 text-sm text-slate-500" aria-label="Breadcrumb"><a href="{{ route('dashboard') }}" class="hover:text-black">Dashboard</a><span>›</span><span>Orders</span></nav>
        </section>
        {{-- Orders heading section ends here. --}}

        <section class="mt-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <article class="rounded-xl bg-white p-5 shadow-sm"><div class="flex items-center gap-4"><span class="grid h-14 w-14 place-items-center rounded-full bg-[#fff3cf] text-2xl">🛒</span><div><p class="text-xs text-slate-500">Total Orders</p><p class="mt-1 text-2xl font-bold">{{ $orderStats['total'] }}</p><p class="mt-1 text-xs text-slate-500">From website checkout</p></div></div></article>
            <article class="rounded-xl bg-white p-5 shadow-sm"><div class="flex items-center gap-4"><span class="grid h-14 w-14 place-items-center rounded-full bg-[#fff0cc] text-2xl">◷</span><div><p class="text-xs text-slate-500">Pending Orders</p><p class="mt-1 text-2xl font-bold">{{ $orderStats['pending'] }}</p><p class="mt-1 text-xs text-amber-700">Needs processing</p></div></div></article>
            <article class="rounded-xl bg-white p-5 shadow-sm"><div class="flex items-center gap-4"><span class="grid h-14 w-14 place-items-center rounded-full bg-[#dff7e6] text-2xl">₹</span><div><p class="text-xs text-slate-500">COD Orders</p><p class="mt-1 text-2xl font-bold">{{ $orderStats['cod'] }}</p><p class="mt-1 text-xs text-emerald-700">Payment pending</p></div></div></article>
            <article class="rounded-xl bg-white p-5 shadow-sm"><div class="flex items-center gap-4"><span class="grid h-14 w-14 place-items-center rounded-full bg-[#e2efff] text-2xl">₹</span><div><p class="text-xs text-slate-500">Order Value</p><p class="mt-1 text-2xl font-bold">₹{{ number_format((float) $orderStats['revenue'], 2) }}</p><p class="mt-1 text-xs text-slate-500">All placed orders</p></div></div></article>
        </section>
        {{-- Order statistics section ends here. --}}

        <section class="mt-5 overflow-hidden rounded-xl bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-[1000px] w-full text-left text-sm">
                    <thead class="bg-[#f5f7f9] text-xs font-semibold text-slate-800"><tr><th class="px-4 py-3">#</th><th class="px-4 py-3">Order ID</th><th class="px-4 py-3">Customer</th><th class="px-4 py-3">Products</th><th class="px-4 py-3">Total</th><th class="px-4 py-3">Payment</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Date</th></tr></thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse ($orders as $index => $order)
                            <tr>
                                <td class="px-4 py-4">{{ $index + 1 }}</td>
                                <td class="px-4 py-4 font-semibold">{{ $order->order_number }}</td>
                                <td class="px-4 py-4"><p class="font-medium">{{ $order->customer_name }}</p><p class="text-xs text-slate-500">{{ $order->email }}</p></td>
                                <td class="px-4 py-4"><p>{{ $order->items->first()?->product_name ?? 'Product unavailable' }}</p>@if ($order->items_count > 1)<p class="mt-1 text-xs text-slate-500">+{{ $order->items_count - 1 }} more item(s)</p>@endif</td>
                                <td class="px-4 py-4 font-semibold">₹{{ number_format((float) $order->total, 2) }}</td>
                                <td class="px-4 py-4">{{ strtoupper($order->payment_method) }}<p class="mt-1 text-xs text-amber-700">{{ ucfirst($order->payment_status) }}</p></td>
                                <td class="px-4 py-4"><span class="rounded-md px-3 py-2 text-xs font-medium {{ $order->order_status === 'pending' ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800' }}">{{ ucfirst($order->order_status) }}</span></td>
                                <td class="px-4 py-4 text-xs">{{ $order->created_at->format('d M Y') }}<br><span class="text-slate-500">{{ $order->created_at->format('h:i A') }}</span></td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="px-4 py-12 text-center text-slate-500">No website orders yet. Completed customer checkout orders will show here.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="border-t border-slate-100 px-4 py-4 text-sm text-slate-500">Showing {{ $orders->count() }} {{ $orders->count() === 1 ? 'order' : 'orders' }} from the website.</div>
        </section>
        {{-- Website order table section ends here. --}}
    </main>
@endsection
