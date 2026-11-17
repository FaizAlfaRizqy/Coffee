<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ContactMessage;
use App\Models\GalleryImage;
use App\Models\MenuProduct;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalArticles = Article::count();
        $publishedArticles = Article::where('status', 'published')->count();
        $draftArticles = Article::where('status', 'draft')->count();
        $totalMenuProducts = MenuProduct::count();
        $availableMenuProducts = MenuProduct::where('is_available', true)->count();
        $totalGalleryImages = GalleryImage::count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();

        // Recent articles
        $recentArticles = Article::with('category')
            ->latest()
            ->take(5)
            ->get();

        // Recent messages
        $recentMessages = ContactMessage::latest()
            ->take(5)
            ->get();

        // Recent menu items
        $recentProducts = MenuProduct::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalArticles',
            'publishedArticles',
            'draftArticles',
            'totalMenuProducts',
            'availableMenuProducts',
            'totalGalleryImages',
            'unreadMessages',
            'recentArticles',
            'recentMessages',
            'recentProducts'
        ));
    }
}
