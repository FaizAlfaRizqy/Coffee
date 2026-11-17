<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use App\Models\MenuProduct;
use App\Models\WebsiteContent;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(Request $request): View
    {
        $categories = MenuCategory::with(['availableProducts' => function ($q) {
            $q->orderBy('sort_order', 'asc');
        }])->orderBy('sort_order', 'asc')->get();

        $selectedCategory = $request->query('kategori');

        $productsQuery = MenuProduct::with('category')->available();

        if ($selectedCategory && $selectedCategory !== 'all') {
            $productsQuery->whereHas('category', function ($q) use ($selectedCategory) {
                $q->where('slug', $selectedCategory);
            });
        }

        $products = $productsQuery->orderBy('sort_order', 'asc')->get();

        $settings = WebsiteSetting::all()->pluck('value', 'key')->toArray();

        return view('public.menu', compact('categories', 'products', 'selectedCategory', 'settings'));
    }
}
