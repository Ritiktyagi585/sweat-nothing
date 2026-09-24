@extends('layout.dashboard')

@section('title', 'Settings | Sweat Nothing')

@section('content')
    <main class="mx-auto max-w-6xl px-4 py-6 sm:px-5 lg:px-8 lg:py-8">
        <section class="flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
            <div>
                <h1 class="text-2xl font-bold tracking-[-.03em]">Settings</h1>
                <p class="mt-1 text-slate-500">Manage your account settings.</p>
            </div>
            <nav class="flex items-center gap-2 text-sm text-slate-500" aria-label="Breadcrumb">
                <a href="{{ route('dashboard') }}" class="hover:text-black">Dashboard</a>
                <span>›</span>
                <span>Settings</span>
            </nav>
        </section>

        <form action="{{ route('dashboard.settings.update') }}" method="POST" class="mt-6 rounded-xl bg-white p-5 shadow-sm sm:p-7">
            @csrf
            @method('PATCH')

            @if (session('success'))
                <p class="mb-6 rounded-lg bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">{{ session('success') }}</p>
            @endif

            <section>
                <div class="flex items-center gap-4">
                    <span class="grid h-12 w-12 place-items-center rounded-full bg-[#fff0bd] text-xl">♟</span>
                    <div>
                        <h2 class="font-semibold">Profile Information</h2>
                        <p class="text-sm text-slate-500">Update your basic details.</p>
                    </div>
                </div>

                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    <label class="text-sm font-medium sm:col-span-2">Name
                        <input name="name" class="mt-2 w-full rounded-lg border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-[#ffd400]" type="text" value="{{ old('name', $user->name) }}" autocomplete="name" required>
                        @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </label>
                    <label class="text-sm font-medium sm:col-span-2">Email Address
                        <input name="email" class="mt-2 w-full rounded-lg border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-[#ffd400]" type="email" value="{{ old('email', $user->email) }}" autocomplete="email" required>
                        @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </label>
                    <label class="text-sm font-medium sm:col-span-2">Phone Number
                        <input name="phone" class="mt-2 w-full rounded-lg border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-[#ffd400]" type="tel" inputmode="numeric" maxlength="10" oninput="this.value = this.value.replace(/\D/g, '').slice(0, 10)" value="{{ old('phone', $user->phone) }}" placeholder="Enter phone number" autocomplete="tel">
                        @error('phone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </label>
                </div>
            </section>

            <section class="mt-8 border-t border-slate-100 pt-8">
                <div class="flex items-center gap-4">
                    <span class="grid h-12 w-12 place-items-center rounded-full bg-[#fff0bd] text-xl">▣</span>
                    <div>
                        <h2 class="font-semibold">Change Password</h2>
                        <p class="text-sm text-slate-500">Update your password to keep your account secure.</p>
                    </div>
                </div>

                <div class="mt-6 grid gap-4 sm:grid-cols-[minmax(0,1fr)_minmax(0,1.4fr)] sm:items-center">
                    <label class="text-sm font-medium">Current Password</label>
                    <div class="relative"><input name="current_password" class="w-full rounded-lg border border-slate-200 px-4 py-3 pr-11 text-sm outline-none transition focus:border-[#ffd400]" type="password" placeholder="Enter current password" autocomplete="current-password"><span class="pointer-events-none absolute inset-y-0 right-4 grid place-items-center text-slate-400">◉</span>@error('current_password')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror</div>
                    <label class="text-sm font-medium">New Password</label>
                    <div class="relative"><input name="password" class="w-full rounded-lg border border-slate-200 px-4 py-3 pr-11 text-sm outline-none transition focus:border-[#ffd400]" type="password" placeholder="Enter new password (min. 8 characters)" autocomplete="new-password"><span class="pointer-events-none absolute inset-y-0 right-4 grid place-items-center text-slate-400">◉</span>@error('password')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror</div>
                    <label class="text-sm font-medium">Confirm New Password</label>
                    <div class="relative"><input name="password_confirmation" class="w-full rounded-lg border border-slate-200 px-4 py-3 pr-11 text-sm outline-none transition focus:border-[#ffd400]" type="password" placeholder="Confirm new password" autocomplete="new-password"><span class="pointer-events-none absolute inset-y-0 right-4 grid place-items-center text-slate-400">◉</span></div>
                </div>
            </section>

            <div class="mt-8 flex justify-end border-t border-slate-100 pt-5">
                <button class="rounded-lg bg-[#ffd400] px-5 py-3 text-sm font-semibold text-black transition hover:bg-[#e9c300]" type="submit">▣ <span class="ml-1">Save Changes</span></button>
            </div>
        </form>
    </main>
@endsection
