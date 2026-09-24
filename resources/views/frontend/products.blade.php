@extends('layout.app')

@section('title', 'Products | Sweat Nothing')

@section('content')
    <main>
        <section class="product-banner">
            <div class="product-banner-copy">
                <div class="product-banner-copy-inner">
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
                </div>

            <div class="product-banner-visual">
                <img
                    src="{{ asset('images/home-banner.png') }}"
                    alt="Sweet Nothings liquid sweetener with chai"
                >
            </div>
        </section>

        <section class="mx-auto grid max-w-7xl gap-8 px-6 py-10 lg:grid-cols-[220px_1fr] lg:px-8">
            <aside class="rounded-2xl bg-[#f8f5ef] p-4 text-sm sm:p-5">
                <div class="flex items-center justify-between lg:block">
                    <h2 class="text-lg font-bold">Filters</h2>
                    <p class="text-xs text-black/55 lg:hidden">Choose your preference</p>
                </div>

                <div class="mt-4 grid gap-3 lg:mt-5 lg:block">
                <div class="min-w-0 rounded-xl border border-black/10 bg-white/70 p-3 lg:rounded-none lg:border-x-0 lg:border-b-0 lg:border-t lg:bg-transparent lg:px-0 lg:pb-0 lg:pt-4">
                    <p class="font-bold">Category</p>
                    <div class="mt-3 grid grid-cols-2 gap-x-2 gap-y-2 lg:block">
                        <label class="block"><input checked data-filter-all type="checkbox" class="accent-[#ffd100]"> All Products</label>
                        <label class="block lg:mt-2"><input data-category="sweetener" type="checkbox" class="accent-[#ffd100]"> Sweetener</label>
                        <label class="block lg:mt-2"><input data-category="combo" type="checkbox" class="accent-[#ffd100]"> Combo Pack</label>
                        <label class="block lg:mt-2"><input data-category="trial" type="checkbox" class="accent-[#ffd100]"> Trial Packs</label>
                    </div>
                </div>

                <div class="min-w-0 rounded-xl border border-black/10 bg-white/70 p-3 lg:mt-6 lg:rounded-none lg:border-x-0 lg:border-b-0 lg:border-t lg:bg-transparent lg:px-0 lg:pb-0 lg:pt-4">
                    <label for="price-range" class="font-bold">Price Range</label>
                    <input id="price-range" class="mt-4 w-full accent-[#ffd100]" type="range" min="0" max="1000" step="50" value="1000">
                    <div class="mt-2 flex justify-between text-xs"><span>₹0</span><span id="price-range-value">₹1,000</span></div>
                </div>

                <div class="min-w-0 rounded-xl border border-black/10 bg-white/70 p-3 lg:mt-6 lg:rounded-none lg:border-x-0 lg:border-b-0 lg:border-t lg:bg-transparent lg:px-0 lg:pb-0 lg:pt-4">
                    <p class="font-bold">Diet Preference</p>
                    <div class="mt-3 flex flex-wrap gap-x-3 gap-y-2 lg:block">
                        <label class="block"><input data-diet="keto" type="checkbox" class="accent-[#ffd100]"> Keto Friendly</label>
                        <label class="block lg:mt-2"><input data-diet="vegan" type="checkbox" class="accent-[#ffd100]"> Vegan</label>
                        <label class="block lg:mt-2"><input data-diet="diabetic" type="checkbox" class="accent-[#ffd100]"> Diabetic Friendly</label>
                    </div>
                </div>
                </div>
            </aside>

            <div>
                <div class="mb-5 flex items-center justify-between">
                    <h2 id="product-count" class="text-xl font-black">All Products ({{ $products->count() }})</h2>
                    <label class="sr-only" for="product-sort">Sort products</label>
                    <select id="product-sort" class="rounded-lg border border-black/15 bg-white px-4 py-2 text-sm">
                        <option value="featured">Sort by: Featured</option>
                        <option value="low-to-high">Price: Low to High</option>
                        <option value="high-to-low">Price: High to Low</option>
                    </select>
                </div>
                @if (session('success'))
                    <p class="mb-5 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">{{ session('success') }}</p>
                @endif

                @if (session('error'))
                    <p class="mb-5 rounded-xl bg-red-50 px-4 py-3 text-sm font-medium text-red-700">{{ session('error') }}</p>
                @endif

                <div id="product-grid" class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
                    @forelse ($products as $product)
                        <article data-product-card data-category="{{ strtolower($product->category) }}" data-diets="keto vegan diabetic" data-price="{{ $product->sale_price ?: $product->price }}" class="overflow-hidden rounded-xl border border-black/5 bg-[#fffdf9]">
                            <div class="relative h-52 bg-[#f3eee7]">
                                @if ($product->image)
                                    <img class="h-full w-full object-cover" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                                @else
                                    <div class="absolute inset-x-0 bottom-0 h-12 bg-[#e6d5bf]"></div>
                                    <div class="absolute bottom-4 left-1/2 w-28 -translate-x-1/2 rounded-t-lg bg-black px-3 py-5 text-center shadow-xl"><p class="text-lg font-black tracking-tighter text-white">SWEAT</p><p class="font-serif text-lg font-bold italic text-[#ffd100]">nothing.</p><div class="mt-3 bg-[#ffd100] py-3 text-[6px] font-black">SUGAR FREE</div></div>
                                @endif
                            </div>
                            <div class="p-4">
                                <p class="text-xs font-medium uppercase tracking-wider text-black/50">{{ $product->category }}</p>
                                <h3 class="mt-1 font-bold">{{ $product->name }}</h3>
                                <p class="mt-1 min-h-10 text-sm leading-4 text-black/70">{{ $product->description ?: 'Natural sweetness for your everyday moments.' }}</p>
                                <p class="mt-3 font-bold">₹{{ number_format((float) ($product->sale_price ?: $product->price), 0) }} @if ($product->sale_price)<span class="ml-2 text-sm font-normal text-black/40 line-through">₹{{ number_format((float) $product->price, 0) }}</span>@endif</p>
                                <p class="mt-2 text-sm text-[#f6bb00]">★★★★★ <span class="text-black/60">In stock: {{ $product->stock }}</span></p>
                                <form action="{{ route('cart.store', $product) }}" method="POST">
                                    @csrf
                                    <button class="mt-3 w-full rounded-full bg-[#ffd100] py-2 text-sm font-bold transition hover:bg-[#f2c300]" type="submit">🛒 Add to Cart</button>
                                </form>
                            </div>
                        </article>
                    @empty
                        <p class="col-span-full py-12 text-center text-black/60">No products are available right now.</p>
                    @endforelse
                </div>
                <p id="no-products-message" class="hidden py-12 text-center text-black/60">No products match these filters.</p>
            </div>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const categoryFilters = document.querySelectorAll('[data-category]');
                const dietFilters = document.querySelectorAll('[data-diet]');
                const allProductsFilter = document.querySelector('[data-filter-all]');
                const priceRange = document.querySelector('#price-range');
                const priceRangeValue = document.querySelector('#price-range-value');
                const productCards = [...document.querySelectorAll('[data-product-card]')];
                const productGrid = document.querySelector('#product-grid');
                const productCount = document.querySelector('#product-count');
                const noProductsMessage = document.querySelector('#no-products-message');
                const productSort = document.querySelector('#product-sort');

                const getProductPrice = (card) => Number(card.dataset.price);

                const updateProducts = () => {
                    const selectedCategories = [...categoryFilters]
                        .filter((filter) => filter.checked)
                        .map((filter) => filter.dataset.category);
                    const selectedDiets = [...dietFilters]
                        .filter((filter) => filter.checked)
                        .map((filter) => filter.dataset.diet);
                    const maximumPrice = Number(priceRange.value);
                    let visibleProducts = 0;

                    productCards.forEach((card) => {
                        const category = card.dataset.category;
                        const diets = card.dataset.diets.split(' ');
                        const matchesCategory = selectedCategories.length === 0 || selectedCategories.some((selectedCategory) => category.includes(selectedCategory));
                        const matchesDiet = selectedDiets.every((diet) => diets.includes(diet));
                        const matchesPrice = getProductPrice(card) <= maximumPrice;
                        const shouldShow = matchesCategory && matchesDiet && matchesPrice;

                        card.classList.toggle('hidden', !shouldShow);

                        if (shouldShow) {
                            visibleProducts += 1;
                        }
                    });

                    productCount.textContent = `All Products (${visibleProducts})`;
                    noProductsMessage.classList.toggle('hidden', visibleProducts !== 0);
                    priceRangeValue.textContent = `₹${maximumPrice.toLocaleString('en-IN')}`;
                };

                allProductsFilter.addEventListener('change', () => {
                    if (allProductsFilter.checked) {
                        categoryFilters.forEach((filter) => {
                            filter.checked = false;
                        });
                    }

                    updateProducts();
                });

                categoryFilters.forEach((filter) => {
                    filter.addEventListener('change', () => {
                        allProductsFilter.checked = false;
                        updateProducts();
                    });
                });

                dietFilters.forEach((filter) => filter.addEventListener('change', updateProducts));
                priceRange.addEventListener('input', updateProducts);

                productSort.addEventListener('change', () => {
                    if (productSort.value === 'featured') {
                        return;
                    }

                    const sortedCards = [...productCards].sort((firstCard, secondCard) => {
                        const priceDifference = getProductPrice(firstCard) - getProductPrice(secondCard);

                        return productSort.value === 'high-to-low' ? -priceDifference : priceDifference;
                    });

                    sortedCards.forEach((card) => productGrid.append(card));
                });

                updateProducts();
            });
        </script>

        <section class="mx-auto mb-8 max-w-7xl px-6 lg:px-8"><div class="grid overflow-hidden rounded-3xl bg-[#fff0bd] md:grid-cols-2"><img class="h-56 w-full object-cover" src="https://images.unsplash.com/photo-1514995669114-6081e934b693?auto=format&fit=crop&w=900&q=85" alt="Healthy breakfast bowl"><div class="p-9"><h2 class="font-serif text-4xl font-bold leading-none">Make Everyday<br>Moments Healthier</h2><p class="mt-4">From your morning chai to your favourite desserts, Sweat Nothing fits right in.</p><button class="mt-5 rounded-full bg-black px-6 py-3 text-sm font-bold text-white">Explore Recipes →</button></div></div></section>
    </main>
@endsection
