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

{{-- JS kecil untuk ganti gambar & detail --}}
<script>
  function changeImage(el) {
    document.getElementById('mainImage').src = el.src;
    document.getElementById('produkNama').childNodes[0].nodeValue = el.dataset.nama + ' ';
    document.getElementById('produkHarga').innerText = el.dataset.harga;
    document.getElementById('produkDesc').innerText = el.dataset.deskripsi;
  }
</script>

@endsection
