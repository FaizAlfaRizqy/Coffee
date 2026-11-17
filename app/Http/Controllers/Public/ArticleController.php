<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(Request $request): View
    {
        $query = Article::with('category')->published()->latest('published_at');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori')) {
            $categorySlug = $request->input('kategori');
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        $articles = $query->paginate(6)->withQueryString();
        $categories = ArticleCategory::withCount(['articles' => function ($q) {
            $q->published();
        }])->get();

        $recentArticles = Article::published()->latest('published_at')->take(4)->get();
        $settings = WebsiteSetting::all()->pluck('value', 'key')->toArray();

        return view('public.articles.index', compact('articles', 'categories', 'recentArticles', 'settings'));
    }

    public function show(string $slug): View
    {
        $article = Article::with('category')
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        $relatedArticles = Article::with('category')
            ->where('id', '!=', $article->id)
            ->where('article_category_id', $article->article_category_id)
            ->published()
            ->latest('published_at')
            ->take(3)
            ->get();

        if ($relatedArticles->count() < 3) {
            $moreArticles = Article::with('category')
                ->where('id', '!=', $article->id)
                ->whereNotIn('id', $relatedArticles->pluck('id'))
                ->published()
                ->latest('published_at')
                ->take(3 - $relatedArticles->count())
                ->get();
            $relatedArticles = $relatedArticles->merge($moreArticles);
        }

        $categories = ArticleCategory::withCount(['articles' => function ($q) {
            $q->published();
        }])->get();

        $settings = WebsiteSetting::all()->pluck('value', 'key')->toArray();

        return view('public.articles.show', compact('article', 'relatedArticles', 'categories', 'settings'));
    }
}
