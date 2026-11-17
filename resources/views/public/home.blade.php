@extends('layouts.public')

@section('title', $settings['site_name'] ?? 'Coffee Shop' . ' — Beranda')

@section('content')
  <!-- Hero Section -->
  <section class="relative bg-espresso text-cream overflow-hidden">
    <!-- Large background photograph -->
    <div class="absolute inset-0 z-0">
      <img src="{{ $contents['homepage']['hero_image'] ?? 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=1600&q=80' }}" alt="Atmosphere Coffee Shop" class="w-full h-full object-cover opacity-35 filter brightness-90">
      <div class="absolute inset-0 bg-gradient-to-r from-espresso via-espresso/80 to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 py-28 lg:py-36 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
      <div class="lg:col-span-8 flex flex-col items-start gap-6">
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-caramel/25 border border-caramel/40 text-caramel font-label text-label-sm tracking-wide">
          <span class="material-symbols-outlined text-[16px]">verified</span>
          <span>Profil Resmi Kedai Kopi Spesialti</span>
        </div>

        <h1 class="font-headline text-display-md lg:text-display-lg font-bold leading-tight text-white max-w-3xl text-balance">
          {{ $contents['homepage']['hero_headline'] ?? 'Cerita dan Rasa dalam Setiap Cangkir.' }}
        </h1>

        <p class="text-body-lg text-cream/85 max-w-2xl text-pretty leading-relaxed">
          {{ $contents['homepage']['hero_description'] ?? 'Menghadirkan pengalaman menikmati kopi kurasi Nusantara dengan proses roasting presisi dan suasana ruang yang dirancang untuk percakapan hangat, inspirasi, serta ketenangan.' }}
        </p>

        <div class="flex flex-wrap items-center gap-4 pt-4">
          <a href="{{ $contents['homepage']['hero_cta_url'] ?? route('menu') }}" class="px-8 py-4 bg-caramel hover:bg-[#A37046] text-white font-label text-label-lg rounded-DEFAULT transition-all shadow-lg hover:shadow-xl active:scale-[0.98] inline-flex items-center gap-2">
            <span>{{ $contents['homepage']['hero_cta_text'] ?? 'Jelajahi Menu' }}</span>
            <span class="material-symbols-outlined text-[20px]">restaurant_menu</span>
          </a>
          <a href="{{ $contents['homepage']['hero_cta_secondary_url'] ?? route('about') }}" class="px-8 py-4 bg-transparent hover:bg-white/10 text-cream border border-cream/30 hover:border-cream font-label text-label-lg rounded-DEFAULT transition-all inline-flex items-center gap-2">
            <span>{{ $contents['homepage']['hero_cta_secondary_text'] ?? 'Kenali Kami' }}</span>
            <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
          </a>
        </div>
      </div>

      <div class="lg:col-span-4 hidden lg:block">
        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-6 rounded-xl shadow-2xl flex flex-col gap-4 text-cream">
          <div class="flex items-center justify-between pb-3 border-b border-white/15">
            <span class="font-label text-label-md text-caramel flex items-center gap-1.5">
              <span class="material-symbols-outlined text-[18px]">schedule</span> Jam Buka Hari Ini
            </span>
            <span class="text-label-sm bg-emerald-500/20 text-emerald-300 px-2 py-0.5 rounded font-label border border-emerald-400/30">Buka</span>
          </div>
          <div class="space-y-1.5 text-body-sm">
            <div class="flex justify-between">
              <span class="text-white/70">Senin – Jumat</span>
              <span class="font-medium text-white">{{ $contents['contact']['opening_hours_weekday'] ?? '07:00 – 22:00 WIB' }}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-white/70">Sabtu – Minggu</span>
              <span class="font-medium text-white">{{ $contents['contact']['opening_hours_weekend'] ?? '08:00 – 23:00 WIB' }}</span>
            </div>
          </div>
          <div class="pt-3 border-t border-white/15 flex items-center gap-2 text-body-sm text-white/80">
            <span class="material-symbols-outlined text-caramel text-[18px]">location_on</span>
            <span class="truncate">{{ $contents['contact']['address'] ?? 'Jl. Senopati No. 45, Kebayoran Baru, Jakarta Selatan' }}</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Introduction Philosophy Section -->
  <section class="py-20 bg-light-surface">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
      <div class="lg:col-span-6 relative">
        <div class="rounded-xl overflow-hidden shadow-lg border border-light-outline-variant">
          <img src="https://images.unsplash.com/photo-1447933601403-0c6688de566e?auto=format&fit=crop&w=800&q=80" alt="Proses Sangrai Kopi" class="w-full h-[420px] object-cover">
        </div>
        <div class="absolute -bottom-6 -right-6 bg-white p-6 rounded-lg shadow-xl border border-light-outline-variant hidden sm:block max-w-xs">
          <div class="flex items-center gap-3 mb-2">
            <span class="w-10 h-10 rounded-full bg-light-primary-container text-light-primary flex items-center justify-center font-bold">100%</span>
            <div>
              <p class="font-headline text-headline-sm text-light-primary font-bold">Biji Asli Lokal</p>
              <p class="text-body-sm text-light-on-surface-variant">Langsung dari petani binaan</p>
            </div>
          </div>
        </div>
      </div>

      <div class="lg:col-span-6 flex flex-col items-start gap-5">
        <span class="text-label-sm font-label text-caramel tracking-widest uppercase">Tentang Filosofi Kami</span>
        <h2 class="font-headline text-headline-lg text-light-primary font-bold leading-tight">
          {{ $contents['homepage']['about_headline'] ?? 'Ruang Nyaman Berpadu dengan Dedikasi Rasa Kopi Terbaik' }}
        </h2>
        <p class="text-body-lg text-light-on-surface-variant leading-relaxed">
          {{ $contents['homepage']['about_intro'] ?? 'Berawal dari apresiasi mendalam terhadap kekayaan alam Indonesia, kami bermitra langsung dengan kelompok tani di Aceh Gayo, Kintamani, Toraja, hingga Ijen untuk menyajikan biji kopi pilihan dengan profil sangrai yang menonjolkan keaslian rasa tanah asalnya.' }}
        </p>
        <p class="text-body-md text-light-on-surface-variant leading-relaxed">
          {{ $contents['homepage']['about_p2'] ?? 'Lebih dari sekadar kedai kopi, kami menciptakan tempat singgah yang ramah di tengah hiruk pikuk kota—tempat ide-ide baru lahir dan relasi bermakna terjalin.' }}
        </p>
        <a href="{{ route('about') }}" class="mt-2 text-light-primary font-label text-label-lg inline-flex items-center gap-2 group hover:text-caramel transition-colors">
          <span>Pelajari Kisah Lengkap Kami</span>
          <span class="material-symbols-outlined text-[20px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
        </a>
      </div>
    </div>
  </section>

  <!-- Featured Menu Showcase -->
  <section class="py-20 bg-light-surface-variant/50 border-y border-light-outline-variant">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12">
        <div>
          <span class="text-label-sm font-label text-caramel tracking-widest uppercase">Pilihan Barista</span>
          <h2 class="font-headline text-headline-lg text-light-primary font-bold mt-1">Menu Unggulan Favorit</h2>
        </div>
        <a href="{{ route('menu') }}" class="inline-flex items-center gap-2 text-label-lg font-label text-light-primary hover:text-caramel transition-colors">
          <span>Lihat Semua Menu Lengkap</span>
          <span class="material-symbols-outlined text-[18px]">east</span>
        </a>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($featuredProducts as $item)
          <article class="bg-white rounded-lg border border-light-outline-variant overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col group">
            <div class="h-48 overflow-hidden bg-light-surface-variant">
              <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            </div>
            <div class="p-5 flex flex-col flex-1">
              <span class="text-label-sm font-label text-caramel mb-1">{{ $item->category->name ?? 'Racikan Khas' }}</span>
              <h3 class="font-headline text-headline-sm text-light-primary font-bold mb-2">{{ $item->name }}</h3>
              <p class="text-body-sm text-light-on-surface-variant line-clamp-2 mb-4 flex-1">
                {{ $item->description }}
              </p>
              <div class="flex items-center justify-between pt-3 border-t border-light-outline-variant">
                <span class="font-title text-title-md font-semibold text-light-primary tabular-nums">{{ $item->formatted_price }}</span>
                @if($item->is_available)
                  <span class="text-label-sm text-light-success font-label flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-light-success"></span> Tersedia
                  </span>
                @else
                  <span class="text-label-sm text-light-error font-label">Habis</span>
                @endif
              </div>
            </div>
          </article>
        @empty
          <div class="col-span-4 text-center py-12 text-light-on-surface-variant">
            Belum ada menu unggulan yang ditandai. Kelola melalui Admin CMS.
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Brand Highlights (3 Pillars) -->
  <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Pillar 1 -->
        <div class="p-8 rounded-xl bg-light-surface border border-light-outline-variant flex flex-col items-start gap-4">
          <div class="w-14 h-14 rounded-lg bg-light-primary-container text-light-primary flex items-center justify-center">
            <span class="material-symbols-outlined text-[28px]">agriculture</span>
          </div>
          <h3 class="font-headline text-headline-sm text-light-primary font-bold">
            {{ $contents['homepage']['highlight_1_title'] ?? '100% Single Origin Lokal' }}
          </h3>
          <p class="text-body-md text-light-on-surface-variant leading-relaxed">
            {{ $contents['homepage']['highlight_1_desc'] ?? 'Biji kopi dipasok langsung dari kelompok tani binaan di Sumatra, Jawa, Bali, dan Flores.' }}
          </p>
        </div>

        <!-- Pillar 2 -->
        <div class="p-8 rounded-xl bg-light-surface border border-light-outline-variant flex flex-col items-start gap-4">
          <div class="w-14 h-14 rounded-lg bg-light-primary-container text-light-primary flex items-center justify-center">
            <span class="material-symbols-outlined text-[28px]">local_fire_department</span>
          </div>
          <h3 class="font-headline text-headline-sm text-light-primary font-bold">
            {{ $contents['homepage']['highlight_2_title'] ?? 'Sangrai Segar Berkala' }}
          </h3>
          <p class="text-body-md text-light-on-surface-variant leading-relaxed">
            {{ $contents['homepage']['highlight_2_desc'] ?? 'Profil sangrai batch kecil dikalibrasi harian demi menjaga kompleksitas rasa alami.' }}
          </p>
        </div>

        <!-- Pillar 3 -->
        <div class="p-8 rounded-xl bg-light-surface border border-light-outline-variant flex flex-col items-start gap-4">
          <div class="w-14 h-14 rounded-lg bg-light-primary-container text-light-primary flex items-center justify-center">
            <span class="material-symbols-outlined text-[28px]">storefront</span>
          </div>
          <h3 class="font-headline text-headline-sm text-light-primary font-bold">
            {{ $contents['homepage']['highlight_3_title'] ?? 'Ruang Inklusif & Hangat' }}
          </h3>
          <p class="text-body-md text-light-on-surface-variant leading-relaxed">
            {{ $contents['homepage']['highlight_3_desc'] ?? 'Dirancang dengan kayu jati daur ulang dan suasana ramah untuk bekerja maupun bercengkerama.' }}
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Latest Articles Section -->
  <section class="py-20 bg-light-surface border-t border-light-outline-variant">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12">
        <div>
          <span class="text-label-sm font-label text-caramel tracking-widest uppercase">Cerita & Edukasi</span>
          <h2 class="font-headline text-headline-lg text-light-primary font-bold mt-1">Artikel Terkini dari Roastery</h2>
        </div>
        <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 text-label-lg font-label text-light-primary hover:text-caramel transition-colors">
          <span>Lihat Semua Artikel</span>
          <span class="material-symbols-outlined text-[18px]">east</span>
        </a>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($latestArticles as $article)
          <article class="bg-white rounded-lg border border-light-outline-variant overflow-hidden shadow-sm flex flex-col group">
            <div class="h-48 overflow-hidden bg-light-surface-variant">
              <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            </div>
            <div class="p-6 flex flex-col flex-1">
              <div class="flex items-center gap-2 text-label-sm text-caramel font-label mb-2">
                <span>{{ $article->category->name ?? 'Artikel' }}</span>
                <span>•</span>
                <span class="text-light-on-surface-variant">{{ $article->published_at ? $article->published_at->isoFormat('D MMM Y') : '' }}</span>
              </div>
              <h3 class="font-headline text-headline-sm text-light-primary font-bold mb-3 group-hover:text-caramel transition-colors">
                <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
              </h3>
              <p class="text-body-sm text-light-on-surface-variant line-clamp-3 mb-4 flex-1">
                {{ $article->excerpt }}
              </p>
              <a href="{{ route('articles.show', $article->slug) }}" class="text-label-md font-label text-light-primary inline-flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                <span>Baca Artikel Lengkap</span>
                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
              </a>
            </div>
          </article>
        @empty
          <div class="col-span-3 text-center py-12 text-light-on-surface-variant">
            Belum ada artikel yang dipublikasikan.
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Gallery Preview Grid -->
  <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12">
        <div>
          <span class="text-label-sm font-label text-caramel tracking-widest uppercase">Dokumentasi Visual</span>
          <h2 class="font-headline text-headline-lg text-light-primary font-bold mt-1">Sudut Kedai & Aktivitas</h2>
        </div>
        <a href="{{ route('gallery') }}" class="inline-flex items-center gap-2 text-label-lg font-label text-light-primary hover:text-caramel transition-colors">
          <span>Buka Galeri Lengkap</span>
          <span class="material-symbols-outlined text-[18px]">east</span>
        </a>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
        @forelse($galleryImages as $img)
          <div class="group relative rounded-lg overflow-hidden h-44 bg-light-surface-variant shadow-sm border border-light-outline-variant">
            <img src="{{ $img->image_url }}" alt="{{ $img->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
            <div class="absolute inset-0 bg-espresso/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center p-3 text-center">
              <span class="text-white text-body-sm font-label line-clamp-2">{{ $img->title }}</span>
            </div>
          </div>
        @empty
          <div class="col-span-6 text-center py-12 text-light-on-surface-variant">
            Belum ada foto galeri.
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Location & Opening Hours Section -->
  <section class="py-20 bg-light-surface-variant/40 border-t border-light-outline-variant">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
      <div class="lg:col-span-6 space-y-6">
        <div>
          <span class="text-label-sm font-label text-caramel tracking-widest uppercase">Kunjungi Kami</span>
          <h2 class="font-headline text-headline-lg text-light-primary font-bold mt-1">Tempat Singgah yang Selalu Menyambut Anda</h2>
        </div>
        <p class="text-body-md text-light-on-surface-variant leading-relaxed">
          Terletak di kawasan yang tenang dan mudah diakses, kami siap menyeduhkan cangkir kopi terbaik Anda setiap hari.
        </p>
        
        <div class="space-y-4 pt-2">
          <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-light-primary-container text-light-primary flex items-center justify-center flex-shrink-0">
              <span class="material-symbols-outlined text-[20px]">location_on</span>
            </div>
            <div>
              <p class="font-label text-label-md text-light-primary font-semibold">Alamat Kedai</p>
              <p class="text-body-md text-light-on-surface-variant">{{ $contents['contact']['address'] ?? 'Jl. Senopati No. 45, Kebayoran Baru, Jakarta Selatan' }}</p>
            </div>
          </div>

          <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-light-primary-container text-light-primary flex items-center justify-center flex-shrink-0">
              <span class="material-symbols-outlined text-[20px]">schedule</span>
            </div>
            <div>
              <p class="font-label text-label-md text-light-primary font-semibold">Jam Operasional</p>
              <p class="text-body-md text-light-on-surface-variant">
                Senin – Jumat: {{ $contents['contact']['opening_hours_weekday'] ?? '07:00 – 22:00 WIB' }}<br>
                Sabtu – Minggu: {{ $contents['contact']['opening_hours_weekend'] ?? '08:00 – 23:00 WIB' }}
              </p>
            </div>
          </div>

          <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-light-primary-container text-light-primary flex items-center justify-center flex-shrink-0">
              <span class="material-symbols-outlined text-[20px]">contact_support</span>
            </div>
            <div>
              <p class="font-label text-label-md text-light-primary font-semibold">Kontak & Reservasi</p>
              <p class="text-body-md text-light-on-surface-variant">
                Telepon: {{ $contents['contact']['phone'] ?? '+62 812-3456-7890' }}<br>
                Email: {{ $contents['contact']['email'] ?? 'kontak@coffeeshop.test' }}
              </p>
            </div>
          </div>
        </div>

        <div class="pt-2">
          <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-light-primary hover:bg-[#291B16] text-light-on-primary rounded font-label text-label-md shadow-sm transition-all">
            <span>Kirim Pesan atau Pertanyaan</span>
            <span class="material-symbols-outlined text-[18px]">send</span>
          </a>
        </div>
      </div>

      <div class="lg:col-span-6">
        <div class="rounded-xl overflow-hidden shadow-md border border-light-outline-variant h-[380px] bg-white">
          <iframe 
            src="{{ $contents['contact']['map_embed'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.297445778844!2d106.8083818!3d-6.2244512!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f14d30079f01%3A0x2e061f153245464e!2sKebayoran%20Baru%2C%20South%20Jakarta%20City%2C%20Jakarta!5e0!3m2!1sen!2sid!4v1600000000000!5m2!1sen!2sid' }}" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy">
          </iframe>
        </div>
      </div>
    </div>
  </section>
@endsection
