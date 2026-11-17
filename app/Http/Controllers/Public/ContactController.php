<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\WebsiteContent;
use App\Models\WebsiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $allContents = WebsiteContent::all();
        $contents = [];
        foreach ($allContents as $c) {
            $contents[$c->section][$c->key] = $c->value;
        }

        $settings = WebsiteSetting::all()->pluck('value', 'key')->toArray();

        return view('public.contact', compact('contents', 'settings'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'message.required' => 'Pesan Anda wajib diisi.',
            'message.min' => 'Pesan minimal terdiri dari 10 karakter.',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Terima kasih! Pesan Anda telah kami terima dan akan segera kami respon.');
    }
}
