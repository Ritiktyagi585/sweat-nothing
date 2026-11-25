@extends('layout.app')

@section('title', 'Terms & Conditions | Sweet Nothing')

@section('content')
    <main class="mx-auto max-w-5xl px-5 py-10 sm:px-6 sm:py-14 lg:px-8">
        <header class="rounded-3xl bg-[#fff8df] px-6 py-9 sm:px-10 sm:py-12">
            <p class="text-xs font-bold uppercase tracking-[.3em] text-black/60">Using this website</p>
            <h1 class="mt-3 text-4xl font-black tracking-[-.05em] sm:text-5xl">Terms &amp; <span class="text-[#d7ad00]">Conditions</span></h1>
            <p class="mt-4 max-w-2xl leading-6 text-black/70">These terms describe the basic conditions for browsing our site and ordering Sweet Nothing products.</p>
        </header>

        <article class="mt-7 rounded-3xl border border-black/5 bg-white p-6 shadow-sm sm:p-10">
            <div class="space-y-8 leading-7 text-slate-700">
                <section><h2 class="text-xl font-bold text-black">Website information</h2><p class="mt-2">We work to keep product descriptions, availability, and prices current. Product availability and displayed information may change, and an item may become unavailable before an order is accepted.</p></section>
                <section><h2 class="text-xl font-bold text-black">Orders and payment</h2><p class="mt-2">Please provide accurate contact and delivery details when placing an order. An order is subject to confirmation and successful completion of the selected payment method. We may contact you if information is incomplete or needs clarification.</p></section>
                <section><h2 class="text-xl font-bold text-black">Delivery and order support</h2><p class="mt-2">Delivery timing can depend on the destination and delivery service. For an update, cancellation request, or issue with an order, contact support with your order details so our team can assist.</p></section>
                <section><h2 class="text-xl font-bold text-black">Using the website</h2><p class="mt-2">Use the website lawfully and do not interfere with its operation, attempt unauthorized access, or submit misleading information through its forms.</p></section>
                <section><h2 class="text-xl font-bold text-black">Updates and questions</h2><p class="mt-2">We may revise these terms as the website and services change. Continued use after an update means you are viewing the current version of this page. If you have a question, contact our team.</p><a href="{{ route('support') }}" class="mt-3 inline-flex font-semibold text-[#806500] hover:underline">Contact support <span class="ml-1" aria-hidden="true">→</span></a></section>
            </div>
        </article>
    </main>
@endsection
