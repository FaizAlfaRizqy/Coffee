<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ContentController extends Controller
{
    public function index(): View
    {
        $allContents = WebsiteContent::all();
        $contents = [];
        foreach ($allContents as $c) {
            $contents[$c->section][$c->key] = $c->value;
        }

        return view('admin.content.index', compact('contents'));
    }

    public function update(Request $request): RedirectResponse
    {
        $section = $request->input('_section', 'all');

        // Handle uploaded files like hero_image
        if ($request->hasFile('homepage.hero_image_file')) {
            $path = $request->file('homepage.hero_image_file')->store('content', 'public');
            WebsiteContent::set('homepage', 'hero_image', asset('storage/' . $path));
        }

        // Loop through all inputs except internal csrf and section
        foreach ($request->all() as $sectionKey => $values) {
            if (in_array($sectionKey, ['_token', '_method', '_section'])) {
                continue;
            }

            if (is_array($values)) {
                foreach ($values as $key => $val) {
                    if ($key === 'hero_image_file') {
                        continue;
                    }
                    WebsiteContent::set($sectionKey, $key, $val);
                }
            }
        }

        return redirect()->route('admin.content.index')
            ->with('success', 'Konten website berhasil disimpan dan disinkronkan ke halaman publik!');
    }
}
