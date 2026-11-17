@extends('layouts.public')

@section('title', 'Katalog Menu — ' . ($settings['site_name'] ?? 'Coffee Shop'))

@section('content')
  <!-- Menu Header -->
  <section class="bg-espresso text-cream py-16 text-center">
    <div class="max-w-7xl mx-auto px-6 max-w-2xl">
      <span class="text-label-sm font-label text-caramel tracking-widest uppercase">Katalog Sajian</span>
      <h1 class="font-headline text-display-md text-white font-bold mt-2">Daftar Menu & Racikan</h1>
      <p class="text-body-md text-cream/80 mt-2">
        Seluruh sajian diracik segar menggunakan bahan baku berkualitas prima dengan standar kalibrasi harian.
      </p>
    </div>
  </section>

  <!-- Menu Content & Filter -->
  <section class="py-16 bg-light-surface">
    <div class="max-w-7xl mx-auto px-6">
      
      <!-- Category Filter Tabs -->
      <div class="flex flex-wrap items-center justify-center gap-2 mb-12">
        <a href="{{ route('menu') }}" 
           class="px-5 py-2 rounded-full font-label text-label-md transition-all {{ empty($selectedCategory) || $selectedCategory === 'all' ? 'bg-light-primary text-light-on-primary shadow-sm' : 'bg-white border border-light-outline text-light-on-surface-variant hover:border-caramel hover:text-caramel' }}">
          Semua Kategori ({{ \App\Models\MenuProduct::where('is_available', true)->count() }})
        </a>

        @foreach($categories as $cat)
          <a href="{{ route('menu', ['kategori' => $cat->slug]) }}" 
             class="px-5 py-2 rounded-full font-label text-label-md transition-all {{ $selectedCategory === $cat->slug ? 'bg-light-primary text-light-on-primary shadow-sm' : 'bg-white border border-light-outline text-light-on-surface-variant hover:border-caramel hover:text-caramel' }}">
            {{ $cat->name }} ({{ $cat->availableProducts->count() }})
          </a>
        @endforeach
      </div>

      <!-- Product Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($products as $product)
          <article class="bg-white rounded-lg border border-light-outline-variant overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col group">
            <div class="h-56 bg-light-surface-variant overflow-hidden relative">
              <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
              
              @if($product->is_featured)
                <span class="absolute top-3 left-3 bg-caramel text-white text-[11px] font-label px-2.5 py-1 rounded shadow flex items-center gap-1">
                  <span class="material-symbols-outlined text-[13px]">star</span>
                  Unggulan
                </span>
              @endif

              <span class="absolute bottom-3 right-3 bg-white/90 backdrop-blur text-light-primary font-title text-title-md font-bold px-3 py-1 rounded shadow-sm tabular-nums">
                {{ $product->formatted_price }}
              </span>
            </div>

            <div class="p-6 flex flex-col flex-1">
              <span class="text-label-sm font-label text-caramel mb-1">
                {{ $product->category->name ?? 'Racikan Kopi' }}
              </span>
              <h3 class="font-headline text-headline-sm text-light-primary font-bold mb-2">
                {{ $product->name }}
              </h3>
              <p class="text-body-sm text-light-on-surface-variant line-clamp-3 mb-4 flex-1">
                {{ $product->description }}
              </p>

              <div class="pt-4 border-t border-light-outline-variant flex items-center justify-between">
                @if($product->is_available)
                  <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-label-sm font-label bg-emerald-50 text-light-success border border-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-light-success"></span>
                    <span>Tersedia Hari Ini</span>
                  </span>
                @else
                  <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-label-sm font-label bg-red-50 text-light-error border border-red-200">
                    <span class="w-2 h-2 rounded-full bg-light-error"></span>
                    <span>Sedang Habis</span>
                  </span>
                @endif

                <span class="text-body-sm text-light-on-surface-variant/80 font-label">
                  Fresh Brew
                </span>
              </div>
            </div>
          </article>
        @empty
          <div class="col-span-3 text-center py-16 bg-white rounded-xl border border-light-outline-variant">
            <span class="material-symbols-outlined text-[48px] text-light-on-surface-variant mb-2">restaurant_menu</span>
            <p class="font-headline text-headline-sm text-light-primary font-bold">Belum Ada Menu di Kategori Ini</p>
            <p class="text-body-md text-light-on-surface-variant mt-1">Silakan pilih kategori lainnya atau kelola menu melalui CMS.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>
@endsection
