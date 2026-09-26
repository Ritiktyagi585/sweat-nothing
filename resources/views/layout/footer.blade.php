<footer id="contact" class="bg-[#101010] text-white">
    <div class="mx-auto flex max-w-7xl flex-col gap-8 px-6 py-10 md:flex-row md:items-center md:justify-between lg:px-8">
        <div class="flex items-center gap-6">
            <div class="p-2">
                <img class="h-16 w-auto" src="{{ asset('images/ayurthlogoh.png') }}" alt="Ayurth">
            </div>
            <p class="text-sm leading-5 text-white/75">A healthier,<br> sweeter tomorrow.</p>
        </div>
        <div class="flex flex-wrap gap-x-7 gap-y-3 text-sm text-white/80">
            <a href="{{ route('home') }}" class="hover:text-[#ffd100]">Home</a><a href="{{ route('products') }}" class="hover:text-[#ffd100]">Product</a><a href="{{ route('about') }}" class="hover:text-[#ffd100]">About Us</a><a href="{{ route('contact') }}" class="hover:text-[#ffd100]">Contact</a>
        </div>
        <div class="flex gap-4 text-lg text-white/80"><a href="#contact" aria-label="Instagram">◎</a><a href="#contact" aria-label="Facebook">f</a><a href="#contact" aria-label="YouTube">▶</a></div>
    </div>
</footer>
