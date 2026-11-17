<?php

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\ArticleController as PublicArticleController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\GalleryController as PublicGalleryController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\MenuController as PublicMenuController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Public Coffee Shop Profile
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [AboutController::class, 'index'])->name('about');
Route::get('/menu', [PublicMenuController::class, 'index'])->name('menu');
Route::get('/artikel', [PublicArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [PublicArticleController::class, 'show'])->name('articles.show');
Route::get('/galeri', [PublicGalleryController::class, 'index'])->name('gallery');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Admin CMS Routes
|--------------------------------------------------------------------------
*/

// Login fallback redirect
Route::get('/login', fn () => redirect()->route('admin.login'))->name('login');

Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Auth Routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    });

    // Authenticated Admin Routes
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Article CRUD
        Route::resource('artikel', AdminArticleController::class)->names([
            'index' => 'artikel.index',
            'create' => 'artikel.create',
            'store' => 'artikel.store',
            'edit' => 'artikel.edit',
            'update' => 'artikel.update',
            'destroy' => 'artikel.destroy',
        ])->parameters(['artikel' => 'article']);

        // Menu CRUD
        Route::resource('menu', AdminMenuController::class)->names([
            'index' => 'menu.index',
            'create' => 'menu.create',
            'store' => 'menu.store',
            'edit' => 'menu.edit',
            'update' => 'menu.update',
            'destroy' => 'menu.destroy',
        ])->parameters(['menu' => 'product']);
        Route::post('menu/{product}/toggle-availability', [AdminMenuController::class, 'toggleAvailability'])->name('menu.toggle-availability');
        Route::post('menu/{product}/toggle-featured', [AdminMenuController::class, 'toggleFeatured'])->name('menu.toggle-featured');

        // Gallery CRUD
        Route::resource('galeri', AdminGalleryController::class)->names([
            'index' => 'galeri.index',
            'store' => 'galeri.store',
            'update' => 'galeri.update',
            'destroy' => 'galeri.destroy',
        ])->parameters(['galeri' => 'image'])->except(['create', 'show', 'edit']);

        // Website Content Management
        Route::get('/konten', [ContentController::class, 'index'])->name('content.index');
        Route::post('/konten', [ContentController::class, 'update'])->name('content.update');

        // Website Settings & Profile
        Route::get('/pengaturan', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('/pengaturan', [SettingsController::class, 'update'])->name('settings.update');
    });
});
