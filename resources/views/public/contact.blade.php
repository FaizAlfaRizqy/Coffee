@extends('layouts.public')

@section('title', 'Kontak & Lokasi — ' . ($settings['site_name'] ?? 'Coffee Shop'))

@section('content')
  <!-- Contact Header -->
  <section class="bg-espresso text-cream py-16 text-center">
    <div class="max-w-7xl mx-auto px-6 max-w-2xl">
      <span class="text-label-sm font-label text-caramel tracking-widest uppercase">Hubungi Kami</span>
      <h1 class="font-headline text-display-md text-white font-bold mt-2">Terhubung Bersama Kami</h1>
      <p class="text-body-md text-cream/80 mt-2">
        Punya pertanyaan seputar biji kopi spesialti, reservasi ruang, atau peluang kolaborasi? Kami senang mendengar dari Anda.
      </p>
    </div>
  </section>

  <!-- Contact Form & Info Section -->
  <section class="py-16 bg-light-surface">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12">
      
      <!-- Left Column: Contact Info Cards -->
      <div class="lg:col-span-5 space-y-6">
        <div>
          <span class="text-label-sm font-label text-caramel tracking-widest uppercase">Informasi Kedai</span>
          <h2 class="font-headline text-headline-md text-light-primary font-bold mt-1">Kunjungi Bar Kopi Kami</h2>
          <p class="text-body-md text-light-on-surface-variant mt-2 leading-relaxed">
            Nikmati aroma sangrai segar dan seduhan langsung dari barista kami setiap hari di lokasi berikut:
          </p>
        </div>

        <div class="space-y-4">
          <!-- Address -->
          <div class="p-5 bg-white rounded-xl border border-light-outline-variant shadow-sm flex items-start gap-4">
            <div class="w-12 h-12 rounded-lg bg-light-primary-container text-light-primary flex items-center justify-center flex-shrink-0">
              <span class="material-symbols-outlined text-[24px]">location_on</span>
            </div>
            <div>
              <p class="font-label text-label-md text-light-primary font-semibold">Alamat Kedai</p>
              <p class="text-body-md text-light-on-surface-variant mt-0.5">
                {{ $contents['contact']['address'] ?? 'Jl. Senopati No. 45, Kebayoran Baru, Jakarta Selatan 12190' }}
              </p>
            </div>
          </div>

          <!-- Hours -->
          <div class="p-5 bg-white rounded-xl border border-light-outline-variant shadow-sm flex items-start gap-4">
            <div class="w-12 h-12 rounded-lg bg-light-primary-container text-light-primary flex items-center justify-center flex-shrink-0">
              <span class="material-symbols-outlined text-[24px]">schedule</span>
            </div>
            <div>
              <p class="font-label text-label-md text-light-primary font-semibold">Jam Operasional</p>
              <p class="text-body-md text-light-on-surface-variant mt-0.5">
                <span class="font-medium text-light-primary">Senin – Jumat:</span> {{ $contents['contact']['opening_hours_weekday'] ?? '07.00 – 22.00 WIB' }}<br>
                <span class="font-medium text-light-primary">Sabtu – Minggu:</span> {{ $contents['contact']['opening_hours_weekend'] ?? '08.00 – 23.00 WIB' }}
              </p>
            </div>
          </div>

          <!-- Contact direct -->
          <div class="p-5 bg-white rounded-xl border border-light-outline-variant shadow-sm flex items-start gap-4">
            <div class="w-12 h-12 rounded-lg bg-light-primary-container text-light-primary flex items-center justify-center flex-shrink-0">
              <span class="material-symbols-outlined text-[24px]">phone_in_talk</span>
            </div>
            <div>
              <p class="font-label text-label-md text-light-primary font-semibold">Kontak & Pertanyaan</p>
              <p class="text-body-md text-light-on-surface-variant mt-0.5">
                Telepon: {{ $contents['contact']['phone'] ?? '+62 812-3456-7890' }}<br>
                Email: {{ $contents['contact']['email'] ?? 'kontak@coffeeshop.test' }}
              </p>
            </div>
          </div>
        </div>

        <!-- Social Media Badges -->
        <div class="p-6 bg-espresso rounded-xl text-cream space-y-3">
          <p class="font-headline text-headline-sm font-bold text-white">Ikuti Jejak Kami</p>
          <p class="text-body-sm text-cream/80">Dapatkan informasi rilis biji kopi edisi terbatas dan kegiatan komunitas melalui media sosial kami.</p>
          <div class="flex items-center gap-3 pt-2">
            @if(!empty($contents['social']['instagram']))
              <a href="{{ $contents['social']['instagram'] }}" target="_blank" class="px-3.5 py-1.5 rounded-full bg-white/10 hover:bg-caramel text-label-sm font-label transition-colors">
                Instagram
              </a>
            @endif
            @if(!empty($contents['social']['facebook']))
              <a href="{{ $contents['social']['facebook'] }}" target="_blank" class="px-3.5 py-1.5 rounded-full bg-white/10 hover:bg-caramel text-label-sm font-label transition-colors">
                Facebook
              </a>
            @endif
            @if(!empty($contents['social']['tiktok']))
              <a href="{{ $contents['social']['tiktok'] }}" target="_blank" class="px-3.5 py-1.5 rounded-full bg-white/10 hover:bg-caramel text-label-sm font-label transition-colors">
                TikTok
              </a>
            @endif
          </div>
        </div>
      </div>

      <!-- Right Column: Interactive Contact Form -->
      <div class="lg:col-span-7 bg-white p-8 sm:p-10 rounded-2xl border border-light-outline-variant shadow-sm space-y-6">
        <div>
          <span class="text-label-sm font-label text-caramel tracking-widest uppercase">Formulir Pesan</span>
          <h2 class="font-headline text-headline-md text-light-primary font-bold mt-1">Kirimkan Pesan Langsung</h2>
          <p class="text-body-md text-light-on-surface-variant mt-1">
            Isi formulir di bawah ini dan tim kami akan menghubungi Anda dalam waktu 1x24 jam.
          </p>
        </div>

        @if(session('success'))
          <div class="p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3">
            <span class="material-symbols-outlined text-emerald-600">check_circle</span>
            <span class="text-body-md font-medium">{{ session('success') }}</span>
          </div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
          @csrf

          <div>
            <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
              Nama Lengkap Anda *
            </label>
            <input 
              type="text" 
              name="name" 
              value="{{ old('name') }}" 
              required 
              placeholder="Contoh: Rian Pratama" 
              class="w-full px-4 py-3 bg-light-surface border {{ $errors->has('name') ? 'border-red-400 ring-1 ring-red-400' : 'border-light-outline' }} rounded text-body-md focus:border-light-primary focus:ring-1 focus:ring-light-primary outline-none">
            @error('name')
              <p class="text-body-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
              <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
                Alamat Email *
              </label>
              <input 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                placeholder="nama@email.com" 
                class="w-full px-4 py-3 bg-light-surface border {{ $errors->has('email') ? 'border-red-400 ring-1 ring-red-400' : 'border-light-outline' }} rounded text-body-md focus:border-light-primary focus:ring-1 focus:ring-light-primary outline-none">
              @error('email')
                <p class="text-body-sm text-red-600 mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
                Nomor Telepon / WhatsApp
              </label>
              <input 
                type="tel" 
                name="phone" 
                value="{{ old('phone') }}" 
                placeholder="+62 8..." 
                class="w-full px-4 py-3 bg-light-surface border border-light-outline rounded text-body-md focus:border-light-primary focus:ring-1 focus:ring-light-primary outline-none">
              @error('phone')
                <p class="text-body-sm text-red-600 mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div>
            <label class="block font-label text-label-md text-light-primary font-medium mb-1.5">
              Pesan atau Pertanyaan Anda *
            </label>
            <textarea 
              name="message" 
              rows="5" 
              required 
              placeholder="Tuliskan pesan, saran, atau pertanyaan Anda di sini..." 
              class="w-full px-4 py-3 bg-light-surface border {{ $errors->has('message') ? 'border-red-400 ring-1 ring-red-400' : 'border-light-outline' }} rounded text-body-md focus:border-light-primary focus:ring-1 focus:ring-light-primary outline-none resize-y">{{ old('message') }}</textarea>
            @error('message')
              <p class="text-body-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="pt-2">
            <button 
              type="submit" 
              class="w-full sm:w-auto px-8 py-3.5 bg-light-primary hover:bg-[#291B16] text-light-on-primary font-label text-label-md rounded shadow-sm hover:shadow transition-all inline-flex items-center justify-center gap-2">
              <span class="material-symbols-outlined text-[20px]">send</span>
              <span>Kirim Pesan Sekarang</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- Map Embed Section -->
  <section class="py-12 bg-white border-t border-light-outline-variant">
    <div class="max-w-7xl mx-auto px-6">
      <div class="rounded-2xl overflow-hidden shadow-md border border-light-outline-variant h-[450px]">
        <iframe 
          src="{{ $contents['contact']['map_embed'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.297445778844!2d106.8083818!3d-6.2244512!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f14d30079f01%3A0x2e061f153245464e!2sKebayoran%20Baru%2C%20South%20Jakarta%20City%2C%20Jakarta!5e0!3m2!1sen!2sid!4v1600000000000!5m2!1sen!2sid' }}" 
          width="100%" 
          height="100%" 
          style="border:0;" 
          allowfullscreen="" 
          loading="lazy">
        </iframe>
      </div>
    </div>
  </section>
@endsection
