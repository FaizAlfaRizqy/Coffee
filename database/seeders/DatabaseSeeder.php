<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use App\Models\MenuCategory;
use App\Models\MenuProduct;
use App\Models\User;
use App\Models\WebsiteContent;
use App\Models\WebsiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@coffeeshop.test'],
            [
                'name' => 'Admin Coffee Shop',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // 2. Website Settings
        $settings = [
            'site_name' => 'Coffee Shop',
            'site_tagline' => 'Artisanal Roastery',
            'site_description' => 'Cerita dan Rasa dalam Setiap Cangkir',
            'primary_color' => '#38251E',
            'secondary_color' => '#B98255',
            'admin_email' => 'admin@coffeeshop.test',
            'phone' => '+62 812-3456-7890',
            'address' => 'Jl. Senopati No. 45, Kebayoran Baru, Jakarta Selatan 12190',
            'logo' => null,
            'favicon' => null,
        ];

        foreach ($settings as $key => $value) {
            WebsiteSetting::set($key, $value);
        }

        // 3. Website Contents
        $contents = [
            // Homepage
            ['section' => 'homepage', 'key' => 'hero_headline', 'value' => 'Cerita dan Rasa dalam Setiap Cangkir'],
            ['section' => 'homepage', 'key' => 'hero_description', 'value' => 'Biji kopi pilihan dari petani terbaik Nusantara, disangrai dan diseduh dengan penuh dedikasi untuk menyajikan pengalaman kopi yang autentik dan berkesan.'],
            ['section' => 'homepage', 'key' => 'hero_cta_text', 'value' => 'Jelajahi Menu Kami'],
            ['section' => 'homepage', 'key' => 'hero_cta_url', 'value' => '/menu'],
            ['section' => 'homepage', 'key' => 'hero_cta_secondary_text', 'value' => 'Pelajari Kisah Kami'],
            ['section' => 'homepage', 'key' => 'hero_cta_secondary_url', 'value' => '/tentang'],
            ['section' => 'homepage', 'key' => 'about_headline', 'value' => 'Ruang Nyaman Berpadu dengan Dedikasi Rasa Kopi Terbaik'],
            ['section' => 'homepage', 'key' => 'about_intro', 'value' => 'Berawal dari apresiasi mendalam terhadap kekayaan alam Indonesia, kami bermitra langsung dengan kelompok tani di Aceh Gayo, Kintamani, Toraja, hingga Ijen untuk menyajikan biji kopi pilihan dengan profil sangrai yang menonjolkan keaslian rasa tanah asalnya.'],
            ['section' => 'homepage', 'key' => 'about_p2', 'value' => 'Lebih dari sekadar kedai kopi, kami menciptakan tempat singgah yang ramah di tengah hiruk pikuk kota—tempat ide-ide baru lahir dan relasi bermakna terjalin.'],
            ['section' => 'homepage', 'key' => 'highlight_1_title', 'value' => '100% Single Origin Lokal'],
            ['section' => 'homepage', 'key' => 'highlight_1_desc', 'value' => 'Biji kopi dipasok langsung dari kelompok tani binaan di Sumatra, Jawa, Bali, dan Flores.'],
            ['section' => 'homepage', 'key' => 'highlight_2_title', 'value' => 'Sangrai Segar Berkala'],
            ['section' => 'homepage', 'key' => 'highlight_2_desc', 'value' => 'Profil sangrai batch kecil dikalibrasi harian demi menjaga kompleksitas rasa alami.'],
            ['section' => 'homepage', 'key' => 'highlight_3_title', 'value' => 'Ruang Inklusif & Hangat'],
            ['section' => 'homepage', 'key' => 'highlight_3_desc', 'value' => 'Dirancang dengan kayu jati daur ulang dan suasana ramah untuk bekerja maupun bercengkerama.'],

            // About
            ['section' => 'about', 'key' => 'intro_title', 'value' => 'Sebuah Perjalanan Rasa dari Tanah Nusantara'],
            ['section' => 'about', 'key' => 'intro_text', 'value' => 'Perjalanan kami dimulai dari kekaguman sederhana terhadap dedikasi para petani kopi tradisional di berbagai pelosok Indonesia. Setiap daerah melahirkan keunikan rasa yang berbeda—dari keharuman rempah khas Sumatra hingga kelembutan sitrus dataran tinggi Bali.'],
            ['section' => 'about', 'key' => 'brand_story_title', 'value' => 'Menghubungkan Petani dengan Penikmat Kopi'],
            ['section' => 'about', 'key' => 'brand_story_text', 'value' => 'Kami percaya secangkir kopi istimewa bukan kebetulan, melainkan mata rantai panjang dedikasi: dari perawatan pohon kopi, pemetikan buah matang optimal, proses fermentasi yang cermat, hingga penyangraian artisanal dan penyeduhan presisi oleh barista kami.'],
            ['section' => 'about', 'key' => 'vision', 'value' => 'Menjadi ruang singgah artisanal terpercaya yang merayakan kekayaan kopi Indonesia melalui sajian berkelas, praktik perdagangan berkeadilan, dan keramahan yang tulus.'],
            ['section' => 'about', 'key' => 'mission_1', 'value' => 'Membeli hasil panen langsung dari kelompok tani lokal dengan harga yang adil dan menghargai dedikasi mereka.'],
            ['section' => 'about', 'key' => 'mission_2', 'value' => 'Mengedukasi penikmat kopi mengenai keanekaragaman cita rasa biji kopi single origin Indonesia.'],
            ['section' => 'about', 'key' => 'mission_3', 'value' => 'Menyediakan wadah sosial yang hangat, inklusif, dan ramah lingkungan.'],
            ['section' => 'about', 'key' => 'atmosphere_title', 'value' => 'Desain Ruang yang Menenangkan Jiwa'],
            ['section' => 'about', 'key' => 'atmosphere_text', 'value' => 'Setiap sudut kedai kami ditata dengan material alami kayu jati daur ulang, bata ekspos hangat, serta tanaman hijau indoor yang menyegarkan pandangan. Baik Anda datang untuk menyelesaikan proyek kreatif, membaca buku favorit, atau sekadar bertukar kabar bersama sahabat karib, kami memastikan Anda merasa disambut layaknya di rumah sendiri.'],

            // Contact
            ['section' => 'contact', 'key' => 'address', 'value' => 'Jl. Senopati No. 45, Kebayoran Baru, Jakarta Selatan 12190'],
            ['section' => 'contact', 'key' => 'phone', 'value' => '+62 812-3456-7890'],
            ['section' => 'contact', 'key' => 'email', 'value' => 'kontak@coffeeshop.test'],
            ['section' => 'contact', 'key' => 'opening_hours_weekday', 'value' => 'Senin – Jumat: 07.00 – 22.00 WIB'],
            ['section' => 'contact', 'key' => 'opening_hours_weekend', 'value' => 'Sabtu – Minggu: 08.00 – 23.00 WIB'],
            ['section' => 'contact', 'key' => 'map_embed', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.297445778844!2d106.8083818!3d-6.2244512!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f14d30079f01%3A0x2e061f153245464e!2sKebayoran%20Baru%2C%20South%20Jakarta%20City%2C%20Jakarta!5e0!3m2!1sen!2sid!4v1600000000000!5m2!1sen!2sid'],

            // Social Media
            ['section' => 'social', 'key' => 'instagram', 'value' => 'https://instagram.com/coffeeshop'],
            ['section' => 'social', 'key' => 'facebook', 'value' => 'https://facebook.com/coffeeshop'],
            ['section' => 'social', 'key' => 'tiktok', 'value' => 'https://tiktok.com/@coffeeshop'],
            ['section' => 'social', 'key' => 'youtube', 'value' => 'https://youtube.com/@coffeeshop'],

            // Footer
            ['section' => 'footer', 'key' => 'description', 'value' => 'Kedai kopi artisanal yang berdedikasi menyajikan cita rasa terbaik kopi Nusantara dalam atmosfer yang hangat, tenang, dan bersahabat.'],
            ['section' => 'footer', 'key' => 'copyright', 'value' => '© 2026 Coffee Shop Artisanal Roastery. Seluruh hak cipta dilindungi.'],
        ];

        foreach ($contents as $c) {
            WebsiteContent::set($c['section'], $c['key'], $c['value']);
        }

        // 4. Menu Categories & Products
        $catEspresso = MenuCategory::create(['name' => 'Espresso Based', 'slug' => 'espresso-based', 'sort_order' => 1]);
        $catManual = MenuCategory::create(['name' => 'Manual Brew', 'slug' => 'manual-brew', 'sort_order' => 2]);
        $catSignature = MenuCategory::create(['name' => 'Signature Drinks', 'slug' => 'signature-drinks', 'sort_order' => 3]);
        $catNonCoffee = MenuCategory::create(['name' => 'Non-Coffee', 'slug' => 'non-coffee', 'sort_order' => 4]);
        $catFood = MenuCategory::create(['name' => 'Food & Snacks', 'slug' => 'food-snacks', 'sort_order' => 5]);

        $products = [
            // Espresso Based
            [
                'category_id' => $catEspresso->id,
                'name' => 'Double Espresso Gayo',
                'description' => 'Ekstraksi intens dengan crema keemasan tebal, menyajikan aroma dark chocolate dan spicy herbal notes yang kuat.',
                'image' => 'https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?auto=format&fit=crop&w=800&q=80',
                'price' => 28000,
                'is_available' => true,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'category_id' => $catEspresso->id,
                'name' => 'Americano Flores',
                'description' => 'Espresso ganda dipadukan dengan air panas murni, menghasilkan rasa kopi yang bersih dengan hint apel manis.',
                'image' => 'https://images.unsplash.com/photo-1551030173-122aabc4489c?auto=format&fit=crop&w=800&q=80',
                'price' => 25000,
                'is_available' => true,
                'is_featured' => false,
                'sort_order' => 2,
            ],
            [
                'category_id' => $catEspresso->id,
                'name' => 'Cafe Latte Toraja',
                'description' => 'Perpaduan lembut espresso Toraja dengan steamed milk bertekstur microfoam sutra yang memanjakan lidah.',
                'image' => 'https://images.unsplash.com/photo-1534778101976-62847782c213?auto=format&fit=crop&w=800&q=80',
                'price' => 35000,
                'is_available' => true,
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'category_id' => $catEspresso->id,
                'name' => 'Cappuccino Nusantara',
                'description' => 'Komposisi klasik seimbang antara espresso pekat, susu hangat, dan buih susu tebal dengan taburan bubuk cokelat.',
                'image' => 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?auto=format&fit=crop&w=800&q=80',
                'price' => 33000,
                'is_available' => true,
                'is_featured' => false,
                'sort_order' => 4,
            ],

            // Manual Brew
            [
                'category_id' => $catManual->id,
                'name' => 'V60 Flores Bajawa',
                'description' => 'Seduhan manual dengan filter kertas Jepang, mengeluarkan keasaman buah plum, aroma floral melati, dan aftertaste karamel manis.',
                'image' => 'https://images.unsplash.com/photo-1544787219-7f47ccb76574?auto=format&fit=crop&w=800&q=80',
                'price' => 45000,
                'is_available' => true,
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'category_id' => $catManual->id,
                'name' => 'Aeropress Aceh Gayo',
                'description' => 'Ekstraksi bertekanan udara yang menghasilkan body kopi mantap dan kejernihan rasa khas rempah Nusantara.',
                'image' => 'https://images.unsplash.com/photo-1517256064527-09c73fc73e38?auto=format&fit=crop&w=800&q=80',
                'price' => 42000,
                'is_available' => true,
                'is_featured' => false,
                'sort_order' => 6,
            ],
            [
                'category_id' => $catManual->id,
                'name' => 'Japanese Iced Drip Bali',
                'description' => 'V60 yang diseduh langsung ke atas kristal es batu, mengunci aroma sitrus segar dan kesegaran tropis khas Kintamani.',
                'image' => 'https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?auto=format&fit=crop&w=800&q=80',
                'price' => 48000,
                'is_available' => true,
                'is_featured' => true,
                'sort_order' => 7,
            ],

            // Signature Drinks
            [
                'category_id' => $catSignature->id,
                'name' => 'Sea Salt Caramel Latte',
                'description' => 'Racikan sirup karamel bakar resep rumahan, espresso pekat, susu segar, dan sentuhan garam laut murni di atas lapisan foam.',
                'image' => 'https://images.unsplash.com/photo-1461023058943-07fcbe16d735?auto=format&fit=crop&w=800&q=80',
                'price' => 38000,
                'is_available' => true,
                'is_featured' => true,
                'sort_order' => 8,
            ],
            [
                'category_id' => $catSignature->id,
                'name' => 'Pandan Coconut Cold Brew',
                'description' => 'Cold brew steeping 16 jam dipadu aroma daun pandan wangi alami dan santan kelapa organik yang menyegarkan.',
                'image' => 'https://images.unsplash.com/photo-1517701604599-bb29b565090c?auto=format&fit=crop&w=800&q=80',
                'price' => 36000,
                'is_available' => true,
                'is_featured' => false,
                'sort_order' => 9,
            ],

            // Non-Coffee
            [
                'category_id' => $catNonCoffee->id,
                'name' => 'Artisanal Uji Matcha Latte',
                'description' => 'Bubuk matcha ceremonial grade dari perkebunan pilihan dengan susu segar dan tekstur velvety yang seimbang.',
                'image' => 'https://images.unsplash.com/photo-1536256263959-770b48d82b0a?auto=format&fit=crop&w=800&q=80',
                'price' => 35000,
                'is_available' => true,
                'is_featured' => false,
                'sort_order' => 10,
            ],
            [
                'category_id' => $catNonCoffee->id,
                'name' => 'Dark Chocolate Aceh 70%',
                'description' => 'Cokelat hitam murni 70% asal Pidie Jaya Aceh, dilelehkan dengan susu hangat menghasilkan minuman kaya antioksidan.',
                'image' => 'https://images.unsplash.com/photo-1542990253-0d0f5be5f0ed?auto=format&fit=crop&w=800&q=80',
                'price' => 32000,
                'is_available' => true,
                'is_featured' => false,
                'sort_order' => 11,
            ],

            // Food & Snacks
            [
                'category_id' => $catFood->id,
                'name' => 'Butter Croissant Prancisan',
                'description' => 'Pastry renyah berlapis dengan aroma mentega murni Prancis, dipanggang segar setiap pagi untuk teman minum kopi.',
                'image' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?auto=format&fit=crop&w=800&q=80',
                'price' => 24000,
                'is_available' => true,
                'is_featured' => false,
                'sort_order' => 12,
            ],
            [
                'category_id' => $catFood->id,
                'name' => 'Banana Walnut Bread',
                'description' => 'Kue pisang raja panggang dengan taburan kacang walnut renyah dan taburan kayu manis yang wangi.',
                'image' => 'https://images.unsplash.com/photo-1605698802011-8ec2bdf27448?auto=format&fit=crop&w=800&q=80',
                'price' => 26000,
                'is_available' => true,
                'is_featured' => false,
                'sort_order' => 13,
            ],
        ];

        foreach ($products as $p) {
            MenuProduct::create([
                'menu_category_id' => $p['category_id'],
                'name' => $p['name'],
                'description' => $p['description'],
                'image' => $p['image'],
                'price' => $p['price'],
                'is_available' => $p['is_available'],
                'is_featured' => $p['is_featured'],
                'sort_order' => $p['sort_order'],
            ]);
        }

        // 5. Article Categories & Articles
        $artCat1 = ArticleCategory::create(['name' => 'Asal Biji', 'slug' => 'asal-biji']);
        $artCat2 = ArticleCategory::create(['name' => 'Panduan Seduh', 'slug' => 'panduan-seduh']);
        $artCat3 = ArticleCategory::create(['name' => 'Edukasi Kopi', 'slug' => 'edukasi-kopi']);
        $artCat4 = ArticleCategory::create(['name' => 'Berita Kedai', 'slug' => 'berita-kedai']);

        $articles = [
            [
                'category_id' => $artCat1->id,
                'title' => 'Mengenal Karakteristik Rasa Kopi Single Origin Indonesia',
                'slug' => 'mengenal-karakteristik-rasa-kopi-single-origin-indonesia',
                'excerpt' => 'Menelusuri keunikan notes floral dari Toraja hingga keasaman segar buah-buahan dari lereng Gunung Ijen Jawa Timur.',
                'content' => "Indonesia merupakan salah satu negara penghasil kopi paling beragam di dunia. Terbentang di sepanjang garis khatulistiwa dengan rantai pegunungan vulkanik yang subur, setiap pulau melahirkan biji kopi dengan identitas organoleptik yang sangat spesifik dan memikat.\n\nKopi Aceh Gayo dikenal dengan aroma herbal rempah dan body tebal dengan keasaman seimbang. Sementara itu, kopi Toraja Sulawesi menawarkan sentuhan dark chocolate dan grapefruit yang eksotis. Di bagian timur, Flores Bajawa menghadirkan sensasi kacang macadamia dan cokelat susu yang manis lembut.\n\nMemahami asal usul biji kopi memungkinkan kita menikmati secangkir kopi lebih dari sekadar minuman berkafein, melainkan sebuah perjalanan rasa melintasi bentang alam Nusantara.",
                'image' => 'https://images.unsplash.com/photo-1447933601403-0c6688de566e?auto=format&fit=crop&w=800&q=80',
                'status' => 'published',
                'published_at' => now()->subDays(2),
            ],
            [
                'category_id' => $artCat2->id,
                'title' => '5 Rahasia Menyeduh Kopi Manual V60 Nikmat di Rumah',
                'slug' => '5-rahasia-menyeduh-kopi-manual-v60-nikmat-di-rumah',
                'excerpt' => 'Tips praktis mengatur suhu air, rasio gilingan medium, serta ritme penuangan air agar cangkir kopi Anda tidak pahit.',
                'content' => "Menyeduh kopi dengan metode V60 adalah seni mengendalikan variabel untuk menghasilkan ekstraksi yang optimal dan jernih. Berikut lima faktor utama yang perlu diperhatikan:\n\n1. Rasio Seduhan: Gunakan rasio 1:15 atau 1:16 (misalnya 15 gram bubuk kopi untuk 240 ml air).\n2. Tingkat Gilingan: Pilih ukuran gilingan medium-fine yang menyerupai butiran garam meja.\n3. Suhu Air Optimal: Gunakan air dengan temperatur antara 90°C hingga 93°C.\n4. Tahap Blooming: Tuangkan 45 ml air pertama dan biarkan selama 30-45 detik agar gas karbon dioksida terlepas.\n5. Penuangan Konsisten: Tuang air dengan gerakan melingkar teratur dari tengah ke arah luar tanpa mengenai dinding kertas filter.",
                'image' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=800&q=80',
                'status' => 'published',
                'published_at' => now()->subDays(5),
            ],
            [
                'category_id' => $artCat3->id,
                'title' => 'Proses di Balik Secangkir Espresso yang Sempurna',
                'slug' => 'proses-di-balik-secangkir-espresso-yang-sempurna',
                'excerpt' => 'Mengapa kalibrasi mesin setiap pagi, tekanan 9 bar, dan rasio waktu ekstraksi 25-30 detik sangat krusial bagi barista profesional.',
                'content' => "Espresso adalah fondasi dari hampir seluruh minuman kopi modern. Namun, menghasilkan espresso dengan rasa seimbang antara asam, manis, dan pahit membutuhkan presisi mekanik dan kepekaan rasa yang terlatih.\n\nSetiap pagi sebelum membuka pintu untuk pelanggan, barista kami melakukan kalibrasi gilingan biji kopi (dialing-in). Perubahan kelembaban udara dan suhu ruangan dapat mengubah laju ekstraksi bubuk kopi secara drastis.\n\nDengan tekanan 9 bar dan suhu 93°C, air dipaksa menembus bubuk kopi yang dipadatkan (tamped) merata dalam waktu 25 hingga 30 detik. Hasilnya adalah 36 ml cairan kental kaya crema keemasan yang harum.",
                'image' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=800&q=80',
                'status' => 'published',
                'published_at' => now()->subDays(8),
            ],
            [
                'category_id' => $artCat1->id,
                'title' => 'Mengenal Berbagai Jenis Biji Kopi Nusantara',
                'slug' => 'mengenal-berbagai-jenis-biji-kopi-nusantara',
                'excerpt' => 'Perbedaan mendasar antara Arabika, Robusta, dan Liberika yang tumbuh subur di kepulauan Indonesia.',
                'content' => "Indonesia dikaruniai keanekaragaman varietas kopi yang luar biasa. Tiga varietas utama yang dibudidayakan adalah Arabika, Robusta, dan Liberika.\n\nArabika tumbuh optimal di dataran tinggi di atas 1000 mdpl, menghasilkan keasaman kompleks dan aroma floral atau buah-buahan yang kaya. Robusta lebih tangguh terhadap hama, tumbuh di dataran rendah, dan menyajikan body tebal dengan kadar kafein hampir dua kali lipat lebih tinggi.\n\nSementara itu, Liberika memiliki daun dan biji berukuran raksasa dengan aroma khas nangka dan rasa woody yang unik. Mengetahui karakteristik masing-masing membantu kita memilih sajian kopi yang paling sesuai selera.",
                'image' => 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&w=800&q=80',
                'status' => 'published',
                'published_at' => now()->subDays(12),
            ],
            [
                'category_id' => $artCat2->id,
                'title' => 'Tips Menikmati Manual Brew di Rumah Tanpa Alat Mahal',
                'slug' => 'tips-menikmati-manual-brew-di-rumah-tanpa-alat-mahal',
                'excerpt' => 'Panduan cerdas menyeduh kopi nikmat menggunakan French Press atau saringan kain sederhana.',
                'content' => "Menikmati kopi spesialti tidak selalu membutuhkan peralatan mahal bernilai jutaan rupiah. Anda bisa memulai dari alat seduh sederhana seperti French Press atau Clever Dripper.\n\nKunci utamanya terletak pada kualitas biji kopi sangrai segar dan air bersih yang terbebas dari bau klorin. Giling biji kopi sesaat sebelum diseduh, dan gunakan rasio air yang pas. Dengan metode perendaman (immersion) selama 4 menit menggunakan French Press, Anda sudah bisa menikmati secangkir kopi berkarakter utuh dengan rasa yang kaya.",
                'image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=800&q=80',
                'status' => 'published',
                'published_at' => now()->subDays(15),
            ],
            [
                'category_id' => $artCat4->id,
                'title' => 'Kabar Terbaru dari Dapur Sangrai: Roasting Batch Eksklusif Ijen',
                'slug' => 'kabar-terbaru-dari-dapur-sangrai-roasting-batch-eksklusif-ijen',
                'excerpt' => 'Kami menyambut panen musim ini dengan menghadirkan biji anaerobic natural dari lereng Ijen yang kaya aroma tropis.',
                'content' => "Bulan ini dapur sangrai kami kedatangan lot istimewa dari perkebunan lereng Gunung Ijen, Jawa Timur. Melalui proses fermentasi anaerobic natural selama 72 jam, biji kopi ini mengembangkan aroma semangka manis, mangga masak, dan keasaman sitrun yang segar.\n\nBatch terbatas ini kami sangrai pada tingkat light-to-medium demi menjaga kecerahan rasa aslinya. Biji ini kini telah tersedia baik sebagai seduhan manual di bar kami maupun kemasan 200g untuk Anda bawa pulang.",
                'image' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=800&q=80',
                'status' => 'published',
                'published_at' => now()->subDays(20),
            ],
            // 1 Draft Article
            [
                'category_id' => $artCat3->id,
                'title' => 'Masa Depan Industri Kopi Berkelanjutan di Indonesia (Draft)',
                'slug' => 'masa-depan-industri-kopi-berkelanjutan-di-indonesia',
                'excerpt' => 'Ulasan mendalam mengenai agroforestri dan tantangan perubahan iklim bagi perkebunan kopi generasi mendatang.',
                'content' => "Artikel ini masih dalam proses penulisan oleh tim kurasi kami. Membahas bagaimana regenerasi petani muda dan praktik ramah lingkungan menjadi kunci ketahanan kopi Nusantara.",
                'image' => 'https://images.unsplash.com/photo-1498804103079-a6351b050096?auto=format&fit=crop&w=800&q=80',
                'status' => 'draft',
                'published_at' => null,
            ],
        ];

        foreach ($articles as $a) {
            Article::create([
                'article_category_id' => $a['category_id'],
                'title' => $a['title'],
                'slug' => $a['slug'],
                'excerpt' => $a['excerpt'],
                'content' => $a['content'],
                'featured_image' => $a['image'],
                'status' => $a['status'],
                'published_at' => $a['published_at'],
            ]);
        }

        // 6. Gallery Categories & Images
        $galCat1 = GalleryCategory::create(['name' => 'Suasana Kedai', 'slug' => 'suasana-kedai']);
        $galCat2 = GalleryCategory::create(['name' => 'Proses Menyeduh', 'slug' => 'proses-menyeduh']);
        $galCat3 = GalleryCategory::create(['name' => 'Produk Menu', 'slug' => 'produk-menu']);
        $galCat4 = GalleryCategory::create(['name' => 'Acara & Komunitas', 'slug' => 'acara-komunitas']);

        $galleryImages = [
            [
                'category_id' => $galCat1->id,
                'title' => 'Sudut Tenang Meja Kayu & Tanaman',
                'description' => 'Pencahayaan alami dan interior kayu daur ulang yang memberikan kehangatan bagi pengunjung.',
                'image' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 1,
            ],
            [
                'category_id' => $galCat2->id,
                'title' => 'Penyeduhan Manual V60 Presisi',
                'description' => 'Barista menuangkan air panas bersuhu 92 derajat Celsius secara teratur.',
                'image' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 2,
            ],
            [
                'category_id' => $galCat3->id,
                'title' => 'Latte Art Anggun di Cangkir Keramik',
                'description' => 'Kombinasi microfoam sutra dan espresso single origin bercita rasa lembut.',
                'image' => 'https://images.unsplash.com/photo-1534778101976-62847782c213?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 3,
            ],
            [
                'category_id' => $galCat1->id,
                'title' => 'Area Bar Terbuka & Interaksi Barista',
                'description' => 'Pengunjung dapat berbincang langsung mengenai profil seduhan bersama para barista kami.',
                'image' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 4,
            ],
            [
                'category_id' => $galCat2->id,
                'title' => 'Kalibrasi Biji Kopi Sangrai Segar',
                'description' => 'Pemeriksaan visual dan aroma biji kopi setelah proses penyangraian artisanal.',
                'image' => 'https://images.unsplash.com/photo-1447933601403-0c6688de566e?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 5,
            ],
            [
                'category_id' => $galCat3->id,
                'title' => 'Pastry Renyah Panggang Pagi Hari',
                'description' => 'Croissant mentega harum yang siap melengkapi cangkir kopi pagi Anda.',
                'image' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 6,
            ],
            [
                'category_id' => $galCat4->id,
                'title' => 'Sesi Cupping Kopi Bersama Komunitas',
                'description' => 'Mengeksplorasi spektrum aroma dan rasa dari ragam daerah penghasil kopi Indonesia.',
                'image' => 'https://images.unsplash.com/photo-1517256064527-09c73fc73e38?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 7,
            ],
            [
                'category_id' => $galCat1->id,
                'title' => 'Suasana Senja di Kedai Kami',
                'description' => 'Lampu gantung temaram yang menghadirkan suasana santai dan akrab di penghujung hari.',
                'image' => 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 8,
            ],
        ];

        foreach ($galleryImages as $g) {
            GalleryImage::create([
                'gallery_category_id' => $g['category_id'],
                'title' => $g['title'],
                'description' => $g['description'],
                'image' => $g['image'],
                'sort_order' => $g['sort_order'],
            ]);
        }
    }
}
