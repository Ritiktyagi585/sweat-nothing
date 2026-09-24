<header class="sticky top-0 z-50 border-b border-black/5 bg-[#fffdf9]/95 backdrop-blur">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-3 py-2.5 sm:px-5 sm:py-4 lg:px-8">
        <a href="{{ route('home') }}" class="py-1" aria-label="Ayurth home">
            <img class="h-7 w-auto sm:h-9" src="{{ asset('images/ayurth-logo.png') }}" alt="Ayurth.com">
        </a>

        <nav class="hidden items-center gap-9 text-sm font-medium lg:flex" aria-label="Primary navigation">
            <a class="{{ request()->routeIs('home') ? 'border-b-2 border-[#ffd100] pb-1' : 'transition hover:text-[#d69d00]' }}" href="{{ route('home') }}">Home</a>
            <a class="{{ request()->routeIs('products') ? 'border-b-2 border-[#ffd100] pb-1' : 'transition hover:text-[#d69d00]' }}" href="{{ route('products') }}">Product</a>
            <a class="{{ request()->routeIs('about') ? 'border-b-2 border-[#ffd100] pb-1' : 'transition hover:text-[#d69d00]' }}" href="{{ route('about') }}">About Us</a>
            <a class="{{ request()->routeIs('contact') ? 'border-b-2 border-[#ffd100] pb-1' : 'transition hover:text-[#d69d00]' }}" href="{{ route('contact') }}">Contact</a>
        </nav>

        <div class="flex items-center gap-2 sm:gap-3">
            <button class="hidden rounded-full p-2 transition hover:bg-black/5 sm:block" aria-label="Search">⌕</button>
            <a href="{{ route('cart.index') }}" class="relative hidden rounded-full p-2 transition hover:bg-black/5 sm:block" aria-label="Open shopping cart">
                🛍
                @if (collect(session('cart', []))->sum('quantity') > 0)
                    <span class="absolute -right-1 -top-1 grid h-5 min-w-5 place-items-center rounded-full bg-[#ffd100] px-1 text-[10px] font-bold text-black">{{ collect(session('cart', []))->sum('quantity') }}</span>
                @endif
            </a>
            <a href="{{ route('products') }}" class="rounded-full bg-[#ffd100] px-3 py-2 text-[10px] font-bold transition hover:-translate-y-0.5 hover:bg-[#f2c300] sm:px-5 sm:py-3 sm:text-xs">Shop Now →</a>
            <a href="{{ route('cart.index') }}" class="relative rounded-full border border-black/10 px-2.5 py-2 text-[10px] font-bold transition hover:bg-black/5 sm:hidden" aria-label="Open shopping cart">
                Cart
                @if (collect(session('cart', []))->sum('quantity') > 0)
                    <span class="ml-0.5 text-[#b57d00]">({{ collect(session('cart', []))->sum('quantity') }})</span>
                @endif
            </a>
            <button id="mobile-menu-toggle" type="button" class="grid h-9 w-9 place-items-center rounded-lg border border-black/10 transition hover:bg-black/5 lg:hidden" aria-label="Open navigation menu" aria-controls="mobile-menu" aria-expanded="false">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16" /></svg>
            </button>
        </div>
    </div>

    <nav id="mobile-menu" class="hidden border-t border-black/5 bg-[#fffdf9] px-5 py-4 lg:hidden" aria-label="Mobile navigation">
        <div class="grid gap-2 text-sm font-semibold">
            <a class="rounded-lg px-3 py-3 {{ request()->routeIs('home') ? 'bg-[#ffd100]' : 'hover:bg-black/5' }}" href="{{ route('home') }}">Home</a>
            <a class="rounded-lg px-3 py-3 {{ request()->routeIs('products') ? 'bg-[#ffd100]' : 'hover:bg-black/5' }}" href="{{ route('products') }}">Product</a>
            <a class="rounded-lg px-3 py-3 {{ request()->routeIs('about') ? 'bg-[#ffd100]' : 'hover:bg-black/5' }}" href="{{ route('about') }}">About Us</a>
            <a class="rounded-lg px-3 py-3 {{ request()->routeIs('contact') ? 'bg-[#ffd100]' : 'hover:bg-black/5' }}" href="{{ route('contact') }}">Contact</a>
            <a class="rounded-lg px-3 py-3 hover:bg-black/5" href="{{ route('cart.index') }}">Cart ({{ collect(session('cart', []))->sum('quantity') }})</a>
        </div>
    </nav>
</header>

<script>
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuToggle.addEventListener('click', () => {
        const isOpen = mobileMenu.classList.toggle('hidden') === false;

        mobileMenuToggle.setAttribute('aria-expanded', String(isOpen));
        mobileMenuToggle.setAttribute('aria-label', isOpen ? 'Close navigation menu' : 'Open navigation menu');
    });
</script>
