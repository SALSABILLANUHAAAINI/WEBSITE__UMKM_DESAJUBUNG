@extends('layouts.app')

@section('title', 'Home')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/user/umkm/index.css') }}">
@endsection

@section('content')
<div class="content-wrapper">

    {{-- HERO --}}
    @if(isset($heroUmkm) && $heroUmkm->hero)
    <section class="hero">
        <div class="hero__container">
            <div class="hero__content">
                <h1 class="hero__title">{{ $heroUmkm->hero }}</h1>
            </div>
        </div>
    </section>
    @else
    <section class="hero hero--fallback">
        <div class="hero__container hero__container--center">
            <h1 class="hero__title">Selamat Datang di UMKM Desa Jubung</h1>
            <p class="hero__desc">Konten sedang dalam penyiapan. Silakan cek kembali nanti.</p>
        </div>
    </section>
    @endif

    {{-- KATALOG PRODUK --}}
    <section class="section section--light">
        <div class="container">
            <h2 class="section__title">Katalog Produk UMKM</h2>

            <div class="katalog-grid">
                @forelse($products as $product)
                    <div class="katalog-card"
                         data-kategori="{{ strtolower($product->katalog->name ?? '') }}"
                         data-nama="{{ $product->nama_produk }}"
                         data-harga="Rp {{ number_format((float)$product->harga, 0, ',', '.') }}"
                         data-toko="{{ $product->umkm->nama_umkm ?? 'UMKM Desa Jubung' }}"
                         data-gambar="{{ $product->product_image ? asset('storage/product_images/'.$product->product_image) : asset('images/dummy5.PNG') }}">
                        
                        <img src="{{ $product->product_image ? asset('storage/product_images/'.$product->product_image) : asset('images/dummy5.PNG') }}" 
                             alt="{{ $product->nama_produk }}">
                        
                        <div class="katalog-info">
                            <h3 class="katalog-name">{{ $product->nama_produk }}</h3>
                            <p class="harga">Rp {{ number_format((float)$product->harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @empty
                    <p class="empty-state">Belum ada produk yang tersedia saat ini.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- UMKM --}}
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section__title">Berbagai Macam UMKM Desa Jubung</h2>
            </div>

            <div class="umkm-grid">
                @forelse($umkms as $umkm)
                    <div class="umkm-card">
                        <img src="{{ $umkm->gambar ? asset('storage/umkm_images/'.$umkm->gambar) : asset('images/dummy1.png') }}" 
                             alt="{{ $umkm->nama_umkm }}">
                        
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
