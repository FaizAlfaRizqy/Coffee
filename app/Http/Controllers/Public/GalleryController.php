<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        $categories = GalleryCategory::withCount('images')->get();

        $query = GalleryImage::with('category')->orderBy('sort_order', 'asc')->latest();

        if ($request->filled('kategori') && $request->input('kategori') !== 'all') {
            $catSlug = $request->input('kategori');
            $query->whereHas('category', function ($q) use ($catSlug) {
                $q->where('slug', $catSlug);
            });
        }

        $images = $query->get();
        $selectedCategory = $request->query('kategori', 'all');
        $settings = WebsiteSetting::all()->pluck('value', 'key')->toArray();

        return view('public.gallery', compact('images', 'categories', 'selectedCategory', 'settings'));
    }
}
