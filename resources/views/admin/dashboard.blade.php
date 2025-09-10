@extends('admin.partials.sidebar')

@section('title', 'Admin Dashboard')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">

<div class="dashboard-container">

    <section class="admin-hero">
        <h1>Dashboard Admin</h1>
        <p>Selamat datang di halaman Admin Website UMKM Desa Jubung</p>
    </section>

    {{-- KARTU STATISTIK (DINAMIS) --}}
    <section class="grid-container">
        <div class="stat-card">
            {{-- Menggunakan variabel dari View Composer --}}
            <h3 class="stat-value">{{ $jumlahUmkm }}</h3>
            <p class="stat-label">Jumlah UMKM</p>
        </div>

        <div class="stat-card">
            {{-- Menggunakan variabel dari View Composer --}}
            <h3 class="stat-value">{{ $jumlahKatalog }}</h3>
            <p class="stat-label">Jumlah Katalog</p>
        </div>
    </section>

    {{-- BAGIAN DAFTAR PRODUK DAN KATALOG (DINAMIS) --}}

    {{-- 1. DAFTAR PRODUK TERBARU --}}
    <section class="list-section">
        <h2 class="section-title">Produk Terbaru</h2>
        <div class="grid-container">
            @forelse($recentProducts as $product)
                <div class="produk-card">
                    {{-- KODE BARU DENGAN PENGAMAN --}}
                    @if($product->gambar)
                        {{-- Jika produk punya gambar, tampilkan --}}
                        <img src="{{ asset('storage/' . $product->gambar) }}" class="produk-img" alt="{{ $product->name }}">
                    @else
                        {{-- Jika tidak, tampilkan gambar placeholder LOKAL --}}
                        <img src="{{ asset('images/no-image.png') }}" class="produk-img" alt="{{ $product->name }}">
                    @endif
                    <div class="produk-body">
                        <h4 class="produk-nama">{{ $product->name }}</h4>
                        <p class="produk-sub">{{ $product->katalog->name ?? 'Tanpa Kategori' }}</p>
                        <p class="produk-harga">{{-- Anda bisa menambahkan harga di sini jika kolomnya sudah ada --}}</p>
                        <div class="produk-btn-group">
                            <a href="{{ route('admin.product.edit', $product->id) }}" class="btn lihat">Edit</a>
                            <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn hapus" onclick="return confirm('Anda yakin?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full">Belum ada produk.</p>
            @endforelse
        </div>
    </section>

    {{-- 2. DAFTAR KATEGORI KATALOG TERBARU --}}
    <section class="list-section">
        <h2 class="section-title">Kategori Katalog Terbaru</h2>
        <div class="grid-container">
            @forelse($recentKatalogs as $katalog)
                <div class="produk-card">
                    {{-- Kita tidak punya gambar untuk katalog --}}
                    <div class="produk-body" style="padding-top: 2rem;"> {{-- Sedikit style agar rapi --}}
                        <h4 class="produk-nama">{{ $katalog->name }}</h4>
                        <p class="produk-sub">Status: {{ $katalog->is_active ? 'Aktif' : 'Tidak Aktif' }}</p>
                        <div class="produk-btn-group">
                            <a href="{{ route('admin.katalog.edit', $katalog->id) }}" class="btn lihat">Edit</a>
                            <form action="{{ route('admin.katalog.destroy', $katalog->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn hapus" onclick="return confirm('Anda yakin?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full">Belum ada kategori katalog.</p>
            @endforelse
        </div>
    </section>

</div>

@endsection
