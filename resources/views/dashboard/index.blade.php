@extends('layout.dashboard')

@section('title', 'Dashboard | Sweat Nothing')

@section('content')
    <main class="mx-auto max-w-[1500px] p-5 lg:p-7">
        <section class="flex flex-col justify-between gap-5 md:flex-row md:items-end">
            <div>
                <p class="text-slate-500">Good {{ now()->hour < 12 ? 'Morning' : (now()->hour < 18 ? 'Afternoon' : 'Evening') }}!</p>
                <h1 class="mt-1 text-2xl font-bold tracking-[-.03em] sm:text-3xl">Welcome Back, Ritik!</h1>
                <p class="mt-2 text-slate-500">Here's a live overview of your store.</p>
            </div>
            <p class="rounded-lg bg-white px-4 py-3 text-sm text-slate-500 shadow-sm">📅 {{ now()->format('l, d M Y') }}</p>
        </section>
        {{-- Dashboard heading section ends here. --}}

        <section class="mt-7 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <article class="rounded-2xl bg-white p-5 shadow-sm"><div class="flex items-center gap-4"><span class="grid h-16 w-16 place-items-center rounded-full bg-[#fff3cf] text-3xl">🛒</span><div><p class="text-xs text-slate-500">Today's Orders</p><p class="mt-1 text-2xl font-bold">{{ $dashboardStats['todayOrders'] }}</p><p class="mt-1 text-xs text-slate-500">Placed today</p></div></div></article>
            <article class="rounded-2xl bg-white p-5 shadow-sm"><div class="flex items-center gap-4"><span class="grid h-16 w-16 place-items-center rounded-full bg-[#dcf7e3] text-3xl">📦</span><div><p class="text-xs text-slate-500">Total Orders</p><p class="mt-1 text-2xl font-bold">{{ $dashboardStats['totalOrders'] }}</p><p class="mt-1 text-xs text-emerald-600">From website checkout</p></div></div></article>
            <article class="rounded-2xl bg-white p-5 shadow-sm"><div class="flex items-center gap-4"><span class="grid h-16 w-16 place-items-center rounded-full bg-[#e2efff] text-3xl">◼</span><div><p class="text-xs text-slate-500">Total Products</p><p class="mt-1 text-2xl font-bold">{{ $dashboardStats['totalProducts'] }}</p><p class="mt-1 text-xs text-slate-500">In product database</p></div></div></article>
            <article class="rounded-2xl bg-white p-5 shadow-sm"><div class="flex items-center gap-4"><span class="grid h-16 w-16 place-items-center rounded-full bg-[#ffe3e3] text-3xl font-black text-[#b80000]">₹</span><div><p class="text-xs text-slate-500">Total Revenue</p><p class="mt-1 text-2xl font-bold">₹{{ number_format((float) $dashboardStats['totalRevenue'], 2) }}</p><p class="mt-1 text-xs text-slate-500">Excluding cancelled orders</p></div></div></article>
        </section>
        {{-- Live statistics section ends here. --}}

        <section class="mt-5 grid gap-5 xl:grid-cols-[1.35fr_.95fr]">
            <article class="rounded-2xl bg-white p-5 shadow-sm lg:p-6">
                <div class="flex items-center justify-between gap-4"><div><h2 class="text-lg font-semibold">Orders Overview</h2><p class="mt-1 text-xs text-slate-500">Orders received in the last 7 days</p></div><span class="rounded-lg border border-black/10 px-3 py-2 text-xs">Last 7 Days</span></div>
                <div class="mt-6 grid h-64 grid-cols-7 items-end gap-3 border-b border-slate-200 px-2">
                    @foreach ($orderChart as $day)
                        <div class="flex h-full flex-col justify-end text-center">
                            <span class="mb-2 text-xs font-semibold text-slate-600">{{ $day['count'] }}</span>
                            <div class="rounded-t-lg bg-[#ffd400] transition hover:bg-[#e9c300]" style="height: {{ $day['height'] }}%"></div>
                            <span class="mt-3 whitespace-nowrap text-[11px] text-slate-500">{{ $day['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </article>

            <article class="rounded-2xl bg-white p-5 shadow-sm lg:p-6">
                <div class="flex items-center justify-between"><h2 class="text-lg font-semibold">Recent Orders</h2><a href="{{ route('dashboard.orders') }}" class="text-xs font-medium hover:underline">View All</a></div>
                <div class="mt-4 space-y-3">
                    @forelse ($recentOrders as $order)
                        <div class="flex items-center gap-3 border-b border-black/5 pb-3 last:border-0">
                            <span class="grid h-10 w-10 place-items-center rounded-lg bg-[#fff4cc] text-lg">📦</span>
                            <div class="min-w-0 flex-1"><p class="font-medium">{{ $order->order_number }}</p><p class="truncate text-xs text-slate-500">{{ $order->created_at->format('d M Y, h:i A') }}</p></div>
                            <p class="font-semibold">₹{{ number_format((float) $order->total, 2) }}</p>
                            <span class="hidden rounded-lg px-3 py-2 text-xs font-medium sm:block {{ $order->order_status === 'pending' ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800' }}">{{ ucfirst($order->order_status) }}</span>
                        </div>
                    @empty
                        <p class="py-10 text-center text-sm text-slate-500">No orders received yet.</p>
                    @endforelse
                </div>
            </article>
        </section>
        {{-- Dynamic chart and recent orders section ends here. --}}

        <section class="mt-5 grid gap-5 xl:grid-cols-[1.05fr_.95fr]">
            <article class="relative min-h-60 overflow-hidden rounded-2xl bg-[#131313] p-7 text-white shadow-sm"><img src="{{ asset('images/dashboard-promo.png') }}" alt="Natural sweetener jar" class="absolute inset-0 h-full w-full object-cover opacity-75"><div class="absolute inset-0 bg-gradient-to-r from-black via-black/75 to-transparent"></div><div class="relative z-10 max-w-52"><p class="text-2xl font-bold tracking-[-.08em]">SWEAT</p><p class="font-serif text-2xl font-semibold italic text-[#ffd400]">nothing.</p><p class="mt-5 text-lg font-medium leading-tight">Goodness in<br>Every Drop.</p><div class="mt-5 h-1 w-24 rounded-full bg-[#ffd400]"></div></div></article>

            <article class="rounded-2xl bg-white p-5 shadow-sm lg:p-6"><h2 class="text-lg font-semibold">Quick Actions</h2><div class="mt-4 grid gap-3 sm:grid-cols-2"><a href="{{ route('dashboard.enquiries') }}" class="rounded-xl bg-[#fff6d8] p-5 text-center font-medium transition hover:-translate-y-0.5"><span class="mb-2 block text-2xl">✉</span>View Enquiries</a><a href="{{ route('dashboard.orders') }}" class="rounded-xl bg-[#dff7e6] p-5 text-center font-medium transition hover:-translate-y-0.5"><span class="mb-2 block text-2xl">🛒</span>Manage Orders</a><a href="{{ route('dashboard.products') }}" class="rounded-xl bg-[#e3efff] p-5 text-center font-medium transition hover:-translate-y-0.5"><span class="mb-2 block text-2xl">◼</span>Manage Products</a><a href="#" class="rounded-xl bg-[#ffe5e5] p-5 text-center font-medium transition hover:-translate-y-0.5"><span class="mb-2 block text-2xl">⚙</span>Site Settings</a></div></article>
        </section>
        {{-- Dashboard quick actions section ends here. --}}
    </main>
@endsection
