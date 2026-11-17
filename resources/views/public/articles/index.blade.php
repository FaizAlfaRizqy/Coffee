@extends('layouts.public')

@section('title', 'Artikel & Cerita Kopi — ' . ($settings['site_name'] ?? 'Coffee Shop'))

@section('content')
  <!-- Page Header -->
  <section class="bg-espresso text-cream py-16">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
          <span class="text-label-sm font-label text-caramel tracking-widest uppercase">Blog & Edukasi</span>
          <h1 class="font-headline text-display-md text-white font-bold mt-2">Artikel & Cerita Rasa</h1>
          <p class="text-body-md text-cream/80 mt-2 max-w-xl">
            Pelajari teknik penyeduhan, wawasan asal-usul komoditas kopi, dan kabar terkini dari roastery kami.
          </p>
        </div>

        <!-- Search Form -->
        <form action="{{ route('articles.index') }}" method="GET" class="w-full md:w-80">
          @if(request('kategori'))
            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
          @endif
          <div class="relative">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-light-on-surface-variant text-[20px]">search</span>
            <input 
              type="text" 
              name="search" 
              value="{{ request('search') }}" 
              placeholder="Cari topik artikel..." 
              class="w-full pl-10 pr-4 py-2.5 bg-white border border-light-outline rounded text-body-md text-light-primary focus:border-light-primary focus:ring-1 focus:ring-light-primary outline-none">
          </div>
        </form>
      </div>

      <!-- Category Filter Tabs -->
      <div class="flex flex-wrap items-center gap-2 mt-8 pt-6 border-t border-white/10">
        <a href="{{ route('articles.index', ['search' => request('search')]) }}" 
           class="px-4 py-1.5 rounded-full text-label-sm font-label transition-all {{ !request('kategori') ? 'bg-caramel text-white' : 'bg-white/10 text-cream hover:bg-white/20' }}">
          Semua Topik
        </a>
        @foreach($categories as $cat)
          <a href="{{ route('articles.index', ['kategori' => $cat->slug, 'search' => request('search')]) }}" 
             class="px-4 py-1.5 rounded-full text-label-sm font-label transition-all {{ request('kategori') === $cat->slug ? 'bg-caramel text-white' : 'bg-white/10 text-cream hover:bg-white/20' }}">
            {{ $cat->name }} ({{ $cat->articles_count }})
          </a>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Articles List -->
  <section class="py-16 bg-light-surface">
    <div class="max-w-7xl mx-auto px-6">
      
      @if(request('search'))
        <div class="mb-8 p-4 bg-light-primary-container rounded-lg flex items-center justify-between text-body-sm text-light-primary">
          <span>Menampilkan hasil pencarian untuk: <strong>"{{ request('search') }}"</strong></span>
          <a href="{{ route('articles.index') }}" class="text-caramel font-label underline">Reset Pencarian</a>
        </div>
      @endif

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        @forelse($articles as $article)
          <article class="bg-white rounded-lg border border-light-outline-variant overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col group">
            <div class="h-52 overflow-hidden bg-light-surface-variant">
              <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            </div>
            
            <div class="p-6 flex flex-col flex-1">
              <div class="flex items-center gap-2 text-label-sm text-caramel font-label mb-2">
                <span>{{ $article->category->name ?? 'Wawasan' }}</span>
                <span>•</span>
                <span class="text-light-on-surface-variant">{{ $article->published_at ? $article->published_at->isoFormat('D MMM Y') : '' }}</span>
              </div>

              <h2 class="font-headline text-headline-sm text-light-primary font-bold mb-3 group-hover:text-caramel transition-colors line-clamp-2">
                <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
              </h2>

              <p class="text-body-sm text-light-on-surface-variant line-clamp-3 mb-6 flex-1">
                {{ $article->excerpt }}
              </p>

              <div class="pt-4 border-t border-light-outline-variant flex items-center justify-between">
                <a href="{{ route('articles.show', $article->slug) }}" class="text-label-md font-label text-light-primary inline-flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                  <span>Baca Selengkapnya</span>
                  <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
                <span class="text-body-sm text-light-on-surface-variant/60 flex items-center gap-1">
                  <span class="material-symbols-outlined text-[16px]">menu_book</span>
                  <span>4 min</span>
                </span>
              </div>
            </div>
          </article>
        @empty
          <div class="col-span-3 text-center py-16 bg-white rounded-xl border border-light-outline-variant">
            <span class="material-symbols-outlined text-[48px] text-light-on-surface-variant mb-2">article</span>
            <p class="font-headline text-headline-sm text-light-primary font-bold">Tidak Ada Artikel Ditemukan</p>
            <p class="text-body-md text-light-on-surface-variant mt-1">Coba gunakan kata kunci pencarian yang lain.</p>
          </div>
        @endforelse
      </div>

      <!-- Pagination Links -->
      <div class="flex justify-center">
        {{ $articles->links() }}
      </div>
    </div>
  </section>
@endsection
