<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\ContactMessage;
use App\Models\MenuProduct;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    public function test_homepage_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Cerita dan Rasa dalam Setiap Cangkir');
        $response->assertSee('Menu Unggulan Favorit');
    }

    public function test_about_page_loads_successfully(): void
    {
        $response = $this->get('/tentang');
        $response->assertStatus(200);
        $response->assertSee('Kisah dan Nilai di Balik Cangkir Kami');
        $response->assertSee('Visi Kami');
        $response->assertSee('Misi Kami');
    }

    public function test_menu_page_loads_and_displays_products(): void
    {
        $response = $this->get('/menu');
        $response->assertStatus(200);
        $response->assertSee('Katalog Sajian');
        $response->assertSee('Double Espresso Gayo');
        $response->assertSee('Rp 28.000');
    }

    public function test_articles_index_loads_and_hides_drafts(): void
    {
        $response = $this->get('/artikel');
        $response->assertStatus(200);
        $response->assertSee('Cerita Rasa');
        
        // Draft article must NOT be visible
        $response->assertDontSee('Masa Depan Industri Kopi Berkelanjutan di Indonesia (Draft)');
    }

    public function test_article_detail_page_loads(): void
    {
        $published = Article::where('status', 'published')->first();
        $this->assertNotNull($published);

        $response = $this->get('/artikel/' . $published->slug);
        $response->assertStatus(200);
        $response->assertSee($published->title);
    }

    public function test_gallery_page_loads(): void
    {
        $response = $this->get('/galeri');
        $response->assertStatus(200);
        $response->assertSee('Galeri Suasana');
    }

    public function test_contact_page_loads(): void
    {
        $response = $this->get('/kontak');
        $response->assertStatus(200);
        $response->assertSee('Terhubung Bersama Kami');
        $response->assertSee('Formulir Pesan');
    }

    public function test_contact_form_validates_and_stores_message(): void
    {
        $payload = [
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '+628123456789',
            'message' => 'Halo, apakah kedai ini menyediakan fasilitas untuk reservasi pertemuan 10 orang?',
        ];

        $response = $this->post('/kontak', $payload);
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', [
            'email' => 'budi@example.com',
            'name' => 'Budi Santoso',
        ]);
    }
}
