@extends('layouts.admin')

@section('title', 'Tulis Artikel Baru')
@section('header_title', 'Tulis Artikel Baru')
@section('header_subtitle', 'Tulis dan publikasikan wawasan seputar kopi, teknik seduh, atau berita kedai.')

@section('content')
  <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf

    <div class="flex items-center justify-between pb-4 border-b border-light-outline-variant">
      <a href="{{ route('admin.artikel.index') }}" class="inline-flex items-center gap-2 text-label-md font-label text-light-primary hover:text-caramel">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        <span>Kembali ke Daftar Artikel</span>
      </a>
      <div class="flex items-center gap-3">
        <button type="submit" name="status" value="draft" class="px-4 py-2 border border-light-outline text-light-primary bg-white hover:bg-light-surface rounded-DEFAULT text-label-md font-label flex items-center gap-1.5 transition-colors">
          <span class="material-symbols-outlined text-[18px]">save</span>
          <span>Simpan Draf</span>
        </button>
        <button type="submit" name="status" value="published" class="px-5 py-2 bg-light-primary hover:bg-[#291B16] text-white rounded-DEFAULT text-label-md font-label flex items-center gap-1.5 shadow transition-all">
          <span class="material-symbols-outlined text-[18px]">publish</span>
          <span>Terbitkan Sekarang</span>
        </button>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
      
      <!-- Main Content Area (8 Cols) -->
      <div class="lg:col-span-8 bg-white p-6 rounded-xl border border-light-outline-variant space-y-6 shadow-sm">
        
        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Judul Artikel *
          </label>
          <input 
            type="text" 
            name="title" 
            id="article-title" 
            value="{{ old('title') }}" 
            required 
            placeholder="Contoh: Mengenal Karakteristik Rasa Kopi Gayo" 
            class="w-full px-4 py-3 bg-light-surface border {{ $errors->has('title') ? 'border-red-400' : 'border-light-outline' }} rounded text-headline-sm font-headline font-bold focus:border-light-primary outline-none">
          @error('title')
            <p class="text-body-sm text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label class="block font-label text-label-sm text-light-on-surface-variant font-medium mb-1">
            Ringkasan / Excerpt Singkat *
          </label>
          <textarea 
            name="excerpt" 
            rows="3" 
            placeholder="Tuliskan 1-2 kalimat ringkasan yang menarik minat pembaca..." 
            class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none resize-none">{{ old('excerpt') }}</textarea>
          @error('excerpt')
            <p class="text-body-sm text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Rich Text Editor Section -->
        <div class="space-y-1.5">
          <label class="block font-label text-label-md text-light-primary font-medium">
            Konten Utama Artikel *
          </label>
          <div class="border border-light-outline rounded overflow-hidden">
            <!-- Toolbar Mockup -->
            <div class="bg-light-surface-variant border-b border-light-outline px-3 py-2 flex flex-wrap items-center gap-1.5 text-light-on-surface-variant text-sm">
              <button type="button" onclick="formatText('bold')" class="px-2 py-1 hover:bg-white rounded font-bold" title="Tebal">B</button>
              <button type="button" onclick="formatText('italic')" class="px-2 py-1 hover:bg-white rounded italic" title="Miring">I</button>
              <button type="button" onclick="formatText('underline')" class="px-2 py-1 hover:bg-white rounded underline" title="Garis Bawah">U</button>
              <span class="w-[1px] h-4 bg-light-outline mx-1"></span>
              <button type="button" onclick="insertHeading()" class="px-2 py-1 hover:bg-white rounded font-semibold text-xs">H2</button>
              <button type="button" onclick="insertQuote()" class="px-2 py-1 hover:bg-white rounded text-xs">Kutipan</button>
            </div>
            <textarea 
              name="content" 
              id="article-content" 
              rows="14" 
              required 
              placeholder="Tuliskan isi artikel lengkap di sini. Gunakan baris baru antar paragraf..." 
              class="w-full p-4 bg-white text-body-md text-light-on-surface outline-none resize-y leading-relaxed">{{ old('content') }}</textarea>
          </div>
          @error('content')
            <p class="text-body-sm text-red-600 mt-1">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <!-- Meta & Settings Column (4 Cols) -->
      <div class="lg:col-span-4 space-y-6">
        
        <!-- Status & Category Box -->
        <div class="bg-white p-6 rounded-xl border border-light-outline-variant space-y-5 shadow-sm">
          <h3 class="font-headline text-headline-sm text-light-primary font-bold">Pengaturan Publikasi</h3>

          <div>
            <label class="block font-label text-label-sm text-light-primary font-medium mb-1">
              Kategori Artikel *
            </label>
            <select name="article_category_id" class="w-full px-3 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">
              <option value="">Pilih Kategori</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('article_category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label class="block font-label text-label-sm text-light-primary font-medium mb-1">
              Jadwal / Tanggal Publikasi
            </label>
            <input 
              type="datetime-local" 
              name="published_at" 
              value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}" 
              class="w-full px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
            <span class="text-[11px] text-light-on-surface-variant mt-1 block">Biarkan kosong atau isi waktu sekarang untuk langsung terbit.</span>
          </div>
        </div>

        <!-- Featured Image Upload Box -->
        <div class="bg-white p-6 rounded-xl border border-light-outline-variant space-y-4 shadow-sm">
          <h3 class="font-headline text-headline-sm text-light-primary font-bold">Foto Sampul (Featured Image)</h3>
          
          <div>
            <label class="block font-label text-label-sm text-light-on-surface-variant font-medium mb-1.5">
              Unggah File Gambar (JPG, PNG, WebP)
            </label>
            <input 
              type="file" 
              name="featured_image" 
              accept="image/*" 
              class="w-full text-body-sm text-light-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-label-sm file:font-label file:bg-light-primary-container file:text-light-primary hover:file:bg-caramel hover:file:text-white cursor-pointer">
          </div>

          <div class="relative flex py-1 items-center">
            <div class="flex-grow border-t border-light-outline"></div>
            <span class="flex-shrink mx-3 text-light-on-surface-variant text-[11px] uppercase">atau gunakan URL gambar</span>
            <div class="flex-grow border-t border-light-outline"></div>
          </div>

          <div>
            <label class="block font-label text-label-sm text-light-on-surface-variant font-medium mb-1">
              URL Gambar Eksternal
            </label>
            <input 
              type="url" 
              name="image_url" 
              value="{{ old('image_url') }}" 
              placeholder="https://images.unsplash.com/..." 
              class="w-full px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
          </div>
        </div>

      </div>
    </div>
  </form>

  @push('scripts')
    <script>
      function insertHeading() {
        const textarea = document.getElementById('article-content');
        textarea.value += "\n\n## Subjudul Artikel Baru\n";
        textarea.focus();
      }
      function insertQuote() {
        const textarea = document.getElementById('article-content');
        textarea.value += "\n\n> Kutipan menarik dari pembicara atau catatan penting...\n\n";
        textarea.focus();
      }
      function formatText(style) {
        const textarea = document.getElementById('article-content');
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const selected = textarea.value.substring(start, end);
        if (selected) {
          let wrap = style === 'bold' ? '**' : (style === 'italic' ? '*' : '_');
          textarea.value = textarea.value.substring(0, start) + wrap + selected + wrap + textarea.value.substring(end);
        }
        textarea.focus();
      }
    </script>
  @endpush
@endsection
