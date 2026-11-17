<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin CMS') — {{ \App\Models\WebsiteSetting::get('site_name', 'Coffee Shop') }} CMS Portal</title>
  
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
  </style>

  @stack('styles')
</head>
<body class="min-h-screen bg-[#F6F4F0] text-light-on-surface font-body antialiased flex flex-col selection:bg-caramel selection:text-white">

  <!-- Top Proposal Header Banner connecting back to public site -->
  <header class="bg-espresso text-cream px-6 py-2 border-b border-[#4D362C] flex flex-wrap items-center justify-between text-body-sm z-40 sticky top-0">
    <div class="flex items-center gap-3">
      <span class="inline-flex items-center justify-center w-2.5 h-2.5 rounded-full bg-caramel ring-4 ring-caramel/20"></span>
      <span class="font-label text-label-sm font-semibold text-white tracking-wide uppercase">Admin CMS Portal</span>
      <span class="text-white/60 hidden sm:inline">| Demonstrasi Pengelolaan Mandiri Konten Kedai Kopi</span>
    </div>
    <div class="flex items-center gap-3">
      <a href="{{ route('home') }}" target="_blank" class="text-label-sm bg-caramel/20 hover:bg-caramel/30 text-caramel border border-caramel/40 px-2.5 py-0.5 rounded font-label flex items-center gap-1 transition-colors">
        <span class="material-symbols-outlined text-[14px]">open_in_new</span>
        Buka Web Publik
      </a>
      <form action="{{ route('admin.logout') }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="text-white/80 hover:text-white text-label-sm font-label flex items-center gap-1">
          <span class="material-symbols-outlined text-[16px]">logout</span>
          Keluar
        </button>
      </form>
    </div>
  </header>

  <!-- Main Body Layout with Fixed 260px Sidebar -->
  <div class="flex-1 flex min-h-0">
    
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-light-outline-variant flex flex-col flex-shrink-0 z-30">
      
      <!-- Brand header -->
      <div class="p-5 border-b border-light-outline-variant flex items-center gap-3">
        <div class="w-9 h-9 rounded bg-light-primary text-light-on-primary flex items-center justify-center font-headline font-bold text-headline-sm">
          {{ strtoupper(substr(\App\Models\WebsiteSetting::get('site_name', 'CS'), 0, 2)) }}
        </div>
        <div class="flex flex-col min-w-0">
          <span class="font-headline text-title-md font-bold text-light-primary truncate">
            {{ \App\Models\WebsiteSetting::get('site_name', 'Coffee Shop') }}
          </span>
          <span class="text-label-sm text-caramel font-label uppercase tracking-wider text-[10px]">
            Content Manager
          </span>
        </div>
      </div>

      <!-- Navigation Modules List -->
      <div class="p-3 flex-1 overflow-y-auto space-y-1">
        
        <!-- Module: Dashboard -->
        <a href="{{ route('admin.dashboard') }}" 
           class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT text-left font-label text-label-md transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-light-primary text-light-on-primary shadow-sm' : 'text-light-on-surface-variant hover:bg-light-surface hover:text-light-primary' }}">
          <span class="material-symbols-outlined text-[20px]">dashboard</span>
          <span>Ikhtisar Dashboard</span>
        </a>

        <!-- Module: Articles -->
        <a href="{{ route('admin.artikel.index') }}" 
           class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT text-left font-label text-label-md transition-all {{ request()->routeIs('admin.artikel.*') ? 'bg-light-primary text-light-on-primary shadow-sm' : 'text-light-on-surface-variant hover:bg-light-surface hover:text-light-primary' }}">
          <span class="material-symbols-outlined text-[20px]">article</span>
          <span>Kelola Artikel</span>
        </a>

        <!-- Module: Menu Products -->
        <a href="{{ route('admin.menu.index') }}" 
           class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT text-left font-label text-label-md transition-all {{ request()->routeIs('admin.menu.*') ? 'bg-light-primary text-light-on-primary shadow-sm' : 'text-light-on-surface-variant hover:bg-light-surface hover:text-light-primary' }}">
          <span class="material-symbols-outlined text-[20px]">restaurant_menu</span>
          <span>Kelola Menu</span>
        </a>

        <!-- Module: Gallery -->
        <a href="{{ route('admin.galeri.index') }}" 
           class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT text-left font-label text-label-md transition-all {{ request()->routeIs('admin.galeri.*') ? 'bg-light-primary text-light-on-primary shadow-sm' : 'text-light-on-surface-variant hover:bg-light-surface hover:text-light-primary' }}">
          <span class="material-symbols-outlined text-[20px]">photo_library</span>
          <span>Kelola Galeri Foto</span>
        </a>

        <!-- Module: Website Content -->
        <a href="{{ route('admin.content.index') }}" 
           class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT text-left font-label text-label-md transition-all {{ request()->routeIs('admin.content.*') ? 'bg-light-primary text-light-on-primary shadow-sm' : 'text-light-on-surface-variant hover:bg-light-surface hover:text-light-primary' }}">
          <span class="material-symbols-outlined text-[20px]">web</span>
          <span>Konten Halaman Web</span>
        </a>

        <!-- Module: Settings -->
        <a href="{{ route('admin.settings.index') }}" 
           class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT text-left font-label text-label-md transition-all {{ request()->routeIs('admin.settings.*') ? 'bg-light-primary text-light-on-primary shadow-sm' : 'text-light-on-surface-variant hover:bg-light-surface hover:text-light-primary' }}">
          <span class="material-symbols-outlined text-[20px]">settings</span>
          <span>Pengaturan Identitas</span>
        </a>
      </div>

      <!-- User Profile Card -->
      <div class="p-4 border-t border-light-outline-variant bg-light-surface/60">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-full bg-caramel/20 text-caramel flex items-center justify-center font-bold font-headline">
            {{ strtoupper(substr(auth()->user()->name ?? 'AD', 0, 2)) }}
          </div>
          <div class="flex-1 min-w-0">
            <p class="font-label text-label-sm text-light-primary font-semibold truncate">{{ auth()->user()->name ?? 'Administrator' }}</p>
            <p class="text-body-sm text-light-on-surface-variant truncate">{{ auth()->user()->email ?? 'admin@coffeeshop.test' }}</p>
          </div>
          <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-light-on-surface-variant hover:text-light-error p-1 rounded" title="Keluar">
              <span class="material-symbols-outlined text-[18px]">logout</span>
            </button>
          </form>
        </div>
      </div>
    </aside>

    <!-- Main Content Workspace Area -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
      
      <!-- Top Action Bar -->
      <div class="bg-white border-b border-light-outline-variant px-8 py-4 flex flex-wrap items-center justify-between gap-4 sticky top-0 z-20 shadow-sm">
        <div>
          <h2 class="font-headline text-headline-sm text-light-primary font-bold">
            @yield('header_title', 'Admin Dashboard')
          </h2>
          <p class="text-body-sm text-light-on-surface-variant">
            @yield('header_subtitle', 'Kelola seluruh konten website kedai kopi Anda secara terpusat.')
          </p>
        </div>

        <div class="flex items-center gap-3">
          <!-- Quick Status Pill -->
          <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 text-light-success text-label-sm font-label border border-emerald-200">
            <span class="w-2 h-2 rounded-full bg-light-success animate-ping"></span>
            <span>CMS Terhubung Database</span>
          </div>

          @yield('header_actions')
        </div>
      </div>

      <!-- Flash Notifications -->
      @if(session('success'))
        <div class="mx-8 mt-6 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-sm">
          <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-emerald-600">check_circle</span>
            <span class="font-medium text-body-sm">{{ session('success') }}</span>
          </div>
          <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800">
            <span class="material-symbols-outlined text-[18px]">close</span>
          </button>
        </div>
      @endif

      @if(session('error'))
        <div class="mx-8 mt-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-800 flex items-center justify-between shadow-sm">
          <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-red-600">error</span>
            <span class="font-medium text-body-sm">{{ session('error') }}</span>
          </div>
          <button onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-800">
            <span class="material-symbols-outlined text-[18px]">close</span>
          </button>
        </div>
      @endif

      @if($errors->any())
        <div class="mx-8 mt-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-800 shadow-sm">
          <div class="flex items-center gap-2 mb-2 font-semibold text-body-sm">
            <span class="material-symbols-outlined text-red-600">warning</span>
            <span>Terdapat beberapa kesalahan input:</span>
          </div>
          <ul class="list-disc list-inside text-body-sm text-red-700 space-y-1">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Main Section Content -->
      <div class="p-8 flex-1">
        @yield('content')
      </div>
    </div>
  </div>

  @stack('scripts')
</body>
</html>
