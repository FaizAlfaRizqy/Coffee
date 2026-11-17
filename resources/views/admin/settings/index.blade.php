@extends('layouts.admin')

@section('title', 'Pengaturan Website & Profil')
@section('header_title', 'Pengaturan Identitas & Akun')
@section('header_subtitle', 'Kelola nama brand, palet warna, logo, dan kredensial akses administrator.')

@section('content')
  <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8 max-w-4xl">
    @csrf

    <div class="flex items-center justify-between pb-4 border-b border-light-outline-variant">
      <span class="text-body-sm text-light-on-surface-variant">Pastikan menyimpan perubahan sebelum meninggalkan halaman ini.</span>
      <button type="submit" class="px-6 py-2.5 bg-light-primary hover:bg-[#291B16] text-white rounded text-label-md font-label flex items-center gap-1.5 shadow transition-all">
        <span class="material-symbols-outlined text-[18px]">save</span>
        <span>Simpan Pengaturan</span>
      </button>
    </div>

    <!-- Section 1: Brand & Site Identity -->
    <div class="bg-white p-8 rounded-xl border border-light-outline-variant shadow-sm space-y-6">
      <div class="border-b border-light-outline-variant pb-4">
        <h3 class="font-headline text-headline-sm text-light-primary font-bold">Identitas Merek Kedai Kopi</h3>
        <p class="text-body-sm text-light-on-surface-variant">Nama dan slogan yang merepresentasikan profil bisnis kopi Anda.</p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Nama Website / Kedai Kopi *
          </label>
          <input 
            type="text" 
            name="site_name" 
            value="{{ old('site_name', $allSettings['site_name'] ?? 'Coffee Shop') }}" 
            required 
            class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md font-semibold text-light-primary focus:border-light-primary outline-none">
        </div>

        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Slogan / Tagline Pendek
          </label>
          <input 
            type="text" 
            name="site_tagline" 
            value="{{ old('site_tagline', $allSettings['site_tagline'] ?? 'Artisanal Roastery') }}" 
            class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">
        </div>
      </div>

      <div>
        <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
          Deskripsi Singkat Identitas Website
        </label>
        <textarea 
          name="site_description" 
          rows="2" 
          class="w-full px-4 py-2 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none resize-none">{{ old('site_description', $allSettings['site_description'] ?? 'Cerita dan Rasa dalam Setiap Cangkir') }}</textarea>
      </div>

      <!-- Color Palette Scheme -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-light-outline-variant">
        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Warna Primer (Espresso)
          </label>
          <div class="flex items-center gap-3">
            <input 
              type="color" 
              name="primary_color" 
              value="{{ old('primary_color', $allSettings['primary_color'] ?? '#38251E') }}" 
              class="w-12 h-10 rounded border border-light-outline cursor-pointer p-0 bg-transparent">
            <input 
              type="text" 
              value="{{ old('primary_color', $allSettings['primary_color'] ?? '#38251E') }}" 
              readonly 
              class="flex-1 px-3 py-2 bg-light-surface border border-light-outline rounded font-mono text-body-sm text-light-on-surface-variant">
          </div>
          <span class="text-[11px] text-light-on-surface-variant mt-1 block">Warna dasar navbar, footer, tombol utama.</span>
        </div>

        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Warna Aksen / Sekunder (Caramel)
          </label>
          <div class="flex items-center gap-3">
            <input 
              type="color" 
              name="secondary_color" 
              value="{{ old('secondary_color', $allSettings['secondary_color'] ?? '#B98255') }}" 
              class="w-12 h-10 rounded border border-light-outline cursor-pointer p-0 bg-transparent">
            <input 
              type="text" 
              value="{{ old('secondary_color', $allSettings['secondary_color'] ?? '#B98255') }}" 
              readonly 
              class="flex-1 px-3 py-2 bg-light-surface border border-light-outline rounded font-mono text-body-sm text-light-on-surface-variant">
          </div>
          <span class="text-[11px] text-light-on-surface-variant mt-1 block">Warna aksen sorotan, tombol CTA, dan ikon.</span>
        </div>
      </div>

      <!-- Logo and Favicon Upload -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-light-outline-variant">
        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Logo Kedai Kopi
          </label>
          @if(!empty($allSettings['logo']))
            <div class="mb-2 p-2 bg-light-surface rounded border border-light-outline-variant inline-block">
              <img src="{{ $allSettings['logo'] }}" alt="Logo" class="h-10 w-auto">
            </div>
          @endif
          <input 
            type="file" 
            name="logo" 
            accept="image/*" 
            class="w-full text-body-sm text-light-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-label-sm file:font-label file:bg-light-primary-container file:text-light-primary hover:file:bg-caramel hover:file:text-white cursor-pointer">
          <span class="text-[11px] text-light-on-surface-variant mt-1 block">Format PNG atau SVG transparan direkomendasikan.</span>
        </div>

        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Favicon Browser
          </label>
          @if(!empty($allSettings['favicon']))
            <div class="mb-2 p-2 bg-light-surface rounded border border-light-outline-variant inline-block">
              <img src="{{ $allSettings['favicon'] }}" alt="Favicon" class="h-6 w-auto">
            </div>
          @endif
          <input 
            type="file" 
            name="favicon" 
            accept="image/*" 
            class="w-full text-body-sm text-light-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-label-sm file:font-label file:bg-light-primary-container file:text-light-primary hover:file:bg-caramel hover:file:text-white cursor-pointer">
        </div>
      </div>
    </div>

    <!-- Section 2: Admin Profile & Credentials -->
    <div class="bg-white p-8 rounded-xl border border-light-outline-variant shadow-sm space-y-6">
      <div class="border-b border-light-outline-variant pb-4">
        <h3 class="font-headline text-headline-sm text-light-primary font-bold">Akun Profil Administrator</h3>
        <p class="text-body-sm text-light-on-surface-variant">Data akun untuk masuk ke dashboard pengelolaan CMS ini.</p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Nama Pengguna Admin
          </label>
          <input 
            type="text" 
            name="admin_name" 
            value="{{ old('admin_name', $user->name ?? 'Admin Coffee Shop') }}" 
            class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">
        </div>

        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Alamat Email Login
          </label>
          <input 
            type="email" 
            name="user_email" 
            value="{{ old('user_email', $user->email ?? 'admin@coffeeshop.test') }}" 
            class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">
        </div>
      </div>

      <!-- Change Password -->
      <div class="pt-6 border-t border-light-outline-variant space-y-4">
        <h4 class="font-headline text-headline-sm text-light-primary font-bold">Ganti Kata Sandi (Opsional)</h4>
        <p class="text-body-sm text-light-on-surface-variant">Kosongkan jika Anda tidak ingin mengubah kata sandi.</p>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <div>
            <label class="block font-label text-label-sm text-light-primary font-medium mb-1">
              Kata Sandi Saat Ini
            </label>
            <input 
              type="password" 
              name="current_password" 
              placeholder="••••••••" 
              class="w-full px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
          </div>

          <div>
            <label class="block font-label text-label-sm text-light-primary font-medium mb-1">
              Kata Sandi Baru
            </label>
            <input 
              type="password" 
              name="new_password" 
              placeholder="Min 8 karakter" 
              class="w-full px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
          </div>

          <div>
            <label class="block font-label text-label-sm text-light-primary font-medium mb-1">
              Konfirmasi Sandi Baru
            </label>
            <input 
              type="password" 
              name="new_password_confirmation" 
              placeholder="Ulangi sandi baru" 
              class="w-full px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
          </div>
        </div>
      </div>
    </div>
  </form>
@endsection
