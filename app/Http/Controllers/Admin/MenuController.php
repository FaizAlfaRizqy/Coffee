<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use App\Models\MenuProduct;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(Request $request): View
    {
        $query = MenuProduct::with('category')->orderBy('sort_order', 'asc')->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        if ($request->filled('category')) {
            $query->where('menu_category_id', $request->input('category'));
        }

        if ($request->filled('availability')) {
            $query->where('is_available', $request->input('availability') === '1');
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = MenuCategory::orderBy('sort_order', 'asc')->get();

        return view('admin.menu.index', compact('products', 'categories'));
    }

    public function create(): View
    {
        $categories = MenuCategory::orderBy('sort_order', 'asc')->get();
        return view('admin.menu.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'menu_category_id' => ['required', 'exists:menu_categories,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'image_url' => ['nullable', 'url', 'max:1000'],
            'is_available' => ['sometimes', 'boolean'],
            'is_featured' => ['sometimes', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['is_available'] = $request->has('is_available');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('menu', 'public');
            $validated['image'] = $path;
        } elseif ($request->filled('image_url')) {
            $validated['image'] = $request->input('image_url');
        }

        MenuProduct::create($validated);

        return redirect()->route('admin.menu.index')
            ->with('success', 'Produk menu berhasil ditambahkan!');
    }

    public function edit(MenuProduct $product): View
    {
        $categories = MenuCategory::orderBy('sort_order', 'asc')->get();
        return view('admin.menu.edit', compact('product', 'categories'));
    }

    public function update(Request $request, MenuProduct $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'menu_category_id' => ['required', 'exists:menu_categories,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'image_url' => ['nullable', 'url', 'max:1000'],
            'is_available' => ['sometimes', 'boolean'],
            'is_featured' => ['sometimes', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['is_available'] = $request->has('is_available');
        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('image')) {
            if ($product->image && !Str::startsWith($product->image, 'http')) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('menu', 'public');
            $validated['image'] = $path;
        } elseif ($request->filled('image_url')) {
            $validated['image'] = $request->input('image_url');
        }

        $product->update($validated);

        return redirect()->route('admin.menu.index')
            ->with('success', 'Produk menu berhasil diperbarui!');
    }

    public function destroy(MenuProduct $product): RedirectResponse
    {
        if ($product->image && !Str::startsWith($product->image, 'http')) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.menu.index')
            ->with('success', 'Produk menu berhasil dihapus!');
    }

    public function toggleAvailability(MenuProduct $product): RedirectResponse
    {
        $product->update(['is_available' => !$product->is_available]);
        $status = $product->is_available ? 'Tersedia' : 'Habis';
        return back()->with('success', "Status produk diubah menjadi: {$status}");
    }

    public function toggleFeatured(MenuProduct $product): RedirectResponse
    {
        $product->update(['is_featured' => !$product->is_featured]);
        $status = $product->is_featured ? 'Unggulan' : 'Reguler';
        return back()->with('success', "Status unggulan diubah menjadi: {$status}");
    }
}
