<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', \App\Models\WebsiteSetting::get('site_name', 'Coffee Shop')) — {{ \App\Models\WebsiteSetting::get('site_description', 'Cerita dan Rasa dalam Setiap Cangkir') }}</title>
  
  <!-- Tailwind CSS & Plugins -->
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <script id="tailwind-config">
  globalThis.tailwind = globalThis.tailwind || {};
  globalThis.tailwind.config = {
    darkMode: 'class',
    theme: {
      extend: {
        colors: {
          'espresso': '{{ \App\Models\WebsiteSetting::get("primary_color", "#38251E") }}',
          'cream': '#F5F0E8',
          'caramel': '{{ \App\Models\WebsiteSetting::get("secondary_color", "#B98255") }}',
          'beige': '#D9C7B5',
          'charcoal': '#292522',
          'accent': '{{ \App\Models\WebsiteSetting::get("secondary_color", "#B98255") }}',
          'light-primary': '{{ \App\Models\WebsiteSetting::get("primary_color", "#38251E") }}',
          'light-on-primary': '#FFFFFF',
          'light-primary-container': '#F5F0E8',
          'light-on-primary-container': '{{ \App\Models\WebsiteSetting::get("primary_color", "#38251E") }}',
          'light-secondary': '{{ \App\Models\WebsiteSetting::get("secondary_color", "#B98255") }}',
          'light-on-secondary': '#272727',
          'light-secondary-container': '#EFE6DC',
          'light-on-secondary-container': '#38251E',
          'light-surface': '#FAF8F5',
          'light-on-surface': '#292522',
          'light-surface-variant': '#F3EDE4',
          'light-on-surface-variant': '#5A4E47',
          'light-outline': '#D9C7B5',
          'light-outline-variant': '#E7DDD2',
          'light-success': '#2E6B4A',
          'light-on-success': '#FFFFFF',
          'light-warning': '#B4691B',
          'light-on-warning': '#101010',
          'light-error': '#A32D2D',
          'light-on-error': '#FFFFFF',
        },
        borderRadius: {
          'sm': '4px',
          'DEFAULT': '8px',
          'md': '12px',
          'lg': '16px',
          'xl': '24px',
          'full': '9999px',
        },
        fontFamily: {
          'display': ['"Playfair Display"', 'serif'],
          'headline': ['"Playfair Display"', 'serif'],
          'title': ['"Poppins"', 'sans-serif'],
          'body': ['"Poppins"', 'sans-serif'],
          'label': ['"Poppins"', 'sans-serif'],
        },
        fontSize: {
          'display-lg': ['48px', { lineHeight: '56px', letterSpacing: '-0.5px', fontWeight: '700' }],
          'display-md': ['40px', { lineHeight: '48px', fontWeight: '600' }],
          'headline-lg': ['32px', { lineHeight: '40px', fontWeight: '600' }],
          'headline-md': ['24px', { lineHeight: '32px', fontWeight: '600' }],
          'headline-sm': ['20px', { lineHeight: '28px', fontWeight: '600' }],
          'title-lg': ['18px', { lineHeight: '26px', fontWeight: '600' }],
          'title-md': ['16px', { lineHeight: '24px', fontWeight: '600' }],
          'body-lg': ['16px', { lineHeight: '26px', fontWeight: '400' }],
          'body-md': ['14px', { lineHeight: '22px', fontWeight: '400' }],
          'body-sm': ['12px', { lineHeight: '18px', fontWeight: '400' }],
          'label-lg': ['14px', { lineHeight: '20px', letterSpacing: '0.5px', fontWeight: '600' }],
          'label-md': ['12px', { lineHeight: '16px', letterSpacing: '0.5px', fontWeight: '600' }],
          'label-sm': ['11px', { lineHeight: '14px', letterSpacing: '0.5px', fontWeight: '500' }],
        },
      },
    },
  };
  </script>

  <!-- Google Fonts & Material Symbols -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=block" rel="stylesheet">
  
  <style>
    .material-symbols-outlined {
      display: inline-block; width: 1em; height: 1em; line-height: 1 !important;
      box-sizing: content-box; overflow: hidden; white-space: nowrap; direction: ltr; vertical-align: middle;
    }
    html { scroll-behavior: smooth; }
  </style>

  @stack('styles')
</head>
<body class="min-h-screen bg-light-surface text-light-on-surface font-body antialiased selection:bg-caramel selection:text-white flex flex-col">

  <!-- Top Proposal Demonstration Bar -->
  <aside class="bg-espresso text-cream text-body-sm py-2 px-4 border-b border-[#4D362C] sticky top-0 z-50">
    <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-3">
      <div class="flex items-center gap-2">
        <span class="inline-flex items-center justify-center w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
        <span class="font-label text-label-sm uppercase tracking-wider text-caramel">Demo Proposal Website</span>
        <span class="text-white/60 text-body-sm hidden md:inline">| Seluruh konten dapat dikelola langsung via CMS tanpa coding</span>
      </div>
      <div class="flex items-center gap-3">
        <button onclick="document.getElementById('cms-sync-indicator').classList.toggle('hidden')" class="inline-flex items-center gap-1.5 px-3 py-1 bg-caramel/20 hover:bg-caramel/30 text-caramel border border-caramel/40 rounded text-label-sm font-label transition-colors">
          <span class="material-symbols-outlined text-[16px]">sync</span>
          Status Sinkronisasi CMS
        </button>
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1.5 px-3 py-1 bg-caramel text-white hover:bg-[#A37046] rounded text-label-sm font-label font-medium transition-colors shadow-sm">
          <span class="material-symbols-outlined text-[16px]">admin_panel_settings</span>
          Buka Admin CMS
        </a>
      </div>
    </div>
  </aside>

  <!-- CMS Live Sync Overlay Alert -->
  <div id="cms-sync-indicator" class="hidden bg-[#2C211C] text-cream px-6 py-3 border-b border-caramel/30 sticky top-[41px] z-40 transition-all">
    <div class="max-w-7xl mx-auto flex items-center justify-between text-body-sm">
      <div class="flex items-center gap-3">
        <span class="material-symbols-outlined text-caramel">hub</span>
        <span><strong>Database Terintegrasi:</strong> Konten hero, katalog menu ({{ \App\Models\MenuProduct::count() }} produk), artikel ({{ \App\Models\Article::where('status','published')->count() }} terbit), dan galeri tersinkronisasi dinamis dari MySQL Database.</span>
      </div>
      <button onclick="document.getElementById('cms-sync-indicator').classList.add('hidden')" class="text-white/60 hover:text-white">
        <span class="material-symbols-outlined text-[18px]">close</span>
      </button>
    </div>
  </div>

  <!-- Primary Navigation Bar -->
  <header class="bg-white/95 backdrop-blur border-b border-light-outline-variant sticky top-[41px] z-30 transition-all">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
      <!-- Logo & Brand Identity -->
      <a href="{{ route('home') }}" class="group flex items-center gap-3">
        @php
          $logoUrl = \App\Models\WebsiteSetting::get('logo');
          $siteName = \App\Models\WebsiteSetting::get('site_name', 'Coffee Shop');
          $siteTagline = \App\Models\WebsiteSetting::get('site_tagline', 'Artisanal Roastery');
        @endphp
        @if($logoUrl)
          <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h-10 w-auto rounded object-contain">
        @else
          <div class="w-10 h-10 rounded-DEFAULT bg-light-primary text-light-on-primary flex items-center justify-center font-headline text-headline-sm font-bold shadow-sm group-hover:bg-caramel transition-colors">
            {{ strtoupper(substr($siteName, 0, 2)) }}
          </div>
        @endif
        <div class="flex flex-col">
          <span class="font-headline text-headline-sm text-light-primary leading-tight font-bold tracking-tight">
            {{ $siteName }}
          </span>
          <span class="text-label-sm text-caramel font-label tracking-widest uppercase">
            {{ $siteTagline }}
          </span>
        </div>
      </a>

      <!-- Desktop Navigation Links -->
      <nav class="hidden lg:flex items-center gap-8">
        <a href="{{ route('home') }}" class="font-label text-label-md py-1 border-b-2 transition-colors {{ request()->routeIs('home') ? 'text-caramel border-caramel' : 'text-light-on-surface-variant hover:text-light-primary border-transparent' }}">Beranda</a>
        <a href="{{ route('about') }}" class="font-label text-label-md py-1 border-b-2 transition-colors {{ request()->routeIs('about') ? 'text-caramel border-caramel' : 'text-light-on-surface-variant hover:text-light-primary border-transparent' }}">Tentang Kami</a>
        <a href="{{ route('menu') }}" class="font-label text-label-md py-1 border-b-2 transition-colors {{ request()->routeIs('menu') ? 'text-caramel border-caramel' : 'text-light-on-surface-variant hover:text-light-primary border-transparent' }}">Menu</a>
        <a href="{{ route('articles.index') }}" class="font-label text-label-md py-1 border-b-2 transition-colors {{ request()->routeIs('articles.*') ? 'text-caramel border-caramel' : 'text-light-on-surface-variant hover:text-light-primary border-transparent' }}">Artikel</a>
        <a href="{{ route('gallery') }}" class="font-label text-label-md py-1 border-b-2 transition-colors {{ request()->routeIs('gallery') ? 'text-caramel border-caramel' : 'text-light-on-surface-variant hover:text-light-primary border-transparent' }}">Galeri</a>
        <a href="{{ route('contact') }}" class="font-label text-label-md py-1 border-b-2 transition-colors {{ request()->routeIs('contact') ? 'text-caramel border-caramel' : 'text-light-on-surface-variant hover:text-light-primary border-transparent' }}">Kontak</a>
      </nav>

      <!-- Action Button & Mobile Toggle -->
      <div class="flex items-center gap-4">
        <a href="{{ route('menu') }}" class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 bg-light-primary hover:bg-[#291B16] text-light-on-primary font-label text-label-md rounded-DEFAULT transition-all shadow-sm">
          <span class="material-symbols-outlined text-[18px]">local_cafe</span>
          <span>Pesan / Menu</span>
        </a>
        
        <!-- Mobile Menu Trigger -->
        <button id="mobile-menu-toggle" onclick="toggleMobileMenu()" class="lg:hidden p-2 text-light-primary hover:bg-light-surface-variant rounded" aria-label="Buka menu navigasi">
          <span class="material-symbols-outlined text-[26px]">menu</span>
        </button>
      </div>
    </div>

    <!-- Mobile Drawer Menu -->
    <div id="mobile-drawer" class="hidden lg:hidden border-t border-light-outline-variant bg-white px-6 py-4 flex flex-col gap-3 shadow-lg">
      <a href="{{ route('home') }}" class="text-left py-2 font-label text-label-md {{ request()->routeIs('home') ? 'text-caramel font-semibold' : 'text-light-on-surface-variant' }}">Beranda</a>
      <a href="{{ route('about') }}" class="text-left py-2 font-label text-label-md {{ request()->routeIs('about') ? 'text-caramel font-semibold' : 'text-light-on-surface-variant' }}">Tentang Kami</a>
      <a href="{{ route('menu') }}" class="text-left py-2 font-label text-label-md {{ request()->routeIs('menu') ? 'text-caramel font-semibold' : 'text-light-on-surface-variant' }}">Menu</a>
      <a href="{{ route('articles.index') }}" class="text-left py-2 font-label text-label-md {{ request()->routeIs('articles.*') ? 'text-caramel font-semibold' : 'text-light-on-surface-variant' }}">Artikel</a>
      <a href="{{ route('gallery') }}" class="text-left py-2 font-label text-label-md {{ request()->routeIs('gallery') ? 'text-caramel font-semibold' : 'text-light-on-surface-variant' }}">Galeri</a>
      <a href="{{ route('contact') }}" class="text-left py-2 font-label text-label-md {{ request()->routeIs('contact') ? 'text-caramel font-semibold' : 'text-light-on-surface-variant' }}">Kontak</a>
      <a href="{{ route('admin.dashboard') }}" class="text-left py-2 font-label text-label-md text-caramel flex items-center gap-1.5 border-t border-light-outline-variant mt-2 pt-3">
        <span class="material-symbols-outlined text-[18px]">admin_panel_settings</span>
        Login Admin CMS
      </a>
    </div>
  </header>

  <!-- Global Flash Alerts -->
  @if(session('success'))
    <div class="bg-emerald-50 border-b border-emerald-200 text-emerald-800 px-6 py-3">
      <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div class="flex items-center gap-2">
          <span class="material-symbols-outlined text-emerald-600">check_circle</span>
          <span class="text-body-md font-medium">{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">
          <span class="material-symbols-outlined text-[18px]">close</span>
        </button>
      </div>
    </div>
  @endif

  <!-- Main View Content -->
  <main class="flex-1">
    @yield('content')
  </main>

  <!-- Footer Section -->
  <footer class="bg-espresso text-cream pt-16 border-t border-[#4D362C]">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-16">
      <!-- Col 1: Brand -->
      <div class="lg:col-span-2 space-y-4">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-DEFAULT bg-caramel text-white flex items-center justify-center font-headline text-headline-sm font-bold shadow-sm">
            {{ strtoupper(substr(\App\Models\WebsiteSetting::get('site_name', 'Coffee Shop'), 0, 2)) }}
          </div>
          <span class="font-headline text-headline-md text-white font-bold">{{ \App\Models\WebsiteSetting::get('site_name', 'Coffee Shop') }}</span>
        </div>
        <p class="text-body-md text-cream/70 max-w-sm leading-relaxed">
          {{ \App\Models\WebsiteContent::get('footer', 'description', 'Kedai kopi artisanal yang berdedikasi menyajikan cita rasa terbaik kopi Nusantara dalam atmosfer yang hangat, tenang, dan bersahabat.') }}
        </p>
        <p class="text-label-sm text-caramel font-label pt-2 flex items-center gap-1.5">
          <span class="material-symbols-outlined text-[16px]">sync_alt</span>
          Konten & identitas merek dikelola langsung via Admin CMS.
        </p>
      </div>

      <!-- Col 2: Navigation Links -->
      <div class="space-y-3">
        <p class="font-label text-label-md text-white font-semibold">Tautan Cepat</p>
        <ul class="space-y-2 text-body-sm text-cream/70">
          <li><a href="{{ route('home') }}" class="hover:text-caramel transition-colors">Beranda</a></li>
          <li><a href="{{ route('about') }}" class="hover:text-caramel transition-colors">Tentang Kami</a></li>
          <li><a href="{{ route('menu') }}" class="hover:text-caramel transition-colors">Katalog Menu</a></li>
          <li><a href="{{ route('articles.index') }}" class="hover:text-caramel transition-colors">Artikel & Cerita</a></li>
          <li><a href="{{ route('gallery') }}" class="hover:text-caramel transition-colors">Galeri Foto</a></li>
          <li><a href="{{ route('contact') }}" class="hover:text-caramel transition-colors">Kontak & Lokasi</a></li>
        </ul>
      </div>

      <!-- Col 3: Operational Hours -->
      <div class="space-y-3">
        <p class="font-label text-label-md text-white font-semibold">Jam Operasional</p>
        <div class="text-body-sm text-cream/70 space-y-2">
          <p>
            <strong class="text-cream block">Senin – Jumat:</strong>
            {{ \App\Models\WebsiteContent::get('contact', 'opening_hours_weekday', '07:00 – 22:00 WIB') }}
          </p>
          <p>
            <strong class="text-cream block">Sabtu – Minggu:</strong>
            {{ \App\Models\WebsiteContent::get('contact', 'opening_hours_weekend', '08:00 – 23:00 WIB') }}
          </p>
        </div>
      </div>

      <!-- Col 4: Contacts & Social -->
      <div class="space-y-3">
        <p class="font-label text-label-md text-white font-semibold">Hubungi Kami</p>
        <div class="text-body-sm text-cream/70 space-y-2.5">
          <p class="flex items-start gap-2">
            <span class="material-symbols-outlined text-caramel text-[18px] mt-0.5">call</span>
            <span>{{ \App\Models\WebsiteContent::get('contact', 'phone', '+62 812-3456-7890') }}</span>
          </p>
          <p class="flex items-start gap-2">
            <span class="material-symbols-outlined text-caramel text-[18px] mt-0.5">mail</span>
            <span>{{ \App\Models\WebsiteContent::get('contact', 'email', 'kontak@coffeeshop.test') }}</span>
          </p>
          <p class="flex items-start gap-2">
            <span class="material-symbols-outlined text-caramel text-[18px] mt-0.5">location_on</span>
            <span>{{ \App\Models\WebsiteContent::get('contact', 'address', 'Jl. Senopati No. 45, Kebayoran Baru, Jakarta Selatan') }}</span>
          </p>
        </div>
        <div class="pt-2 flex items-center gap-3">
          @if(\App\Models\WebsiteContent::get('social', 'instagram'))
            <a href="{{ \App\Models\WebsiteContent::get('social', 'instagram') }}" target="_blank" class="w-8 h-8 rounded-full bg-white/10 hover:bg-caramel flex items-center justify-center text-cream transition-colors text-sm">IG</a>
          @endif
          @if(\App\Models\WebsiteContent::get('social', 'facebook'))
            <a href="{{ \App\Models\WebsiteContent::get('social', 'facebook') }}" target="_blank" class="w-8 h-8 rounded-full bg-white/10 hover:bg-caramel flex items-center justify-center text-cream transition-colors text-sm">FB</a>
          @endif
          @if(\App\Models\WebsiteContent::get('social', 'tiktok'))
            <a href="{{ \App\Models\WebsiteContent::get('social', 'tiktok') }}" target="_blank" class="w-8 h-8 rounded-full bg-white/10 hover:bg-caramel flex items-center justify-center text-cream transition-colors text-sm">TT</a>
          @endif
        </div>
      </div>
    </div>

    <!-- Copyright Sub-footer -->
    <div class="border-t border-[#4D362C] py-6 px-6 bg-[#271914] text-center text-body-sm text-cream/60">
      <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-3">
        <p>{{ \App\Models\WebsiteContent::get('footer', 'copyright', '© 2026 Coffee Shop Artisanal Roastery. Seluruh hak cipta dilindungi.') }}</p>
        <div class="flex items-center gap-4 text-cream/70">
          <a href="{{ route('admin.dashboard') }}" class="hover:text-caramel flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">lock</span>
            Admin CMS Login
          </a>
        </div>
      </div>
    </div>
  </footer>

  <script>
    function toggleMobileMenu() {
      const drawer = document.getElementById('mobile-drawer');
      drawer.classList.toggle('hidden');
    }
  </script>

  @stack('scripts')
</body>
</html>
