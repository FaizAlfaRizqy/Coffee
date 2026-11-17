@extends('layouts.admin')

@section('title', 'Kelola Menu')
@section('header_title', 'Katalog Menu & Racikan')
@section('header_subtitle', 'Kelola daftar produk sajian, ketersediaan harian, harga, dan produk unggulan.')

@section('header_actions')
  <a href="{{ route('admin.menu.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-light-primary hover:bg-[#291B16] text-white font-label text-label-sm rounded-DEFAULT transition-all shadow-sm">
    <span class="material-symbols-outlined text-[16px]">add</span>
    <span>Tambah Produk Menu</span>
  </a>
@endsection

@section('content')
  <div class="space-y-6">
    
    <!-- Filter Bar -->
    <div class="bg-white p-4 rounded-xl border border-light-outline-variant shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
      <form action="{{ route('admin.menu.index') }}" method="GET" class="flex-1 w-full flex flex-wrap items-center gap-3">
        
        <div class="relative flex-1 min-w-[200px]">
          <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-light-on-surface-variant text-[20px]">search</span>
          <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Cari nama menu atau deskripsi..." 
            class="w-full pl-10 pr-4 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary focus:ring-1 focus:ring-light-primary outline-none">
        </div>

        <select name="category" onchange="this.form.submit()" class="px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
          <option value="">Semua Kategori</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
          @endforeach
        </select>

        <select name="availability" onchange="this.form.submit()" class="px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
          <option value="">Status Stok</option>
          <option value="1" {{ request('availability') === '1' ? 'selected' : '' }}>Tersedia</option>
          <option value="0" {{ request('availability') === '0' ? 'selected' : '' }}>Habis</option>
        </select>

        <button type="submit" class="px-4 py-2 bg-caramel text-white rounded text-label-sm font-label hover:bg-[#A37046] transition-colors">
          Cari
        </button>

        @if(request()->hasAny(['search', 'category', 'availability']))
          <a href="{{ route('admin.menu.index') }}" class="p-2 text-light-on-surface-variant hover:text-light-error" title="Reset Filter">
            <span class="material-symbols-outlined text-[20px]">restart_alt</span>
          </a>
        @endif
      </form>
    </div>

    <!-- Products Data Table -->
    <div class="bg-white rounded-xl border border-light-outline-variant shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-light-surface border-b border-light-outline-variant text-label-sm font-label text-light-primary uppercase tracking-wider">
              <th class="py-3.5 px-4">Produk Menu</th>
              <th class="py-3.5 px-4">Kategori</th>
              <th class="py-3.5 px-4">Harga (IDR)</th>
              <th class="py-3.5 px-4 text-center">Status Stok</th>
              <th class="py-3.5 px-4 text-center">Unggulan</th>
              <th class="py-3.5 px-4 text-right">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-light-outline-variant text-body-sm">
            @forelse($products as $p)
              <tr class="hover:bg-light-surface/60 transition-colors">
                <td class="py-4 px-4 max-w-sm">
                  <div class="flex items-center gap-3">
                    <img src="{{ $p->image_url }}" alt="" class="w-12 h-12 rounded object-cover flex-shrink-0">
                    <div class="min-w-0">
                      <p class="font-label text-label-md font-semibold text-light-primary truncate">{{ $p->name }}</p>
                      <p class="text-body-sm text-light-on-surface-variant line-clamp-1">{{ $p->description }}</p>
                    </div>
                  </div>
                </td>
                <td class="py-4 px-4 text-light-on-surface-variant">
                  <span class="px-2.5 py-1 rounded bg-light-surface-variant text-light-primary text-[12px] font-label font-medium">
                    {{ $p->category->name ?? 'Menu' }}
                  </span>
                </td>
                <td class="py-4 px-4 font-title text-title-md font-semibold text-light-primary tabular-nums">
                  {{ $p->formatted_price }}
                </td>
                <td class="py-4 px-4 text-center">
                  <form action="{{ route('admin.menu.toggle-availability', $p) }}" method="POST" class="inline">
                    @csrf
                    @if($p->is_available)
                      <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-label-sm font-label bg-emerald-50 text-light-success border border-emerald-200 hover:bg-emerald-100 transition-colors" title="Klik untuk ubah status">
                        <span class="w-2 h-2 rounded-full bg-light-success"></span>
                        <span>Tersedia</span>
                      </button>
                    @else
                      <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-label-sm font-label bg-red-50 text-light-error border border-red-200 hover:bg-red-100 transition-colors" title="Klik untuk ubah status">
                        <span class="w-2 h-2 rounded-full bg-light-error"></span>
                        <span>Habis</span>
                      </button>
                    @endif
                  </form>
                </td>
                <td class="py-4 px-4 text-center">
                  <form action="{{ route('admin.menu.toggle-featured', $p) }}" method="POST" class="inline">
                    @csrf
                    @if($p->is_featured)
                      <button type="submit" class="p-1 text-caramel hover:text-caramel/70 transition-colors" title="Produk Unggulan (Klik untuk hapus)">
                        <span class="material-symbols-outlined text-[22px]" style="font-variation-settings: 'FILL' 1;">star</span>
                      </button>
                    @else
                      <button type="submit" class="p-1 text-gray-300 hover:text-caramel transition-colors" title="Jadikan Unggulan">
                        <span class="material-symbols-outlined text-[22px]">star</span>
                      </button>
                    @endif
                  </form>
                </td>
                <td class="py-4 px-4 text-right whitespace-nowrap">
                  <div class="inline-flex items-center gap-1">
                    <a href="{{ route('admin.menu.edit', $p) }}" class="p-1.5 rounded hover:bg-light-surface-variant text-light-on-surface-variant hover:text-light-primary" title="Edit Produk">
                      <span class="material-symbols-outlined text-[18px]">edit</span>
                    </a>
                    <form action="{{ route('admin.menu.destroy', $p) }}" method="POST" onsubmit="return confirm('Hapus produk {{ $p->name }}?')" class="inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="p-1.5 rounded hover:bg-red-50 text-light-on-surface-variant hover:text-light-error" title="Hapus Produk">
                        <span class="material-symbols-outlined text-[18px]">delete</span>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="py-12 text-center text-light-on-surface-variant">
                  Tidak ada produk menu yang sesuai.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="p-4 border-t border-light-outline-variant bg-light-surface/40 flex justify-between items-center">
        <p class="text-body-sm text-light-on-surface-variant">
          Menampilkan {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} produk
        </p>
        <div>
          {{ $products->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
