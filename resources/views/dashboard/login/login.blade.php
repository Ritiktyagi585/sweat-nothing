<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Login | Sweat Nothing</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[#f7f8fa] font-sans text-[#121826] antialiased">
        <main class="flex min-h-screen items-center justify-center px-5 py-4 sm:py-6">
            <section class="w-full max-w-[560px] rounded-2xl bg-white px-6 py-6 shadow-[0_20px_65px_rgba(35,45,65,.10)] sm:px-9 sm:py-7">
                <div class="text-center">
                    <img class="mx-auto h-14 w-auto" src="{{ asset('images/brand-logo.png') }}" alt="Sweat Nothing">
                    <h1 class="mt-5 text-2xl font-bold tracking-[-.04em]">Admin Login</h1>
                    <p class="mt-1 text-base text-slate-500">Sign in to access your dashboard</p>
                </div>
                {{-- Login heading section ends here. --}}

                <form action="{{ route('dashboard.login.store') }}" method="POST" class="mx-auto mt-6 max-w-[500px]">
                    @csrf
                    <label for="email" class="text-sm font-semibold">Email Address</label>
                    <div class="mt-2 flex items-center overflow-hidden rounded-xl border border-slate-300 bg-white focus-within:border-[#ffd400] focus-within:ring-2 focus-within:ring-[#ffd400]/25">
                        <span class="border-r border-slate-200 px-3 py-3 text-lg text-slate-500">✉</span>
                        <input id="email" name="email" value="{{ old('email') }}" type="email" placeholder="Enter your email" class="w-full px-3 py-3 text-sm outline-none" autocomplete="email" required>
                    </div>
                    @error('email')<p class="mt-2 text-sm text-red-600">{{ $message }}</p>@enderror

                    <label for="password" class="mt-4 block text-sm font-semibold">Password</label>
                    <div class="mt-2 flex items-center overflow-hidden rounded-xl border border-slate-300 bg-white focus-within:border-[#ffd400] focus-within:ring-2 focus-within:ring-[#ffd400]/25">
                        <span class="border-r border-slate-200 px-3 py-3 text-lg text-slate-500">♙</span>
                        <input id="password" name="password" type="password" placeholder="Enter your password" class="w-full px-3 py-3 text-sm outline-none" autocomplete="current-password" required>
                        <button id="password-toggle" type="button" class="px-3 text-slate-500 transition hover:text-black" aria-label="Show password" aria-pressed="false">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z" /><circle cx="12" cy="12" r="3" /></svg>
                        </button>
                    </div>

                    <div class="mt-4 flex items-center justify-between gap-4 text-sm">
                        <label class="flex items-center gap-2"><input name="remember" value="1" type="checkbox" class="h-5 w-5 rounded border-slate-300 accent-[#ffd400]"> Remember me</label>
                        <a href="#" class="font-medium underline underline-offset-2 hover:text-[#b58b00]">Forgot password?</a>
                    </div>

                    <button type="submit" class="mt-5 w-full rounded-xl bg-[#ffd400] py-3 text-base font-bold text-black transition hover:bg-[#eabd00]">Login</button>
                </form>
                {{-- Login form section ends here. --}}

                <div class="mx-auto mt-5 flex max-w-[500px] items-center gap-4 text-sm text-slate-500"><span class="h-px flex-1 bg-slate-200"></span><span>OR</span><span class="h-px flex-1 bg-slate-200"></span></div>
                <a href="{{ route('home') }}" class="mx-auto mt-5 flex w-fit items-center gap-3 text-sm font-medium text-slate-500 transition hover:text-black">← Back to Website</a>
                {{-- Back to website section ends here. --}}
            </section>
        </main>
        <script>
            const passwordInput = document.getElementById('password');
            const passwordToggle = document.getElementById('password-toggle');

            passwordToggle.addEventListener('click', () => {
                const isHidden = passwordInput.type === 'password';

                passwordInput.type = isHidden ? 'text' : 'password';
                passwordToggle.setAttribute('aria-label', isHidden ? 'Hide password' : 'Show password');
                passwordToggle.setAttribute('aria-pressed', String(isHidden));
            });
        </script>
    </body>
</html>
