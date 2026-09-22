<header class="sticky top-0 z-50 border-b border-black/5 bg-[#fffdf9]/95 backdrop-blur">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 lg:px-8">
        <a href="{{ route('home') }}" class="rounded-md bg-[#101010] px-3 py-2" aria-label="Sweat Nothing home">
            <img class="h-10 w-auto" src="{{ asset('images/brand-logo.png') }}" alt="Sweat Nothing">
        </a>

        <nav class="hidden items-center gap-9 text-sm font-medium lg:flex" aria-label="Primary navigation">
            <a class="{{ request()->routeIs('home') ? 'border-b-2 border-[#ffd100] pb-1' : 'transition hover:text-[#d69d00]' }}" href="{{ route('home') }}">Home</a>
            <a class="{{ request()->routeIs('products') ? 'border-b-2 border-[#ffd100] pb-1' : 'transition hover:text-[#d69d00]' }}" href="{{ route('products') }}">Product</a>
            <a class="{{ request()->routeIs('about') ? 'border-b-2 border-[#ffd100] pb-1' : 'transition hover:text-[#d69d00]' }}" href="{{ route('about') }}">About Us</a>
            <a class="{{ request()->routeIs('contact') ? 'border-b-2 border-[#ffd100] pb-1' : 'transition hover:text-[#d69d00]' }}" href="{{ route('contact') }}">Contact</a>
        </nav>

        <div class="flex items-center gap-3">
            <button class="hidden rounded-full p-2 transition hover:bg-black/5 sm:block" aria-label="Search">⌕</button>
            <button class="hidden rounded-full p-2 transition hover:bg-black/5 sm:block" aria-label="Shopping bag">🛍</button>
            <a href="{{ route('products') }}" class="rounded-full bg-[#ffd100] px-5 py-3 text-xs font-bold transition hover:-translate-y-0.5 hover:bg-[#f2c300]">Shop Now →</a>
        </div>
    </div>
</header>
