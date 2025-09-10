@extends('admin.partials.sidebar')

@section('title', 'Admin Dashboard')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/produk/produk.css') }}">

<div class="dashboard-container">

    <section class="admin-hero">
        <h1>Dashboard Admin</h1>
        <p>Selamat datang di halaman Admin Website UMKM Desa Jubung</p>
    </section>

    {{-- KARTU STATISTIK --}}
    <section class="grid-container">
        <div class="stat-card">
            <h3 class="stat-value">{{ $jumlahUmkm }}</h3>
            <p class="stat-label">Jumlah UMKM</p>
        </div>

        <div class="stat-card">
            <h3 class="stat-value">{{ $jumlahKatalog }}</h3>
            <p class="stat-label">Jumlah Katalog</p>
        </div>
    </section>

    {{-- PRODUK TERBARU --}}
    <section class="list-section">
        <h2 class="section-title">Produk Terbaru</h2>
        <div class="produk-grid">
            @forelse($recentProducts as $product)
                <div class="produk-card">
                    {{-- Gambar produk dengan fallback --}}
                    <img src="{{ $product->gambar ? asset('storage/' . $product->gambar) : asset('images/sample-produk.jpg') }}"
                         alt="{{ $product->name }}" class="produk-img">

                    <div class="produk-body">
                        <h3 class="produk-nama">{{ $product->name }}</h3>
                        <p class="produk-desc">{{ $product->katalog->name ?? 'Tanpa Kategori' }}</p>
                        @if(isset($product->harga))
                        <p class="produk-desc harga">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                        @endif
                    </div>

                    <div class="produk-btn-group">
                        <a href="{{ route('admin.product.edit', $product->id) }}" class="btn edit">Edit</a>
                        <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn hapus" onclick="return confirm('Yakin hapus produk ini?')">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>Belum ada produk terbaru.</p>
            @endforelse
        </div>
    </section>

    {{-- KATEGORI KATALOG TERBARU --}}
    <section class="list-section">
        <h2 class="section-title">Kategori Katalog Terbaru</h2>
        <div class="produk-grid">
            @forelse($recentKatalogs as $katalog)
                <div class="produk-card">
                    <div class="produk-body">
                        <h3 class="produk-nama">{{ $katalog->name }}</h3>
                        <p class="produk-desc">Status: {{ $katalog->is_active ? 'Aktif' : 'Tidak Aktif' }}</p>
                    </div>
                    <div class="produk-btn-group">
                        <a href="{{ route('admin.katalog.edit', $katalog->id) }}" class="btn edit">Edit</a>
                        <form action="{{ route('admin.katalog.destroy', $katalog->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn hapus" onclick="return confirm('Yakin hapus kategori ini?')">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>Belum ada kategori katalog.</p>
            @endforelse
        </div>
    </section>

</div>

@endsection
