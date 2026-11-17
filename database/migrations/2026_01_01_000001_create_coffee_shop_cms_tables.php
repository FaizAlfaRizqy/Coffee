<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Article Categories
        Schema::create('article_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // 2. Articles
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_category_id')->nullable()->constrained('article_categories')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('featured_image')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft')->index();
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamps();
        });

        // 3. Menu Categories
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 4. Menu Products
        Schema::create('menu_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_category_id')->nullable()->constrained('menu_categories')->nullOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->boolean('is_available')->default(true)->index();
            $table->boolean('is_featured')->default(false)->index();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 5. Gallery Categories
        Schema::create('gallery_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // 6. Gallery Images
        Schema::create('gallery_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_category_id')->nullable()->constrained('gallery_categories')->nullOnDelete();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('image');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // 7. Website Settings
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->longText('value')->nullable();
            $table->timestamps();
        });

        // 8. Website Contents
        Schema::create('website_contents', function (Blueprint $table) {
            $table->id();
            $table->string('section')->index();
            $table->string('key');
            $table->longText('value')->nullable();
            $table->unique(['section', 'key']);
            $table->timestamps();
        });

        // 9. Contact Messages
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('message');
            $table->boolean('is_read')->default(false)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('website_contents');
        Schema::dropIfExists('website_settings');
        Schema::dropIfExists('gallery_images');
        Schema::dropIfExists('gallery_categories');
        Schema::dropIfExists('menu_products');
        Schema::dropIfExists('menu_categories');
        Schema::dropIfExists('articles');
        Schema::dropIfExists('article_categories');
    }
};
