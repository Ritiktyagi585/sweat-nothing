@extends('layout.dashboard')

@section('title', 'Enquiries | Sweat Nothing')

@section('content')
    <main class="mx-auto max-w-[1500px] p-5 lg:p-7">
        <section class="flex flex-col justify-between gap-4 md:flex-row md:items-end">
            <div><h1 class="text-2xl font-bold tracking-[-.03em]">Enquiries</h1><p class="mt-1 text-slate-500">Website contact form messages appear here automatically.</p></div>
            <nav class="flex items-center gap-2 text-sm text-slate-500" aria-label="Breadcrumb"><a href="{{ route('dashboard') }}" class="hover:text-black">Dashboard</a><span>›</span><span>Enquiries</span></nav>
        </section>
        {{-- Page heading section ends here. --}}

        <section class="mt-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @foreach ([['Total Enquiries', $enquiryStats['total'], '✉', '#fff3cf'], ['New Enquiries', $enquiryStats['new'], '✉', '#e2efff'], ['Responded', $enquiryStats['responded'], '✓', '#dff7e6'], ['Pending', $enquiryStats['pending'], '◷', '#ffe3e3']] as [$label, $count, $icon, $color])
                <article class="rounded-xl bg-white p-5 shadow-sm"><div class="flex items-center gap-4"><span class="grid h-14 w-14 place-items-center rounded-full text-2xl" style="background-color: {{ $color }}">{{ $icon }}</span><div><p class="text-xs text-slate-500">{{ $label }}</p><p class="mt-1 text-2xl font-bold">{{ $count }}</p><p class="mt-1 text-xs text-slate-500">From website contact form</p></div></div></article>
            @endforeach
        </section>
        {{-- Enquiry statistic cards section ends here. --}}

        @if (session('success'))
            <p class="mt-4 rounded-xl bg-emerald-50 px-4 py-3 text-sm text-emerald-700">{{ session('success') }}</p>
        @endif

        <section class="mt-5 rounded-xl bg-white p-4 shadow-sm lg:p-5">
            <form method="GET" action="{{ route('dashboard.enquiries') }}" class="flex flex-col gap-3 xl:flex-row xl:items-center xl:justify-between">
                <div class="grid gap-3 sm:grid-cols-3">
                    <select name="status" class="rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm outline-none"><option value="">All Status</option>@foreach (['new' => 'New', 'responded' => 'Responded', 'pending' => 'Pending'] as $value => $label)<option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>@endforeach</select>
                    <select name="subject" class="rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm outline-none"><option value="">All Enquiry Types</option>@foreach ($subjects as $subject)<option value="{{ $subject }}" @selected(request('subject') === $subject)>{{ $subject }}</option>@endforeach</select>
                    <input name="date" value="{{ request('date') }}" class="rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none" type="date" aria-label="Select enquiry date">
                </div>
                <div class="flex gap-3"><button class="rounded-lg border border-slate-200 px-4 py-2.5 text-sm font-medium hover:bg-slate-50">Filter</button><a href="{{ route('contact') }}" class="rounded-lg bg-[#111111] px-4 py-2.5 text-sm font-medium text-white transition hover:bg-black/80">+ Add Enquiry</a></div>
            </form>
        </section>
        {{-- Filter controls section ends here. --}}

        <section class="mt-4 overflow-hidden rounded-xl bg-white shadow-sm">
            <div class="space-y-3 p-3 sm:hidden">
                @forelse ($enquiries as $enquiry)
                    @php($statusStyles = ['new' => 'bg-blue-100 text-blue-700', 'responded' => 'bg-emerald-100 text-emerald-700', 'pending' => 'bg-amber-100 text-amber-700'])
                    <article class="rounded-lg border border-slate-100 p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <p class="font-semibold">{{ $enquiry->name }}</p>
                                <p class="truncate text-xs text-slate-500">{{ $enquiry->email }}</p>
                            </div>
                            <span class="shrink-0 rounded-md px-3 py-1.5 text-xs font-medium {{ $statusStyles[$enquiry->status] ?? 'bg-slate-100 text-slate-700' }}">{{ ucfirst($enquiry->status) }}</span>
                        </div>
                        <div class="mt-3 grid gap-2 text-sm">
                            <p><span class="text-slate-500">Phone:</span> {{ $enquiry->phone ?: '—' }}</p>
                            <p><span class="text-slate-500">Subject:</span> {{ $enquiry->subject }}</p>
                            <p class="text-xs text-slate-500">{{ $enquiry->message }}</p>
                            <p class="text-xs text-slate-500">{{ $enquiry->created_at->format('d M Y, h:i A') }}</p>
                        </div>
                        <form action="{{ route('dashboard.enquiries.update', $enquiry) }}" method="POST" class="mt-4 flex gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="min-w-0 flex-1 rounded-lg border border-slate-200 bg-white px-2 py-2 text-xs outline-none">
                                @foreach (['new' => 'New', 'responded' => 'Responded', 'pending' => 'Pending'] as $value => $label)
                                    <option value="{{ $value }}" @selected($enquiry->status === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                            <button class="rounded-lg bg-[#ffd400] px-3 py-2 text-xs font-semibold text-black hover:bg-[#eabd00]">Update</button>
                        </form>
                    </article>
                @empty
                    <p class="py-10 text-center text-sm text-slate-500">No enquiries received yet.</p>
                @endforelse
            </div>

            <div class="hidden overflow-x-auto sm:block"><table class="min-w-[1150px] w-full text-left text-sm"><thead class="bg-[#f5f7f9] text-xs font-semibold text-slate-800"><tr><th class="px-4 py-3">#</th><th class="px-4 py-3">Name</th><th class="px-4 py-3">Email</th><th class="px-4 py-3">Phone</th><th class="px-4 py-3">Subject / Message</th><th class="px-4 py-3">Date</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Action</th></tr></thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse ($enquiries as $enquiry)
                        @php($statusStyles = ['new' => 'bg-blue-100 text-blue-700', 'responded' => 'bg-emerald-100 text-emerald-700', 'pending' => 'bg-amber-100 text-amber-700'])
                        <tr><td class="px-4 py-3">{{ $enquiries->firstItem() + $loop->index }}</td><td class="px-4 py-3 font-medium">{{ $enquiry->name }}</td><td class="px-4 py-3">{{ $enquiry->email }}</td><td class="px-4 py-3">{{ $enquiry->phone ?: '—' }}</td><td class="px-4 py-3"><p>{{ $enquiry->subject }}</p><p class="max-w-56 truncate text-xs text-slate-500">{{ $enquiry->message }}</p></td><td class="px-4 py-3 text-xs">{{ $enquiry->created_at->format('d M Y') }}<br><span class="text-slate-500">{{ $enquiry->created_at->format('h:i A') }}</span></td><td class="px-4 py-3"><span class="rounded-md px-3 py-2 text-xs font-medium {{ $statusStyles[$enquiry->status] ?? 'bg-slate-100 text-slate-700' }}">{{ ucfirst($enquiry->status) }}</span></td><td class="px-4 py-3"><form action="{{ route('dashboard.enquiries.update', $enquiry) }}" method="POST" class="flex items-center gap-2">@csrf @method('PATCH')<select name="status" class="rounded-lg border border-slate-200 bg-white px-2 py-2 text-xs outline-none">@foreach (['new' => 'New', 'responded' => 'Responded', 'pending' => 'Pending'] as $value => $label)<option value="{{ $value }}" @selected($enquiry->status === $value)>{{ $label }}</option>@endforeach</select><button class="rounded-lg bg-[#ffd400] px-3 py-2 text-xs font-semibold text-black hover:bg-[#eabd00]">Update</button></form></td></tr>
                    @empty
                        <tr><td colspan="8" class="px-4 py-12 text-center text-slate-500">No enquiries received yet.</td></tr>
                    @endforelse
                </tbody></table></div>
            <div class="flex flex-col gap-3 border-t border-slate-100 px-4 py-4 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between"><p>Showing {{ $enquiries->firstItem() ?? 0 }} to {{ $enquiries->lastItem() ?? 0 }} of {{ $enquiries->total() }} enquiries</p>{{ $enquiries->onEachSide(1)->links() }}</div>
        </section>
        {{-- Enquiries table and pagination section ends here. --}}
    </main>
@endsection
