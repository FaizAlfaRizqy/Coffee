@extends('layouts.admin')

@section('title', 'Kelola Artikel')
@section('header_title', 'Manajemen Artikel & Edukasi')
@section('header_subtitle', 'Tulis, jadwalkan, dan kelola seluruh publikasi cerita serta wawasan kopi.')

@section('header_actions')
  <a href="{{ route('admin.artikel.create') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-light-primary hover:bg-[#291B16] text-white font-label text-label-sm rounded-DEFAULT transition-all shadow-sm">
    <span class="material-symbols-outlined text-[16px]">add</span>
    <span>Tulis Artikel Baru</span>
  </a>
@endsection

@section('content')
  <div class="space-y-6">
    
    <!-- Filter Bar -->
    <div class="bg-white p-4 rounded-xl border border-light-outline-variant shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
      
      <!-- Search Input -->
      <form action="{{ route('admin.artikel.index') }}" method="GET" class="flex-1 w-full flex items-center gap-3">
        <div class="relative flex-1">
          <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-light-on-surface-variant text-[20px]">search</span>
          <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Cari judul atau ringkasan artikel..." 
            class="w-full pl-10 pr-4 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary focus:ring-1 focus:ring-light-primary outline-none">
        </div>

        <select name="category" onchange="this.form.submit()" class="px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
          <option value="">Semua Kategori</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
          @endforeach
        </select>

        <select name="status" onchange="this.form.submit()" class="px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
          <option value="">Semua Status</option>
          <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Diterbitkan</option>
          <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draf</option>
        </select>

        <button type="submit" class="px-4 py-2 bg-caramel text-white rounded text-label-sm font-label hover:bg-[#A37046] transition-colors">
          Cari
        </button>

        @if(request()->hasAny(['search', 'category', 'status']))
          <a href="{{ route('admin.artikel.index') }}" class="p-2 text-light-on-surface-variant hover:text-light-error" title="Reset Filter">
            <span class="material-symbols-outlined text-[20px]">restart_alt</span>
          </a>
        @endif
      </form>
    </div>

    <!-- Articles Data Table -->
    <div class="bg-white rounded-xl border border-light-outline-variant shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-light-surface border-b border-light-outline-variant text-label-sm font-label text-light-primary uppercase tracking-wider">
              <th class="py-3.5 px-4">Artikel & Judul</th>
              <th class="py-3.5 px-4">Kategori</th>
              <th class="py-3.5 px-4">Status</th>
              <th class="py-3.5 px-4">Tanggal Rilis</th>
              <th class="py-3.5 px-4 text-right">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-light-outline-variant text-body-sm">
            @forelse($articles as $art)
              <tr class="hover:bg-light-surface/60 transition-colors">
                <td class="py-4 px-4 max-w-md">
                  <div class="flex items-center gap-3">
                    <img src="{{ $art->image_url }}" alt="" class="w-14 h-14 rounded object-cover flex-shrink-0">
                    <div class="min-w-0">
                      <p class="font-label text-label-md font-semibold text-light-primary line-clamp-1">{{ $art->title }}</p>
                      <p class="text-body-sm text-light-on-surface-variant line-clamp-1 mt-0.5">{{ $art->excerpt }}</p>
                      <span class="text-[11px] text-gray-400 font-mono">/artikel/{{ $art->slug }}</span>
                    </div>
                  </div>
                </td>
                <td class="py-4 px-4 text-light-on-surface-variant">
                  <span class="px-2.5 py-1 rounded-full bg-light-surface-variant text-light-primary text-[12px] font-label font-medium">
                    {{ $art->category->name ?? 'Tanpa Kategori' }}
                  </span>
                </td>
                <td class="py-4 px-4">
                  @if($art->status === 'published')
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[12px] font-label bg-emerald-50 text-light-success border border-emerald-200">
                      <span class="w-1.5 h-1.5 rounded-full bg-light-success"></span>
                      <span>Diterbitkan</span>
                    </span>
                  @else
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[12px] font-label bg-amber-50 text-light-warning border border-amber-200">
                      <span class="w-1.5 h-1.5 rounded-full bg-light-warning"></span>
                      <span>Draf</span>
                    </span>
                  @endif
                </td>
                <td class="py-4 px-4 text-light-on-surface-variant whitespace-nowrap">
                  {{ $art->published_at ? $art->published_at->format('d M Y') : '—' }}
                </td>
                <td class="py-4 px-4 text-right whitespace-nowrap">
                  <div class="inline-flex items-center gap-1">
                    @if($art->status === 'published')
                      <a href="{{ route('articles.show', $art->slug) }}" target="_blank" class="p-1.5 rounded hover:bg-light-surface-variant text-light-on-surface-variant hover:text-light-primary" title="Pratinjau Publik">
                        <span class="material-symbols-outlined text-[18px]">visibility</span>
                      </a>
                    @endif
                    <a href="{{ route('admin.artikel.edit', $art) }}" class="p-1.5 rounded hover:bg-light-surface-variant text-light-on-surface-variant hover:text-light-primary" title="Edit Artikel">
                      <span class="material-symbols-outlined text-[18px]">edit</span>
                    </a>
                    <form action="{{ route('admin.artikel.destroy', $art) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')" class="inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="p-1.5 rounded hover:bg-red-50 text-light-on-surface-variant hover:text-light-error" title="Hapus Artikel">
                        <span class="material-symbols-outlined text-[18px]">delete</span>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="py-12 text-center text-light-on-surface-variant">
                  Tidak ada artikel yang sesuai kriteria pencarian.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="p-4 border-t border-light-outline-variant bg-light-surface/40 flex justify-between items-center">
        <p class="text-body-sm text-light-on-surface-variant">
          Menampilkan {{ $articles->firstItem() ?? 0 }} - {{ $articles->lastItem() ?? 0 }} dari {{ $articles->total() }} artikel
        </p>
        <div>
          {{ $articles->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
