@extends('layout.dashboard')

@section('title', 'Dashboard | Sweat Nothing')

@section('content')
    <main class="dashboard-overview mx-auto max-w-[1500px] p-5 lg:p-7">
        <section class="dashboard-overview-head flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <p class="dashboard-greeting">Good {{ now()->hour < 12 ? 'Morning' : (now()->hour < 18 ? 'Afternoon' : 'Evening') }}!</p>
                <h1 class="dashboard-overview-title">Welcome Back, {{ auth()->user()?->name ?? 'Admin' }}!</h1>
                <p class="dashboard-overview-subtitle">Here's a live overview of your store.</p>
            </div>
            <p class="dashboard-date"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18"/></svg>{{ now()->format('l, d M Y') }}</p>
        </section>

        <section class="dashboard-stat-grid mt-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <article class="dashboard-stat-card"><div class="flex items-center gap-4"><span class="dashboard-stat-icon bg-[#fff3cf]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M5 8h14l1 12H4L5 8Z"/><path d="M9 9V6a3 3 0 0 1 6 0v3"/></svg></span><div><p class="dashboard-stat-label">Today's Orders</p><p class="dashboard-stat-count">{{ $dashboardStats['todayOrders'] }}</p><p class="dashboard-stat-caption">Placed today</p></div></div></article>
            <article class="dashboard-stat-card"><div class="flex items-center gap-4"><span class="dashboard-stat-icon bg-[#dff7e6]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="m12 3 8.5 4.5v9L12 21l-8.5-4.5v-9L12 3Z"/><path d="m3.8 7.7 8.2 4.5 8.2-4.5M12 12.2V21"/></svg></span><div><p class="dashboard-stat-label">Total Orders</p><p class="dashboard-stat-count">{{ $dashboardStats['totalOrders'] }}</p><p class="dashboard-stat-caption text-emerald-600">From website checkout</p></div></div></article>
            <article class="dashboard-stat-card"><div class="flex items-center gap-4"><span class="dashboard-stat-icon bg-[#e2efff]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="m12 3 8.5 4.5v9L12 21l-8.5-4.5v-9L12 3Z"/><path d="m3.8 7.7 8.2 4.5 8.2-4.5M12 12.2V21"/></svg></span><div><p class="dashboard-stat-label">Total Products</p><p class="dashboard-stat-count">{{ $dashboardStats['totalProducts'] }}</p><p class="dashboard-stat-caption">In product database</p></div></div></article>
            <article class="dashboard-stat-card"><div class="flex items-center gap-4"><span class="dashboard-stat-icon bg-[#ffe3e3] text-[#b80000]"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 3v18m5-14H9a3 3 0 0 0 0 6h6a3 3 0 0 1 0 6H7"/></svg></span><div><p class="dashboard-stat-label">Total Revenue</p><p class="dashboard-stat-count">₹{{ number_format((float) $dashboardStats['totalRevenue'], 2) }}</p><p class="dashboard-stat-caption">Excluding cancelled orders</p></div></div></article>
        </section>

        <section class="dashboard-overview-panels mt-4 grid gap-4 xl:grid-cols-[1.35fr_.95fr]">
            <article class="dashboard-panel">
                <div class="flex items-center justify-between gap-4"><div><h2 class="dashboard-panel-title">Orders Overview</h2><p class="dashboard-panel-subtitle">Orders received in the last 7 days</p></div><span class="dashboard-period-pill">Last 7 Days</span></div>
                <div class="dashboard-chart mt-5 grid grid-cols-7 items-end gap-3 border-b border-slate-200 px-2">
                    @foreach ($orderChart as $day)
                        <div class="dashboard-chart-column flex h-full flex-col justify-end text-center"><span class="mb-2 text-xs font-semibold text-slate-600">{{ $day['count'] }}</span><div class="dashboard-chart-bar rounded-t-lg bg-[#ffd400] transition hover:bg-[#e9c300]" style="height: {{ max(4, $day['height']) }}%"></div><span class="mt-2 whitespace-nowrap text-[11px] text-slate-500">{{ $day['label'] }}</span></div>
                    @endforeach
                </div>
            </article>

            <article class="dashboard-panel">
                <div class="flex items-center justify-between"><h2 class="dashboard-panel-title">Recent Orders</h2><a href="{{ route('dashboard.orders') }}" class="dashboard-view-all">View All</a></div>
                <div class="dashboard-recent-list mt-3">
                    @forelse ($recentOrders as $order)
                        <div class="dashboard-recent-order"><span class="dashboard-recent-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path d="m12 3 8.5 4.5v9L12 21l-8.5-4.5v-9L12 3Z"/><path d="m3.8 7.7 8.2 4.5 8.2-4.5M12 12.2V21"/></svg></span><div class="min-w-0 flex-1"><p class="truncate font-medium">{{ $order->order_number }}</p><p class="truncate text-xs text-slate-500">{{ $order->created_at->format('d M Y, h:i A') }}</p></div><p class="shrink-0 font-semibold">₹{{ number_format((float) $order->total, 2) }}</p><span class="dashboard-order-status {{ $order->order_status === 'pending' ? 'is-pending' : 'is-complete' }}">{{ ucfirst($order->order_status) }}</span></div>
                    @empty
                        <div class="dashboard-empty-state"><span class="dashboard-empty-icon"><svg viewBox="0 0 48 48" fill="none" aria-hidden="true"><path d="M8 12h4l4 21h20l5-15H15"/><circle cx="20" cy="39" r="2"/><circle cx="34" cy="39" r="2"/></svg></span><strong>No orders yet</strong><span>Completed website orders will appear here.</span></div>
                    @endforelse
                </div>
            </article>
        </section>

        <section class="dashboard-overview-bottom mt-4 grid gap-4 xl:grid-cols-[1.05fr_.95fr]">
            <article class="dashboard-promo-card"><img src="{{ asset('images/dashboard-promo.png') }}" alt="Natural sweetener jar" class="absolute inset-0 h-full w-full object-cover opacity-75"><div class="absolute inset-0 bg-gradient-to-r from-black via-black/75 to-transparent"></div><div class="relative z-10 max-w-52"><p class="text-2xl font-bold tracking-[-.08em]">SWEET</p><p class="font-serif text-2xl font-semibold italic text-[#ffd400]">nothing.</p><p class="mt-4 text-lg font-medium leading-tight">Goodness in<br>Every Drop.</p><div class="mt-4 h-1 w-24 rounded-full bg-[#ffd400]"></div></div></article>
            <article class="dashboard-panel"><h2 class="dashboard-panel-title">Quick Actions</h2><div class="dashboard-quick-grid mt-4 grid gap-3 sm:grid-cols-2">
                <a href="{{ route('dashboard.enquiries') }}" class="dashboard-quick-action bg-[#fff6d8]"><span class="dashboard-quick-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/></svg></span>View Enquiries</a>
                <a href="{{ route('dashboard.orders') }}" class="dashboard-quick-action bg-[#dff7e6]"><span class="dashboard-quick-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M5 8h14l1 12H4L5 8Z"/><path d="M9 9V6a3 3 0 0 1 6 0v3"/></svg></span>Manage Orders</a>
                <a href="{{ route('dashboard.products') }}" class="dashboard-quick-action bg-[#e3efff]"><span class="dashboard-quick-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="m12 3 8.5 4.5v9L12 21l-8.5-4.5v-9L12 3Z"/><path d="m3.8 7.7 8.2 4.5 8.2-4.5M12 12.2V21"/></svg></span>Manage Products</a>
                <a href="{{ route('dashboard.settings') }}" class="dashboard-quick-action bg-[#ffe5e5]"><span class="dashboard-quick-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="12" r="3"/><path d="m19.4 15 1.1.9-1.5 2.6-1.4-.6a8 8 0 0 1-1.6.9l-.2 1.5h-3l-.4-1.5a8 8 0 0 1-1.6-.9l-1.4.6-1.5-2.6L7 15a8 8 0 0 1 0-1.8l-1.1-.9 1.5-2.6 1.4.6a8 8 0 0 1 1.6-.9l.2-1.5h3l.4 1.5a8 8 0 0 1 1.6.9l1.4-.6 1.5 2.6-1.1.9a8 8 0 0 1 0 1.8Z"/></svg></span>Site Settings</a>
            </div></article>
        </section>
    </main>
@endsection
