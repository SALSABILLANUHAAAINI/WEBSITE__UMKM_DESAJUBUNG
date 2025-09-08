@extends('layouts.app')

@section('title', 'Detail UMKM - ' . $umkm->nama_umkm)

@section('content')

{{-- CSS halaman detail UMKM --}}
<link rel="stylesheet" href="{{ asset('css/user/umkm/show.css') }}">

<main class="umkm-detail">
  <!-- Bagian Gambar + Judul -->
  <div class="umkm-left">
    <h1 class="umkm-title">{{ $umkm->nama_umkm }}</h1>
    <div class="slider">
      <img
        src="{{ $umkm->gambar ? asset('storage/'.$umkm->gambar) : asset('images/dummy1.png') }}"
        alt="{{ $umkm->nama_umkm }}">
    </div>
  </div>

  <!-- Bagian Deskripsi -->
  <div class="umkm-right">
    <p>{{ $umkm->deskripsi }}</p>
  </div>
</main>

{{-- ========================= --}}
{{-- KATALOG PRODUK (DI ATAS KONTAK) --}}
{{-- ========================= --}}
@if($umkm->products && $umkm->products->count() > 0)
<section class="katalog-wrap">
  <h2 class="katalog-title">Produk UMKM</h2>

  <main class="katalog">
    <div class="produk-display">
      {{-- Produk utama (ambil produk pertama) --}}
      @php
        $firstProduct = $umkm->products->first();
      @endphp
      <img id="mainImage"
           src="{{ $firstProduct->product_image ? asset('storage/'.$firstProduct->product_image) : asset('images/dummy1.png') }}"
           alt="Produk Utama"
           class="main-img"
           loading="lazy">

      <div class="thumbnail-container">
        @foreach($umkm->products as $item)
          <img src="{{ $item->product_image ? asset('storage/'.$item->product_image) : asset('images/dummy1.png') }}"
               alt="Thumbnail {{ $item->nama_produk }}"
               data-nama="{{ $item->nama_produk }}"
               data-harga="Rp {{ number_format($item->harga, 0, ',', '.') }}"
               data-deskripsi="{{ $item->deskripsi }}"
               onclick="changeImage(this)"
               loading="lazy">
        @endforeach
      </div>
    </div>

    <div class="produk-deskripsi">
      <h2 id="produkNama">
        {{ $firstProduct->nama_produk }}
        <span class="harga" id="produkHarga">
          Rp {{ number_format($firstProduct->harga, 0, ',', '.') }}
        </span>
      </h2>
      <p id="produkDesc">{{ $firstProduct->deskripsi }}</p>

      <hr>
      <p><strong>Toko:</strong> {{ $umkm->nama_umkm }}</p>
      <p>{{ $umkm->deskripsi }}</p>
    </div>
  </main>
</section>
@endif

<section class="umkm-contact">
  <h2 class="contact-title">Kontak & Alamat</h2>

  <div class="contact-cards">
    <!-- KONTAK -->
    <a href="https://wa.me/{{ $umkm->kontak }}" target="_blank" class="contact-card">
      <h3>Kontak WhatsApp</h3>
      <p>{{ $umkm->kontak }}</p>
    </a>

    <!-- ALAMAT -->
    <div class="contact-card">
      <h3>Alamat</h3>
      <p>{{ $umkm->alamat }}</p>
    </div>
  </div>

  <!-- Google Maps -->
  @if($umkm->gmaps)
  <div class="map-container">
    <iframe
        src="{{ $umkm->gmaps }}"
        width="100%" height="300" style="border:0;"
        allowfullscreen="" loading="lazy"></iframe>
  </div>
  @endif
</section>

{{-- ====== JS: fungsional + animasi ringan (khusus halaman ini) ====== --}}
<script>
  // Ganti gambar & info produk (fungsi asli, tetap dipakai)
  function changeImage(el) {
    document.getElementById('mainImage').src = el.src;
    document.getElementById('produkNama').childNodes[0].nodeValue = el.dataset.nama + ' ';
    document.getElementById('produkHarga').innerText = el.dataset.harga;
    document.getElementById('produkDesc').innerText = el.dataset.deskripsi;
  }

  // ===== Scroll Reveal + efek muncul halus =====
  (function(){
    const revealEls = [
      ...document.querySelectorAll('.umkm-detail, .umkm-title, .umkm-right'),
      ...document.querySelectorAll('.katalog-wrap, .katalog-title, .katalog'),
      ...document.querySelectorAll('.umkm-contact, .contact-title, .contact-cards, .map-container')
    ];

    // Tambahkan kelas 'reveal' + arah
    revealEls.forEach(el => {
      el.classList.add('reveal');
      if (el.classList.contains('umkm-right') || el.classList.contains('katalog'))
        el.classList.add('reveal-right');
      if (el.classList.contains('umkm-detail') || el.classList.contains('katalog-wrap'))
        el.classList.add('reveal-left');
    });

    const io = new IntersectionObserver((entries)=>{
      entries.forEach(en=>{
        if(en.isIntersecting){
          en.target.classList.add('is-visible');
          en.target.classList.remove('reveal-left','reveal-right','reveal-up');
          io.unobserve(en.target);
        }
      });
    }, { threshold: 0.15 });

    revealEls.forEach(el => io.observe(el));

    // muncul awal untuk gambar
    document.querySelectorAll('.slider img, .thumbnail-container img').forEach(img=>{
      img.classList.add('appear');
    });
  })();

  // ===== Tilt ringan pada gambar utama mengikuti kursor =====
  (function(){
    const img = document.querySelector('.slider img');
    if(!img) return;
    const maxTilt = 4; // derajat
    img.addEventListener('mousemove', (e)=>{
      const r = img.getBoundingClientRect();
      const rx = ((e.clientY - r.top)/r.height - .5) * maxTilt;   // rotasi X
      const ry = ((e.clientX - r.left)/r.width - .5) * -maxTilt;  // rotasi Y
      img.style.setProperty('--tiltX', rx.toFixed(2) + 'deg');
      img.style.setProperty('--tiltY', ry.toFixed(2) + 'deg');
    });
    img.addEventListener('mouseleave', ()=>{
      img.style.setProperty('--tiltX', '0deg');
      img.style.setProperty('--tiltY', '0deg');
    });
  })();
</script>

@endsection
