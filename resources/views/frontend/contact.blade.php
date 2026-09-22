@extends('layout.app')

@section('title', 'Contact Us | Sweat Nothing')

@section('content')
    <main>
        <section class="contact-hero bg-[#fff9ef]">
            <div class="contact-hero-copy">
                <div class="contact-hero-copy-inner">
                    <p class="text-xs font-bold tracking-[.35em]">GET IN TOUCH</p>
                    <h1 class="mt-4 text-5xl font-black leading-[.9] tracking-[-.07em] sm:text-7xl">We'd Love<br>to Hear From <span class="text-[#ffcf00]">You.</span></h1>
                    <p class="mt-5 max-w-md leading-6 text-black/75">Have a question, suggestion or just want to say hello? We're here to help. Let's make everyday moments sweeter, together.</p>
                    <div class="mt-8 grid grid-cols-3 gap-5 text-center text-sm"><div><span class="text-4xl">☏</span><h3 class="mt-2 font-bold">Quick Response</h3><p class="text-xs">We usually reply within 24 hours</p></div><div><span class="text-4xl">♡</span><h3 class="mt-2 font-bold">We Care</h3><p class="text-xs">Your feedback matters</p></div><div><span class="text-4xl">♧</span><h3 class="mt-2 font-bold">Here for You</h3><p class="text-xs">Always happy to help</p></div></div>
                </div>
                </div>

            <div class="contact-hero-visual">
                <img src="{{ asset('images/contact-banner.png') }}" alt="Sweet Nothings contact and office setup">
            </div>
        </section>

        <section class="contact-form-layout mx-auto grid max-w-7xl gap-6 px-6 py-10 lg:grid-cols-[1.25fr_.95fr] lg:px-8">
            <form class="contact-message-form rounded-3xl border border-black/5 bg-white p-7 shadow-sm"><p class="text-xs font-bold tracking-[.3em]">SEND US A MESSAGE</p><h2 class="mt-2 text-4xl font-black tracking-[-.05em]">Let's <span class="text-[#ffca00]">Connect</span></h2><p class="mt-2">Fill out the form and our team will get back to you soon.</p><div class="mt-6 grid gap-4 sm:grid-cols-2"><input class="rounded-xl border border-black/15 p-4" placeholder="Your Name *"><input class="rounded-xl border border-black/15 p-4" placeholder="Your Email *"><input class="rounded-xl border border-black/15 p-4" placeholder="Phone Number"><select class="rounded-xl border border-black/15 p-4"><option>Subject *</option></select></div><textarea class="mt-4 h-32 w-full rounded-xl border border-black/15 p-4" placeholder="Your Message *"></textarea><label class="mt-4 block text-sm"><input type="checkbox"> I agree to the privacy policy.</label><button type="button" class="mt-5 w-full rounded-full bg-[#ffd100] py-4 font-bold">Send Message →</button></form>
            <div class="contact-details-card rounded-3xl bg-[#fff1c5] p-7"><h2 class="text-2xl font-black">Our Contact Details</h2><p class="mt-1 text-sm">Reach us through any of the following channels.</p><div class="contact-details-list mt-7 space-y-5"><p><b>📍 Our Address</b><br>Tower-C, Cyber Park, 712 A,<br>Noida – 62, India</p><p><b>☎ Call Us</b><br>+91 20 456 7890<br><span class="text-sm text-black/60">Mon – Fri, 10:00 AM – 6:00 PM</span></p><p><b>✉ Email Us</b><br>hello@sweatnothing.in<br><span class="text-sm text-black/60">We'll get back to you within 24 hours.</span></p><p><b>◷ Business Hours</b><br>Monday – Friday: 10:00 AM – 6:00 PM<br>Saturday: 10:00 AM – 2:00 PM</p></div></div>
        </section>

        <section class="contact-info-layout mx-auto grid max-w-7xl gap-6 px-6 pb-6 lg:grid-cols-[1.25fr_.8fr] lg:px-8">
            <div class="min-h-64 overflow-hidden rounded-3xl">
                <iframe
                    class="h-full min-h-64 w-full border-0"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.5718416539316!2d77.36293017500756!3d28.612618784985653!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce5687a962671%3A0x5d66885cf442835e!2sLogix%20Cyber%20Park!5e0!3m2!1sen!2sin!4v1789984808026!5m2!1sen!2sin"
                    title="Logix Cyber Park location"
                    loading="lazy"
                    allowfullscreen
                    referrerpolicy="strict-origin-when-cross-origin"
                ></iframe>
            </div>

            <div class="rounded-3xl bg-[#fff1c5] p-8">
                <p class="text-xs font-bold tracking-[.3em]">HAVE A QUICK QUESTION?</p>
                <h2 class="mt-2 text-4xl font-black">Find <span class="text-[#ffca00]">Answers</span></h2>
                <p class="mt-4">Check out our FAQs for quick information about our products, shipping, returns and more.</p>
                <button class="mt-5 rounded-full bg-black px-6 py-3 font-bold text-white">Visit FAQs →</button>
            </div>
        </section>

        <section class="mx-auto mb-8 grid max-w-7xl overflow-hidden rounded-3xl bg-[#f8f3e9] md:grid-cols-2"><img class="h-64 w-full object-cover" src="https://images.unsplash.com/photo-1571934811356-5cc061b6821f?auto=format&fit=crop&w=900&q=85" alt="A cup of chai"><div class="p-9"><p class="text-xs font-bold tracking-[.3em]">STAY CONNECTED</p><h2 class="mt-2 text-4xl font-black">Join Our <span class="text-[#ffca00]">Journey</span></h2><p class="mt-3">Follow us on social media for the latest updates, recipes, wellness tips and more.</p><div class="mt-6 flex gap-3"><span class="grid h-11 w-11 place-items-center rounded-full bg-black text-white">◎</span><span class="grid h-11 w-11 place-items-center rounded-full bg-black text-white">f</span><span class="grid h-11 w-11 place-items-center rounded-full bg-black text-white">▶</span><span class="grid h-11 w-11 place-items-center rounded-full bg-black text-white">in</span></div></div></section>
    </main>
@endsection
