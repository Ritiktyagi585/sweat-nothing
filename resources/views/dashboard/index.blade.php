@extends('layout.dashboard')

@section('title', 'Dashboard | Sweat Nothing')

@section('content')
    <main class="mx-auto max-w-[1500px] p-5 lg:p-9">
        <section class="flex flex-col justify-between gap-5 md:flex-row md:items-end">
            <div>
                <p class="text-slate-500">Good Afternoon!</p>
                <h1 class="mt-1 text-2xl font-bold tracking-[-.03em] sm:text-3xl">Welcome Back, Ritik!</h1>
                <p class="mt-2 text-slate-500">Here's an overview of your store today.</p>
            </div>
            <p class="rounded-lg bg-white px-4 py-3 text-sm text-slate-500 shadow-sm">&#128197; Monday, 21 Sep 2026</p>
        </section>

        <section class="mt-7 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <article class="rounded-2xl bg-white p-5 shadow-sm">
                <div class="flex items-center gap-4">
                    <span class="grid h-16 w-16 place-items-center rounded-full bg-[#fff3cf] text-3xl">&#9993;</span>
                    <div><p class="text-xs text-slate-500">Total Enquiries</p><p class="mt-1 text-2xl font-bold">24</p><p class="mt-1 text-xs text-emerald-600">&#8593; +20% <span class="text-slate-500">vs last month</span></p></div>
                </div>
            </article>

            <article class="rounded-2xl bg-white p-5 shadow-sm">
                <div class="flex items-center gap-4">
                    <span class="grid h-16 w-16 place-items-center rounded-full bg-[#dcf7e3] text-3xl">&#128722;</span>
                    <div><p class="text-xs text-slate-500">Total Orders</p><p class="mt-1 text-2xl font-bold">142</p><p class="mt-1 text-xs text-emerald-600">&#8593; +15% <span class="text-slate-500">vs last month</span></p></div>
                </div>
            </article>

            <article class="rounded-2xl bg-white p-5 shadow-sm">
                <div class="flex items-center gap-4">
                    <span class="grid h-16 w-16 place-items-center rounded-full bg-[#e2efff] text-3xl">&#9632;</span>
                    <div><p class="text-xs text-slate-500">Total Products</p><p class="mt-1 text-2xl font-bold">86</p><p class="mt-1 text-xs text-emerald-600">&#8593; +8% <span class="text-slate-500">vs last month</span></p></div>
                </div>
            </article>

            <article class="rounded-2xl bg-white p-5 shadow-sm">
                <div class="flex items-center gap-4">
                    <span class="grid h-16 w-16 place-items-center rounded-full bg-[#ffe3e3] text-3xl font-black text-[#b80000]">₹</span>
                    <div><p class="text-xs text-slate-500">Total Revenue</p><p class="mt-1 text-2xl font-bold">₹ 1,24,350</p><p class="mt-1 text-xs text-emerald-600">&#8593; +18% <span class="text-slate-500">vs last month</span></p></div>
                </div>
            </article>
        </section>

        <section class="mt-5 grid gap-5 xl:grid-cols-[1.35fr_.95fr]">
            <article class="rounded-2xl bg-white p-5 shadow-sm lg:p-6">
                <div class="flex items-center justify-between gap-4"><h2 class="text-lg font-semibold">Orders Overview</h2><button class="rounded-lg border border-black/10 px-3 py-2 text-xs">Last 7 Days &#8964;</button></div>
                <div class="mt-6 overflow-x-auto">
                    <svg viewBox="0 0 670 250" class="min-w-[620px] w-full" role="img" aria-label="Order chart for the last seven days">
                        <defs><linearGradient id="chart-fill" x1="0" x2="0" y1="0" y2="1"><stop offset="0" stop-color="#ffd400" stop-opacity=".28"/><stop offset="1" stop-color="#ffd400" stop-opacity=".02"/></linearGradient></defs>
                        <g stroke="#e8edf2" stroke-width="1"><line x1="40" y1="25" x2="650" y2="25"/><line x1="40" y1="75" x2="650" y2="75"/><line x1="40" y1="125" x2="650" y2="125"/><line x1="40" y1="175" x2="650" y2="175"/><line x1="40" y1="210" x2="650" y2="210"/></g>
                        <path d="M40 185 L140 145 L240 115 L340 133 L440 90 L540 115 L640 50 L640 210 L40 210 Z" fill="url(#chart-fill)"/>
                        <path d="M40 185 L140 145 L240 115 L340 133 L440 90 L540 115 L640 50" fill="none" stroke="#f4c900" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                        <g fill="#f4c900"><circle cx="40" cy="185" r="6"/><circle cx="140" cy="145" r="6"/><circle cx="240" cy="115" r="6"/><circle cx="340" cy="133" r="6"/><circle cx="440" cy="90" r="6"/><circle cx="540" cy="115" r="6"/><circle cx="640" cy="50" r="6"/></g>
                        <g fill="#64748b" font-size="13"><text x="7" y="30">40</text><text x="7" y="80">30</text><text x="7" y="130">20</text><text x="7" y="180">10</text><text x="20" y="215">0</text><text x="25" y="240">15 Sep</text><text x="120" y="240">16 Sep</text><text x="220" y="240">17 Sep</text><text x="320" y="240">18 Sep</text><text x="420" y="240">19 Sep</text><text x="520" y="240">20 Sep</text><text x="615" y="240">21 Sep</text></g>
                    </svg>
                </div>
            </article>

            <article class="rounded-2xl bg-white p-5 shadow-sm lg:p-6">
                <div class="flex items-center justify-between"><h2 class="text-lg font-semibold">Recent Orders</h2><a href="#" class="text-xs font-medium">View All</a></div>
                <div class="mt-4 space-y-3">
                    @foreach ([['#ORD-1001', '21 Sep 2026, 11:45 AM', '₹ 2,450', 'Delivered', 'bg-emerald-100 text-emerald-700'], ['#ORD-1000', '21 Sep 2026, 10:20 AM', '₹ 890', 'Processing', 'bg-amber-100 text-amber-800'], ['#ORD-0999', '20 Sep 2026, 06:15 PM', '₹ 1,320', 'Shipped', 'bg-blue-100 text-blue-800'], ['#ORD-0998', '20 Sep 2026, 02:40 PM', '₹ 650', 'Delivered', 'bg-emerald-100 text-emerald-700'], ['#ORD-0997', '19 Sep 2026, 01:12 PM', '₹ 2,100', 'Cancelled', 'bg-red-100 text-red-700']] as [$number, $date, $amount, $status, $statusClass])
                        <div class="flex items-center gap-3 border-b border-black/5 pb-3 last:border-0">
                            <span class="grid h-10 w-10 place-items-center rounded-lg bg-[#fff4cc] text-lg">&#129526;</span>
                            <div class="min-w-0 flex-1"><p class="font-medium">{{ $number }}</p><p class="truncate text-xs text-slate-500">{{ $date }}</p></div>
                            <p class="font-semibold">{{ $amount }}</p>
                            <span class="hidden rounded-lg px-3 py-2 text-xs font-medium sm:block {{ $statusClass }}">{{ $status }}</span>
                        </div>
                    @endforeach
                </div>
            </article>
        </section>

        <section class="mt-5 grid gap-5 xl:grid-cols-[1.05fr_.95fr]">
            <article class="relative min-h-60 overflow-hidden rounded-2xl bg-[#131313] p-7 text-white shadow-sm">
                <img src="{{ asset('images/dashboard-promo.png') }}" alt="Natural sweetener jar" class="absolute inset-0 h-full w-full object-cover opacity-75">
                <div class="absolute inset-0 bg-gradient-to-r from-black via-black/75 to-transparent"></div>
                <div class="relative z-10 max-w-52"><p class="text-2xl font-bold tracking-[-.08em]">SWEAT</p><p class="font-serif text-2xl font-semibold italic text-[#ffd400]">nothing.</p><p class="mt-5 text-lg font-medium leading-tight">Goodness in<br>Every Drop.</p><div class="mt-5 h-1 w-24 rounded-full bg-[#ffd400]"></div></div>
            </article>

            <article class="rounded-2xl bg-white p-5 shadow-sm lg:p-6">
                <h2 class="text-lg font-semibold">Quick Actions</h2>
                <div class="mt-4 grid gap-3 sm:grid-cols-2">
                    <a href="#" class="rounded-xl bg-[#fff6d8] p-5 text-center font-medium transition hover:-translate-y-0.5"><span class="mb-2 block text-2xl">&#9993;</span>View Enquiries</a>
                    <a href="#" class="rounded-xl bg-[#dff7e6] p-5 text-center font-medium transition hover:-translate-y-0.5"><span class="mb-2 block text-2xl">&#128722;</span>Manage Orders</a>
                    <a href="#" class="rounded-xl bg-[#e3efff] p-5 text-center font-medium transition hover:-translate-y-0.5"><span class="mb-2 block text-2xl">&#9632;</span>Manage Products</a>
                    <a href="#" class="rounded-xl bg-[#ffe5e5] p-5 text-center font-medium transition hover:-translate-y-0.5"><span class="mb-2 block text-2xl">&#9881;</span>Site Settings</a>
                </div>
            </article>
        </section>
    </main>
@endsection
