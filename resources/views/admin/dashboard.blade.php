@extends('admin.partials.sidebar')

@section('title', 'Admin Dashboard')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/produk/produk.css') }}">

<div class="dashboard-container">

    {{-- HERO ADMIN --}}
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
<section class="section-headline">
    <h2>Produk Terbaru</h2>
    <p>3 produk terbaru yang ditambahkan ke sistem</p>
</section>

<div class="produk-grid">
    @forelse($recentProducts as $product)
        <div class="produk-card">
            {{-- Gambar Produk --}}
            <img src="{{ $product->product_image ? asset($product->product_image) : asset('images/sample-produk.jpg') }}"
                alt="{{ $product->nama_produk }}" class="produk-img">

            {{-- Body Produk --}}
            <div class="produk-body">
                <h3 class="produk-nama">{{ $product->nama_produk }}</h3>
                <p class="produk-desc">{{ $product->umkm->nama_umkm ?? '-' }}</p>
                <p class="produk-desc harga">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
            </div>

            {{-- Tombol Aksi --}}
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
        <p class="col-span-full">Belum ada produk.</p>
    @endforelse
</div>

{{-- KATEGORI KATALOG TERBARU --}}
<section class="section-headline">
    <h2>Kategori Katalog Terbaru</h2>
    <p>3 kategori katalog terbaru yang ditambahkan</p>
</section>

<div class="grid-container">
    @forelse($recentKatalogs as $katalog)
        <div class="card-katalog">
            <div class="produk-body">
                <h4 class="produk-nama">{{ $katalog->name }}</h4>
                <p class="produk-sub">Status: {{ $katalog->is_active ? 'Aktif' : 'Tidak Aktif' }}</p>
            </div>

            <div class="produk-btn-group">
                <a href="{{ route('admin.katalog.edit', $katalog->id) }}" class="btn lihat">Edit</a>
                <form action="{{ route('admin.katalog.destroy', $katalog->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn hapus" onclick="return confirm('Anda yakin?')">Hapus</button>
                </form>
            </div>
        </div>
    @empty
        <p class="col-span-full">Belum ada kategori katalog.</p>
    @endforelse
</div>

</div>

@endsection
