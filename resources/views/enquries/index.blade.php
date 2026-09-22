@extends('layout.dashboard')

@section('title', 'Enquiries | Sweat Nothing')

@section('content')
    <main class="mx-auto max-w-[1500px] p-5 lg:p-7">
        <section class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div>
                <h1 class="text-2xl font-bold tracking-[-.03em]">Enquiries</h1>
                <p class="mt-1 text-slate-500">Manage and track all customer enquiries from your website.</p>
            </div>

            <nav class="flex items-center gap-2 text-sm text-slate-500" aria-label="Breadcrumb">
                <a href="{{ route('dashboard') }}" class="hover:text-black">Dashboard</a>
                <span>&#8250;</span>
                <span>Enquiries</span>
            </nav>
        </section>
        {{-- Page heading section ends here. --}}

        <section class="mt-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <article class="rounded-xl bg-white p-5 shadow-sm">
                <div class="flex items-center gap-4">
                    <span class="grid h-14 w-14 place-items-center rounded-full bg-[#fff3cf] text-2xl">&#9993;</span>
                    <div><p class="text-xs text-slate-500">Total Enquiries</p><p class="mt-1 text-2xl font-bold">56</p><p class="mt-1 text-xs text-emerald-600">&#8593; +12% <span class="text-slate-500">this month</span></p></div>
                </div>
            </article>

            <article class="rounded-xl bg-white p-5 shadow-sm">
                <div class="flex items-center gap-4">
                    <span class="grid h-14 w-14 place-items-center rounded-full bg-[#e2efff] text-2xl">&#9993;</span>
                    <div><p class="text-xs text-slate-500">New Enquiries</p><p class="mt-1 text-2xl font-bold">18</p><p class="mt-1 text-xs text-emerald-600">&#8593; +28% <span class="text-slate-500">this week</span></p></div>
                </div>
            </article>

            <article class="rounded-xl bg-white p-5 shadow-sm">
                <div class="flex items-center gap-4">
                    <span class="grid h-14 w-14 place-items-center rounded-full bg-[#dff7e6] text-2xl">&#10003;</span>
                    <div><p class="text-xs text-slate-500">Responded</p><p class="mt-1 text-2xl font-bold">32</p><p class="mt-1 text-xs text-emerald-600">&#8593; +14% <span class="text-slate-500">this month</span></p></div>
                </div>
            </article>

            <article class="rounded-xl bg-white p-5 shadow-sm">
                <div class="flex items-center gap-4">
                    <span class="grid h-14 w-14 place-items-center rounded-full bg-[#ffe3e3] text-2xl">&#9716;</span>
                    <div><p class="text-xs text-slate-500">Pending</p><p class="mt-1 text-2xl font-bold">24</p><p class="mt-1 text-xs text-emerald-600">&#8593; +5% <span class="text-slate-500">this month</span></p></div>
                </div>
            </article>
        </section>
        {{-- Enquiry statistic cards section ends here. --}}

        <section class="mt-5 rounded-xl bg-white p-4 shadow-sm lg:p-5">
            <div class="flex flex-col gap-3 xl:flex-row xl:items-center xl:justify-between">
                <div class="grid gap-3 sm:grid-cols-3">
                    <select class="rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm outline-none"><option>All Status</option><option>New</option><option>Responded</option><option>Pending</option></select>
                    <select class="rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm outline-none"><option>All Enquiry Types</option><option>Product enquiry</option><option>Bulk order</option><option>Collaboration</option></select>
                    <input class="rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none" type="date" aria-label="Select enquiry date">
                </div>

                <button class="rounded-lg bg-[#111111] px-4 py-2.5 text-sm font-medium text-white transition hover:bg-black/80">+ Add Enquiry</button>
            </div>
        </section>
        {{-- Filter controls section ends here. --}}

        <section class="mt-4 overflow-hidden rounded-xl bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-[1100px] w-full text-left text-sm">
                    <thead class="bg-[#f5f7f9] text-xs font-semibold text-slate-800">
                        <tr>
                            <th class="px-4 py-3">#</th><th class="px-4 py-3">Name</th><th class="px-4 py-3">Email</th><th class="px-4 py-3">Phone</th><th class="px-4 py-3">Subject / Message</th><th class="px-4 py-3">Date</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        <tr><td class="px-4 py-3">1</td><td class="px-4 py-3 font-medium">Aarav Sharma</td><td class="px-4 py-3">aarav@gmail.com</td><td class="px-4 py-3">+91 98765 43210</td><td class="px-4 py-3"><p>Product enquiry</p><p class="max-w-56 truncate text-xs text-slate-500">Hi, I would like to know more about your product.</p></td><td class="px-4 py-3 text-xs">21 Sep 2026<br><span class="text-slate-500">11:45 AM</span></td><td class="px-4 py-3"><span class="rounded-md bg-blue-100 px-3 py-2 text-xs font-medium text-blue-700">New</span></td><td class="px-4 py-3"><button class="rounded-lg bg-slate-50 px-3 py-2">&#128065;</button></td></tr>
                        <tr><td class="px-4 py-3">2</td><td class="px-4 py-3 font-medium">Priya Mehta</td><td class="px-4 py-3">priya@outlook.com</td><td class="px-4 py-3">+91 98123 45678</td><td class="px-4 py-3"><p>Bulk order</p><p class="max-w-56 truncate text-xs text-slate-500">We are interested in placing a bulk order.</p></td><td class="px-4 py-3 text-xs">21 Sep 2026<br><span class="text-slate-500">10:20 AM</span></td><td class="px-4 py-3"><span class="rounded-md bg-emerald-100 px-3 py-2 text-xs font-medium text-emerald-700">Responded</span></td><td class="px-4 py-3"><button class="rounded-lg bg-slate-50 px-3 py-2">&#128065;</button></td></tr>
                        <tr><td class="px-4 py-3">3</td><td class="px-4 py-3 font-medium">Rahul Verma</td><td class="px-4 py-3">rahulv@gmail.com</td><td class="px-4 py-3">+91 91234 56789</td><td class="px-4 py-3"><p>Collaboration</p><p class="max-w-56 truncate text-xs text-slate-500">I would like to collaborate with your brand.</p></td><td class="px-4 py-3 text-xs">20 Sep 2026<br><span class="text-slate-500">06:15 PM</span></td><td class="px-4 py-3"><span class="rounded-md bg-amber-100 px-3 py-2 text-xs font-medium text-amber-700">Pending</span></td><td class="px-4 py-3"><button class="rounded-lg bg-slate-50 px-3 py-2">&#128065;</button></td></tr>
                        <tr><td class="px-4 py-3">4</td><td class="px-4 py-3 font-medium">Sneha Kapoor</td><td class="px-4 py-3">sneha.k@gmail.com</td><td class="px-4 py-3">+91 99887 66554</td><td class="px-4 py-3"><p>Product enquiry</p><p class="max-w-56 truncate text-xs text-slate-500">Do you have this product in different sizes?</p></td><td class="px-4 py-3 text-xs">20 Sep 2026<br><span class="text-slate-500">02:40 PM</span></td><td class="px-4 py-3"><span class="rounded-md bg-emerald-100 px-3 py-2 text-xs font-medium text-emerald-700">Responded</span></td><td class="px-4 py-3"><button class="rounded-lg bg-slate-50 px-3 py-2">&#128065;</button></td></tr>
                        <tr><td class="px-4 py-3">5</td><td class="px-4 py-3 font-medium">Vikram Singh</td><td class="px-4 py-3">vikram@gmail.com</td><td class="px-4 py-3">+91 98765 11122</td><td class="px-4 py-3"><p>Other</p><p class="max-w-56 truncate text-xs text-slate-500">Just wanted to say your products are amazing.</p></td><td class="px-4 py-3 text-xs">19 Sep 2026<br><span class="text-slate-500">01:12 PM</span></td><td class="px-4 py-3"><span class="rounded-md bg-blue-100 px-3 py-2 text-xs font-medium text-blue-700">New</span></td><td class="px-4 py-3"><button class="rounded-lg bg-slate-50 px-3 py-2">&#128065;</button></td></tr>
                        <tr><td class="px-4 py-3">6</td><td class="px-4 py-3 font-medium">Neha Jain</td><td class="px-4 py-3">neha.j@gmail.com</td><td class="px-4 py-3">+91 96655 44332</td><td class="px-4 py-3"><p>Reseller enquiry</p><p class="max-w-56 truncate text-xs text-slate-500">I want to become a reseller. Please share details.</p></td><td class="px-4 py-3 text-xs">18 Sep 2026<br><span class="text-slate-500">04:30 PM</span></td><td class="px-4 py-3"><span class="rounded-md bg-amber-100 px-3 py-2 text-xs font-medium text-amber-700">Pending</span></td><td class="px-4 py-3"><button class="rounded-lg bg-slate-50 px-3 py-2">&#128065;</button></td></tr>
                        <tr><td class="px-4 py-3">7</td><td class="px-4 py-3 font-medium">Karan Malhotra</td><td class="px-4 py-3">karan.m@gmail.com</td><td class="px-4 py-3">+91 95555 66777</td><td class="px-4 py-3"><p>Product availability</p><p class="max-w-56 truncate text-xs text-slate-500">Is this product currently in stock?</p></td><td class="px-4 py-3 text-xs">18 Sep 2026<br><span class="text-slate-500">11:05 AM</span></td><td class="px-4 py-3"><span class="rounded-md bg-emerald-100 px-3 py-2 text-xs font-medium text-emerald-700">Responded</span></td><td class="px-4 py-3"><button class="rounded-lg bg-slate-50 px-3 py-2">&#128065;</button></td></tr>
                        <tr><td class="px-4 py-3">8</td><td class="px-4 py-3 font-medium">Isha Gupta</td><td class="px-4 py-3">isha.g@outlook.com</td><td class="px-4 py-3">+91 93456 77889</td><td class="px-4 py-3"><p>Payment query</p><p class="max-w-56 truncate text-xs text-slate-500">What payment methods do you accept?</p></td><td class="px-4 py-3 text-xs">17 Sep 2026<br><span class="text-slate-500">03:22 PM</span></td><td class="px-4 py-3"><span class="rounded-md bg-blue-100 px-3 py-2 text-xs font-medium text-blue-700">New</span></td><td class="px-4 py-3"><button class="rounded-lg bg-slate-50 px-3 py-2">&#128065;</button></td></tr>
                    </tbody>
                </table>
            </div>

            <div class="flex flex-col gap-3 border-t border-slate-100 px-4 py-4 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                <p>Showing 1 to 8 of 56 enquiries</p>
                <div class="flex items-center gap-2"><button class="rounded-lg bg-slate-100 px-3 py-2">&#8249;</button><button class="rounded-lg bg-[#ffd400] px-3 py-2 font-medium text-black">1</button><button class="rounded-lg px-3 py-2">2</button><button class="rounded-lg px-3 py-2">3</button><button class="rounded-lg px-3 py-2">4</button><button class="rounded-lg bg-slate-100 px-3 py-2">&#8250;</button></div>
            </div>
        </section>
        {{-- Enquiries table and pagination section ends here. --}}
    </main>
@endsection
