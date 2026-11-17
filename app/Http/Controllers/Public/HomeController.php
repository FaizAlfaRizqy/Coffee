<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\GalleryImage;
use App\Models\MenuProduct;
use App\Models\WebsiteContent;
use App\Models\WebsiteSetting;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredProducts = MenuProduct::with('category')
            ->available()
            ->featured()
            ->orderBy('sort_order', 'asc')
            ->take(4)
            ->get();

        if ($featuredProducts->count() < 4) {
            $extraProducts = MenuProduct::with('category')
                ->available()
                ->where('is_featured', false)
                ->orderBy('sort_order', 'asc')
                ->take(4 - $featuredProducts->count())
                ->get();
            $featuredProducts = $featuredProducts->merge($extraProducts);
        }

        $latestArticles = Article::with('category')
            ->published()
            ->latest('published_at')
            ->take(3)
            ->get();

        $galleryImages = GalleryImage::orderBy('sort_order', 'asc')
            ->take(6)
            ->get();

        $allContents = WebsiteContent::all();
        $contents = [];
        foreach ($allContents as $c) {
            $contents[$c->section][$c->key] = $c->value;
        }

        $settings = WebsiteSetting::all()->pluck('value', 'key')->toArray();

        return view('public.home', compact(
            'featuredProducts',
            'latestArticles',
            'galleryImages',
            'contents',
            'settings'
        ));
    }
}
