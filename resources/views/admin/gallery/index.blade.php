@extends('layouts.admin')

@section('title', 'Kelola Galeri Foto')
@section('header_title', 'Manajemen Galeri Visual')
@section('header_subtitle', 'Unggah dan kurasi dokumentasi suasana kedai, profil produk, dan aktivitas roastery.')

@section('content')
  <div class="space-y-8">
    
    <!-- Upload New Image Box -->
    <div class="bg-white p-6 sm:p-8 rounded-xl border border-light-outline-variant shadow-sm space-y-6">
      <div class="flex items-center gap-2 pb-4 border-b border-light-outline-variant">
        <span class="material-symbols-outlined text-caramel text-[24px]">cloud_upload</span>
        <h3 class="font-headline text-headline-sm text-light-primary font-bold">Unggah Foto Baru ke Galeri</h3>
      </div>

      <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
            <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
              Judul / Keterangan Foto Singkat
            </label>
            <input 
              type="text" 
              name="title" 
              placeholder="Contoh: Sudut Meja Kayu & Tanaman" 
              class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">
          </div>

          <div>
            <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
              Kategori Galeri
            </label>
            <select name="gallery_category_id" class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">
              <option value="">Pilih Kategori Galeri</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Deskripsi Detail Foto (Opsional)
          </label>
          <input 
            type="text" 
            name="description" 
            placeholder="Jelaskan momen atau suasana yang terekam dalam foto ini..." 
            class="w-full px-4 py-2 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 p-5 bg-light-surface rounded-xl border border-light-outline-variant">
          <div>
            <label class="block font-label text-label-sm text-light-primary font-medium mb-1.5">
              Pilih Berkas Foto (Dapat Lebih dari Satu)
            </label>
            <input 
              type="file" 
              name="images[]" 
              multiple 
              accept="image/*" 
              class="w-full text-body-sm text-light-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-label-sm file:font-label file:bg-light-primary-container file:text-light-primary hover:file:bg-caramel hover:file:text-white cursor-pointer">
          </div>

          <div>
            <label class="block font-label text-label-sm text-light-primary font-medium mb-1.5">
              Atau Masukkan URL Foto Online
            </label>
            <input 
              type="url" 
              name="image_url" 
              placeholder="https://images.unsplash.com/..." 
              class="w-full px-3 py-2 bg-white border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
          </div>
        </div>

        <div class="flex justify-end">
          <button type="submit" class="px-6 py-2.5 bg-light-primary hover:bg-[#291B16] text-white rounded text-label-md font-label flex items-center gap-2 shadow transition-all">
            <span class="material-symbols-outlined text-[18px]">add_photo_alternate</span>
            <span>Unggah ke Galeri</span>
          </button>
        </div>
      </form>
    </div>

    <!-- Gallery Grid & Category Filters -->
    <div class="bg-white p-6 rounded-xl border border-light-outline-variant shadow-sm space-y-6">
      <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <div>
          <h3 class="font-headline text-headline-sm text-light-primary font-bold">Koleksi Foto Galeri</h3>
          <p class="text-body-sm text-light-on-surface-variant">Total {{ $images->total() }} foto tersimpan di database.</p>
        </div>

        <!-- Filter Dropdown -->
        <form action="{{ route('admin.galeri.index') }}" method="GET" class="flex items-center gap-2">
          <select name="category" onchange="this.form.submit()" class="px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
          </select>
          @if(request('category'))
            <a href="{{ route('admin.galeri.index') }}" class="p-2 text-light-on-surface-variant hover:text-light-error">
              <span class="material-symbols-outlined text-[18px]">close</span>
            </a>
          @endif
        </form>
      </div>

      <!-- Photo Cards Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($images as $img)
          <div class="bg-light-surface rounded-xl border border-light-outline-variant overflow-hidden flex flex-col group shadow-sm">
            <div class="h-44 bg-light-surface-variant overflow-hidden relative">
              <img src="{{ $img->image_url }}" alt="{{ $img->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
              <span class="absolute top-2 left-2 bg-espresso/80 text-white text-[11px] font-label px-2 py-0.5 rounded backdrop-blur">
                {{ $img->category->name ?? 'Galeri' }}
              </span>
            </div>

            <div class="p-4 flex-1 flex flex-col justify-between">
              <div>
                <p class="font-label text-label-md font-semibold text-light-primary line-clamp-1">{{ $img->title }}</p>
                @if($img->description)
                  <p class="text-body-sm text-light-on-surface-variant line-clamp-2 mt-1">{{ $img->description }}</p>
                @endif
              </div>

              <div class="pt-3 border-t border-light-outline flex items-center justify-between mt-3">
                <span class="text-[11px] text-light-on-surface-variant">{{ $img->created_at->format('d/m/Y') }}</span>
                <form action="{{ route('admin.galeri.destroy', $img) }}" method="POST" onsubmit="return confirm('Hapus foto ini dari galeri?')" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="p-1 text-light-on-surface-variant hover:text-light-error transition-colors" title="Hapus Foto">
                    <span class="material-symbols-outlined text-[18px]">delete</span>
                  </button>
                </form>
              </div>
            </div>
          </div>
        @empty
          <div class="col-span-4 text-center py-16 text-light-on-surface-variant">
            Belum ada foto yang diunggah ke galeri.
          </div>
        @endforelse
      </div>

      <div class="pt-4 border-t border-light-outline-variant">
        {{ $images->links() }}
      </div>
    </div>
  </div>
@endsection
