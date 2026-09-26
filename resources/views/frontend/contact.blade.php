@extends('layout.app')

@section('title', 'Contact Us | Sweat Nothing')

@section('content')
    <main>
        <section class="contact-hero bg-[#fff9ef]">
            <div class="contact-hero-copy"><div class="contact-hero-copy-inner"><p class="text-xs font-bold tracking-[.35em]">GET IN TOUCH</p><h1 class="mt-4 text-5xl font-black leading-[.9] tracking-[-.07em] sm:text-7xl">We'd Love<br>to Hear From <span class="text-[#ffcf00]">You.</span></h1><p class="mt-5 max-w-md leading-6 text-black/75">Have a question, suggestion or just want to say hello? We're here to help. Let's make everyday moments sweeter, together.</p><div class="mt-8 grid grid-cols-3 gap-5 text-center text-sm"><div><span class="text-4xl">☎</span><h3 class="mt-2 font-bold">Quick Response</h3><p class="text-xs">We usually reply within 24 hours</p></div><div><span class="text-4xl">♡</span><h3 class="mt-2 font-bold">We Care</h3><p class="text-xs">Your feedback matters</p></div><div><span class="text-4xl">♧</span><h3 class="mt-2 font-bold">Here for You</h3><p class="text-xs">Always happy to help</p></div></div></div></div>
            <div class="contact-hero-visual"><img src="{{ asset('images/contact-banner.png') }}" alt="Sweet Nothings contact and office setup"></div>
        </section>

        <section class="contact-form-layout mx-auto grid max-w-7xl gap-6 px-6 py-10 lg:grid-cols-[1.25fr_.95fr] lg:px-8">
            <form action="{{ route('contact.store') }}" method="POST" class="contact-message-form rounded-3xl border border-black/5 bg-white p-7 shadow-sm">
                @csrf
                <p class="text-xs font-bold tracking-[.3em]">SEND US A MESSAGE</p><h2 class="mt-2 text-4xl font-black tracking-[-.05em]">Let's <span class="text-[#ffca00]">Connect</span></h2><p class="mt-2">Fill out the form and our team will get back to you soon.</p>
                @if (session('success'))<p class="mt-4 rounded-xl bg-emerald-50 p-3 text-sm text-emerald-700">{{ session('success') }}</p>@endif
                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div><input name="name" value="{{ old('name') }}" class="w-full rounded-xl border border-black/15 p-4" placeholder="Your Name *">@error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror</div>
                    <div><input name="email" type="email" value="{{ old('email') }}" class="w-full rounded-xl border border-black/15 p-4" placeholder="Your Email *">@error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror</div>
                    <div><input name="phone" value="{{ old('phone') }}" class="w-full rounded-xl border border-black/15 p-4" placeholder="Phone Number">@error('phone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror</div>
                    <div><select name="subject" class="w-full rounded-xl border border-black/15 p-4"><option value="">Subject *</option><option value="Product enquiry" @selected(old('subject') === 'Product enquiry')>Product enquiry</option><option value="Bulk order" @selected(old('subject') === 'Bulk order')>Bulk order</option><option value="Collaboration" @selected(old('subject') === 'Collaboration')>Collaboration</option><option value="Other" @selected(old('subject') === 'Other')>Other</option></select>@error('subject')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror</div>
                </div>
                <textarea name="message" class="mt-4 h-32 w-full rounded-xl border border-black/15 p-4" placeholder="Your Message *">{{ old('message') }}</textarea>@error('message')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                <label class="mt-4 block text-sm"><input name="privacy_policy" value="1" type="checkbox" @checked(old('privacy_policy'))> I agree to the privacy policy.</label>@error('privacy_policy')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                <button type="submit" class="mt-5 w-full rounded-full bg-[#ffd100] py-4 font-bold">Send Message →</button>
            </form>
            <div class="contact-details-card rounded-3xl bg-[#fff1c5] p-7"><h2 class="text-2xl font-black">Our Contact Details</h2><p class="mt-1 text-sm">Reach us through any of the following channels.</p><div class="contact-details-list mt-7 space-y-5"><p><b>☎ Call Us</b><br>+91 20 456 7890<br><span class="text-sm text-black/60">Mon – Fri, 10:00 AM – 6:00 PM</span></p><p><b>✉ Email Us</b><br>hello@sweatnothing.in<br><span class="text-sm text-black/60">We'll get back to you within 24 hours.</span></p><p><b>◷ Business Hours</b><br>Monday – Friday: 10:00 AM – 6:00 PM<br>Saturday: 10:00 AM – 2:00 PM</p></div></div>
        </section>

        <section class="mx-auto max-w-7xl px-6 pb-6 lg:px-8"><div class="rounded-3xl bg-[#fff1c5] p-8"><p class="text-xs font-bold tracking-[.3em]">HAVE A QUICK QUESTION?</p><h2 class="mt-2 text-4xl font-black">Find <span class="text-[#ffca00]">Answers</span></h2><p class="mt-4">Check out our FAQs for quick information about our products, shipping, returns and more.</p><button id="visit-faqs" type="button" aria-controls="faqs" aria-expanded="false" class="mt-5 rounded-full bg-black px-6 py-3 font-bold text-white">Visit FAQs →</button></div></section>
        <section id="faqs" hidden class="scroll-mt-24 mx-auto max-w-7xl px-6 py-16 lg:px-8">
            <div class="max-w-2xl">
                <p class="text-xs font-bold tracking-[.3em]">FREQUENTLY ASKED QUESTIONS</p>
                <h2 class="mt-3 text-4xl font-black tracking-[-.05em]">Quick <span class="text-[#ffca00]">Answers.</span></h2>
                <p class="mt-4 leading-6 text-black/70">Everything you may want to know before adding a little more sweetness to your day.</p>
            </div>
            <div class="mt-8 grid items-start gap-4 lg:grid-cols-2">
                <details class="rounded-2xl border border-black/10 bg-white p-5"><summary class="cursor-pointer font-bold">What is Sweet Nothing liquid sweetener?</summary><p class="mt-3 text-sm leading-6 text-black/70">It is a convenient sugar alternative made to sweeten your everyday chai, coffee, desserts and recipes with great taste.</p></details>
                <details class="rounded-2xl border border-black/10 bg-white p-5"><summary class="cursor-pointer font-bold">How do I use it in tea or coffee?</summary><p class="mt-3 text-sm leading-6 text-black/70">Add a few drops to your drink, stir well and adjust the quantity according to your preferred sweetness.</p></details>
                <details class="rounded-2xl border border-black/10 bg-white p-5"><summary class="cursor-pointer font-bold">Is it suitable for daily use?</summary><p class="mt-3 text-sm leading-6 text-black/70">It is designed as an easy everyday sugar swap. Please review the product label and consult a healthcare professional for personal dietary guidance.</p></details>
                <details class="rounded-2xl border border-black/10 bg-white p-5"><summary class="cursor-pointer font-bold">How long does delivery take?</summary><p class="mt-3 text-sm leading-6 text-black/70">Orders are usually dispatched promptly and delivery timing depends on your location. We will share tracking details once your order ships.</p></details>
                <details class="rounded-2xl border border-black/10 bg-white p-5"><summary class="cursor-pointer font-bold">Can I return a product?</summary><p class="mt-3 text-sm leading-6 text-black/70">If there is an issue with your order, contact us with your order details and our team will help you with the next steps.</p></details>
                <details class="rounded-2xl border border-black/10 bg-white p-5"><summary class="cursor-pointer font-bold">How can I get help with my order?</summary><p class="mt-3 text-sm leading-6 text-black/70">Use the contact form above or email us at hello@sweatnothing.in. Our support team will get back to you as soon as possible.</p></details>
            </div>
        </section>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const faqButton = document.getElementById('visit-faqs');
            const faqSection = document.getElementById('faqs');

            faqButton?.addEventListener('click', () => {
                faqSection.hidden = false;
                faqButton.setAttribute('aria-expanded', 'true');
                faqSection.scrollIntoView({ behavior: 'smooth' });
            });
        });
    </script>
@endsection
