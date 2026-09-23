@extends('layout.dashboard')

@section('title', $product->name.' | Sweet Nothing')

@section('content')
    <main class="mx-auto max-w-5xl p-5 lg:p-7">
        <section class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <p class="text-sm text-slate-500">Product Details</p>
                <h1 class="mt-1 text-2xl font-bold tracking-[-.03em]">{{ $product->name }}</h1>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('dashboard.products') }}" class="rounded-lg border border-slate-200 px-4 py-2.5 text-sm font-medium hover:bg-slate-50">Back to Products</a>
                <a href="{{ route('admin.products.edit', $product) }}" class="rounded-lg bg-[#ffd400] px-4 py-2.5 text-sm font-medium text-black hover:bg-[#e9c300]">Edit Product</a>
            </div>
        </section>
        {{-- Product details heading section ends here. --}}

        <section class="mt-5 grid gap-5 md:grid-cols-[280px_1fr]">
            <article class="rounded-xl bg-white p-5 shadow-sm">
                @if ($product->image)
                    <img class="aspect-square w-full rounded-lg object-cover" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                @else
                    <div class="grid aspect-square place-items-center rounded-lg bg-[#fff3cf] text-4xl font-bold text-slate-700">SN</div>
                @endif
            </article>

            <article class="rounded-xl bg-white p-5 shadow-sm lg:p-6">
                <dl class="grid gap-5 sm:grid-cols-2">
                    <div><dt class="text-xs font-medium uppercase tracking-wider text-slate-500">SKU</dt><dd class="mt-1 font-semibold">{{ $product->sku }}</dd></div>
                    <div><dt class="text-xs font-medium uppercase tracking-wider text-slate-500">Category</dt><dd class="mt-1 font-semibold">{{ $product->category }}</dd></div>
                    <div><dt class="text-xs font-medium uppercase tracking-wider text-slate-500">Price</dt><dd class="mt-1 font-semibold">₹ {{ number_format((float) $product->price, 2) }}</dd></div>
                    <div><dt class="text-xs font-medium uppercase tracking-wider text-slate-500">Sale Price</dt><dd class="mt-1 font-semibold">{{ $product->sale_price ? '₹ '.number_format((float) $product->sale_price, 2) : 'Not set' }}</dd></div>
                    <div><dt class="text-xs font-medium uppercase tracking-wider text-slate-500">Stock</dt><dd class="mt-1 font-semibold">{{ $product->stock }} units</dd></div>
                    <div><dt class="text-xs font-medium uppercase tracking-wider text-slate-500">Status</dt><dd class="mt-1"><span class="rounded-md px-3 py-1.5 text-xs font-medium {{ $product->status ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">{{ $product->status ? 'Active' : 'Inactive' }}</span></dd></div>
                </dl>

                <div class="mt-6 border-t border-slate-100 pt-5">
                    <p class="text-xs font-medium uppercase tracking-wider text-slate-500">Description</p>
                    <p class="mt-2 leading-7 text-slate-600">{{ $product->description ?: 'No description added.' }}</p>
                </div>
            </article>
        </section>
        {{-- Product information section ends here. --}}
    </main>
@endsection
