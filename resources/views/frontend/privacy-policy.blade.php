@extends('layout.app')

@section('title', 'Privacy Policy | Sweet Nothing')

@section('content')
    <main class="mx-auto max-w-5xl px-5 py-10 sm:px-6 sm:py-14 lg:px-8">
        <header class="rounded-3xl bg-[#fff8df] px-6 py-9 sm:px-10 sm:py-12">
            <p class="text-xs font-bold uppercase tracking-[.3em] text-black/60">Your information</p>
            <h1 class="mt-3 text-4xl font-black tracking-[-.05em] sm:text-5xl">Privacy <span class="text-[#d7ad00]">Policy</span></h1>
            <p class="mt-4 max-w-2xl leading-6 text-black/70">This page explains how Sweet Nothing uses information you share while browsing, placing an order, or contacting us.</p>
        </header>

        <article class="mt-7 rounded-3xl border border-black/5 bg-white p-6 shadow-sm sm:p-10">
            <div class="space-y-8 leading-7 text-slate-700">
                <section><h2 class="text-xl font-bold text-black">Information you provide</h2><p class="mt-2">When you place an order or send us a message, we may receive details such as your name, email address, phone number, delivery address, and the information in your enquiry.</p></section>
                <section><h2 class="text-xl font-bold text-black">How we use it</h2><p class="mt-2">We use these details to process and deliver orders, provide order updates, respond to questions, and maintain the operation and security of this website. Essential session data may be used to keep your cart and checkout working.</p></section>
                <section><h2 class="text-xl font-bold text-black">Service providers</h2><p class="mt-2">To complete a requested service, relevant information may be shared with providers involved in payment processing, delivery, or website operation. They receive only the information needed for their role.</p></section>
                <section><h2 class="text-xl font-bold text-black">Keeping information safe</h2><p class="mt-2">We take reasonable steps to protect information handled through this website. Please avoid sending sensitive payment credentials or passwords through contact forms or email.</p></section>
                <section><h2 class="text-xl font-bold text-black">Your choices and questions</h2><p class="mt-2">For questions about information connected to an order or enquiry, contact our support team. We may need to verify your request before making changes.</p><a href="{{ route('support') }}" class="mt-3 inline-flex font-semibold text-[#806500] hover:underline">Contact support <span class="ml-1" aria-hidden="true">→</span></a></section>
            </div>
        </article>
        <p class="mt-6 text-sm text-slate-500">We may update this page when our website or the way we handle information changes.</p>
    </main>
@endsection
