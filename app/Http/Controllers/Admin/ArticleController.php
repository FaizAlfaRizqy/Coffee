<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(Request $request): View
    {
        $query = Article::with('category')->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('article_category_id', $request->input('category'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $articles = $query->paginate(10)->withQueryString();
        $categories = ArticleCategory::orderBy('name')->get();

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    public function create(): View
    {
        $categories = ArticleCategory::orderBy('name')->get();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'article_category_id' => ['nullable', 'exists:article_categories,id'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'published_at' => ['nullable', 'date'],
            'featured_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'image_url' => ['nullable', 'url', 'max:1000'],
        ]);

        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $count = 1;
        while (Article::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$count}";
            $count++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('articles', 'public');
            $validated['featured_image'] = $path;
        } elseif ($request->filled('image_url')) {
            $validated['featured_image'] = $request->input('image_url');
        }

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        Article::create($validated);

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil diterbitkan!');
    }

    public function edit(Article $article): View
    {
        $categories = ArticleCategory::orderBy('name')->get();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'article_category_id' => ['nullable', 'exists:article_categories,id'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,published'],
            'published_at' => ['nullable', 'date'],
            'featured_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'image_url' => ['nullable', 'url', 'max:1000'],
        ]);

        if ($article->title !== $validated['title']) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $count = 1;
            while (Article::where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
                $slug = "{$baseSlug}-{$count}";
                $count++;
            }
            $validated['slug'] = $slug;
        }

        if ($request->hasFile('featured_image')) {
            if ($article->featured_image && !Str::startsWith($article->featured_image, 'http')) {
                Storage::disk('public')->delete($article->featured_image);
            }
            $path = $request->file('featured_image')->store('articles', 'public');
            $validated['featured_image'] = $path;
        } elseif ($request->filled('image_url')) {
            $validated['featured_image'] = $request->input('image_url');
        }

        if ($validated['status'] === 'published' && empty($article->published_at) && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $article->update($validated);

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Perubahan artikel berhasil disimpan!');
    }

    public function destroy(Article $article): RedirectResponse
    {
        if ($article->featured_image && !Str::startsWith($article->featured_image, 'http')) {
            Storage::disk('public')->delete($article->featured_image);
        }

        $article->delete();

        return redirect()->route('admin.artikel.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }
}
