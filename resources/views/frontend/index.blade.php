@extends('layout.app')

@section('title', 'Sweet Nothing | Less sugar, more life')

@section('content')
    <main id="home" class="overflow-hidden">
        <section class="home-hero product-banner">
            <div class="contents">
                <div class="home-hero-copy product-banner-copy relative z-10">
                    <div class="product-banner-copy-inner">
                    <p class="mb-3 text-[9px] font-bold tracking-[0.28em] text-black/70 sm:text-[11px] sm:tracking-[0.35em]">
                        SAME SWEETNESS<br>
                        A HEALTHIER TOMORROW
                    </p>
                    <h1 class="max-w-xl text-4xl font-black leading-[0.88] tracking-[-0.07em] sm:text-5xl lg:text-6xl">
                        Less<br>
                        Sugar.<br>
                        <span class="text-[#ffcf00]">More Life.</span>
                    </h1>
                    <p class="mt-4 max-w-sm text-sm leading-5 text-black/75 sm:text-base sm:leading-6">
                        Your everyday sugar alternative for chai, coffee, desserts and more.
                    </p>
                    <a href="{{ route('products') }}" class="mt-4 inline-flex rounded-full bg-[#ffd100] px-6 py-3 text-xs font-bold shadow-[0_8px_24px_rgba(255,209,0,.25)] transition hover:-translate-y-1 sm:px-7 sm:py-3 sm:text-sm">
                        Explore Product&nbsp; →
                    </a>
                    <div class="mt-8 grid max-w-md grid-cols-4 gap-2 text-center text-[8px] font-semibold leading-3 sm:mt-10 sm:gap-4 sm:text-[10px] lg:mt-6">
                        <div><span class="mb-1 block text-2xl sm:mb-2 sm:text-3xl">◯</span>Zero Added<br>Sugar</div>
                        <div><span class="mb-1 block text-2xl sm:mb-2 sm:text-3xl">♡</span>Keto<br>Friendly</div>
                        <div><span class="mb-1 block text-2xl sm:mb-2 sm:text-3xl">♧</span>Plant<br>Based</div>
                        <div><span class="mb-1 block text-2xl sm:mb-2 sm:text-3xl">☺</span>Great<br>Taste</div>
                    </div>
                    </div>
                </div>

                <div class="home-hero-image product-banner-visual">
                    <img
                        src="{{ asset('images/home-celebrity-banner.png') }}"
                        alt="Sweet Nothings Liquid Sweetener campaign with Shankar Mahadevan"
                    >
                </div>
            </div>
        </section>

        <section id="product" class="mx-auto max-w-7xl px-5 py-10 sm:px-6 sm:py-16 lg:px-8">
            <div class="mb-8 text-center">
                <p class="text-[10px] font-bold tracking-[0.3em]">SWEET MOMENTS, NEW POSSIBILITIES</p>
                <h2 class="mt-2 text-3xl font-black tracking-[-0.05em] sm:text-4xl">Made for What You Love</h2>
            </div>
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <article class="group">
                    <img class="h-52 w-full rounded-2xl object-cover" src="https://images.unsplash.com/photo-1571934811356-5cc061b6821f?auto=format&fit=crop&w=700&q=85" alt="Chai with Sweet Nothing">
                    <div class="mt-3 flex items-end justify-between gap-3">
                        <div><h3 class="font-bold">Chai</h3><p class="mt-1 max-w-36 text-xs leading-4 text-black/70">Same comfort. Just better.</p></div>
                        <span class="rounded-full bg-[#ffd100] px-3 py-2 font-bold">→</span>
                    </div>
                </article>
                <article class="group">
                    <img class="h-52 w-full rounded-2xl object-cover" src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=700&q=85" alt="Coffee with Sweet Nothing">
                    <div class="mt-3 flex items-end justify-between gap-3">
                        <div><h3 class="font-bold">Coffee</h3><p class="mt-1 max-w-36 text-xs leading-4 text-black/70">All the flavour. None of the sugar.</p></div>
                        <span class="rounded-full bg-[#ffd100] px-3 py-2 font-bold">→</span>
                    </div>
                </article>
                <article class="group">
                    <img class="h-52 w-full rounded-2xl object-cover" src="https://images.unsplash.com/photo-1488477181946-6428a0291777?auto=format&fit=crop&w=700&q=85" alt="Desserts with Sweet Nothing">
                    <div class="mt-3 flex items-end justify-between gap-3">
                        <div><h3 class="font-bold">Desserts</h3><p class="mt-1 max-w-36 text-xs leading-4 text-black/70">Sweet moments, guilt-free.</p></div>
                        <span class="rounded-full bg-[#ffd100] px-3 py-2 font-bold">→</span>
                    </div>
                </article>
                <article class="group">
                    <img class="h-52 w-full rounded-2xl object-cover" src="https://images.unsplash.com/photo-1607958996333-41aef7caefaa?auto=format&fit=crop&w=700&q=85" alt="Baking with Sweet Nothing">
                    <div class="mt-3 flex items-end justify-between gap-3">
                        <div><h3 class="font-bold">Baking</h3><p class="mt-1 max-w-36 text-xs leading-4 text-black/70">Because healthy can be delicious.</p></div>
                        <span class="rounded-full bg-[#ffd100] px-3 py-2 font-bold">→</span>
                    </div>
                </article>
            </div>
        </section>

        <section id="story" class="mx-auto grid max-w-7xl items-center gap-10 px-6 py-14 lg:grid-cols-2 lg:px-8">
            <div>
                <h2 class="max-w-md text-4xl font-black leading-[.95] tracking-[-.06em] sm:text-5xl">A Small Swap<br>A Bigger Tomorrow</h2>
                <p class="mt-5 max-w-md leading-6 text-black/75">
                    At Sweet Nothing, we believe you don't have to choose between great taste and good health.
                    Our sweetness brings a little more joy to your everyday moments — without the sugar.
                </p>
                <a href="{{ route('about') }}" class="mt-6 inline-flex rounded-full bg-[#ffd100] px-6 py-3 text-sm font-bold">Our Story →</a>
            </div>
            <div class="relative overflow-hidden rounded-[3rem] bg-[#ffe792] p-10">
                <p class="relative z-10 font-serif text-3xl italic">Healthier<br>Happier<br>You ♡</p>
                <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('images/natural-syrup-bowl.png') }}" alt="Natural syrup flowing into a wooden bowl">
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-6 pb-16 lg:px-8">
            <div class="rounded-3xl bg-[#f7f3ec] px-6 py-12 text-center">
                <p class="text-[10px] font-bold tracking-[.28em]">A HEALTHIER CHOICE FOR A BRIGHTER YOU</p>
                <h2 class="mt-2 text-3xl font-black tracking-[-.05em]">Why Choose Sweet Nothing?</h2>
                <div class="mt-10 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <span class="mx-auto grid h-14 w-14 place-items-center rounded-full bg-[#ffe28a] text-2xl">◯</span>
                        <h3 class="mt-4 font-bold">No Sugar Spikes</h3>
                        <p class="mx-auto mt-2 max-w-48 text-sm leading-5 text-black/65">Enjoy sweetness without the crash.</p>
                    </div>
                    <div>
                        <span class="mx-auto grid h-14 w-14 place-items-center rounded-full bg-[#ffe28a] text-2xl">♡</span>
                        <h3 class="mt-4 font-bold">Supports a Healthier You</h3>
                        <p class="mx-auto mt-2 max-w-48 text-sm leading-5 text-black/65">A smart choice for everyday wellness.</p>
                    </div>
                    <div>
                        <span class="mx-auto grid h-14 w-14 place-items-center rounded-full bg-[#ffe28a] text-2xl">♧</span>
                        <h3 class="mt-4 font-bold">Made from Nature</h3>
                        <p class="mx-auto mt-2 max-w-48 text-sm leading-5 text-black/65">Naturally sourced ingredients.</p>
                    </div>
                    <div>
                        <span class="mx-auto grid h-14 w-14 place-items-center rounded-full bg-[#ffe28a] text-2xl">☺</span>
                        <h3 class="mt-4 font-bold">Great Taste, Always</h3>
                        <p class="mx-auto mt-2 max-w-48 text-sm leading-5 text-black/65">Because you shouldn't have to compromise.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-6 pb-16 lg:px-8">
            <img
                src="{{ asset('images/home-commitment-banner.png') }}"
                alt="Sweet Nothing commitment to a healthier, happier you"
                class="w-full rounded-3xl object-cover"
            >
        </section>
    </main>
@endsection
