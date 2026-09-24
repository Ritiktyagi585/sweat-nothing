<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'Dashboard | Sweat Nothing')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#f7f8fa] font-sans text-[15px] font-normal text-[#121212] antialiased">
        <div class="min-h-screen lg:grid lg:grid-cols-[260px_1fr]">
            <div id="dashboard-sidebar-backdrop" class="fixed inset-0 z-40 hidden bg-black/50 lg:hidden"></div>

            <aside id="dashboard-sidebar" class="fixed inset-y-0 left-0 z-50 flex w-[260px] -translate-x-full flex-col overflow-y-auto bg-[#101111] text-white transition-transform duration-200 lg:sticky lg:top-0 lg:h-screen lg:w-auto lg:translate-x-0 lg:self-start">
                <a href="{{ route('dashboard') }}" class="px-7 py-6 leading-none lg:px-9 lg:py-8" aria-label="Ayurth dashboard home">
                    <span class="inline-flex rounded-lg bg-white p-2">
                        <img class="h-9 w-auto" src="{{ asset('images/ayurth-logo.png') }}" alt="Ayurth.com">
                    </span>
                </a>

                <nav class="flex w-full flex-col gap-2 px-4 py-2 text-[13px] lg:py-4" aria-label="Dashboard navigation">
                    <a href="{{ route('dashboard') }}" class="rounded-lg px-5 py-4 transition hover:bg-white/10 {{ request()->routeIs('dashboard') ? 'bg-[#ffd400] font-semibold text-black hover:bg-[#ffd400]' : '' }}">&#8962; <span class="ml-3">Dashboard</span></a>
                    <a href="{{ route('dashboard.enquiries') }}" class="rounded-lg px-5 py-4 transition hover:bg-white/10 {{ request()->routeIs('dashboard.enquiries') ? 'bg-[#ffd400] font-semibold text-black hover:bg-[#ffd400]' : '' }}">&#9993; <span class="ml-3">Enquiries</span></a>
                    <a href="{{ route('dashboard.orders') }}" class="rounded-lg px-5 py-4 transition hover:bg-white/10 {{ request()->routeIs('dashboard.orders') ? 'bg-[#ffd400] font-semibold text-black hover:bg-[#ffd400]' : '' }}">&#128722; <span class="ml-3">Orders</span></a>
                    <a href="{{ route('admin.products.index') }}" class="rounded-lg px-5 py-4 transition hover:bg-white/10 {{ request()->routeIs('admin.products.*') ? 'bg-[#ffd400] font-semibold text-black hover:bg-[#ffd400]' : '' }}">&#9632; <span class="ml-3">Product</span></a>
                    <a href="{{ route('dashboard.settings') }}" class="rounded-lg px-5 py-4 transition hover:bg-white/10 {{ request()->routeIs('dashboard.settings') ? 'bg-[#ffd400] font-semibold text-black hover:bg-[#ffd400]' : '' }}">&#9881; <span class="ml-3">Settings</span></a>
                </nav>

                <div class="mt-auto border-t border-white/10 px-4 py-4">
                    <a href="{{ route('home') }}" class="block rounded-lg px-5 py-3 text-sm transition hover:bg-white/10 hover:text-[#ffd400]">&#8592; Back to Website</a>
                    <form action="{{ route('dashboard.logout') }}" method="POST" class="mt-1">@csrf<button class="block w-full rounded-lg px-5 py-3 text-left text-sm text-red-300 transition hover:bg-red-500/10 hover:text-red-200">&#10162; Logout</button></form>
                </div>
            </aside>

            <div class="min-w-0">
                <header class="sticky top-0 z-20 flex min-h-16 items-center justify-between border-b border-black/5 bg-white px-4 py-3 sm:min-h-20 sm:px-5 sm:py-4 lg:px-8">
                    <button id="dashboard-menu-toggle" type="button" class="grid h-10 w-10 place-items-center rounded-lg border border-black/10 text-xl transition hover:bg-slate-100 lg:hidden" aria-label="Open dashboard menu" aria-controls="dashboard-sidebar" aria-expanded="false">
                        &#9776;
                    </button>
                    <label class="hidden max-w-md flex-1 items-center gap-3 rounded-xl bg-[#f4f5f7] px-4 py-3 text-sm text-slate-500 sm:flex">
                        <span class="text-xl text-black">&#9906;</span>
                        <input class="w-full bg-transparent outline-none" type="search" placeholder="Search orders, products, enquiries...">
                    </label>

                    <div class="ml-auto flex items-center gap-2 sm:gap-4">
                        <button class="relative grid h-10 w-10 place-items-center rounded-full transition hover:bg-slate-100" aria-label="Notifications">
                            <span class="text-2xl">&#128276;</span>
                            <span class="absolute right-2 top-1 h-2.5 w-2.5 rounded-full bg-[#ffd400]"></span>
                        </button>
                        <div class="hidden h-10 w-px bg-black/10 sm:block"></div>
                        <div class="grid h-10 w-10 place-items-center rounded-full bg-[#ffe88b] text-base font-bold sm:h-11 sm:w-11 sm:text-lg">RT</div>
                        <div class="hidden sm:block"><p class="font-semibold leading-none">Ritik Tyagi</p><p class="mt-1 text-xs text-slate-500">Admin</p></div>
                        <span class="hidden text-slate-500 sm:block">&#8964;</span>
                    </div>
                </header>

                @yield('content')
            </div>
        </div>
        <script>
            const dashboardMenuToggle = document.getElementById('dashboard-menu-toggle');
            const dashboardSidebar = document.getElementById('dashboard-sidebar');
            const dashboardSidebarBackdrop = document.getElementById('dashboard-sidebar-backdrop');

            const closeDashboardMenu = () => {
                dashboardSidebar.classList.add('-translate-x-full');
                dashboardSidebarBackdrop.classList.add('hidden');
                dashboardMenuToggle.setAttribute('aria-expanded', 'false');
                dashboardMenuToggle.setAttribute('aria-label', 'Open dashboard menu');
            };

            dashboardMenuToggle.addEventListener('click', () => {
                const isOpen = dashboardSidebar.classList.toggle('-translate-x-full') === false;

                dashboardSidebarBackdrop.classList.toggle('hidden', !isOpen);
                dashboardMenuToggle.setAttribute('aria-expanded', String(isOpen));
                dashboardMenuToggle.setAttribute('aria-label', isOpen ? 'Close dashboard menu' : 'Open dashboard menu');
            });

            dashboardSidebarBackdrop.addEventListener('click', closeDashboardMenu);
        </script>
    </body>
</html>
