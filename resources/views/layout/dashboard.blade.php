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
            <aside class="flex bg-[#101111] text-white lg:sticky lg:top-0 lg:h-screen lg:self-start lg:flex-col lg:overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="hidden px-9 py-8 leading-none lg:block" aria-label="Sweat Nothing dashboard home">
                    <img class="h-16 w-auto" src="{{ asset('images/brand-logo.png') }}" alt="Sweat Nothing">
                </a>

                <nav class="flex w-full gap-2 overflow-x-auto px-4 py-3 text-[13px] lg:flex-col lg:px-4 lg:py-4" aria-label="Dashboard navigation">
                    <a href="{{ route('dashboard') }}" class="shrink-0 rounded-lg px-5 py-4 transition hover:bg-white/10 {{ request()->routeIs('dashboard') ? 'bg-[#ffd400] font-semibold text-black hover:bg-[#ffd400]' : '' }}">&#8962; <span class="ml-3">Dashboard</span></a>
                    <a href="{{ route('dashboard.enquiries') }}" class="shrink-0 rounded-lg px-5 py-4 transition hover:bg-white/10 {{ request()->routeIs('dashboard.enquiries') ? 'bg-[#ffd400] font-semibold text-black hover:bg-[#ffd400]' : '' }}">&#9993; <span class="ml-3">Enquiries</span></a>
                    <a href="{{ route('dashboard.orders') }}" class="shrink-0 rounded-lg px-5 py-4 transition hover:bg-white/10 {{ request()->routeIs('dashboard.orders') ? 'bg-[#ffd400] font-semibold text-black hover:bg-[#ffd400]' : '' }}">&#128722; <span class="ml-3">Orders</span></a>
                    <a href="{{ route('dashboard.products') }}" class="shrink-0 rounded-lg px-5 py-4 transition hover:bg-white/10 {{ request()->routeIs('dashboard.products') ? 'bg-[#ffd400] font-semibold text-black hover:bg-[#ffd400]' : '' }}">&#9632; <span class="ml-3">Product</span></a>
                    <a href="#" class="shrink-0 rounded-lg px-5 py-4 transition hover:bg-white/10">&#9881; <span class="ml-3">Settings</span></a>
                </nav>

                <a href="{{ route('home') }}" class="hidden border-t border-white/10 px-9 py-7 text-sm transition hover:text-[#ffd400] lg:mt-auto lg:block">&#8592; Back to Website</a>
            </aside>

            <div class="min-w-0">
                <header class="sticky top-0 z-20 flex min-h-20 items-center justify-between border-b border-black/5 bg-white px-5 py-4 lg:px-8">
                    <label class="hidden max-w-md flex-1 items-center gap-3 rounded-xl bg-[#f4f5f7] px-4 py-3 text-sm text-slate-500 sm:flex">
                        <span class="text-xl text-black">&#9906;</span>
                        <input class="w-full bg-transparent outline-none" type="search" placeholder="Search orders, products, enquiries...">
                    </label>

                    <div class="ml-auto flex items-center gap-4">
                        <button class="relative grid h-10 w-10 place-items-center rounded-full transition hover:bg-slate-100" aria-label="Notifications">
                            <span class="text-2xl">&#128276;</span>
                            <span class="absolute right-2 top-1 h-2.5 w-2.5 rounded-full bg-[#ffd400]"></span>
                        </button>
                        <div class="hidden h-10 w-px bg-black/10 sm:block"></div>
                        <div class="grid h-11 w-11 place-items-center rounded-full bg-[#ffe88b] text-lg font-bold">RT</div>
                        <div class="hidden sm:block"><p class="font-semibold leading-none">Ritik Tyagi</p><p class="mt-1 text-xs text-slate-500">Admin</p></div>
                        <span class="hidden text-slate-500 sm:block">&#8964;</span>
                    </div>
                </header>

                @yield('content')
            </div>
        </div>
    </body>
</html>
