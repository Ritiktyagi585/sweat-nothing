@extends('layout.app')

@section('title', 'Your Cart | Sweat Nothing')

@section('content')
    <main class="mx-auto max-w-6xl px-5 py-10 lg:px-8">
        <section class="flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
            <div>
                <p class="text-xs font-bold tracking-[.28em] text-[#c89500]">SHOPPING BAG</p>
                <h1 class="mt-2 text-3xl font-black tracking-[-.04em] sm:text-4xl">Your Cart</h1>
            </div>
            <a href="{{ route('products') }}" class="text-sm font-semibold underline underline-offset-4">Continue Shopping</a>
        </section>
        {{-- Cart heading section ends here. --}}

        @if (session('success'))
            <p class="mt-6 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">{{ session('success') }}</p>
        @endif

        @if ($cartItems->isEmpty())
            <section class="mt-6 rounded-2xl bg-[#f8f5ef] px-6 py-16 text-center">
                <p class="text-4xl">🛍️</p>
                <h2 class="mt-4 text-2xl font-bold">Your cart is empty</h2>
                <p class="mt-2 text-black/60">Add a healthier choice to get started.</p>
                <a href="{{ route('products') }}" class="mt-6 inline-block rounded-full bg-[#ffd100] px-6 py-3 text-sm font-bold">Shop Products</a>
            </section>
        @else
            <section class="mt-6 grid gap-6 lg:grid-cols-[1fr_340px]">
                <div class="overflow-hidden rounded-2xl border border-black/5 bg-white">
                    @foreach ($cartItems as $item)
                        <article class="flex gap-4 border-b border-black/5 p-4 last:border-0 sm:p-5">
                            @if ($item['image'])
                                <img class="h-20 w-20 rounded-xl object-cover sm:h-24 sm:w-24" src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}">
                            @else
                                <div class="grid h-20 w-20 shrink-0 place-items-center rounded-xl bg-[#fff0bd] text-lg font-black sm:h-24 sm:w-24">SN</div>
                            @endif

                            <div class="min-w-0 flex-1">
                                <h2 class="font-bold">{{ $item['name'] }}</h2>
                                <p class="mt-1 text-sm text-black/60">₹{{ number_format((float) $item['price'], 2) }} each</p>

                                <div class="mt-3 flex flex-wrap items-center justify-between gap-3">
                                    <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <label class="text-sm text-black/60" for="quantity-{{ $item['id'] }}">Quantity</label>
                                        <input id="quantity-{{ $item['id'] }}" name="quantity" class="w-16 rounded-lg border border-black/15 px-2 py-1.5 text-center text-sm" type="number" min="1" max="{{ $item['stock'] }}" value="{{ $item['quantity'] }}" onchange="this.form.submit()">
                                    </form>

                                    <form action="{{ route('cart.destroy', $item['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-sm font-semibold text-red-600 hover:underline" type="submit">Remove</button>
                                    </form>
                                </div>
                            </div>

                            <p class="whitespace-nowrap font-bold">₹{{ number_format((float) ($item['price'] * $item['quantity']), 2) }}</p>
                        </article>
                    @endforeach
                </div>
                {{-- Cart item list section ends here. --}}

                <aside class="h-fit rounded-2xl bg-[#101010] p-6 text-white">
                    <h2 class="text-xl font-bold">Order Summary</h2>
                    <div class="mt-5 flex items-center justify-between border-b border-white/15 pb-4 text-sm text-white/70"><span>Subtotal</span><span>₹{{ number_format($cartTotal, 2) }}</span></div>
                    <div class="flex items-center justify-between py-4 text-lg font-bold"><span>Total</span><span>₹{{ number_format($cartTotal, 2) }}</span></div>
                    <p class="text-xs leading-5 text-white/60">Delivery charges and address details will be added at checkout.</p>
                    <a href="{{ route('checkout.index') }}" class="mt-5 block w-full rounded-full bg-[#ffd100] py-3 text-center text-sm font-bold text-black transition hover:bg-[#f2c300]">Checkout</a>
                </aside>
                {{-- Cart total section ends here. --}}
            </section>
        @endif
    </main>
@endsection
