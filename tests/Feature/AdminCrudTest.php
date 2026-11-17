<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\MenuCategory;
use App\Models\MenuProduct;
use App\Models\User;
use App\Models\WebsiteContent;
use App\Models\WebsiteSetting;
use Tests\TestCase;

class AdminCrudTest extends TestCase
{
    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::first();
    }

    public function test_admin_dashboard_shows_statistics(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Ikhtisar Dashboard Konten');
        $response->assertSee('Artikel Terbit');
        $response->assertSee('Katalog Menu');
    }

    public function test_admin_can_create_article(): void
    {
        $cat = ArticleCategory::first();

        $payload = [
            'title' => 'Eksperimen Sangrai Biji Kopi Bali Kintamani',
            'article_category_id' => $cat->id,
            'excerpt' => 'Catatan eksperimen profil sangrai light roast untuk menonjolkan keasaman segar buah jeruk.',
            'content' => 'Berikut adalah detail proses penyangraian menggunakan mesin drum...',
            'status' => 'published',
            'published_at' => now()->format('Y-m-d H:i:s'),
        ];

        $response = $this->actingAs($this->admin)->post('/admin/artikel', $payload);
        $response->assertRedirect('/admin/artikel');

        $this->assertDatabaseHas('articles', [
            'title' => 'Eksperimen Sangrai Biji Kopi Bali Kintamani',
            'status' => 'published',
        ]);
    }

    public function test_admin_can_update_article(): void
    {
        $article = Article::create([
            'title' => 'Artikel Uji Coba Update',
            'slug' => 'artikel-uji-coba-update',
            'article_category_id' => ArticleCategory::first()->id,
            'excerpt' => 'Ringkasan artikel uji coba',
            'content' => 'Konten artikel uji coba',
            'status' => 'published',
        ]);

        $response = $this->actingAs($this->admin)->put('/admin/artikel/' . $article->id, [
            'title' => 'Artikel Uji Coba Update (Updated)',
            'article_category_id' => $article->article_category_id,
            'excerpt' => $article->excerpt,
            'content' => $article->content,
            'status' => 'published',
        ]);

        $response->assertRedirect('/admin/artikel');
        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'title' => 'Artikel Uji Coba Update (Updated)',
        ]);
    }

    public function test_admin_can_create_menu_product(): void
    {
        $category = MenuCategory::first();

        $payload = [
            'name' => 'Cold Brew Citrus Fizz',
            'menu_category_id' => $category->id,
            'price' => 38000,
            'description' => 'Cold brew 18 jam dengan sirup lemon organik dan soda.',
            'is_available' => '1',
            'is_featured' => '1',
        ];

        $response = $this->actingAs($this->admin)->post('/admin/menu', $payload);
        $response->assertRedirect('/admin/menu');

        $this->assertDatabaseHas('menu_products', [
            'name' => 'Cold Brew Citrus Fizz',
            'price' => 38000,
            'is_available' => true,
        ]);
    }

    public function test_admin_can_toggle_menu_availability(): void
    {
        $product = MenuProduct::create([
            'name' => 'Produk Tes Toggle',
            'menu_category_id' => MenuCategory::first()->id,
            'price' => 20000,
            'is_available' => true,
        ]);

        $response = $this->actingAs($this->admin)->post('/admin/menu/' . $product->id . '/toggle-availability');
        $response->assertSessionHas('success');

        $product->refresh();
        $this->assertFalse($product->is_available);
    }

    public function test_admin_can_update_website_content(): void
    {
        $newHeadline = 'Kopi Kurasi Nusantara Terbaik untuk Setiap Momen';

        $response = $this->actingAs($this->admin)->post('/admin/konten', [
            'homepage' => [
                'hero_headline' => $newHeadline,
            ],
        ]);

        $response->assertRedirect('/admin/konten');
        $this->assertEquals($newHeadline, WebsiteContent::get('homepage', 'hero_headline'));

        // Verify it immediately reflects on the public homepage!
        $homeResponse = $this->get('/');
        $homeResponse->assertSee($newHeadline);
    }

    public function test_admin_can_update_website_settings(): void
    {
        $newBrandName = 'Kedai Kopi Nusantara';

        $response = $this->actingAs($this->admin)->post('/admin/pengaturan', [
            'site_name' => $newBrandName,
            'site_tagline' => 'Specialty Roastery & Brew Bar',
        ]);

        $response->assertRedirect('/admin/pengaturan');
        $this->assertEquals($newBrandName, WebsiteSetting::get('site_name'));

        // Verify it reflects on public site title and nav
        $homeResponse = $this->get('/');
        $homeResponse->assertSee($newBrandName);
    }
}
