@extends('layouts.public')

@section('title', 'Tentang Kami — ' . ($settings['site_name'] ?? 'Coffee Shop'))

@section('content')
  <!-- Page Header -->
  <section class="bg-espresso text-cream py-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-20">
      <img src="https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&w=1600&q=80" alt="About background" class="w-full h-full object-cover">
    </div>
    <div class="max-w-7xl mx-auto px-6 relative z-10 text-center max-w-3xl">
      <span class="text-label-sm font-label text-caramel tracking-widest uppercase">Mengenal Lebih Dekat</span>
      <h1 class="font-headline text-display-md lg:text-display-lg text-white font-bold mt-2">Kisah dan Nilai di Balik Cangkir Kami</h1>
      <p class="text-body-lg text-cream/80 mt-4 leading-relaxed">
        Menghubungkan kerja keras para petani kopi di pelosok Nusantara dengan kehangatan cangkir yang Anda nikmati hari ini.
      </p>
    </div>
  </section>

  <!-- Section 1: Brand Story & Philosophy -->
  <section class="py-20 bg-light-surface">
    <div class="max-w-7xl mx-auto px-6">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-20">
        <div class="lg:col-span-6 space-y-6">
          <span class="text-label-sm font-label text-caramel tracking-widest uppercase">Awal Mula</span>
          <h2 class="font-headline text-headline-lg text-light-primary font-bold">
            {{ $contents['about']['intro_title'] ?? 'Sebuah Perjalanan Rasa dari Tanah Nusantara' }}
          </h2>
          <p class="text-body-md text-light-on-surface-variant leading-relaxed">
            {{ $contents['about']['intro_text'] ?? 'Perjalanan kami dimulai dari kekaguman sederhana terhadap dedikasi para petani kopi tradisional di berbagai pelosok Indonesia. Setiap daerah menghasilkan karakter biji yang unik—dari keharuman rempah khas Sumatra hingga kelembutan sitrus dataran tinggi Bali.' }}
          </p>
          <p class="text-body-md text-light-on-surface-variant leading-relaxed">
            {{ $contents['about']['brand_story_text'] ?? 'Kami percaya secangkir kopi istimewa bukan kebetulan, melainkan mata rantai panjang dedikasi: dari perawatan pohon kopi, pemetikan buah matang optimal, proses fermentasi yang cermat, hingga penyangraian artisanal dan penyeduhan presisi oleh barista kami.' }}
          </p>
        </div>
        <div class="lg:col-span-6">
          <div class="rounded-xl overflow-hidden shadow-lg border border-light-outline-variant">
            <img src="https://images.unsplash.com/photo-1498804103079-a6351b050096?auto=format&fit=crop&w=800&q=80" alt="Petani Kopi" class="w-full h-[400px] object-cover">
          </div>
        </div>
      </div>

      <!-- Vision & Mission Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">
        <!-- Vision -->
        <div class="p-8 rounded-xl bg-white border border-light-outline-variant shadow-sm flex flex-col gap-4">
          <div class="w-12 h-12 rounded-lg bg-light-primary text-light-on-primary flex items-center justify-center font-bold">
            <span class="material-symbols-outlined text-[24px]">visibility</span>
          </div>
          <h3 class="font-headline text-headline-sm text-light-primary font-bold">Visi Kami</h3>
          <p class="text-body-md text-light-on-surface-variant leading-relaxed">
            {{ $contents['about']['vision'] ?? 'Menjadi ruang singgah artisanal terpercaya yang merayakan kekayaan kopi Indonesia melalui sajian berkelas, praktik perdagangan berkeadilan, dan keramahan yang tulus.' }}
          </p>
        </div>

        <!-- Mission -->
        <div class="p-8 rounded-xl bg-white border border-light-outline-variant shadow-sm flex flex-col gap-4">
          <div class="w-12 h-12 rounded-lg bg-caramel text-white flex items-center justify-center font-bold">
            <span class="material-symbols-outlined text-[24px]">flag</span>
          </div>
          <h3 class="font-headline text-headline-sm text-light-primary font-bold">Misi Kami</h3>
          <ul class="space-y-3 text-body-md text-light-on-surface-variant">
            <li class="flex items-start gap-2.5">
              <span class="material-symbols-outlined text-caramel text-[20px] mt-0.5">check_circle</span>
              <span>{{ $contents['about']['mission_1'] ?? 'Membeli hasil panen langsung dari kelompok tani lokal dengan harga yang adil.' }}</span>
            </li>
            <li class="flex items-start gap-2.5">
              <span class="material-symbols-outlined text-caramel text-[20px] mt-0.5">check_circle</span>
              <span>{{ $contents['about']['mission_2'] ?? 'Mengedukasi penikmat kopi mengenai keanekaragaman cita rasa biji kopi single origin.' }}</span>
            </li>
            <li class="flex items-start gap-2.5">
              <span class="material-symbols-outlined text-caramel text-[20px] mt-0.5">check_circle</span>
              <span>{{ $contents['about']['mission_3'] ?? 'Menyediakan wadah sosial yang hangat, inklusif, dan ramah lingkungan.' }}</span>
            </li>
          </ul>
        </div>
      </div>

      <!-- Atmosphere & Values Section -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-6 order-2 lg:order-1">
          <div class="rounded-xl overflow-hidden shadow-md border border-light-outline-variant">
            <img src="https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=800&q=80" alt="Interior Kedai" class="w-full h-[380px] object-cover">
          </div>
        </div>
        <div class="lg:col-span-6 order-1 lg:order-2 space-y-5">
          <span class="text-label-sm font-label text-caramel tracking-widest uppercase">Nilai & Filosofi</span>
          <h2 class="font-headline text-headline-lg text-light-primary font-bold">
            {{ $contents['about']['atmosphere_title'] ?? 'Desain Ruang yang Menenangkan Jiwa' }}
          </h2>
          <p class="text-body-md text-light-on-surface-variant leading-relaxed">
            {{ $contents['about']['atmosphere_text'] ?? 'Setiap sudut kedai kami ditata dengan material alami kayu jati daur ulang, bata ekspos hangat, serta tanaman hijau indoor yang menyegarkan pandangan. Baik Anda datang untuk menyelesaikan proyek kreatif, membaca buku favorit, atau sekadar bertukar kabar bersama sahabat karib, kami memastikan Anda merasa disambut layaknya di rumah sendiri.' }}
          </p>
          <div class="pt-4">
            <a href="{{ route('menu') }}" class="px-6 py-3 bg-light-primary hover:bg-[#291B16] text-light-on-primary rounded font-label text-label-md inline-flex items-center gap-2 transition-all shadow-sm">
              <span>Coba Sajian Kami</span>
              <span class="material-symbols-outlined text-[18px]">restaurant_menu</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
