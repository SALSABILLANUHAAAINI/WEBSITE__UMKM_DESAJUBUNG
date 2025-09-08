@extends('layouts.app')

@section('title', 'Tentang UMKM Desa Jubung')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user/about/about.css') }}">
@endsection

@section('content')
<!-- HEADER UTAMA -->
<header class="about-header">
    <h1 class="about-heading">{{ $tentang->hero ?? 'Tentang UMKM Desa Jubung' }}</h1>
</header>

<!-- SECTION 1: Gambar kiri, teks kanan -->
<section class="about-section">
    <div class="container about-grid">
        <div class="about-image">
            <img src="{{ $tentang && $tentang->image1 ? asset('storage/'.$tentang->image1) : asset('images/dummy14.jpg') }}"
                 alt="Gambar 1">
        </div>
        <div class="about-content">
            <span class="about-number">01</span>
            <h2 class="about-title">{{ $tentang->title1 ?? 'Judul 1' }}</h2>
            <p class="about-desc">{{ $tentang->desc1 ?? 'Deskripsi 1' }}</p>
        </div>
    </div>
</section>

<!-- SECTION 2: Gambar kanan, teks kiri -->
<section class="about-section alt">
    <div class="container about-grid">
        <div class="about-content">
            <span class="about-number">02</span>
            <h2 class="about-title">{{ $tentang->title2 ?? 'Judul 2' }}</h2>
            <p class="about-desc">{{ $tentang->desc2 ?? 'Deskripsi 2' }}</p>
        </div>
        <div class="about-image">
            <img src="{{ $tentang && $tentang->image2 ? asset('storage/'.$tentang->image2) : asset('images/dummy13.jpg') }}"
                 alt="Gambar 2">
        </div>
    </div>
</section>

<!-- SECTION MISSION -->
<section class="pastel-section">
    <div class="container pastel-inner">
        <p class="pastel-kicker">The Mission</p>
        <h3 class="pastel-title">{{ $tentang->title3 ?? 'Judul 3' }}</h3>
        <p class="pastel-text">{{ $tentang->webdesc ?? 'Deskripsi Website' }}</p>
    </div>
</section>
@endsection
