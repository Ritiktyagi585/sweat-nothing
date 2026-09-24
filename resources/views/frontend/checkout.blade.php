@extends('layout.app')

@section('title', 'Checkout | Sweat Nothing')

@section('content')
    <main class="mx-auto max-w-6xl px-5 py-10 lg:px-8">
        <section class="flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
            <div>
                <p class="text-xs font-bold tracking-[.28em] text-[#c89500]">CHECKOUT · STEP 1 OF 2</p>
                <h1 class="mt-2 text-3xl font-black tracking-[-.04em] sm:text-4xl">Delivery Address</h1>
                <p class="mt-2 text-sm text-black/60">Enter the address where you want your order delivered.</p>
            </div>
            <a href="{{ route('cart.index') }}" class="text-sm font-semibold underline underline-offset-4">Back to Cart</a>
        </section>
        {{-- Checkout heading section ends here. --}}

        @if (session('success'))
            <p class="mt-6 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">{{ session('success') }}</p>
        @endif

        <section class="mt-6 grid gap-6 lg:grid-cols-[1fr_340px]">
            <form action="{{ route('checkout.address.store') }}" method="POST" class="rounded-2xl bg-white p-5 shadow-sm sm:p-7">
                @csrf

                <h2 class="text-xl font-bold">Contact Details</h2>
                <div class="mt-5 grid gap-4 sm:grid-cols-2">
                    <div><label for="name" class="text-sm font-semibold">Full Name *</label><input id="name" name="name" value="{{ old('name', $address['name'] ?? '') }}" class="mt-2 w-full rounded-lg border border-black/15 px-3 py-3 text-sm outline-none focus:border-[#ffd100]" required></div>
                    <div><label for="phone" class="text-sm font-semibold">Mobile Number *</label><input id="phone" name="phone" value="{{ old('phone', $address['phone'] ?? '') }}" class="mt-2 w-full rounded-lg border border-black/15 px-3 py-3 text-sm outline-none focus:border-[#ffd100]" type="tel" inputmode="numeric" pattern="[0-9]{10}" maxlength="10" oninput="this.value = this.value.replace(/\D/g, '').slice(0, 10)" required></div>
                </div>
                <div class="mt-4"><label for="email" class="text-sm font-semibold">Email Address *</label><input id="email" name="email" value="{{ old('email', $address['email'] ?? '') }}" class="mt-2 w-full rounded-lg border border-black/15 px-3 py-3 text-sm outline-none focus:border-[#ffd100]" type="email" required></div>
                {{-- Customer contact section ends here. --}}

                <h2 class="mt-8 text-xl font-bold">Address Details</h2>
                <div class="mt-5"><label for="address-line-1" class="text-sm font-semibold">House / Flat / Building *</label><input id="address-line-1" name="address_line_1" value="{{ old('address_line_1', $address['address_line_1'] ?? '') }}" class="mt-2 w-full rounded-lg border border-black/15 px-3 py-3 text-sm outline-none focus:border-[#ffd100]" required></div>
                <div class="mt-4"><label for="address-line-2" class="text-sm font-semibold">Area, Street, Landmark</label><input id="address-line-2" name="address_line_2" value="{{ old('address_line_2', $address['address_line_2'] ?? '') }}" class="mt-2 w-full rounded-lg border border-black/15 px-3 py-3 text-sm outline-none focus:border-[#ffd100]"></div>
                <div class="mt-4 grid gap-4 sm:grid-cols-3">
                    <div><label for="city" class="text-sm font-semibold">City *</label><input id="city" name="city" value="{{ old('city', $address['city'] ?? '') }}" class="mt-2 w-full rounded-lg border border-black/15 px-3 py-3 text-sm outline-none focus:border-[#ffd100]" required></div>
                    <div><label for="state" class="text-sm font-semibold">State *</label><input id="state" name="state" value="{{ old('state', $address['state'] ?? '') }}" class="mt-2 w-full rounded-lg border border-black/15 px-3 py-3 text-sm outline-none focus:border-[#ffd100]" required></div>
                    <div><label for="pincode" class="text-sm font-semibold">Pincode *</label><input id="pincode" name="pincode" value="{{ old('pincode', $address['pincode'] ?? '') }}" class="mt-2 w-full rounded-lg border border-black/15 px-3 py-3 text-sm outline-none focus:border-[#ffd100]" inputmode="numeric" pattern="[0-9]{6}" maxlength="6" oninput="this.value = this.value.replace(/\D/g, '').slice(0, 6)" required></div>
                </div>
                <fieldset class="mt-5"><legend class="text-sm font-semibold">Address Type *</legend><div class="mt-3 flex flex-wrap gap-4"><label class="flex items-center gap-2 text-sm"><input name="address_type" value="Home" type="radio" @checked(old('address_type', $address['address_type'] ?? 'Home') === 'Home')> Home</label><label class="flex items-center gap-2 text-sm"><input name="address_type" value="Work" type="radio" @checked(old('address_type', $address['address_type'] ?? '') === 'Work')> Work</label><label class="flex items-center gap-2 text-sm"><input name="address_type" value="Other" type="radio" @checked(old('address_type', $address['address_type'] ?? '') === 'Other')> Other</label></div></fieldset>
                {{-- Delivery address section ends here. --}}

                @if ($errors->any())
                    <p class="mt-5 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">Please fill all required details correctly.</p>
                @endif

                <button class="mt-7 w-full rounded-full bg-[#ffd100] py-3 text-sm font-bold transition hover:bg-[#f2c300]" type="submit">Save Address &amp; Continue</button>
            </form>

            <aside class="h-fit rounded-2xl bg-[#101010] p-6 text-white">
                <h2 class="text-xl font-bold">Order Summary</h2>
                <div class="mt-5 space-y-3 border-b border-white/15 pb-5">
                    @foreach ($cartItems as $item)
                        <div class="flex justify-between gap-3 text-sm text-white/70"><span>{{ $item['name'] }} × {{ $item['quantity'] }}</span><span>₹{{ number_format((float) ($item['price'] * $item['quantity']), 2) }}</span></div>
                    @endforeach
                </div>
                <div class="flex items-center justify-between py-5 text-lg font-bold"><span>Total</span><span>₹{{ number_format($cartTotal, 2) }}</span></div>
                <p class="text-xs leading-5 text-white/60">Your payment option comes after saving the delivery address.</p>
            </aside>
            {{-- Checkout summary section ends here. --}}
        </section>
    </main>
@endsection
