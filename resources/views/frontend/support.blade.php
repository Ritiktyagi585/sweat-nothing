@extends('layout.app')

@section('title', 'Customer Support | Sweet Nothing')

@section('content')
    <main class="mx-auto max-w-6xl px-5 py-10 sm:px-6 sm:py-14 lg:px-8">
        <section class="grid overflow-hidden rounded-3xl bg-[#fff8df] lg:grid-cols-[1.05fr_.95fr]">
            <div class="p-7 sm:p-10 lg:p-12">
                <p class="text-xs font-bold uppercase tracking-[.3em] text-black/60">We're here to help</p>
                <h1 class="mt-3 text-4xl font-black tracking-[-.05em] sm:text-5xl">Customer <span class="text-[#d7ad00]">Support</span></h1>
                <p class="mt-4 max-w-xl leading-6 text-black/70">Need help with a product, order, payment, or delivery? Send our team a message and include your order number if you have one.</p>
                <div class="mt-7 flex flex-wrap gap-3">
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center rounded-full bg-[#ffd100] px-6 py-3 text-sm font-bold transition hover:-translate-y-0.5">Contact our team <span class="ml-2" aria-hidden="true">→</span></a>
                    <a href="{{ route('contact') }}#customer-details" class="inline-flex items-center justify-center rounded-full border border-black/15 bg-white/70 px-6 py-3 text-sm font-semibold hover:bg-white">Contact details</a>
                </div>
            </div>
            <div class="flex flex-col justify-center gap-4 bg-white/70 p-7 sm:p-10">
                <a href="tel:+91204567890" class="flex items-center gap-4 rounded-2xl border border-black/5 bg-white p-4 shadow-sm"><span class="grid h-11 w-11 place-items-center rounded-full bg-[#fff3cf] text-lg" aria-hidden="true">☎</span><span><strong class="block">Call us</strong><span class="text-sm text-slate-600">+91 20 456 7890</span></span></a>
                <a href="mailto:hello@sweatnothing.in" class="flex items-center gap-4 rounded-2xl border border-black/5 bg-white p-4 shadow-sm"><span class="grid h-11 w-11 place-items-center rounded-full bg-[#e2efff] text-lg" aria-hidden="true">✉</span><span><strong class="block">Email us</strong><span class="text-sm text-slate-600">hello@sweatnothing.in</span></span></a>
                <p class="px-1 text-sm leading-5 text-slate-600">For order questions, include the email or phone number used at checkout so we can find your order.</p>
            </div>
        </section>

        <section class="mt-8 rounded-3xl border border-black/5 bg-white p-6 shadow-sm sm:p-9">
            <h2 class="text-2xl font-black tracking-[-.03em]">How can we help?</h2>
            <div class="mt-5 grid gap-4 sm:grid-cols-3">
                <article class="rounded-2xl bg-[#fff9e8] p-5"><h3 class="font-bold">Product questions</h3><p class="mt-2 text-sm leading-5 text-slate-600">Ask us about our products or choosing the right option for you.</p></article>
                <article class="rounded-2xl bg-[#f1f7ff] p-5"><h3 class="font-bold">Order updates</h3><p class="mt-2 text-sm leading-5 text-slate-600">Share your order details and our team can help with its status.</p></article>
                <article class="rounded-2xl bg-[#eefaf1] p-5"><h3 class="font-bold">Payments and delivery</h3><p class="mt-2 text-sm leading-5 text-slate-600">Tell us what happened and include any useful checkout details.</p></article>
            </div>
        </section>
    </main>
@endsection
