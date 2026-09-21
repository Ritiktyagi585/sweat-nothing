@extends('layout.app')

@section('title', 'Products | Sweat Nothing')

@section('content')
    <main>
        <section class="relative overflow-hidden bg-[radial-gradient(circle_at_70%_45%,#ffd316_0,transparent_19%),linear-gradient(110deg,#fffdf8,#f5eee5)]">
            <div class="mx-auto grid max-w-7xl items-center gap-8 px-6 py-14 lg:grid-cols-2 lg:px-8">
                <div>
                    <p class="text-xs font-bold tracking-[.35em]">OUR PRODUCTS</p>
                    <h1 class="mt-4 text-5xl font-black leading-[.9] tracking-[-.07em] sm:text-7xl">Good Taste.<br><span class="text-[#ffcf00]">Better Choices.</span></h1>
                    <p class="mt-5 max-w-md leading-6 text-black/75">Explore our range of sugar alternatives for chai, coffee, desserts and everyday favourites.</p>
                    <div class="mt-8 grid max-w-md grid-cols-4 gap-4 text-center text-[10px] font-semibold">
                        <div><span class="mb-2 block text-3xl">◯</span>Zero<br>Added Sugar</div>
                        <div><span class="mb-2 block text-3xl">♡</span>Keto<br>Friendly</div>
                        <div><span class="mb-2 block text-3xl">♧</span>Plant<br>Based</div>
                        <div><span class="mb-2 block text-3xl">☺</span>Great<br>Taste</div>
                    </div>
                </div>
                <div class="relative mx-auto h-84 w-full max-w-lg">
                    <p class="absolute left-4 top-0 z-10 font-serif text-3xl italic -rotate-12">Same chai,<br>just healthier ♡</p>
                    <div class="absolute bottom-2 left-8 h-34 w-26 rounded-b-full border-4 border-white/60 bg-[#c77a3e] shadow-xl"><div class="mt-4 h-4 bg-[#f5d5ba]"></div></div>
                    <div class="absolute bottom-0 right-6 w-56 rounded-t-xl bg-gradient-to-b from-zinc-700 via-[#101010] to-black px-5 pb-5 pt-8 shadow-2xl sm:w-64">
                        <div class="text-center text-3xl font-black tracking-tighter text-white">SWEAT</div>
                        <div class="text-center font-serif text-3xl font-bold italic text-[#ffd100]">nothing.</div>
                        <div class="mt-5 border-y border-white/20 py-4 text-sm font-bold text-white">SWEETNESS<br>WITHOUT<br><span class="text-[#ffd100]">THE SUGAR</span></div>
                        <div class="mt-5 bg-[#ffd100] px-3 py-4 text-[8px] font-black">FOR A HEALTHIER YOU</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mx-auto grid max-w-7xl gap-8 px-6 py-10 lg:grid-cols-[220px_1fr] lg:px-8">
            <aside class="rounded-2xl bg-[#f8f5ef] p-5 text-sm">
                <h2 class="text-lg font-bold">Filters</h2>
                <div class="mt-5 border-t border-black/10 pt-4"><p class="font-bold">Category</p><label class="mt-3 block"><input checked type="checkbox" class="accent-[#ffd100]"> All Products</label><label class="mt-2 block"><input type="checkbox"> Sweetener</label><label class="mt-2 block"><input type="checkbox"> Combo Pack</label><label class="mt-2 block"><input type="checkbox"> Trial Packs</label></div>
                <div class="mt-6 border-t border-black/10 pt-4"><p class="font-bold">Price Range</p><div class="mt-4 h-1 rounded bg-[#ffd100]"></div><div class="mt-2 flex justify-between text-xs"><span>₹0</span><span>₹1,000</span></div></div>
                <div class="mt-6 border-t border-black/10 pt-4"><p class="font-bold">Diet Preference</p><label class="mt-3 block"><input type="checkbox"> Keto Friendly</label><label class="mt-2 block"><input type="checkbox"> Vegan</label><label class="mt-2 block"><input type="checkbox"> Diabetic Friendly</label></div>
            </aside>

            <div>
                <div class="mb-5 flex items-center justify-between"><h2 class="text-xl font-black">All Products (6)</h2><button class="rounded-lg border border-black/15 px-4 py-2 text-sm">Sort by: Featured⌄</button></div>
                <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
                    @foreach ([['Original','Natural sweetness for your everyday moments.','₹299','200 g','#ffd100'],['Stevia Blend','Plant based sweetness with stevia extract.','₹349','200 g','#79a64b'],['Monk Fruit Blend','Naturally sweet. Zero compromise.','₹349','200 g','#a7783e'],['Sugar Free Combo Pack','Original + Stevia + Monk Fruit','₹899','3 x 200 g','#f4c700'],['Trial Pack','Perfect to start your healthy journey.','₹149','50 g','#ffd100'],['Gift Pack','A healthier gift for your loved ones.','₹999','200 g + Mug','#252525']] as [$name, $description, $price, $weight, $color])
                        <article class="overflow-hidden rounded-xl border border-black/5 bg-[#fffdf9]">
                            <div class="relative h-46 bg-[#f3eee7]"><div class="absolute inset-x-0 bottom-0 h-12 bg-[#e6d5bf]"></div><div class="absolute bottom-4 left-1/2 w-28 -translate-x-1/2 rounded-t-lg bg-black px-3 py-5 text-center shadow-xl"><p class="text-lg font-black tracking-tighter text-white">SWEAT</p><p class="font-serif text-lg font-bold italic text-[#ffd100]">nothing.</p><div class="mt-3 py-3 text-[6px] font-black" style="background-color: {{ $color }}">SUGAR FREE</div></div></div>
                            <div class="p-3"><h3 class="font-bold">Sweat Nothing – {{ $name }}</h3><p class="mt-1 min-h-10 text-sm leading-4 text-black/70">{{ $description }}</p><p class="mt-3 font-bold">{{ $price }} <span class="ml-1 text-sm font-normal text-black/60">{{ $weight }}</span></p><p class="mt-2 text-sm text-[#f6bb00]">★★★★★ <span class="text-black/60">(98)</span></p><button class="mt-3 w-full rounded-full bg-[#ffd100] py-2 text-sm font-bold">🛒 Add to Cart</button></div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="mx-auto mb-8 max-w-7xl px-6 lg:px-8"><div class="grid overflow-hidden rounded-3xl bg-[#fff0bd] md:grid-cols-2"><img class="h-56 w-full object-cover" src="https://images.unsplash.com/photo-1514995669114-6081e934b693?auto=format&fit=crop&w=900&q=85" alt="Healthy breakfast bowl"><div class="p-9"><h2 class="font-serif text-4xl font-bold leading-none">Make Everyday<br>Moments Healthier</h2><p class="mt-4">From your morning chai to your favourite desserts, Sweat Nothing fits right in.</p><button class="mt-5 rounded-full bg-black px-6 py-3 text-sm font-bold text-white">Explore Recipes →</button></div></div></section>
    </main>
@endsection
