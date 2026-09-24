@extends('layout.dashboard')

@section('title', 'Products | Sweat Nothing')

@section('content')
    <main class="mx-auto max-w-[1500px] p-5 lg:p-7">
        <section class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div><h1 class="text-2xl font-bold tracking-[-.03em]">Products</h1><p class="mt-1 text-slate-500">Manage your store products. Add, edit or remove products.</p></div>
            <nav class="flex items-center gap-2 text-sm text-slate-500" aria-label="Breadcrumb"><a href="{{ route('dashboard') }}" class="hover:text-black">Dashboard</a><span>&#8250;</span><span>Products</span></nav>
        </section>
        {{-- Page heading section ends here. --}}

        <section class="mt-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <article class="rounded-xl bg-white p-5 shadow-sm"><div class="flex items-center gap-4"><span class="grid h-14 w-14 place-items-center rounded-full bg-[#fff3cf] text-2xl">&#9632;</span><div><p class="text-xs text-slate-500">Total Products</p><p class="mt-1 text-2xl font-bold">{{ $products->count() }}</p><p class="mt-1 text-xs text-emerald-600">Saved in database</p></div></div></article>
            <article class="rounded-xl bg-white p-5 shadow-sm"><div class="flex items-center gap-4"><span class="grid h-14 w-14 place-items-center rounded-full bg-[#dff7e6] text-2xl">&#9633;</span><div><p class="text-xs text-slate-500">Active Products</p><p class="mt-1 text-2xl font-bold">{{ $products->where('status', true)->count() }}</p><p class="mt-1 text-xs text-emerald-600">Currently active</p></div></div></article>
            <article class="rounded-xl bg-white p-5 shadow-sm"><div class="flex items-center gap-4"><span class="grid h-14 w-14 place-items-center rounded-full bg-[#ffe3e3] text-2xl">&#8855;</span><div><p class="text-xs text-slate-500">Out of Stock</p><p class="mt-1 text-2xl font-bold">{{ $products->where('stock', 0)->count() }}</p><p class="mt-1 text-xs text-red-600">Needs restocking</p></div></div></article>
            <article class="rounded-xl bg-white p-5 shadow-sm"><div class="flex items-center gap-4"><span class="grid h-14 w-14 place-items-center rounded-full bg-[#e2efff] text-2xl">&#9671;</span><div><p class="text-xs text-slate-500">Categories</p><p class="mt-1 text-2xl font-bold">{{ $products->pluck('category')->filter()->unique()->count() }}</p><p class="mt-1 text-xs text-emerald-600">Available categories</p></div></div></article>
        </section>
        {{-- Product statistic cards section ends here. --}}

        <section class="mt-5 rounded-xl bg-white p-4 shadow-sm lg:p-5">
            @if (session('success'))
                <p class="mb-4 rounded-lg bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
                    {{ session('success') }}
                </p>
            @endif

            <div class="flex flex-col gap-3 xl:flex-row xl:items-center xl:justify-between">
                <div class="grid gap-3 sm:grid-cols-3">
                    <select class="rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm outline-none"><option>All Categories</option><option>Hoodies</option><option>T-Shirts</option><option>Accessories</option></select>
                    <select class="rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm outline-none"><option>All Status</option><option>Active</option><option>Out of Stock</option><option>Low Stock</option></select>
                    <label class="flex items-center gap-2 rounded-lg bg-[#f5f7f9] px-3 py-2.5 text-sm text-slate-500"><span>&#9906;</span><input class="w-full bg-transparent outline-none" type="search" placeholder="Search products..."></label>
                </div>

                <a href="{{ route('admin.products.create') }}" class="rounded-lg bg-[#ffd400] px-4 py-2.5 text-sm font-medium text-black transition hover:bg-[#e9c300]">
    + Add Product
</a>
            </div>
        </section>
        {{-- Product filter controls section ends here. --}}

        <section class="mt-4 overflow-hidden rounded-xl bg-white shadow-sm">
            <div class="space-y-3 p-3 sm:hidden">
                @forelse ($products as $index => $product)
                    <article class="rounded-lg border border-slate-100 p-4">
                        <div class="flex gap-3">
                            @if ($product->image)
                                <img class="h-16 w-16 shrink-0 rounded-lg object-cover" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                            @else
                                <span class="grid h-16 w-16 shrink-0 place-items-center rounded-lg bg-[#fff3cf] text-sm font-bold text-slate-700">SN</span>
                            @endif
                            <div class="min-w-0 flex-1">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="min-w-0"><p class="truncate font-semibold">{{ $product->name }}</p><p class="mt-1 text-xs text-slate-500">{{ $product->sku }}</p></div>
                                    <span class="shrink-0 rounded-md px-2.5 py-1.5 text-xs font-medium {{ $product->status ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">{{ $product->status ? 'Active' : 'Inactive' }}</span>
                                </div>
                                <p class="mt-2 text-xs text-slate-500">{{ $product->category ?: 'Uncategorised' }}</p>
                                <div class="mt-2 flex items-center justify-between gap-3"><p class="font-semibold">₹{{ number_format((float) $product->price, 2) }}</p><p class="text-sm text-slate-600">Stock: {{ $product->stock }}</p></div>
                            </div>
                        </div>
                        <div class="mt-4 flex gap-2 border-t border-slate-100 pt-3">
                            <a href="{{ route('admin.products.edit', $product) }}" class="flex-1 rounded-lg bg-slate-50 px-3 py-2 text-center text-xs font-medium hover:bg-slate-100">Edit</a>
                            <a href="{{ route('admin.products.show', $product) }}" class="flex-1 rounded-lg bg-slate-50 px-3 py-2 text-center text-xs font-medium hover:bg-slate-100">View</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button class="w-full rounded-lg bg-red-50 px-3 py-2 text-xs font-medium text-red-600 hover:bg-red-100" type="submit" onclick="return confirm('Delete this product?')">Delete</button>
                            </form>
                        </div>
                    </article>
                @empty
                    <p class="py-10 text-center text-sm text-slate-500">No products added yet. Click “Add Product” to create your first product.</p>
                @endforelse
            </div>

            <div class="hidden overflow-x-auto sm:block">
                <table class="min-w-[1100px] w-full text-left text-sm">
                    <thead class="bg-[#f5f7f9] text-xs font-semibold text-slate-800"><tr><th class="px-4 py-3"><input type="checkbox" aria-label="Select all products"></th><th class="px-4 py-3">#</th><th class="px-4 py-3">Image</th><th class="px-4 py-3">Product Name</th><th class="px-4 py-3">SKU</th><th class="px-4 py-3">Category</th><th class="px-4 py-3">Price</th><th class="px-4 py-3">Stock</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Action</th></tr></thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse ($products as $index => $product)
                            <tr>
                                <td class="px-4 py-3"><input type="checkbox" aria-label="Select {{ $product->name }}"></td>
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">
                                    @if ($product->image)
                                        <img class="h-12 w-12 rounded-lg object-cover" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                                    @else
                                        <span class="grid h-12 w-12 place-items-center rounded-lg bg-[#fff3cf] text-xs font-bold text-slate-700">SN</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 font-medium">{{ $product->name }}</td>
                                <td class="px-4 py-3 text-slate-500">{{ $product->sku }}</td>
                                <td class="px-4 py-3 text-slate-500">{{ $product->category }}</td>
                                <td class="px-4 py-3 font-semibold">₹ {{ number_format((float) $product->price, 2) }}</td>
                                <td class="px-4 py-3">{{ $product->stock }}</td>
                                <td class="px-4 py-3">
                                    <span class="rounded-md px-3 py-2 text-xs font-medium {{ $product->status ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">
                                        {{ $product->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="rounded-lg bg-slate-50 px-3 py-2 hover:bg-slate-100" aria-label="Edit {{ $product->name }}" title="Edit product">&#9998;</a>
                                        <a href="{{ route('admin.products.show', $product) }}" class="rounded-lg bg-slate-50 px-3 py-2 hover:bg-slate-100" aria-label="View {{ $product->name }}" title="View product">&#128065;</a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="grid h-10 w-10 place-items-center rounded-lg bg-red-50 text-red-600 hover:bg-red-100" type="submit" aria-label="Delete {{ $product->name }}" title="Delete product" onclick="return confirm('Delete this product?')">
                                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                    <path d="M3 6h18M8 6V4h8v2m-9 0 1 14h8l1-14M10 11v5m4-5v5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-4 py-10 text-center text-slate-500">
                                    No products added yet. Click “Add Product” to create your first product.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-t border-slate-100 px-4 py-4 text-sm text-slate-500">
                Showing {{ $products->count() }} {{ $products->count() === 1 ? 'product' : 'products' }} from the database
            </div>
        </section>
        {{-- Product table and pagination section ends here. --}}
    </main>
@endsection
