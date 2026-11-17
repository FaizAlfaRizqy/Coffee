<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        $query = GalleryImage::with('category')->orderBy('sort_order', 'asc')->latest();

        if ($request->filled('category')) {
            $query->where('gallery_category_id', $request->input('category'));
        }

        $images = $query->paginate(16)->withQueryString();
        $categories = GalleryCategory::orderBy('name')->get();

        return view('admin.gallery.index', compact('images', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'gallery_category_id' => ['nullable', 'exists:gallery_categories,id'],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'image_url' => ['nullable', 'url', 'max:1000'],
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('gallery', 'public');
                GalleryImage::create([
                    'gallery_category_id' => $request->input('gallery_category_id'),
                    'title' => $request->input('title') ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                    'description' => $request->input('description'),
                    'image' => $path,
                ]);
            }
        } elseif ($request->filled('image_url')) {
            GalleryImage::create([
                'gallery_category_id' => $request->input('gallery_category_id'),
                'title' => $request->input('title') ?? 'Foto Galeri',
                'description' => $request->input('description'),
                'image' => $request->input('image_url'),
            ]);
        }

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto berhasil ditambahkan ke galeri!');
    }

    public function update(Request $request, GalleryImage $image): RedirectResponse
    {
        $validated = $request->validate([
            'gallery_category_id' => ['nullable', 'exists:gallery_categories,id'],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $image->update($validated);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Informasi foto galeri berhasil diperbarui!');
    }

    public function destroy(GalleryImage $image): RedirectResponse
    {
        if ($image->image && !Str::startsWith($image->image, 'http')) {
            Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil dihapus!');
    }
}
