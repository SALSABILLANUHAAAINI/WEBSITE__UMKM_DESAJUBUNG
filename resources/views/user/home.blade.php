@extends('layouts.app')

@section('title', 'Home')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/user/umkm/index.css') }}">
@endsection

@section('content')
<div class="content-wrapper">

    {{-- =================== HERO =================== --}}
    @if($home)
    <section class="hero">
        <div class="hero__container">
            <div class="hero__img hero__img--left">
                <img src="{{ $home->gambar_kiri ? asset('home_images/'.$home->gambar_kiri) : asset('images/dummy14.jpg') }}" alt="Gambar Kiri">
            </div>

            <div class="hero__content">
                <h3 class="hero__subtitle">{{ $home->subjudul }}</h3>
                <h1 class="hero__title">{{ $home->judul }}</h1>
                <p class="hero__desc">{{ $home->deskripsi }}</p>
            </div>

            <div class="hero__img hero__img--right">
                <img src="{{ $home->gambar_kanan ? asset('home_images/'.$home->gambar_kanan) : asset('images/dummy14.jpg') }}" alt="Gambar Kanan">
            </div>
        </div>
    </section>

    {{-- ================= HIGHLIGHT ================= --}}
    <section class="highlight" style="--highlight-bg: url('{{ asset('images/dummy14.jpg') }}');">
        <div class="highlight__overlay"></div>
        <div class="highlight__box">
            <h2 class="highlight__text">{!! nl2br(e($home->highlight)) !!}</h2>
            <a href="{{ url('/umkm') }}" class="btn btn--primary">Lihat Selengkapnya</a>
        </div>
    </section>
    @else
    <section class="hero hero--fallback">
        <div class="hero__container hero__container--center">
            <h1 class="hero__title">Selamat Datang</h1>
            <p class="hero__desc">Konten sedang dalam penyiapan. Silakan cek kembali nanti.</p>
        </div>
    </section>
    @endif

    {{-- ============= KATALOG PRODUK ============= --}}
    <section class="section section--light">
        <div class="container">
            <h2 class="section__title">Katalog Produk UMKM</h2>

            <div class="katalog-grid">
                @forelse($products as $product)
                    <div class="katalog-card"
                        data-kategori="{{ strtolower($product->katalog->name ?? '') }}"
                        data-nama="{{ $product->nama_produk }}"
                        data-harga="Rp {{ number_format((float) $product->harga, 0, ',', '.') }}"
                        data-toko="{{ $product->umkm->nama_umkm ?? 'UMKM Desa Jubung' }}"
                        data-gambar="{{ $product->product_image ? asset($product->product_image) : asset('images/sample-produk.jpg') }}">

                        <img src="{{ $product->product_image ? asset($product->product_image) : asset('images/sample-produk.jpg') }}"
                            alt="{{ $product->nama_produk }}">
                        <div class="katalog-info">
                            <h3 class="katalog-name">{{ $product->nama_produk }}</h3>
                            <p class="harga">Rp {{ number_format((float) $product->harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @empty
                    <p class="empty-state">Belum ada produk yang tersedia saat ini.</p>
                @endforelse
            </div>
    </section>

    {{-- ===================== UMKM ===================== --}}
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section__title">Berbagai Macam UMKM Desa Jubung</h2>
            </div>

            <div class="umkm-grid">
                @forelse($umkms as $umkm)
                    <div class="umkm-card">
                        <img src="{{ $umkm->gambar ? asset($umkm->gambar) : asset('images/dummy1.png') }}" alt="{{ $umkm->nama_umkm }}" class="produk-img">
                        <div class="umkm-info">
                            <h3 class="umkm-name">{{ $umkm->nama_umkm }}</h3>
                            <p class="umkm-desc">{{ Str::limit($umkm->deskripsi, 150) }}</p>
                        </div>
                        <a href="{{ route('umkm.show', $umkm->id) }}" class="btn btn--primary btn--block">Lihat Detail</a>
                    </div>
                @empty
                    <p class="empty-state">Belum ada data UMKM.</p>
                @endforelse
            </div>
        </div>
    </section>

</div>
@endsection
