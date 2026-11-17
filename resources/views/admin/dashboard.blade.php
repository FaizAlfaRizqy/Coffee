@extends('layouts.admin')

@section('title', 'Ikhtisar Dashboard')
@section('header_title', 'Ikhtisar Dashboard Konten')
@section('header_subtitle', 'Ringkasan status publikasi seluruh materi website profil kedai kopi Anda.')

@section('header_actions')
  <a href="{{ route('admin.artikel.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-caramel hover:bg-[#A37046] text-white font-label text-label-sm rounded-DEFAULT transition-all shadow-sm">
    <span class="material-symbols-outlined text-[16px]">add</span>
    <span>Artikel Baru</span>
  </a>
  <a href="{{ route('admin.menu.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-light-primary hover:bg-[#291B16] text-light-on-primary font-label text-label-sm rounded-DEFAULT transition-all shadow-sm">
    <span class="material-symbols-outlined text-[16px]">restaurant_menu</span>
    <span>Menu Baru</span>
  </a>
@endsection

@section('content')
  <div class="space-y-8">
    
    <!-- Real-time Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      
      <!-- Card 1: Articles -->
      <div class="bg-white p-6 rounded-xl border border-light-outline-variant shadow-sm flex flex-col justify-between">
        <div class="flex items-center justify-between mb-4">
          <span class="text-label-sm font-label text-light-on-surface-variant uppercase tracking-wider">Artikel Terbit</span>
          <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">article</span>
          </div>
        </div>
        <div>
          <div class="flex items-baseline gap-2">
            <span class="font-headline text-display-md font-bold text-light-primary">{{ $publishedArticles }}</span>
            <span class="text-body-sm text-light-on-surface-variant">/ {{ $totalArticles }} total</span>
          </div>
          <p class="text-body-sm text-light-on-surface-variant mt-1 flex items-center gap-1">
            <span class="inline-block w-2 h-2 rounded-full bg-amber-500"></span>
            <span>{{ $draftArticles }} draf sedang disiapkan</span>
          </p>
        </div>
        <div class="mt-4 pt-3 border-t border-light-outline-variant">
          <a href="{{ route('admin.artikel.index') }}" class="text-label-sm text-caramel hover:underline font-label inline-flex items-center gap-1">
            <span>Kelola Artikel</span>
            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
          </a>
        </div>
      </div>

      <!-- Card 2: Menu Products -->
      <div class="bg-white p-6 rounded-xl border border-light-outline-variant shadow-sm flex flex-col justify-between">
        <div class="flex items-center justify-between mb-4">
          <span class="text-label-sm font-label text-light-on-surface-variant uppercase tracking-wider">Katalog Menu</span>
          <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">restaurant_menu</span>
          </div>
        </div>
        <div>
          <div class="flex items-baseline gap-2">
            <span class="font-headline text-display-md font-bold text-light-primary">{{ $availableMenuProducts }}</span>
            <span class="text-body-sm text-light-on-surface-variant">/ {{ $totalMenuProducts }} item</span>
          </div>
          <p class="text-body-sm text-light-on-surface-variant mt-1 flex items-center gap-1">
            <span class="inline-block w-2 h-2 rounded-full bg-emerald-500"></span>
            <span>Tersedia untuk pelanggan</span>
          </p>
        </div>
        <div class="mt-4 pt-3 border-t border-light-outline-variant">
          <a href="{{ route('admin.menu.index') }}" class="text-label-sm text-caramel hover:underline font-label inline-flex items-center gap-1">
            <span>Kelola Menu</span>
            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
          </a>
        </div>
      </div>

      <!-- Card 3: Gallery Photos -->
      <div class="bg-white p-6 rounded-xl border border-light-outline-variant shadow-sm flex flex-col justify-between">
        <div class="flex items-center justify-between mb-4">
          <span class="text-label-sm font-label text-light-on-surface-variant uppercase tracking-wider">Foto Galeri</span>
          <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">photo_library</span>
          </div>
        </div>
        <div>
          <div class="flex items-baseline gap-2">
            <span class="font-headline text-display-md font-bold text-light-primary">{{ $totalGalleryImages }}</span>
            <span class="text-body-sm text-light-on-surface-variant">foto di website</span>
          </div>
          <p class="text-body-sm text-light-on-surface-variant mt-1 flex items-center gap-1">
            <span class="inline-block w-2 h-2 rounded-full bg-blue-500"></span>
            <span>Resolusi optimal</span>
          </p>
        </div>
        <div class="mt-4 pt-3 border-t border-light-outline-variant">
          <a href="{{ route('admin.galeri.index') }}" class="text-label-sm text-caramel hover:underline font-label inline-flex items-center gap-1">
            <span>Kelola Galeri</span>
            <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
          </a>
        </div>
      </div>

      <!-- Card 4: Customer Messages -->
      <div class="bg-white p-6 rounded-xl border border-light-outline-variant shadow-sm flex flex-col justify-between">
        <div class="flex items-center justify-between mb-4">
          <span class="text-label-sm font-label text-light-on-surface-variant uppercase tracking-wider">Pesan Masuk</span>
          <div class="w-10 h-10 rounded-lg bg-purple-50 text-purple-700 flex items-center justify-center">
            <span class="material-symbols-outlined text-[22px]">mail</span>
          </div>
        </div>
        <div>
          <div class="flex items-baseline gap-2">
            <span class="font-headline text-display-md font-bold text-light-primary">{{ $unreadMessages }}</span>
            <span class="text-body-sm text-light-on-surface-variant">pesan baru</span>
          </div>
          <p class="text-body-sm text-light-on-surface-variant mt-1 flex items-center gap-1">
            <span class="inline-block w-2 h-2 rounded-full bg-purple-500"></span>
            <span>Dari formulir kontak website</span>
          </p>
        </div>
        <div class="mt-4 pt-3 border-t border-light-outline-variant">
          <a href="#messages-list" class="text-label-sm text-caramel hover:underline font-label inline-flex items-center gap-1">
            <span>Lihat Pesan</span>
            <span class="material-symbols-outlined text-[14px]">arrow_downward</span>
          </a>
        </div>
      </div>
    </div>

    <!-- Quick Management Action Shortcuts -->
    <div class="bg-white p-6 rounded-xl border border-light-outline-variant shadow-sm">
      <h3 class="font-headline text-headline-sm text-light-primary font-bold mb-4">
        Akses Cepat Pengelolaan Website
      </h3>
      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
        <a href="{{ route('admin.content.index') }}" class="p-4 rounded-lg bg-light-surface hover:bg-light-surface-variant transition-colors flex flex-col items-center text-center gap-2 group">
          <div class="w-12 h-12 rounded-full bg-light-primary-container text-light-primary group-hover:bg-caramel group-hover:text-white transition-colors flex items-center justify-center">
            <span class="material-symbols-outlined text-[24px]">web</span>
          </div>
          <span class="font-label text-label-sm text-light-primary font-semibold">Edit Konten Web</span>
        </a>

        <a href="{{ route('admin.artikel.create') }}" class="p-4 rounded-lg bg-light-surface hover:bg-light-surface-variant transition-colors flex flex-col items-center text-center gap-2 group">
          <div class="w-12 h-12 rounded-full bg-light-primary-container text-light-primary group-hover:bg-caramel group-hover:text-white transition-colors flex items-center justify-center">
            <span class="material-symbols-outlined text-[24px]">edit_note</span>
          </div>
          <span class="font-label text-label-sm text-light-primary font-semibold">Tulis Artikel</span>
        </a>

        <a href="{{ route('admin.menu.create') }}" class="p-4 rounded-lg bg-light-surface hover:bg-light-surface-variant transition-colors flex flex-col items-center text-center gap-2 group">
          <div class="w-12 h-12 rounded-full bg-light-primary-container text-light-primary group-hover:bg-caramel group-hover:text-white transition-colors flex items-center justify-center">
            <span class="material-symbols-outlined text-[24px]">add_circle</span>
          </div>
          <span class="font-label text-label-sm text-light-primary font-semibold">Tambah Menu</span>
        </a>

        <a href="{{ route('admin.galeri.index') }}" class="p-4 rounded-lg bg-light-surface hover:bg-light-surface-variant transition-colors flex flex-col items-center text-center gap-2 group">
          <div class="w-12 h-12 rounded-full bg-light-primary-container text-light-primary group-hover:bg-caramel group-hover:text-white transition-colors flex items-center justify-center">
            <span class="material-symbols-outlined text-[24px]">upload</span>
          </div>
          <span class="font-label text-label-sm text-light-primary font-semibold">Unggah Foto</span>
        </a>

        <a href="{{ route('admin.settings.index') }}" class="p-4 rounded-lg bg-light-surface hover:bg-light-surface-variant transition-colors flex flex-col items-center text-center gap-2 group">
          <div class="w-12 h-12 rounded-full bg-light-primary-container text-light-primary group-hover:bg-caramel group-hover:text-white transition-colors flex items-center justify-center">
            <span class="material-symbols-outlined text-[24px]">tune</span>
          </div>
          <span class="font-label text-label-sm text-light-primary font-semibold">Pengaturan Identitas</span>
        </a>
      </div>
    </div>

    <!-- Two-column Activity Showcase -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
      
      <!-- Recent Articles Table -->
      <div class="bg-white rounded-xl border border-light-outline-variant shadow-sm overflow-hidden flex flex-col">
        <div class="p-6 border-b border-light-outline-variant flex items-center justify-between">
          <h3 class="font-headline text-headline-sm text-light-primary font-bold">
            Artikel Terbaru
          </h3>
          <a href="{{ route('admin.artikel.index') }}" class="text-label-sm text-caramel hover:underline font-label">
            Lihat Semua ({{ $totalArticles }})
          </a>
        </div>
        <div class="divide-y divide-light-outline-variant overflow-x-auto">
          @forelse($recentArticles as $art)
            <div class="p-4 hover:bg-light-surface/60 transition-colors flex items-center gap-4">
              <img src="{{ $art->image_url }}" alt="" class="w-12 h-12 rounded object-cover flex-shrink-0">
              <div class="flex-1 min-w-0">
                <p class="font-label text-label-md font-semibold text-light-primary truncate">{{ $art->title }}</p>
                <div class="flex items-center gap-2 text-body-sm text-light-on-surface-variant">
                  <span>{{ $art->category->name ?? 'Umum' }}</span>
                  <span>•</span>
                  <span>{{ $art->published_at ? $art->published_at->format('d M Y') : 'Draf' }}</span>
                </div>
              </div>
              <div class="flex items-center gap-2">
                @if($art->status === 'published')
                  <span class="px-2.5 py-0.5 rounded-full text-label-sm font-label bg-emerald-50 text-light-success border border-emerald-200">
                    Terbit
                  </span>
                @else
                  <span class="px-2.5 py-0.5 rounded-full text-label-sm font-label bg-amber-50 text-light-warning border border-amber-200">
                    Draf
                  </span>
                @endif
                <a href="{{ route('admin.artikel.edit', $art) }}" class="p-1 hover:text-caramel">
                  <span class="material-symbols-outlined text-[18px]">edit</span>
                </a>
              </div>
            </div>
          @empty
            <div class="p-8 text-center text-light-on-surface-variant text-body-sm">
              Belum ada artikel.
            </div>
          @endforelse
        </div>
      </div>

      <!-- Recent Customer Messages -->
      <div id="messages-list" class="bg-white rounded-xl border border-light-outline-variant shadow-sm overflow-hidden flex flex-col">
        <div class="p-6 border-b border-light-outline-variant flex items-center justify-between">
          <h3 class="font-headline text-headline-sm text-light-primary font-bold">
            Pesan Masuk dari Pengunjung
          </h3>
          <span class="text-label-sm font-label bg-caramel/20 text-caramel px-2 py-0.5 rounded">
            Formulir Kontak
          </span>
        </div>
        <div class="divide-y divide-light-outline-variant overflow-x-auto">
          @forelse($recentMessages as $msg)
            <div class="p-4 hover:bg-light-surface/60 transition-colors space-y-1">
              <div class="flex items-center justify-between">
                <span class="font-label text-label-md font-semibold text-light-primary">{{ $msg->name }}</span>
                <span class="text-body-sm text-light-on-surface-variant">{{ $msg->created_at->diffForHumans() }}</span>
              </div>
              <p class="text-body-sm text-caramel">{{ $msg->email }} {{ $msg->phone ? '• ' . $msg->phone : '' }}</p>
              <p class="text-body-sm text-light-on-surface-variant line-clamp-2 mt-1">{{ $msg->message }}</p>
            </div>
          @empty
            <div class="p-8 text-center text-light-on-surface-variant text-body-sm">
              Belum ada pesan dari formulir kontak.
            </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
@endsection
