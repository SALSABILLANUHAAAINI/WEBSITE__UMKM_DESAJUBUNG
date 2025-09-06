@extends('layouts.app')

@section('title', 'Detail UMKM - Contoh UMKM')

@section('content')

{{-- CSS halaman detail UMKM (SAMA FILE, tidak pakai CSS katalog terpisah) --}}
<link rel="stylesheet" href="{{ asset('css/user/umkm/show.css') }}">

<main class="umkm-detail">
  <!-- Bagian Gambar + Judul -->
  <div class="umkm-left">
    <h1 class="umkm-title">UMKM Contoh</h1>
    <div class="slider">
      <img
        src="{{ asset('images/dummy1.PNG') }}"
        alt="UMKM Contoh">
    </div>
  </div>

  <!-- Bagian Deskripsi -->
  <div class="umkm-right">
    <p>
      Ini adalah deskripsi singkat mengenai UMKM Contoh yang ada di Desa Jubung.
      UMKM ini memproduksi berbagai produk lokal berkualitas dengan cita rasa khas
      dan harga terjangkau.
    </p>
  </div>
</main>

{{-- ========================= --}}
{{-- KATALOG PRODUK (DI ATAS KONTAK) --}}
{{-- ========================= --}}
@php
  // Dummy data produk (nanti gampang diganti dari DB)
  $produk = [
    [
      'nama' => 'Keripik Rengginang',
      'harga' => 'Rp 10.000',
      'deskripsi' => 'Keripik rengginang renyah, gurih, cocok untuk camilan harian.',
      'gambar' => asset('images/dummy6.PNG'),
    ],
    [
      'nama' => 'Keripik Singkong',
      'harga' => 'Rp 10.000',
      'deskripsi' => 'Singkong pilihan dengan bumbu klasik nikmat.',
      'gambar' => asset('images/dummy7.PNG'),
    ],
    [
      'nama' => 'Keripik Pisang',
      'harga' => 'Rp 10.000',
      'deskripsi' => 'Pisang iris tipis garing, rasa manis gurih seimbang.',
      'gambar' => asset('images/dummy8.PNG'),
    ],
  ];

  $toko = (object) [
    'nama_toko' => 'Keripik Angkasa',
    'deskripsi' => 'Produk rumahan dengan rasa nostalgia, dibuat harian dari bahan lokal pilihan.'
  ];
@endphp

@if(!empty($produk))
<section class="katalog-wrap">
  <h2 class="katalog-title">Produk UMKM</h2>

  <main class="katalog">
    <div class="produk-display">
      <img id="mainImage" src="{{ $produk[0]['gambar'] }}" alt="Produk Utama" class="main-img" loading="lazy">

      <div class="thumbnail-container">
        @foreach($produk as $item)
          <img src="{{ $item['gambar'] }}"
               alt="Thumbnail {{ $item['nama'] }}"
               data-nama="{{ $item['nama'] }}"
               data-harga="{{ $item['harga'] }}"
               data-deskripsi="{{ $item['deskripsi'] }}"
               onclick="changeImage(this)"
               loading="lazy">
        @endforeach
      </div>
    </div>

    <div class="produk-deskripsi">
      <h2 id="produkNama">
        {{ $produk[0]['nama'] }}
        <span class="harga" id="produkHarga">{{ $produk[0]['harga'] }}</span>
      </h2>
      <p id="produkDesc">{{ $produk[0]['deskripsi'] }}</p>

      <hr>
      <p><strong>Toko:</strong> {{ $toko->nama_toko }}</p>
      <p>{{ $toko->deskripsi }}</p>
    </div>
  </main>
</section>
@endif

<section class="umkm-contact">
  <h2 class="contact-title">Kontak & Alamat</h2>

  <div class="contact-cards">
    <!-- KONTAK -->
    <a href="https://wa.me/6281234567890" target="_blank" class="contact-card">
      <h3>Kontak WhatsApp</h3>
      <p>+62 812-3456-7890</p>
    </a>

    <!-- ALAMAT -->
    <div class="contact-card">
      <h3>Alamat</h3>
      <p>Desa Jubung, Kecamatan Sukorambi, Jember</p>
    </div>
  </div>

  <!-- Google Maps -->
  <div class="map-container">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.318984308358!2d113.6871!3d-8.1905!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6e3e48f0f123%3A0x123456789abcdef!2sDesa%20Jubung%2C%20Sukorambi%2C%20Kabupaten%20Jember!5e0!3m2!1sid!2sid!4v1694572000000!5m2!1sid!2sid"
        width="100%" height="300" style="border:0;"
        allowfullscreen="" loading="lazy"></iframe>
  </div>
</section>

{{-- JS kecil untuk ganti gambar & detail --}}
<script>
  function changeImage(el) {
    document.getElementById('mainImage').src = el.src;
    // ganti teks nama (jaga <span> harga tetap ada)
    document.getElementById('produkNama').childNodes[0].nodeValue = el.dataset.nama + ' ';
    document.getElementById('produkHarga').innerText = el.dataset.harga;
    document.getElementById('produkDesc').innerText = el.dataset.deskripsi;
  }
</script>

@endsection
