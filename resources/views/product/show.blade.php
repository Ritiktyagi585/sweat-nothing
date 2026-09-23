@extends('layout.dashboard')

@section('title', ($product ? 'Edit Product' : 'Add Product').' | Sweet Nothing')

@section('content')

<main class="mx-auto max-w-[1500px] p-5 lg:p-7">

    {{-- Page Heading --}}
    <section class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
        <div>
            <h1 class="text-2xl font-bold tracking-[-.03em]">{{ $product ? 'Edit Product' : 'Add Product' }}</h1>
            <p class="mt-1 text-slate-500">
                {{ $product ? 'Update the details for this product.' : 'Fill in the details to add a new product to your store.' }}
            </p>
        </div>

        <nav class="flex flex-wrap items-center gap-2 text-sm text-slate-500"
             aria-label="Breadcrumb">

            <a href="{{ route('dashboard') }}" class="hover:text-black">
                Dashboard
            </a>

            <span>&#8250;</span>

            <a href="{{ route('admin.products.index') }}" class="hover:text-black">
                Products
            </a>

            <span>&#8250;</span>
            <span>{{ $product ? 'Edit Product' : 'Add Product' }}</span>
        </nav>
    </section>


    {{-- Add Product Form --}}
    <form
        class="mt-5 grid gap-5 xl:grid-cols-[1.45fr_.95fr]"
        action="{{ $product ? route('admin.products.update', $product) : route('admin.products.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @if ($product)
            @method('PATCH')
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="xl:col-span-2 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">

                <p class="font-semibold">
                    Please correct the following errors:
                </p>

                <ul class="mt-2 list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif


        {{-- LEFT SIDE --}}
        <section class="rounded-xl bg-white p-5 shadow-sm lg:p-6">

            <div class="flex items-center gap-4">

                <span class="grid h-11 w-11 place-items-center rounded-full bg-[#fff3cf] text-xl">
                    &#9632;
                </span>

                <div>
                    <h2 class="font-semibold">Product Information</h2>
                    <p class="text-sm text-slate-500">
                        Basic details about your product.
                    </p>
                </div>

            </div>


            {{-- Product Name + SKU --}}
            <div class="mt-6 grid gap-5 md:grid-cols-2">

                <div>
                    <label for="product-name" class="text-sm font-medium">
                        Product Name
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="product-name"
                        name="name"
                        value="{{ old('name', $product?->name) }}"
                        class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-[#ffd400]"
                        type="text"
                        placeholder="Enter product name"
                        required
                    >
                </div>


                <div>
                    <label for="sku" class="text-sm font-medium">
                        SKU
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="sku"
                        name="sku"
                        value="{{ old('sku', $product?->sku) }}"
                        class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-[#ffd400]"
                        type="text"
                        placeholder="e.g. SN-P001"
                        required
                    >
                </div>

            </div>


            {{-- Description --}}
            <div class="mt-5">

                <label for="description" class="text-sm font-medium">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    class="mt-2 min-h-28 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-[#ffd400]"
                    placeholder="Enter product description..."
                >{{ old('description', $product?->description) }}</textarea>

            </div>


            {{-- Category + Status --}}
            <div class="mt-5 grid gap-5 md:grid-cols-2">

                <div>

                    <label for="category" class="text-sm font-medium">
                        Category
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="category"
                        name="category"
                        class="mt-2 w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm outline-none focus:border-[#ffd400]"
                        required
                    >

                        <option value="">Select category</option>

                        <option
                            value="Liquid Sweetener"
                            @selected(old('category', $product?->category) === 'Liquid Sweetener')
                        >
                            Liquid Sweetener
                        </option>

                        <option
                            value="Sweet Drops"
                            @selected(old('category', $product?->category) === 'Sweet Drops')
                        >
                            Sweet Drops
                        </option>

                        <option
                            value="Combo Pack"
                            @selected(old('category', $product?->category) === 'Combo Pack')
                        >
                            Combo Pack
                        </option>

                    </select>

                </div>


                <div>

                    <label for="status" class="text-sm font-medium">
                        Status
                    </label>

                    <select
                        id="status"
                        name="status"
                        class="mt-2 w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm outline-none focus:border-[#ffd400]"
                    >

                        <option
                            value="1"
                            @selected((string) old('status', $product?->status ?? 1) === '1')
                        >
                            Active
                        </option>

                        <option
                            value="0"
                            @selected((string) old('status', $product?->status ?? 1) === '0')
                        >
                            Inactive
                        </option>

                    </select>

                </div>

            </div>


            {{-- Price + Sale Price --}}
            <div class="mt-5 grid gap-5 md:grid-cols-2">

                <div>

                    <label for="price" class="text-sm font-medium">
                        Price (₹)
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="price"
                        name="price"
                        value="{{ old('price', $product?->price) }}"
                        class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-[#ffd400]"
                        type="number"
                        min="0"
                        step="0.01"
                        placeholder="0.00"
                        required
                    >

                </div>


                <div>

                    <label for="sale-price" class="text-sm font-medium">
                        Sale Price (₹)
                    </label>

                    <input
                        id="sale-price"
                        name="sale_price"
                        value="{{ old('sale_price', $product?->sale_price) }}"
                        class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-[#ffd400]"
                        type="number"
                        min="0"
                        step="0.01"
                        placeholder="0.00"
                    >

                    <p class="mt-1 text-xs text-slate-500">
                        Leave empty if no sale price.
                    </p>

                </div>

            </div>


            {{-- Stock --}}
            <div class="mt-5 md:max-w-[calc(50%-0.625rem)]">

                <label for="stock" class="text-sm font-medium">
                    Stock Quantity
                    <span class="text-red-500">*</span>
                </label>

                <input
                    id="stock"
                    name="stock"
                    value="{{ old('stock', $product?->stock) }}"
                    class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-[#ffd400]"
                    type="number"
                    min="0"
                    placeholder="0"
                    required
                >

                <p class="mt-1 text-xs text-slate-500">
                    Enter available stock quantity.
                </p>

            </div>

        </section>


        {{-- RIGHT SIDE --}}
        <div class="space-y-5">


            {{-- Product Image --}}
            <section class="rounded-xl bg-white p-5 shadow-sm lg:p-6">

                <div class="flex items-center gap-4">

                    <span class="grid h-11 w-11 place-items-center rounded-full bg-[#fff3cf] text-xl">
                        &#128444;
                    </span>

                    <div>
                        <h2 class="font-semibold">Product Image</h2>
                        <p class="text-sm text-slate-500">
                            Upload a product image.
                        </p>
                    </div>

                </div>


                <label class="mt-5 flex min-h-44 cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-slate-300 px-5 text-center transition hover:border-[#ffd400]">

                    <span class="text-3xl text-slate-400">
                        &#128444;
                    </span>

                    <span class="mt-3 text-sm font-medium">
                        Click to upload product image
                    </span>

                    <span class="mt-1 text-sm text-slate-500">
                        Choose an image from your computer
                    </span>

                    <span class="mt-2 text-xs text-slate-400">
                        JPG, JPEG, PNG or WEBP (Max 2MB)
                    </span>

                    <input
                        name="image"
                        class="hidden"
                        type="file"
                        accept="image/jpeg,image/png,image/webp"
                    >

                </label>

            </section>


            {{-- Additional Information --}}
            <section class="rounded-xl bg-white p-5 shadow-sm lg:p-6">

                <div class="flex items-center gap-4">

                    <span class="grid h-11 w-11 place-items-center rounded-full bg-[#fff3cf] text-xl">
                        &#128196;
                    </span>

                    <div>
                        <h2 class="font-semibold">
                            Additional Information
                        </h2>

                        <p class="text-sm text-slate-500">
                            Optional product details.
                        </p>
                    </div>

                </div>


                <div class="mt-5">

                    <label for="tags" class="text-sm font-medium">
                        Tags
                    </label>

                    <input
                        id="tags"
                        class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-[#ffd400]"
                        type="text"
                        placeholder="e.g. sweetener, sugar-free, drops"
                    >

                    <p class="mt-1 text-xs text-slate-500">
                        SEO fields will be connected later.
                    </p>

                </div>


                <div class="mt-5">

                    <label for="meta-title" class="text-sm font-medium">
                        Meta Title
                    </label>

                    <input
                        id="meta-title"
                        class="mt-2 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-[#ffd400]"
                        type="text"
                        placeholder="Enter meta title (SEO)"
                    >

                </div>


                <div class="mt-5">

                    <label for="meta-description" class="text-sm font-medium">
                        Meta Description
                    </label>

                    <textarea
                        id="meta-description"
                        class="mt-2 min-h-28 w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-[#ffd400]"
                        placeholder="Enter meta description (SEO)"
                    ></textarea>

                </div>

            </section>

        </div>


        {{-- Form Actions --}}
        <div class="xl:col-span-2 flex items-center justify-between rounded-xl bg-white p-4 shadow-sm">

            <a
                href="{{ route('admin.products.index') }}"
                class="rounded-lg border border-slate-200 px-4 py-2.5 text-sm font-medium transition hover:bg-slate-50"
            >
                Cancel
            </a>


            <button
                class="rounded-lg bg-[#ffd400] px-5 py-2.5 text-sm font-medium text-black transition hover:bg-[#e9c300]"
                type="submit"
            >
                &#128190; {{ $product ? 'Update Product' : 'Save Product' }}
            </button>

        </div>

    </form>

</main>

@endsection
