<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk Admin CMS — {{ \App\Models\WebsiteSetting::get('site_name', 'Coffee Shop') }}</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
  <script id="tailwind-config">
  globalThis.tailwind = globalThis.tailwind || {};
  globalThis.tailwind.config = {
    theme: {
      extend: {
        colors: {
          'espresso': '{{ \App\Models\WebsiteSetting::get("primary_color", "#38251E") }}',
          'cream': '#F5F0E8',
          'caramel': '{{ \App\Models\WebsiteSetting::get("secondary_color", "#B98255") }}',
          'light-primary': '{{ \App\Models\WebsiteSetting::get("primary_color", "#38251E") }}',
          'light-surface': '#FAF8F5',
          'light-outline-variant': '#E7DDD2',
        },
        fontFamily: {
          'display': ['"Playfair Display"', 'serif'],
          'headline': ['"Playfair Display"', 'serif'],
          'body': ['"Poppins"', 'sans-serif'],
        },
      },
    },
  };
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=block" rel="stylesheet">
  <style>
    .material-symbols-outlined { display: inline-block; width: 1em; height: 1em; line-height: 1 !important; vertical-align: middle; }
  </style>
</head>
<body class="min-h-screen bg-espresso text-cream font-body flex items-center justify-center p-4 relative selection:bg-caramel selection:text-white">

  <!-- Background Texture Overlay -->
  <div class="absolute inset-0 opacity-15">
    <img src="https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=1600&q=80" alt="Background" class="w-full h-full object-cover">
  </div>

  <div class="relative z-10 max-w-md w-full bg-white text-gray-900 rounded-2xl shadow-2xl border border-light-outline-variant p-8">
    
    <!-- Top Brand Logo -->
    <div class="text-center mb-8">
      <div class="w-14 h-14 rounded-2xl bg-espresso text-cream flex items-center justify-center font-headline text-2xl font-bold mx-auto mb-3 shadow-md">
        {{ strtoupper(substr(\App\Models\WebsiteSetting::get('site_name', 'CS'), 0, 2)) }}
      </div>
      <h1 class="font-headline text-2xl font-bold text-espresso">
        Admin CMS Login
      </h1>
      <p class="text-sm text-gray-500 mt-1">
        Kelola profil, menu, artikel, dan materi website secara mandiri tanpa pemrograman.
      </p>
    </div>

    @if($errors->any())
      <div class="mb-6 p-3 rounded-lg bg-red-50 border border-red-200 text-red-700 text-xs">
        {{ $errors->first() }}
      </div>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
      @csrf

      <div>
        <label class="block text-xs font-semibold text-espresso uppercase tracking-wider mb-1">
          Alamat Email Admin
        </label>
        <div class="relative">
          <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">mail</span>
          <input 
            type="email" 
            name="email" 
            value="{{ old('email') }}" 
            required 
            placeholder="nama@email.com" 
            class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg text-sm text-gray-900 focus:bg-white focus:border-espresso focus:ring-1 focus:ring-espresso outline-none">
        </div>
      </div>

      <div>
        <label class="block text-xs font-semibold text-espresso uppercase tracking-wider mb-1">
          Kata Sandi
        </label>
        <div class="relative">
          <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">lock</span>
          <input 
            type="password" 
            name="password" 
            required 
            placeholder="••••••••" 
            class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-300 rounded-lg text-sm text-gray-900 focus:bg-white focus:border-espresso focus:ring-1 focus:ring-espresso outline-none">
        </div>
      </div>

      <div class="flex items-center justify-between text-xs pt-1">
        <label class="flex items-center gap-2 cursor-pointer text-gray-600">
          <input type="checkbox" name="remember" class="rounded border-gray-300 text-espresso focus:ring-espresso">
          <span>Ingat sesi saya</span>
        </label>
        <a href="{{ route('home') }}" class="text-caramel hover:underline">Kembali ke Website</a>
      </div>

      <div class="pt-2">
        <button 
          type="submit" 
          class="w-full py-3 px-4 bg-espresso hover:bg-[#291B16] text-white rounded-lg text-sm font-semibold transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2">
          <span class="material-symbols-outlined text-[18px]">login</span>
          <span>Masuk ke Dashboard</span>
        </button>
      </div>
    </form>

    <div class="mt-6 pt-6 border-t border-gray-200 text-center text-xs text-gray-500">
      <a href="{{ route('home') }}" class="inline-flex items-center gap-1 hover:text-espresso">
        <span class="material-symbols-outlined text-[14px]">arrow_back</span>
        <span>Lihat Website Profil Publik</span>
      </a>
    </div>
  </div>

</body>
</html>
