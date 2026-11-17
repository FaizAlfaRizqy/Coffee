@extends('layouts.admin')

@section('title', 'Tambah Produk Menu')
@section('header_title', 'Tambah Produk Menu')
@section('header_subtitle', 'Tambahkan sajian minuman atau makanan baru ke katalog website.')

@section('content')
  <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-4xl">
    @csrf

    <div class="flex items-center justify-between pb-4 border-b border-light-outline-variant">
      <a href="{{ route('admin.menu.index') }}" class="inline-flex items-center gap-2 text-label-md font-label text-light-primary hover:text-caramel">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        <span>Kembali ke Daftar Menu</span>
      </a>
      <button type="submit" class="px-5 py-2 bg-light-primary hover:bg-[#291B16] text-white rounded-DEFAULT text-label-md font-label flex items-center gap-1.5 shadow transition-all">
        <span class="material-symbols-outlined text-[18px]">save</span>
        <span>Simpan Produk Menu</span>
      </button>
    </div>

    <div class="bg-white p-8 rounded-xl border border-light-outline-variant shadow-sm space-y-6">
      
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Nama Produk Menu *
          </label>
          <input 
            type="text" 
            name="name" 
            value="{{ old('name') }}" 
            required 
            placeholder="Contoh: Sea Salt Caramel Latte" 
            class="w-full px-4 py-2.5 bg-light-surface border {{ $errors->has('name') ? 'border-red-400' : 'border-light-outline' }} rounded text-body-md focus:border-light-primary outline-none">
          @error('name')
            <p class="text-body-sm text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Kategori Menu *
          </label>
          <select name="menu_category_id" required class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">
            <option value="">Pilih Kategori</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}" {{ old('menu_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Harga Satuan (Rupiah) *
          </label>
          <div class="relative">
            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 font-title text-title-md font-semibold text-light-on-surface-variant">Rp</span>
            <input 
              type="number" 
              name="price" 
              value="{{ old('price', 35000) }}" 
              required 
              min="0" 
              step="500" 
              class="w-full pl-12 pr-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md font-title font-semibold focus:border-light-primary outline-none">
          </div>
          @error('price')
            <p class="text-body-sm text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Urutan Tampilan
          </label>
          <input 
            type="number" 
            name="sort_order" 
            value="{{ old('sort_order', 0) }}" 
            min="0" 
            class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">
        </div>
      </div>

      <div>
        <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
          Deskripsi & Profil Rasa Produk
        </label>
        <textarea 
          name="description" 
          rows="3" 
          placeholder="Jelaskan aroma, bahan baku, rasa, atau keunikan sajian ini..." 
          class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none resize-none">{{ old('description') }}</textarea>
      </div>

      <!-- Image Upload Section -->
      <div class="p-6 bg-light-surface rounded-xl border border-light-outline-variant space-y-4">
        <label class="block font-label text-label-md text-light-primary font-medium">
          Foto Produk Menu
        </label>
        
        <div>
          <span class="text-body-sm text-light-on-surface-variant block mb-1">Pilih File Foto (JPG, PNG, WebP)</span>
          <input 
            type="file" 
            name="image" 
            accept="image/*" 
            class="w-full text-body-sm text-light-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-label-sm file:font-label file:bg-light-primary-container file:text-light-primary hover:file:bg-caramel hover:file:text-white cursor-pointer">
        </div>

        <div class="relative flex py-1 items-center">
          <div class="flex-grow border-t border-light-outline"></div>
          <span class="flex-shrink mx-3 text-light-on-surface-variant text-[11px] uppercase">atau gunakan URL gambar online</span>
          <div class="flex-grow border-t border-light-outline"></div>
        </div>

        <div>
          <input 
            type="url" 
            name="image_url" 
            value="{{ old('image_url') }}" 
            placeholder="https://images.unsplash.com/..." 
            class="w-full px-3 py-2 bg-white border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
        </div>
      </div>

      <!-- Toggles & Status -->
      <div class="pt-4 border-t border-light-outline-variant flex flex-wrap items-center gap-8">
        <label class="inline-flex items-center gap-3 cursor-pointer">
          <input type="checkbox" name="is_available" value="1" {{ old('is_available', true) ? 'checked' : '' }} class="w-5 h-5 rounded border-light-outline text-light-primary focus:ring-light-primary">
          <div>
            <span class="font-label text-label-md text-light-primary font-medium block">Tersedia untuk Pelanggan</span>
            <span class="text-body-sm text-light-on-surface-variant">Tampilkan label "Tersedia" di menu publik.</span>
          </div>
        </label>

        <label class="inline-flex items-center gap-3 cursor-pointer">
          <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="w-5 h-5 rounded border-light-outline text-caramel focus:ring-caramel">
          <div>
            <span class="font-label text-label-md text-light-primary font-medium block">Menu Unggulan (Barista Pick)</span>
            <span class="text-body-sm text-light-on-surface-variant">Tampilkan di halaman Beranda (Homepage).</span>
          </div>
        </label>
      </div>

    </div>
  </form>
@endsection
