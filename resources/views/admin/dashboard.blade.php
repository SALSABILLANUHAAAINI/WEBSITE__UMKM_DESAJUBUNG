@extends('admin.partials.sidebar')

@section('title', 'Admin Dashboard')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">

<!-- Hero Section -->
<section class="admin-hero text-white py-16">
  <div class="container mx-auto px-6 text-center">
    <h1 class="text-4xl font-bold mb-4">Dashboard Admin</h1>
    <p class="text-lg">Selamat datang di halaman Admin Website UMKM Desa Jubung</p>
  </div>
</section>

<!-- Statistik Ringkas -->
<!-- Statistik Ringkas -->
<section class="py-12 bg-gray-100">
  <div class="max-w-4xl mx-auto px-6 flex justify-center gap-6 text-center">

    <div class="stat-card">
      <h3 class="stat-value text-blue-500">25</h3>
      <p class="stat-label">Jumlah UMKM</p>
    </div>

    <div class="stat-card">
      <h3 class="stat-value text-pink-500">42</h3>
      <p class="stat-label">Jumlah Katalog</p>
    </div>

  </div>
</section>


<!-- Card List (UMKM & Katalog) -->
<section class="py-12">
  <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

    <!-- Card Katalog -->
    <div class="produk-card">
      <img src="https://picsum.photos/300/200?random=1" class="produk-img" alt="Produk">
      <div class="produk-body">
        <h4 class="produk-nama">Cookies</h4>
        <p class="produk-sub">Coklat Premium</p>
        <p class="produk-harga">Rp 20.000</p>
        <p class="produk-desc">Dipanggang renyah dengan choco chips melimpah.</p>
        <div class="produk-btn-group">
          <button class="btn edit">Edit</button>
          <button class="btn hapus">Hapus</button>
        </div>
      </div>
    </div>

    <!-- Card UMKM -->
    <div class="produk-card">
      <img src="https://picsum.photos/300/200?random=2" class="produk-img" alt="UMKM">
      <div class="produk-body">
        <h4 class="produk-nama">UMKM Batik Jubung</h4>
        <p class="produk-sub">Fashion Batik</p>
        <p class="produk-desc">UMKM lokal yang memproduksi batik tulis khas Jubung.</p>
        <div class="produk-btn-group">
          <button class="btn edit">Edit</button>
          <button class="btn hapus">Hapus</button>
        </div>
      </div>
    </div>

  </div>
</section>

@endsection
