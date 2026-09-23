<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DashboardLoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class DashboardLoginController extends Controller
{
    /**
     * Display the admin sign-in screen.
     */
    public function create(): View
    {
        return view('dashboard.login.login');
    }

    /**
     * Authenticate an administrator and create a secure session.
     */
    public function store(DashboardLoginRequest $request): RedirectResponse
    {
        $email = $request->string('email')->lower()->toString();
        $user = User::query()->where('email', $email)->first();
        $passwordMatches = $user && Hash::check($request->string('password')->toString(), $user->password);

        if (! $passwordMatches) {
            return back()
                ->withErrors(['email' => 'The email address or password is incorrect.'])
                ->onlyInput('email');
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * End the current admin session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
