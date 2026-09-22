@extends('layout.dashboard')

@section('title', 'Products | Sweat Nothing')

@section('content')
    @php
        // Demo product data. Later this can come from the database.
        $products = [
            ['Oversized Hoodie', 'SN-P001', 'Hoodies', '₹ 1,499', 25, 'Active', 'bg-emerald-100 text-emerald-700', 'H', 'bg-[#1f1f1f] text-white'],
            ['Classic T-Shirt', 'SN-P002', 'T-Shirts', '₹ 799', 40, 'Active', 'bg-emerald-100 text-emerald-700', 'T', 'bg-white text-black'],
            ['Snapback Cap', 'SN-P003', 'Accessories', '₹ 599', 12, 'Active', 'bg-emerald-100 text-emerald-700', 'C', 'bg-[#1f1f1f] text-[#ffd400]'],
            ['Comfort Joggers', 'SN-P004', 'Bottoms', '₹ 1,199', 0, 'Out of Stock', 'bg-red-100 text-red-700', 'J', 'bg-[#202020] text-white'],
            ['Steel Water Bottle', 'SN-P005', 'Accessories', '₹ 899', 18, 'Active', 'bg-emerald-100 text-emerald-700', 'B', 'bg-[#1f1f1f] text-[#ffd400]'],
            ['Canvas Tote Bag', 'SN-P006', 'Bags', '₹ 649', 7, 'Low Stock', 'bg-amber-100 text-amber-700', 'B', 'bg-[#efe2c7] text-black'],
            ['Crewneck Sweatshirt', 'SN-P007', 'Sweatshirts', '₹ 1,249', 30, 'Active', 'bg-emerald-100 text-emerald-700', 'S', 'bg-[#1f1f1f] text-white'],
            ['Ankle Socks (Pack of 3)', 'SN-P008', 'Accessories', '₹ 399', 50, 'Active', 'bg-emerald-100 text-emerald-700', 'S', 'bg-[#f3f3f3] text-black'],
        ];
    @endphp

    <main class="mx-auto max-w-[1500px] p-5 lg:p-7">
        <section class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div><h1 class="text-2xl font-bold tracking-[-.03em]">Products</h1><p class="mt-1 text-slate-500">Manage your store products. Add, edit or remove products.</p></div>
            <nav class="flex items-center gap-2 text-sm text-slate-500" aria-label="Breadcrumb"><a href="{{ route('dashboard') }}" class="hover:text-black">Dashboard</a><span>&#8250;</span><span>Products</span></nav>
        </section>
        {{-- Page heading section ends here. --}}

        <section class="mt-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <article class="rounded-xl bg-white p-5 shadow-sm"><div class="flex items-center gap-4"><span class="grid h-14 w-14 place-items-center rounded-full bg-[#fff3cf] text-2xl">&#9632;</span><div><p class="text-xs text-slate-500">Total Products</p><p class="mt-1 text-2xl font-bold">86</p><p class="mt-1 text-xs text-emerald-600">&#8593; +12% <span class="text-slate-500">this month</span></p></div></div></article>
            <article class="rounded-xl bg-white p-5 shadow-sm"><div class="flex items-center gap-4"><span class="grid h-14 w-14 place-items-center rounded-full bg-[#dff7e6] text-2xl">&#9633;</span><div><p class="text-xs text-slate-500">Active Products</p><p class="mt-1 text-2xl font-bold">72</p><p class="mt-1 text-xs text-emerald-600">&#8593; +8% <span class="text-slate-500">this month</span></p></div></div></article>
            <article class="rounded-xl bg-white p-5 shadow-sm"><div class="flex items-center gap-4"><span class="grid h-14 w-14 place-items-center rounded-full bg-[#ffe3e3] text-2xl">&#8855;</span><div><p class="text-xs text-slate-500">Out of Stock</p><p class="mt-1 text-2xl font-bold">6</p><p class="mt-1 text-xs text-red-600">&#8593; +20% <span class="text-slate-500">this month</span></p></div></div></article>
            <article class="rounded-xl bg-white p-5 shadow-sm"><div class="flex items-center gap-4"><span class="grid h-14 w-14 place-items-center rounded-full bg-[#e2efff] text-2xl">&#9671;</span><div><p class="text-xs text-slate-500">Categories</p><p class="mt-1 text-2xl font-bold">12</p><p class="mt-1 text-xs text-emerald-600">&#8593; +0% <span class="text-slate-500">this month</span></p></div></div></article>
        </section>
        {{-- Product statistic cards section ends here. --}}

        <section class="mt-5 rounded-xl bg-white p-4 shadow-sm lg:p-5">
            <div class="flex flex-col gap-3 xl:flex-row xl:items-center xl:justify-between">
                <div class="grid gap-3 sm:grid-cols-3">
                    <select class="rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm outline-none"><option>All Categories</option><option>Hoodies</option><option>T-Shirts</option><option>Accessories</option></select>
                    <select class="rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm outline-none"><option>All Status</option><option>Active</option><option>Out of Stock</option><option>Low Stock</option></select>
                    <label class="flex items-center gap-2 rounded-lg bg-[#f5f7f9] px-3 py-2.5 text-sm text-slate-500"><span>&#9906;</span><input class="w-full bg-transparent outline-none" type="search" placeholder="Search products..."></label>
                </div>

                <button class="rounded-lg bg-[#ffd400] px-4 py-2.5 text-sm font-medium text-black transition hover:bg-[#e9c300]">+ Add Product</button>
            </div>
        </section>
        {{-- Product filter controls section ends here. --}}

        <section class="mt-4 overflow-hidden rounded-xl bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-[1100px] w-full text-left text-sm">
                    <thead class="bg-[#f5f7f9] text-xs font-semibold text-slate-800"><tr><th class="px-4 py-3"><input type="checkbox" aria-label="Select all products"></th><th class="px-4 py-3">#</th><th class="px-4 py-3">Image</th><th class="px-4 py-3">Product Name</th><th class="px-4 py-3">SKU</th><th class="px-4 py-3">Category</th><th class="px-4 py-3">Price</th><th class="px-4 py-3">Stock</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Action</th></tr></thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @foreach ($products as $index => $product)
                            <tr>
                                <td class="px-4 py-3"><input type="checkbox" aria-label="Select {{ $product[0] }}"></td>
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3"><span class="grid h-12 w-12 place-items-center rounded-lg text-lg font-bold {{ $product[8] }}">{{ $product[7] }}</span></td>
                                <td class="px-4 py-3 font-medium">{{ $product[0] }}</td><td class="px-4 py-3 text-slate-500">{{ $product[1] }}</td><td class="px-4 py-3 text-slate-500">{{ $product[2] }}</td><td class="px-4 py-3 font-semibold">{{ $product[3] }}</td><td class="px-4 py-3">{{ $product[4] }}</td>
                                <td class="px-4 py-3"><span class="rounded-md px-3 py-2 text-xs font-medium {{ $product[6] }}">{{ $product[5] }}</span></td>
                                <td class="px-4 py-3"><div class="flex gap-2"><button class="rounded-lg bg-slate-50 px-3 py-2" aria-label="Edit product">&#9998;</button><button class="rounded-lg bg-slate-50 px-3 py-2" aria-label="View product">&#128065;</button><button class="rounded-lg bg-slate-50 px-3 py-2" aria-label="More product options">&#8942;</button></div></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex flex-col gap-3 border-t border-slate-100 px-4 py-4 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between"><p>Showing 1 to 8 of 86 products</p><div class="flex items-center gap-2"><button class="rounded-lg bg-slate-100 px-3 py-2">&#8249;</button><button class="rounded-lg bg-[#ffd400] px-3 py-2 font-medium text-black">1</button><button class="rounded-lg px-3 py-2">2</button><button class="rounded-lg px-3 py-2">3</button><button class="rounded-lg px-3 py-2">4</button><button class="rounded-lg bg-slate-100 px-3 py-2">&#8250;</button></div></div>
        </section>
        {{-- Product table and pagination section ends here. --}}
    </main>
@endsection
