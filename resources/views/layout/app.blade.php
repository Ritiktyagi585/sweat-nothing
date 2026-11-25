<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sweat Nothing — sweetness without the sugar.">
    <title>@yield('title', 'Sweat Nothing | Less sugar, more life')</title>
    <link rel="stylesheet" href="{{ asset('css/contact-layout.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#fffdf9] font-sans text-[#111111] antialiased">
    <header class="sticky top-0 z-50 border-b border-black/5 bg-[#fffdf9]/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-3 py-2.5 sm:px-5 sm:py-4 lg:px-8">
            <a href="{{ route('home') }}" class="py-1" aria-label="Ayurth home">
                <img class="h-12 w-auto sm:h-16" src="{{ asset('images/ayurthlogoh.png') }}" alt="Ayurth">
            </a>

            <nav class="hidden items-center gap-9 text-sm font-medium lg:flex" aria-label="Primary navigation">
                <a class="{{ request()->routeIs('home') ? 'border-b-2 border-[#ffd100] pb-1' : 'transition hover:text-[#d69d00]' }}"
                    href="{{ route('home') }}">Home</a>
                <a class="{{ request()->routeIs('products') ? 'border-b-2 border-[#ffd100] pb-1' : 'transition hover:text-[#d69d00]' }}"
                    href="{{ route('products') }}">Product</a>
                <a class="{{ request()->routeIs('about') ? 'border-b-2 border-[#ffd100] pb-1' : 'transition hover:text-[#d69d00]' }}"
                    href="{{ route('about') }}">About Us</a>
                <a class="{{ request()->routeIs('contact') ? 'border-b-2 border-[#ffd100] pb-1' : 'transition hover:text-[#d69d00]' }}"
                    href="{{ route('contact') }}">Contact</a>
            </nav>

            <div class="flex items-center gap-2 sm:gap-3">
                <div class="relative">
                    <button id="header-search-toggle" type="button" class="rounded-full p-2 transition hover:bg-black/5" aria-label="Open search" aria-controls="header-search" aria-expanded="false">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="10.8" cy="10.8" r="6.8"/><path d="m16 16 4.2 4.2"/></svg>
                    </button>
                    <form id="header-search" action="{{ route('products') }}" method="GET" class="absolute right-0 top-full z-50 mt-2 hidden w-[min(19rem,calc(100vw-2rem))] rounded-xl border border-black/10 bg-white p-3 shadow-xl">
                        <label class="sr-only" for="header-search-input">Search products</label>
                        <div class="flex gap-2">
                            <input id="header-search-input" name="search" type="search" value="{{ request()->query('search') }}" placeholder="Search products..." class="min-w-0 flex-1 rounded-lg border border-black/15 px-3 py-2 text-sm outline-none focus:border-[#d69d00]">
                            <button type="submit" class="rounded-lg bg-[#ffd100] px-4 py-2 text-sm font-semibold hover:bg-[#f2c300]">Search</button>
                        </div>
                    </form>
                </div>
                <a href="{{ route('cart.index') }}"
                    class="relative hidden rounded-full p-2 transition hover:bg-black/5 sm:block"
                    aria-label="Open shopping cart">
                    🛍
                    @if (collect(session('cart', []))->sum('quantity') > 0)
                        <span
                            class="absolute -right-1 -top-1 grid h-5 min-w-5 place-items-center rounded-full bg-[#ffd100] px-1 text-[10px] font-bold text-black">{{ collect(session('cart', []))->sum('quantity') }}</span>
                    @endif
                </a>
                <a href="{{ route('products') }}"
                    class="rounded-full bg-[#ffd100] px-3 py-2 text-[10px] font-bold transition hover:-translate-y-0.5 hover:bg-[#f2c300] sm:px-5 sm:py-3 sm:text-xs">Shop
                    Now →</a>
                <a href="{{ route('cart.index') }}"
                    class="relative rounded-full border border-black/10 px-2.5 py-2 text-[10px] font-bold transition hover:bg-black/5 sm:hidden"
                    aria-label="Open shopping cart">
                    Cart
                    @if (collect(session('cart', []))->sum('quantity') > 0)
                        <span class="ml-0.5 text-[#b57d00]">({{ collect(session('cart', []))->sum('quantity') }})</span>
                    @endif
                </a>
                <button id="mobile-menu-toggle" type="button"
                    class="grid h-9 w-9 place-items-center rounded-lg border border-black/10 transition hover:bg-black/5 lg:hidden"
                    aria-label="Open navigation menu" aria-controls="mobile-menu" aria-expanded="false">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        aria-hidden="true">
                        <path d="M4 7h16M4 12h16M4 17h16" />
                    </svg>
                </button>
            </div>
        </div>

        <nav id="mobile-menu" class="hidden border-t border-black/5 bg-[#fffdf9] px-5 py-4 lg:hidden"
            aria-label="Mobile navigation">
            <div class="grid gap-2 text-sm font-semibold">
                <a class="rounded-lg px-3 py-3 {{ request()->routeIs('home') ? 'bg-[#ffd100]' : 'hover:bg-black/5' }}"
                    href="{{ route('home') }}">Home</a>
                <a class="rounded-lg px-3 py-3 {{ request()->routeIs('products') ? 'bg-[#ffd100]' : 'hover:bg-black/5' }}"
                    href="{{ route('products') }}">Product</a>
                <a class="rounded-lg px-3 py-3 {{ request()->routeIs('about') ? 'bg-[#ffd100]' : 'hover:bg-black/5' }}"
                    href="{{ route('about') }}">About Us</a>
                <a class="rounded-lg px-3 py-3 {{ request()->routeIs('contact') ? 'bg-[#ffd100]' : 'hover:bg-black/5' }}"
                    href="{{ route('contact') }}">Contact</a>
                <a class="rounded-lg px-3 py-3 hover:bg-black/5" href="{{ route('cart.index') }}">Cart
                    ({{ collect(session('cart', []))->sum('quantity') }})</a>
            </div>
        </nav>
    </header>

    <script>
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const searchToggle = document.getElementById('header-search-toggle');
        const searchForm = document.getElementById('header-search');
        const searchInput = document.getElementById('header-search-input');

        searchToggle.addEventListener('click', () => {
            const isOpen = searchForm.classList.toggle('hidden') === false;
            searchToggle.setAttribute('aria-expanded', String(isOpen));
            searchToggle.setAttribute('aria-label', isOpen ? 'Close search' : 'Open search');

            if (isOpen) {
                searchInput.focus();
            }
        });

        searchInput.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                searchForm.classList.add('hidden');
                searchToggle.setAttribute('aria-expanded', 'false');
                searchToggle.setAttribute('aria-label', 'Open search');
                searchToggle.focus();
            }
        });

        mobileMenuToggle.addEventListener('click', () => {
            const isOpen = mobileMenu.classList.toggle('hidden') === false;

            mobileMenuToggle.setAttribute('aria-expanded', String(isOpen));
            mobileMenuToggle.setAttribute('aria-label', isOpen ? 'Close navigation menu' : 'Open navigation menu');
        });
    </script>

    @yield('content')

    <footer id="contact" class="site-footer">
        <div class="site-footer-main">
            <section class="site-footer-brand">
                <a href="{{ route('home') }}" class="site-footer-logo-crop" aria-label="Ayurth home"><img src="{{ asset('images/ayurthlogoh.png') }}" alt="Ayurth"></a>
                <p class="site-footer-tagline">A healthier, sweeter tomorrow.</p>
                <span class="site-footer-accent" aria-hidden="true"></span>
                <p class="site-footer-description">Natural care. Better health. A healthier life with Ayurth.</p>
                <div class="site-footer-benefits">
                    <span><i aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 20c-5-2-8-6-8-12 5 0 9 2 11 6 1-3 3-5 6-6 0 7-3 11-9 12Zm0 0c0-5-2-8-6-10"/></svg></i>Natural<br>Sweetness</span>
                    <span><i aria-hidden="true"><svg viewBox="0 0 24 24"><path d="m12 3 8 3v5c0 5-3 8-8 10-5-2-8-5-8-10V6l8-3Zm-4 9 3 3 5-6"/></svg></i>Trusted<br>Quality</span>
                    <span><i aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M20 5c-7 0-12 3-13 9 0 3 2 5 5 5 6-1 9-7 8-14ZM5 20c2-5 5-8 10-11"/></svg></i>Better<br>Choices</span>
                </div>
            </section>

            <nav class="site-footer-column" aria-label="Quick links">
                <h2>Quick Links</h2><span class="site-footer-accent" aria-hidden="true"></span>
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('products') }}">Product</a>
                <a href="{{ route('about') }}">About Us</a>
                <a href="{{ route('contact') }}">Contact</a>
            </nav>

            <nav class="site-footer-column" aria-label="Our services">
                <h2>Our Services</h2><span class="site-footer-accent" aria-hidden="true"></span>
                <a href="{{ route('products') }}">Shop Sweeteners <span aria-hidden="true">›</span></a>
                <a href="{{ route('about') }}">Our Story <span aria-hidden="true">›</span></a>
                <a href="{{ route('contact') }}#customer-details">Customer Support <span aria-hidden="true">›</span></a>
                <a href="{{ route('contact') }}#faqs">FAQs <span aria-hidden="true">›</span></a>
            </nav>

            <section class="site-footer-column site-footer-contact">
                <h2>Contact Us</h2><span class="site-footer-accent" aria-hidden="true"></span>
                <a href="tel:+91204567890"><i aria-hidden="true">☎</i><span>+91 9911916600</span></a>
                <a href="mailto:hello@sweatnothing.in"><i aria-hidden="true">✉</i><span>ayurth0@gmail.com</span></a>
                <p><i aria-hidden="true">◷</i><span>Mon–Fri, 10:00 AM–6:00 PM<br>Sat, 10:00 AM–2:00 PM</span></p>
            </section>

            <section class="site-footer-column site-footer-social">
                <h2>Follow Us</h2><span class="site-footer-accent" aria-hidden="true"></span>
                <div class="site-footer-social-links" aria-label="Social media">
                    <a href="https://www.facebook.com/profile.php?id=61597047024083" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M13.4 21v-8h2.7l.4-3.1h-3.1v-2c0-.9.3-1.5 1.6-1.5h1.7V3.6c-.3 0-1.3-.1-2.5-.1-2.5 0-4.2 1.5-4.2 4.3v2.1H7.2V13H10v8h3.4Z"/></svg></a>
                    <a href="https://www.instagram.com/ayur.th/?hl=en" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3.2" y="3.2" width="17.6" height="17.6" rx="5"/><circle cx="12" cy="12" r="4.1"/><circle cx="17.7" cy="6.5" r=".9" fill="currentColor" stroke="none"/></svg></a>
                    <a href="https://www.youtube.com/channel/UCY25DCzwRq1Kgsk0YSn4UAw" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.6 12 3.6 12 3.6s-7.5 0-9.4.5A3 3 0 0 0 .5 6.2 31 31 0 0 0 0 12a31 31 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.1A31 31 0 0 0 24 12a31 31 0 0 0-.5-5.8ZM9.6 15.6V8.4l6.2 3.6-6.2 3.6Z"/></svg></a>
                    <a href="https://www.linkedin.com/in/ayurth-undefined-a61159452/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M5.2 3.5a2.2 2.2 0 1 0 0 4.4 2.2 2.2 0 0 0 0-4.4ZM3.3 9.5h3.8v11H3.3v-11Zm6.1 0H13v1.5h.1a4.1 4.1 0 0 1 3.7-2c4 0 4.7 2.6 4.7 5.9v5.6h-3.8v-5c0-1.2 0-2.8-1.8-2.8s-2.1 1.3-2.1 2.7v5.1H9.4v-11Z"/></svg></a>
                    <a href="https://x.com/Ayurth0" target="_blank" rel="noopener noreferrer" aria-label="X"><svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.9 2H22l-6.8 7.8L23.2 22h-6.3L12 14.6 5.5 22H2.3l7.3-8.4L1.8 2h6.5l4.5 6.8L18.9 2Zm-1.1 18h1.7L7.3 3.9H5.5L17.8 20Z"/></svg></a>
                </div>
            </section>
        </div>

        <div class="site-footer-bottom">
            <p>© {{ date('Y') }} <strong>Ayurth.</strong> All rights reserved.</p>
            <span class="site-footer-bottom-rule" aria-hidden="true"><svg viewBox="0 0 40 40"><path d="M20 35C9 31 6 22 8 9c8 3 12 8 12 15 2-8 6-13 13-16 2 13-2 23-13 27Zm0 0c0-8-4-14-11-19m11 19c1-8 5-14 12-20"/></svg></span>
            <nav aria-label="Legal links">
                <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
                <span aria-hidden="true">|</span>
                <a href="{{ route('terms-and-conditions') }}">Terms &amp; Conditions</a>
            </nav>
        </div>
    </footer>
</body>

</html>
