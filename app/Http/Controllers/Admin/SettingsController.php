<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WebsiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(): View
    {
        $allSettings = WebsiteSetting::all()->pluck('value', 'key')->toArray();
        $user = Auth::user();

        return view('admin.settings.index', compact('allSettings', 'user'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_tagline' => ['nullable', 'string', 'max:255'],
            'site_description' => ['nullable', 'string', 'max:500'],
            'primary_color' => ['nullable', 'string', 'max:20'],
            'secondary_color' => ['nullable', 'string', 'max:20'],
            'admin_email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg,webp', 'max:2048'],
            'favicon' => ['nullable', 'image', 'mimes:ico,png,svg', 'max:1024'],
        ]);

        $keys = [
            'site_name',
            'site_tagline',
            'site_description',
            'primary_color',
            'secondary_color',
            'admin_email',
            'phone',
            'address',
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                WebsiteSetting::set($key, $request->input($key));
            }
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('settings', 'public');
            WebsiteSetting::set('logo', asset('storage/' . $path));
        }

        if ($request->hasFile('favicon')) {
            $path = $request->file('favicon')->store('settings', 'public');
            WebsiteSetting::set('favicon', asset('storage/' . $path));
        }

        // Profile update
        if ($request->filled('admin_name') || $request->filled('user_email')) {
            /** @var User $user */
            $user = Auth::user();
            if ($request->filled('admin_name')) {
                $user->name = $request->input('admin_name');
            }
            if ($request->filled('user_email')) {
                $user->email = $request->input('user_email');
            }
            $user->save();
        }

        // Password change
        if ($request->filled('new_password')) {
            $request->validate([
                'current_password' => ['required', 'current_password'],
                'new_password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            /** @var User $user */
            $user = Auth::user();
            $user->password = Hash::make($request->input('new_password'));
            $user->save();
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan website dan profil berhasil diperbarui!');
    }
}
