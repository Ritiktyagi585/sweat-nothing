<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDashboardSettingsRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingsController extends Controller
{
    /**
     * Display the authenticated administrator's settings.
     */
    public function index(Request $request): View
    {
        return view('setting.setting', ['user' => $request->user()]);
    }

    /**
     * Update the authenticated administrator's profile and optional password.
     */
    public function update(UpdateDashboardSettingsRequest $request): RedirectResponse
    {
        $user = $request->user();
        $attributes = $request->safe()->only(['name', 'email']);
        $attributes['phone'] = $request->string('phone')->trim()->toString() ?: null;

        if ($request->filled('password')) {
            $attributes['password'] = $request->string('password')->toString();
        }

        $user->update($attributes);

        return to_route('dashboard.settings')->with('success', 'Settings saved successfully.');
    }
}
