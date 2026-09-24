@extends('layout.app')

@section('title', 'Payment | Sweat Nothing')

@section('content')
    <main class="mx-auto max-w-6xl px-5 py-10 lg:px-8">
        <section class="flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
            <div>
                <p class="text-xs font-bold tracking-[.28em] text-[#c89500]">CHECKOUT · STEP 2 OF 2</p>
                <h1 class="mt-2 text-3xl font-black tracking-[-.04em] sm:text-4xl">Payment Method</h1>
                <p class="mt-2 text-sm text-black/60">Choose how you would like to pay for your order.</p>
            </div>
            <a href="{{ route('checkout.index') }}" class="text-sm font-semibold underline underline-offset-4">Edit Address</a>
        </section>
        {{-- Payment heading section ends here. --}}

        @if (session('success'))
            <p class="mt-6 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">{{ session('success') }}</p>
        @endif

        @if (session('error'))
            <p class="mt-6 rounded-xl bg-red-50 px-4 py-3 text-sm font-medium text-red-700">{{ session('error') }}</p>
        @endif

        @error('cart')
            <p class="mt-6 rounded-xl bg-red-50 px-4 py-3 text-sm font-medium text-red-700">{{ $message }}</p>
        @enderror

        <section class="mt-6 grid gap-6 lg:grid-cols-[1fr_340px]">
            <div class="space-y-4">
                @if ($razorpayOrderId && $razorpayKeyId)
                    <form id="razorpay-payment-form" action="{{ route('checkout.razorpay.verify') }}" method="POST" class="rounded-2xl border-2 border-[#2f6fed] bg-[#f4f8ff] p-5">
                        @csrf
                        <input name="razorpay_order_id" type="hidden">
                        <input name="razorpay_payment_id" type="hidden">
                        <input name="razorpay_signature" type="hidden">
                        <div class="flex items-start justify-between gap-4"><div><h2 class="font-bold">UPI, Cards & More</h2><p class="mt-1 text-sm text-black/70">Pay securely with UPI, debit card, credit card, netbanking or wallets through Razorpay.</p></div><span class="rounded-full bg-[#2f6fed] px-3 py-1 text-xs font-semibold text-white">Razorpay</span></div>
                        <button id="razorpay-pay-button" class="mt-5 w-full rounded-full bg-[#2f6fed] py-3 text-sm font-bold text-white transition hover:bg-[#245bc6]" type="button">Pay Securely · ₹{{ number_format($cartTotal, 2) }}</button>
                    </form>
                @endif

                <form action="{{ route('checkout.place-order') }}" method="POST" class="rounded-2xl border-2 border-[#ffd100] bg-[#fff9dc] p-5">
                    @csrf
                    <input name="payment_method" type="hidden" value="cod">
                    <div class="flex items-start justify-between gap-4"><div><h2 class="font-bold">Cash on Delivery</h2><p class="mt-1 text-sm text-black/70">Pay when your order is delivered to your address.</p></div><span class="text-2xl">💵</span></div>
                    <button class="mt-5 w-full rounded-full bg-[#ffd100] py-3 text-sm font-bold transition hover:bg-[#f2c300]" type="submit">Place COD Order · ₹{{ number_format($cartTotal, 2) }}</button>
                </form>
                {{-- Payment option cards section ends here. --}}
            </div>

            <aside class="h-fit rounded-2xl bg-[#101010] p-6 text-white">
                <h2 class="text-xl font-bold">Delivering To</h2>
                <p class="mt-4 font-semibold">{{ $address['name'] }}</p>
                <p class="mt-1 text-sm leading-6 text-white/65">{{ $address['address_line_1'] }}@if ($address['address_line_2'])<br>{{ $address['address_line_2'] }}@endif<br>{{ $address['city'] }}, {{ $address['state'] }} - {{ $address['pincode'] }}</p>
                <div class="mt-5 border-t border-white/15 pt-5"><div class="flex justify-between text-lg font-bold"><span>Total</span><span>₹{{ number_format($cartTotal, 2) }}</span></div></div>
            </aside>
            {{-- Delivery and total summary section ends here. --}}
        </section>
    </main>

    @if ($razorpayOrderId && $razorpayKeyId)
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
            document.getElementById('razorpay-pay-button').addEventListener('click', () => {
                const checkout = new Razorpay({
                    key: @json($razorpayKeyId),
                    amount: @json($amountInPaise),
                    currency: 'INR',
                    name: 'Sweet Nothing',
                    description: 'Online order payment',
                    order_id: @json($razorpayOrderId),
                    prefill: {
                        name: @json($address['name']),
                        email: @json($address['email']),
                        contact: @json($address['phone']),
                    },
                    theme: {
                        color: '#ffd100',
                    },
                    handler: (response) => {
                        const form = document.getElementById('razorpay-payment-form');
                        form.querySelector('[name="razorpay_order_id"]').value = response.razorpay_order_id;
                        form.querySelector('[name="razorpay_payment_id"]').value = response.razorpay_payment_id;
                        form.querySelector('[name="razorpay_signature"]').value = response.razorpay_signature;
                        form.submit();
                    },
                });

                checkout.open();
            });
        </script>
    @endif
@endsection
