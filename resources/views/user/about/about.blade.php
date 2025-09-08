@extends('layouts.app')

@section('title', 'Tentang UMKM Desa Jubung')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user/about/about.css') }}">
@endsection

@section('content')
<!-- ===== HERO SEDERHANA ===== -->
<header class="about-hero">
  <div class="container">
    <p class="hero-kicker">Tentang Kami</p>
    <h1 class="hero-title">{{ $tentang->hero ?? 'Tentang UMKM Desa Jubung' }}</h1>
  </div>
</header>

<!-- ===== SECTION 1 (gambar kiri) ===== -->
<section class="about-section">
  <div class="container about-grid">
    <div class="about-media reveal" data-reveal="left">
      <div class="media-frame">
        <img src="{{ $tentang && $tentang->image1 ? asset('storage/'.$tentang->image1) : asset('images/dummy14.jpg') }}" alt="Gambar 1">
      </div>
    </div>
    <div class="about-content reveal" data-reveal="right">
      <h2 class="about-title">{{ $tentang->title1 ?? 'Judul 1' }}</h2>
      <p class="about-desc">{{ $tentang->desc1 ?? 'Deskripsi 1' }}</p>
    </div>
  </div>
</section>

<!-- ===== SECTION 2 (gambar kanan) ===== -->
<section class="about-section alt">
  <div class="container about-grid">
    <div class="about-content reveal" data-reveal="left">
      <h2 class="about-title">{{ $tentang->title2 ?? 'Judul 2' }}</h2>
      <p class="about-desc">{{ $tentang->desc2 ?? 'Deskripsi 2' }}</p>
    </div>
    <div class="about-media reveal" data-reveal="right">
      <div class="media-frame">
        <img src="{{ $tentang && $tentang->image2 ? asset('storage/'.$tentang->image2) : asset('images/dummy13.jpg') }}" alt="Gambar 2">
      </div>
    </div>
  </div>
</section>

<!-- ===== MISSION ===== -->
<section class="mission-section">
  <div class="container mission-inner reveal" data-reveal="up">
    <p class="mission-kicker">Misi Kami</p>
    <h3 class="mission-title">{{ $tentang->title3 ?? 'Judul 3' }}</h3>
    <p class="mission-text">{{ $tentang->webdesc ?? 'Deskripsi Website' }}</p>
  </div>
</section>

<!-- ===== Inline JS kecil (khusus halaman ini) ===== -->
<script>
  (function(){
    const els = document.querySelectorAll('.reveal');
    const io = new IntersectionObserver((entries)=>{
      entries.forEach(en=>{
        if(en.isIntersecting){ en.target.classList.add('is-visible'); io.unobserve(en.target); }
      });
    }, {threshold: 0.15});
    els.forEach(el=>io.observe(el));

    // parallax ringan pada gambar (tanpa mengubah data)
    document.querySelectorAll('.media-frame').forEach(frame=>{
      frame.addEventListener('mousemove', e=>{
        const r = frame.getBoundingClientRect();
        const dx = ((e.clientX - r.left)/r.width - .5) * 4;
        const dy = ((e.clientY - r.top)/r.height - .5) * 4;
        frame.style.setProperty('--tiltX', dy.toFixed(2) + 'deg');
        frame.style.setProperty('--tiltY', -dx.toFixed(2) + 'deg');
      });
      frame.addEventListener('mouseleave', ()=>{
        frame.style.setProperty('--tiltX','0deg'); frame.style.setProperty('--tiltY','0deg');
      });
    });
  })();
</script>
@endsection
