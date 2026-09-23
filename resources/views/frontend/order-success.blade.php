@extends('layout.app')

@section('title', 'Order Confirmed | Sweat Nothing')

@section('content')
    <main class="mx-auto max-w-3xl px-5 py-16 text-center lg:px-8">
        <section class="rounded-3xl bg-[#fff0bd] p-8 sm:p-12">
            <p class="text-5xl">✓</p>
            <p class="mt-5 text-xs font-bold tracking-[.28em] text-[#a66f00]">ORDER CONFIRMED</p>
            <h1 class="mt-3 text-3xl font-black tracking-[-.04em] sm:text-4xl">Thank you, {{ $order->customer_name }}!</h1>
            <p class="mt-4 text-black/70">Your order <strong>{{ $order->order_number }}</strong> has been placed successfully.</p>
            <div class="mx-auto mt-7 max-w-md rounded-2xl bg-white p-5 text-left"><p class="text-sm text-black/60">Payment Method</p><p class="mt-1 font-bold">Cash on Delivery</p><p class="mt-4 text-sm text-black/60">Order Total</p><p class="mt-1 text-2xl font-black">₹{{ number_format((float) $order->total, 2) }}</p></div>
            <a href="{{ route('products') }}" class="mt-7 inline-block rounded-full bg-[#101010] px-6 py-3 text-sm font-bold text-white">Continue Shopping</a>
        </section>
        {{-- Order confirmation section ends here. --}}
    </main>
@endsection
