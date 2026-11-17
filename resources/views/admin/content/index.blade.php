@extends('layouts.admin')

@section('title', 'Kelola Konten Website')
@section('header_title', 'Konten Halaman Publik')
@section('header_subtitle', 'Sesuaikan teks utama beranda, kisah brand, kontak, dan informasi footer tanpa coding.')

@section('header_actions')
  <button type="submit" form="content-form" class="inline-flex items-center gap-1.5 px-5 py-2 bg-light-primary hover:bg-[#291B16] text-white font-label text-label-sm rounded-DEFAULT transition-all shadow-sm">
    <span class="material-symbols-outlined text-[16px]">save</span>
    <span>Simpan Seluruh Konten</span>
  </button>
@endsection

@section('content')
  <form id="content-form" action="{{ route('admin.content.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8 max-w-5xl">
    @csrf

    <!-- Section Navigation Tabs -->
    <div class="flex flex-wrap items-center gap-2 border-b border-light-outline-variant pb-3">
      <button type="button" onclick="switchSection('sec-homepage', this)" class="content-tab-btn px-4 py-2 rounded-DEFAULT font-label text-label-md bg-light-primary text-light-on-primary shadow-sm flex items-center gap-1.5 transition-all">
        <span class="material-symbols-outlined text-[18px]">home</span>
        <span>Halaman Beranda</span>
      </button>

      <button type="button" onclick="switchSection('sec-about', this)" class="content-tab-btn px-4 py-2 rounded-DEFAULT font-label text-label-md bg-white border border-light-outline text-light-on-surface-variant hover:bg-light-surface flex items-center gap-1.5 transition-all">
        <span class="material-symbols-outlined text-[18px]">info</span>
        <span>Tentang Kami & Misi</span>
      </button>

      <button type="button" onclick="switchSection('sec-contact', this)" class="content-tab-btn px-4 py-2 rounded-DEFAULT font-label text-label-md bg-white border border-light-outline text-light-on-surface-variant hover:bg-light-surface flex items-center gap-1.5 transition-all">
        <span class="material-symbols-outlined text-[18px]">contact_mail</span>
        <span>Kontak & Jam Buka</span>
      </button>

      <button type="button" onclick="switchSection('sec-social', this)" class="content-tab-btn px-4 py-2 rounded-DEFAULT font-label text-label-md bg-white border border-light-outline text-light-on-surface-variant hover:bg-light-surface flex items-center gap-1.5 transition-all">
        <span class="material-symbols-outlined text-[18px]">share</span>
        <span>Media Sosial</span>
      </button>

      <button type="button" onclick="switchSection('sec-footer', this)" class="content-tab-btn px-4 py-2 rounded-DEFAULT font-label text-label-md bg-white border border-light-outline text-light-on-surface-variant hover:bg-light-surface flex items-center gap-1.5 transition-all">
        <span class="material-symbols-outlined text-[18px]">dock</span>
        <span>Footer & Hak Cipta</span>
      </button>
    </div>

    <!-- TAB 1: HOMEPAGE CONTENT -->
    <div id="sec-homepage" class="content-section space-y-6">
      <div class="bg-white p-8 rounded-xl border border-light-outline-variant shadow-sm space-y-6">
        <div class="border-b border-light-outline-variant pb-4">
          <h3 class="font-headline text-headline-sm text-light-primary font-bold">Hero Banner (Halaman Utama)</h3>
          <p class="text-body-sm text-light-on-surface-variant">Teks dan gambar utama yang pertama kali dilihat oleh pengunjung website.</p>
        </div>

        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Headline Utama (Judul Besar Hero) *
          </label>
          <input 
            type="text" 
            name="homepage[hero_headline]" 
            value="{{ $contents['homepage']['hero_headline'] ?? 'Cerita dan Rasa dalam Setiap Cangkir' }}" 
            class="w-full px-4 py-3 bg-light-surface border border-light-outline rounded text-headline-sm font-headline font-bold focus:border-light-primary outline-none">
        </div>

        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Deskripsi / Subtitle Hero *
          </label>
          <textarea 
            name="homepage[hero_description]" 
            rows="3" 
            class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none resize-none">{{ $contents['homepage']['hero_description'] ?? '' }}</textarea>
        </div>

        <!-- Hero Background Image -->
        <div class="p-6 bg-light-surface rounded-xl border border-light-outline-variant space-y-4">
          <label class="block font-label text-label-md text-light-primary font-medium">
            Foto Latar Belakang Hero
          </label>
          @if(!empty($contents['homepage']['hero_image']))
            <div class="h-44 rounded-lg overflow-hidden border border-light-outline-variant bg-espresso">
              <img src="{{ $contents['homepage']['hero_image'] }}" alt="Hero Preview" class="w-full h-full object-cover opacity-70">
            </div>
          @endif

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <span class="text-body-sm text-light-on-surface-variant block mb-1">Unggah Foto Baru</span>
              <input 
                type="file" 
                name="homepage[hero_image_file]" 
                accept="image/*" 
                class="w-full text-body-sm text-light-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-label-sm file:font-label file:bg-light-primary-container file:text-light-primary hover:file:bg-caramel hover:file:text-white cursor-pointer">
            </div>
            <div>
              <span class="text-body-sm text-light-on-surface-variant block mb-1">Atau Gunakan URL Gambar</span>
              <input 
                type="url" 
                name="homepage[hero_image]" 
                value="{{ $contents['homepage']['hero_image'] ?? '' }}" 
                placeholder="https://..." 
                class="w-full px-3 py-2 bg-white border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
            </div>
          </div>
        </div>

        <!-- CTA Buttons -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-light-outline-variant">
          <div>
            <label class="block font-label text-label-sm text-light-primary font-medium mb-1">
              Teks Tombol Aksi Utama (CTA 1)
            </label>
            <input 
              type="text" 
              name="homepage[hero_cta_text]" 
              value="{{ $contents['homepage']['hero_cta_text'] ?? 'Jelajahi Menu Kami' }}" 
              class="w-full px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
          </div>
          <div>
            <label class="block font-label text-label-sm text-light-primary font-medium mb-1">
              Tautan Tujuan Tombol Utama (CTA 1 URL)
            </label>
            <input 
              type="text" 
              name="homepage[hero_cta_url]" 
              value="{{ $contents['homepage']['hero_cta_url'] ?? '/menu' }}" 
              class="w-full px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
          </div>

          <div>
            <label class="block font-label text-label-sm text-light-primary font-medium mb-1">
              Teks Tombol Sekunder (CTA 2)
            </label>
            <input 
              type="text" 
              name="homepage[hero_cta_secondary_text]" 
              value="{{ $contents['homepage']['hero_cta_secondary_text'] ?? 'Pelajari Kisah Kami' }}" 
              class="w-full px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
          </div>
          <div>
            <label class="block font-label text-label-sm text-light-primary font-medium mb-1">
              Tautan Tujuan Tombol Sekunder (CTA 2 URL)
            </label>
            <input 
              type="text" 
              name="homepage[hero_cta_secondary_url]" 
              value="{{ $contents['homepage']['hero_cta_secondary_url'] ?? '/tentang' }}" 
              class="w-full px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
          </div>
        </div>

        <!-- About Intro on Homepage -->
        <div class="pt-6 border-t border-light-outline-variant space-y-4">
          <h4 class="font-headline text-headline-sm text-light-primary font-bold">Bagian Filosofi di Beranda</h4>
          
          <div>
            <label class="block font-label text-label-sm text-light-primary font-medium mb-1">
              Judul Seksi Filosofi
            </label>
            <input 
              type="text" 
              name="homepage[about_headline]" 
              value="{{ $contents['homepage']['about_headline'] ?? '' }}" 
              class="w-full px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
          </div>

          <div>
            <label class="block font-label text-label-sm text-light-primary font-medium mb-1">
              Paragraf Pengantar
            </label>
            <textarea 
              name="homepage[about_intro]" 
              rows="3" 
              class="w-full px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none resize-none">{{ $contents['homepage']['about_intro'] ?? '' }}</textarea>
          </div>
        </div>
      </div>
    </div>

    <!-- TAB 2: ABOUT US CONTENT -->
    <div id="sec-about" class="content-section hidden space-y-6">
      <div class="bg-white p-8 rounded-xl border border-light-outline-variant shadow-sm space-y-6">
        <div class="border-b border-light-outline-variant pb-4">
          <h3 class="font-headline text-headline-sm text-light-primary font-bold">Halaman Tentang Kami (Brand Story & Visi)</h3>
          <p class="text-body-sm text-light-on-surface-variant">Narasi perjalanan, nilai filosofi, dan komitmen kedai terhadap kopi lokal.</p>
        </div>

        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Judul Kisah Awal
          </label>
          <input 
            type="text" 
            name="about[intro_title]" 
            value="{{ $contents['about']['intro_title'] ?? '' }}" 
            class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">
        </div>

        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Kisah Perjalanan Brand (Paragraf 1)
          </label>
          <textarea 
            name="about[intro_text]" 
            rows="4" 
            class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">{{ $contents['about']['intro_text'] ?? '' }}</textarea>
        </div>

        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Kisah Dedikasi Petani & Sangrai (Paragraf 2)
          </label>
          <textarea 
            name="about[brand_story_text]" 
            rows="4" 
            class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">{{ $contents['about']['brand_story_text'] ?? '' }}</textarea>
        </div>

        <!-- Vision and Missions -->
        <div class="pt-6 border-t border-light-outline-variant space-y-5">
          <h4 class="font-headline text-headline-sm text-light-primary font-bold">Visi & Misi Bisnis</h4>
          
          <div>
            <label class="block font-label text-label-sm text-light-primary font-medium mb-1">
              Pernyataan Visi Kami
            </label>
            <textarea 
              name="about[vision]" 
              rows="2" 
              class="w-full px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">{{ $contents['about']['vision'] ?? '' }}</textarea>
          </div>

          <div class="space-y-3">
            <label class="block font-label text-label-sm text-light-primary font-medium">
              Tiga Pilar Misi Kami
            </label>
            <input 
              type="text" 
              name="about[mission_1]" 
              value="{{ $contents['about']['mission_1'] ?? '' }}" 
              placeholder="Misi 1..." 
              class="w-full px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
            <input 
              type="text" 
              name="about[mission_2]" 
              value="{{ $contents['about']['mission_2'] ?? '' }}" 
              placeholder="Misi 2..." 
              class="w-full px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
            <input 
              type="text" 
              name="about[mission_3]" 
              value="{{ $contents['about']['mission_3'] ?? '' }}" 
              placeholder="Misi 3..." 
              class="w-full px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
          </div>
        </div>

        <!-- Atmosphere Section -->
        <div class="pt-6 border-t border-light-outline-variant space-y-4">
          <h4 class="font-headline text-headline-sm text-light-primary font-bold">Filosofi Desain & Suasana Ruang</h4>
          <div>
            <label class="block font-label text-label-sm text-light-primary font-medium mb-1">
              Judul Seksi Suasana
            </label>
            <input 
              type="text" 
              name="about[atmosphere_title]" 
              value="{{ $contents['about']['atmosphere_title'] ?? '' }}" 
              class="w-full px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
          </div>
          <div>
            <label class="block font-label text-label-sm text-light-primary font-medium mb-1">
              Deskripsi Suasana Kedai
            </label>
            <textarea 
              name="about[atmosphere_text]" 
              rows="3" 
              class="w-full px-3 py-2 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">{{ $contents['about']['atmosphere_text'] ?? '' }}</textarea>
          </div>
        </div>
      </div>
    </div>

    <!-- TAB 3: CONTACT & HOURS -->
    <div id="sec-contact" class="content-section hidden space-y-6">
      <div class="bg-white p-8 rounded-xl border border-light-outline-variant shadow-sm space-y-6">
        <div class="border-b border-light-outline-variant pb-4">
          <h3 class="font-headline text-headline-sm text-light-primary font-bold">Informasi Kontak & Jam Kedai</h3>
          <p class="text-body-sm text-light-on-surface-variant">Data kontak ini ditampilkan di halaman Kontak, Beranda, dan Footer.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
            <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
              Alamat Lengkap Kedai *
            </label>
            <input 
              type="text" 
              name="contact[address]" 
              value="{{ $contents['contact']['address'] ?? '' }}" 
              class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">
          </div>

          <div>
            <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
              Nomor Telepon / WhatsApp
            </label>
            <input 
              type="text" 
              name="contact[phone]" 
              value="{{ $contents['contact']['phone'] ?? '' }}" 
              class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">
          </div>

          <div>
            <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
              Alamat Email Publik
            </label>
            <input 
              type="email" 
              name="contact[email]" 
              value="{{ $contents['contact']['email'] ?? '' }}" 
              class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">
          </div>

          <div>
            <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
              Jam Operasional (Senin – Jumat)
            </label>
            <input 
              type="text" 
              name="contact[opening_hours_weekday]" 
              value="{{ $contents['contact']['opening_hours_weekday'] ?? '07.00 – 22.00 WIB' }}" 
              class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">
          </div>

          <div>
            <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
              Jam Operasional (Sabtu – Minggu)
            </label>
            <input 
              type="text" 
              name="contact[opening_hours_weekend]" 
              value="{{ $contents['contact']['opening_hours_weekend'] ?? '08.00 – 23.00 WIB' }}" 
              class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">
          </div>
        </div>

        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Embed URL Peta Google Maps (Iframe SRC)
          </label>
          <input 
            type="text" 
            name="contact[map_embed]" 
            value="{{ $contents['contact']['map_embed'] ?? '' }}" 
            placeholder="https://www.google.com/maps/embed?pb=..." 
            class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-sm focus:border-light-primary outline-none">
          <span class="text-[11px] text-light-on-surface-variant mt-1 block">Salin link dari menu 'Sematkan Peta' di Google Maps.</span>
        </div>
      </div>
    </div>

    <!-- TAB 4: SOCIAL MEDIA -->
    <div id="sec-social" class="content-section hidden space-y-6">
      <div class="bg-white p-8 rounded-xl border border-light-outline-variant shadow-sm space-y-6">
        <div class="border-b border-light-outline-variant pb-4">
          <h3 class="font-headline text-headline-sm text-light-primary font-bold">Akun Media Sosial Kedai</h3>
          <p class="text-body-sm text-light-on-surface-variant">Tautan profil media sosial yang terhubung pada ikon footer dan kontak.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div>
            <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
              URL Profil Instagram
            </label>
            <input 
              type="url" 
              name="social[instagram]" 
              value="{{ $contents['social']['instagram'] ?? '' }}" 
              placeholder="https://instagram.com/..." 
              class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">
          </div>

          <div>
            <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
              URL Halaman Facebook
            </label>
            <input 
              type="url" 
              name="social[facebook]" 
              value="{{ $contents['social']['facebook'] ?? '' }}" 
              placeholder="https://facebook.com/..." 
              class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">
          </div>

          <div>
            <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
              URL Akun TikTok
            </label>
            <input 
              type="url" 
              name="social[tiktok]" 
              value="{{ $contents['social']['tiktok'] ?? '' }}" 
              placeholder="https://tiktok.com/@..." 
              class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">
          </div>

          <div>
            <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
              URL Channel YouTube
            </label>
            <input 
              type="url" 
              name="social[youtube]" 
              value="{{ $contents['social']['youtube'] ?? '' }}" 
              placeholder="https://youtube.com/@..." 
              class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">
          </div>
        </div>
      </div>
    </div>

    <!-- TAB 5: FOOTER & COPYRIGHT -->
    <div id="sec-footer" class="content-section hidden space-y-6">
      <div class="bg-white p-8 rounded-xl border border-light-outline-variant shadow-sm space-y-6">
        <div class="border-b border-light-outline-variant pb-4">
          <h3 class="font-headline text-headline-sm text-light-primary font-bold">Informasi Footer & Hak Cipta</h3>
          <p class="text-body-sm text-light-on-surface-variant">Deskripsi ringkas profil brand dan teks legal pada bagian paling bawah website.</p>
        </div>

        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Deskripsi Profil di Footer
          </label>
          <textarea 
            name="footer[description]" 
            rows="3" 
            class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none resize-none">{{ $contents['footer']['description'] ?? '' }}</textarea>
        </div>

        <div>
          <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
            Teks Hak Cipta (Copyright Notice)
          </label>
          <input 
            type="text" 
            name="footer[copyright]" 
            value="{{ $contents['footer']['copyright'] ?? '© 2026 Coffee Shop Artisanal Roastery. Seluruh hak cipta dilindungi.' }}" 
            class="w-full px-4 py-2.5 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary outline-none">
        </div>
      </div>
    </div>

  </form>

  @push('scripts')
    <script>
      function switchSection(sectionId, btn) {
        document.querySelectorAll('.content-section').forEach(el => el.classList.add('hidden'));
        document.getElementById(sectionId).classList.remove('hidden');

        document.querySelectorAll('.content-tab-btn').forEach(b => {
          b.classList.remove('bg-light-primary', 'text-light-on-primary', 'shadow-sm');
          b.classList.add('bg-white', 'text-light-on-surface-variant');
        });
        btn.classList.remove('bg-white', 'text-light-on-surface-variant');
        btn.classList.add('bg-light-primary', 'text-light-on-primary', 'shadow-sm');
      }
    </script>
  @endpush
@endsection
