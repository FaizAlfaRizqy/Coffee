@extends('layouts.public')

@section('title', $article->title . ' — ' . ($settings['site_name'] ?? 'Coffee Shop'))

@section('content')
  <!-- Article Header Breadcrumb & Meta -->
  <section class="bg-espresso text-cream pt-16 pb-28 relative">
    <div class="max-w-4xl mx-auto px-6 text-center">
      <nav class="flex items-center justify-center gap-2 text-label-sm font-label text-cream/70 mb-6">
        <a href="{{ route('home') }}" class="hover:text-caramel">Beranda</a>
        <span>/</span>
        <a href="{{ route('articles.index') }}" class="hover:text-caramel">Artikel</a>
        <span>/</span>
        <span class="text-caramel">{{ $article->category->name ?? 'Wawasan' }}</span>
      </nav>

      <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-caramel/25 border border-caramel/40 text-caramel font-label text-label-sm mb-4">
        <span>{{ $article->category->name ?? 'Artikel' }}</span>
        <span>•</span>
        <span>{{ $article->published_at ? $article->published_at->isoFormat('D MMMM Y') : '' }}</span>
      </div>

      <h1 class="font-headline text-display-md lg:text-display-lg text-white font-bold leading-tight max-w-3xl mx-auto">
        {{ $article->title }}
      </h1>

      <p class="text-body-lg text-cream/80 mt-6 max-w-2xl mx-auto leading-relaxed">
        {{ $article->excerpt }}
      </p>
    </div>
  </section>

  <!-- Article Body Content -->
  <article class="bg-light-surface pb-24">
    <div class="max-w-4xl mx-auto px-6 -mt-16 relative z-10">
      
      <!-- Featured Image Banner -->
      <div class="rounded-2xl overflow-hidden shadow-2xl border border-light-outline-variant bg-light-surface-variant max-h-[480px]">
        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
      </div>

      <!-- Article Text Section -->
      <div class="bg-white rounded-2xl p-8 sm:p-12 shadow-sm border border-light-outline-variant mt-8 space-y-6 text-body-lg text-light-on-surface-variant leading-relaxed">
        {!! nl2br(e($article->content)) !!}

        <!-- Author / Editorial Signature -->
        <div class="pt-8 border-t border-light-outline-variant flex items-center justify-between flex-wrap gap-4 mt-12">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full bg-light-primary text-light-on-primary flex items-center justify-center font-headline font-bold">
              CS
            </div>
            <div>
              <p class="font-label text-label-md text-light-primary font-semibold">Tim Editorial Roastery</p>
              <p class="text-body-sm text-light-on-surface-variant">Dipublikasikan oleh {{ $settings['site_name'] ?? 'Coffee Shop' }}</p>
            </div>
          </div>

          <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 border border-light-outline rounded text-label-sm font-label text-light-primary hover:border-caramel hover:text-caramel transition-colors">
            <span class="material-symbols-outlined text-[16px]">arrow_back</span>
            <span>Kembali ke Daftar Artikel</span>
          </a>
        </div>
      </div>
    </div>
  </article>

  <!-- Related Articles -->
  @if($relatedArticles->count() > 0)
    <section class="py-20 bg-light-surface-variant/40 border-t border-light-outline-variant">
      <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between mb-10">
          <div>
            <span class="text-label-sm font-label text-caramel tracking-widest uppercase">Eksplorasi Lanjutan</span>
            <h2 class="font-headline text-headline-lg text-light-primary font-bold mt-1">Artikel Terkait Lainnya</h2>
          </div>
          <a href="{{ route('articles.index') }}" class="font-label text-label-md text-light-primary hover:text-caramel inline-flex items-center gap-1">
            <span>Semua Artikel</span>
            <span class="material-symbols-outlined text-[18px]">east</span>
          </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          @foreach($relatedArticles as $rel)
            <article class="bg-white rounded-lg border border-light-outline-variant overflow-hidden shadow-sm hover:shadow-md transition-all flex flex-col group">
              <div class="h-48 overflow-hidden bg-light-surface-variant">
                <img src="{{ $rel->image_url }}" alt="{{ $rel->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
              </div>
              <div class="p-6 flex flex-col flex-1">
                <div class="flex items-center gap-2 text-label-sm text-caramel font-label mb-2">
                  <span>{{ $rel->category->name ?? 'Artikel' }}</span>
                  <span>•</span>
                  <span class="text-light-on-surface-variant">{{ $rel->published_at ? $rel->published_at->isoFormat('D MMM Y') : '' }}</span>
                </div>
                <h3 class="font-headline text-headline-sm text-light-primary font-bold mb-3 group-hover:text-caramel transition-colors line-clamp-2">
                  <a href="{{ route('articles.show', $rel->slug) }}">{{ $rel->title }}</a>
                </h3>
                <p class="text-body-sm text-light-on-surface-variant line-clamp-2 mb-4 flex-1">
                  {{ $rel->excerpt }}
                </p>
                <a href="{{ route('articles.show', $rel->slug) }}" class="text-label-md font-label text-light-primary inline-flex items-center gap-1 group-hover:translate-x-1 transition-transform">
                  <span>Baca Artikel</span>
                  <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
              </div>
            </article>
          @endforeach
        </div>
      </div>
    </section>
  @endif
@endsection
