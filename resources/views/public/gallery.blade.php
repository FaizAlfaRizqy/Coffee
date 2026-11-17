@extends('layouts.public')

@section('title', 'Galeri Foto — ' . ($settings['site_name'] ?? 'Coffee Shop'))

@section('content')
  <!-- Gallery Header -->
  <section class="bg-espresso text-cream py-16 text-center">
    <div class="max-w-7xl mx-auto px-6 max-w-2xl">
      <span class="text-label-sm font-label text-caramel tracking-widest uppercase">Dokumentasi Ruang & Rasa</span>
      <h1 class="font-headline text-display-md text-white font-bold mt-2">Galeri Suasana & Aktivitas</h1>
      <p class="text-body-md text-cream/80 mt-2">
        Momen-momen otentik dari suasana kedai, dedikasi barista, hingga kehangatan interaksi bersama para penikmat kopi.
      </p>
    </div>
  </section>

  <!-- Gallery Grid & Filter -->
  <section class="py-16 bg-light-surface">
    <div class="max-w-7xl mx-auto px-6">
      
      <!-- Category Filter Tabs -->
      <div class="flex flex-wrap items-center justify-center gap-2 mb-12">
        <a href="{{ route('gallery') }}" 
           class="px-5 py-2 rounded-full font-label text-label-md transition-all {{ empty($selectedCategory) || $selectedCategory === 'all' ? 'bg-light-primary text-light-on-primary shadow-sm' : 'bg-white border border-light-outline text-light-on-surface-variant hover:border-caramel hover:text-caramel' }}">
          Semua Foto ({{ \App\Models\GalleryImage::count() }})
        </a>

        @foreach($categories as $cat)
          <a href="{{ route('gallery', ['kategori' => $cat->slug]) }}" 
             class="px-5 py-2 rounded-full font-label text-label-md transition-all {{ $selectedCategory === $cat->slug ? 'bg-light-primary text-light-on-primary shadow-sm' : 'bg-white border border-light-outline text-light-on-surface-variant hover:border-caramel hover:text-caramel' }}">
            {{ $cat->name }} ({{ $cat->images_count }})
          </a>
        @endforeach
      </div>

      <!-- Photo Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($images as $img)
          <div onclick="openLightbox('{{ $img->image_url }}', '{{ addslashes($img->title ?? '') }}', '{{ addslashes($img->description ?? '') }}')" 
               class="group relative rounded-xl overflow-hidden bg-light-surface-variant border border-light-outline-variant shadow-sm hover:shadow-lg cursor-pointer h-72">
            <img src="{{ $img->image_url }}" alt="{{ $img->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            
            <div class="absolute inset-0 bg-gradient-to-t from-espresso/80 via-espresso/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity p-5 flex flex-col justify-end text-white">
              <span class="text-label-sm text-caramel font-label mb-1">
                {{ $img->category->name ?? 'Galeri Kedai' }}
              </span>
              <h3 class="font-headline text-headline-sm font-bold text-white line-clamp-1">
                {{ $img->title }}
              </h3>
              @if($img->description)
                <p class="text-body-sm text-white/80 line-clamp-2 mt-1">
                  {{ $img->description }}
                </p>
              @endif
              <div class="mt-3 flex items-center gap-1 text-label-sm text-caramel font-label">
                <span class="material-symbols-outlined text-[16px]">zoom_in</span>
                <span>Klik untuk memperbesar</span>
              </div>
            </div>
          </div>
        @empty
          <div class="col-span-4 text-center py-16 bg-white rounded-xl border border-light-outline-variant">
            <span class="material-symbols-outlined text-[48px] text-light-on-surface-variant mb-2">photo_library</span>
            <p class="font-headline text-headline-sm text-light-primary font-bold">Belum Ada Foto di Kategori Ini</p>
            <p class="text-body-md text-light-on-surface-variant mt-1">Kelola galeri dan unggah foto baru melalui CMS.</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <!-- Lightbox Modal -->
  <div id="lightbox-modal" class="hidden fixed inset-0 z-50 bg-black/85 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="relative max-w-4xl w-full bg-[#1E1613] rounded-2xl overflow-hidden shadow-2xl border border-white/10 flex flex-col">
      <button onclick="closeLightbox()" class="absolute top-4 right-4 z-10 w-10 h-10 rounded-full bg-black/50 text-white hover:bg-black/80 flex items-center justify-center transition-colors">
        <span class="material-symbols-outlined text-[24px]">close</span>
      </button>

      <div class="max-h-[70vh] bg-black flex items-center justify-center overflow-hidden">
        <img id="lightbox-img" src="" alt="Pratinjau Foto" class="max-h-[70vh] w-auto object-contain">
      </div>

      <div class="p-6 text-cream">
        <h3 id="lightbox-title" class="font-headline text-headline-sm font-bold text-white mb-1"></h3>
        <p id="lightbox-desc" class="text-body-md text-cream/80"></p>
      </div>
    </div>
  </div>

  @push('scripts')
    <script>
      function openLightbox(url, title, desc) {
        document.getElementById('lightbox-img').src = url;
        document.getElementById('lightbox-title').innerText = title || '';
        document.getElementById('lightbox-desc').innerText = desc || '';
        document.getElementById('lightbox-modal').classList.remove('hidden');
      }

      function closeLightbox() {
        document.getElementById('lightbox-modal').classList.add('hidden');
      }

      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          closeLightbox();
        }
      });
    </script>
  @endpush
@endsection
