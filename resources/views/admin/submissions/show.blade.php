@extends('admin.partials.sidebar')

@section('title', 'Service Setting')

@section('content')
<section class="service-section">
    <link rel="stylesheet" href="{{ asset('css/admin/setting/tinjau.css') }}">

    <div class="service-header">
        <h1 class="service-title">Tinjau Data UMKM</h1>
        <p class="service-subtitle">
            Berikut adalah data submission UMKM pending.
        </p>
    </div>

    <!-- 1. Data UMKM -->
    <div class="form-block">
        <h2 class="block-title">1. Data UMKM</h2>
        <div class="grid-2">
            <div class="form-group">
                <label>Nama UMKM*</label>
                <input type="text" value="{{ $submission->nama_umkm }}" readonly>
            </div>
            <div class="form-group">
                <label>Nama Pemilik / Penanggung Jawab*</label>
                <input type="text" value="{{ $submission->owner }}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label>Alamat UMKM*</label>
            <textarea rows="2" readonly>{{ $submission->alamat }}</textarea>
        </div>
        <div class="form-group">
            <label>Deskripsi UMKM*</label>
            <textarea rows="3" readonly>{{ $submission->deskripsi }}</textarea>
        </div>
        <div class="grid-2">
            <div class="form-group">
                <label>Kontak / WhatsApp*</label>
                <input type="text" value="{{ $submission->kontak }}" readonly>
            </div>
            <div class="form-group">
                <label>Logo UMKM</label>
                <div class="single-preview">
                    <img src="{{ $submission->logo 
                        ? asset('umkm_logos/' . basename($submission->logo)) 
                        : asset('images/dummy5.PNG') }}" 
                        alt="Logo UMKM" class="thumb">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Link Google Maps</label>
            <input type="text" value="{{ $submission->gmaps }}" readonly>
        </div>
        <div class="grid-2">
            <div class="form-group">
                <label>Link Sosial Media / Marketplace</label>
                <input type="text" value="{{ $submission->social }}" readonly>
            </div>
            <div class="form-group">
                <label>Lokasi Penjualan Offline</label>
                <input type="text" value="{{ $submission->store }}" readonly>
            </div>
        </div>
    </div>

    <!-- 2. Data Produk -->
    <div class="form-block">
        <h2 class="block-title">2. Data Produk</h2>
        @foreach($submission->products as $product)
        <div class="grid-2">
            <div class="form-group">
                <label>Nama Produk*</label>
                <input type="text" value="{{ $product->nama_produk }}" readonly>
            </div>
            <div class="form-group">
                <label>Harga Produk*</label>
                <input type="text" value="{{ $product->harga }}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label>Deskripsi Produk*</label>
            <textarea rows="4" readonly>{{ $product->deskripsi }}</textarea>
        </div>
        <div class="form-group">
            <label>Foto Produk</label>
            <div class="preview-grid">
                <img src="{{ $product->product_image 
                    ? asset('product_images/' . basename($product->product_image)) 
                    : asset('images/dummy5.PNG') }}" 
                    alt="{{ $product->nama_produk }}" class="preview-thumb">
            </div>
        </div>
        @endforeach
    </div>

    <!-- Tombol Aksi -->
    <div class="form-actions">
        <form action="{{ route('admin.submissions.reject', $submission->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn-reject">Tolak</button>
        </form>

        <form action="{{ route('admin.submissions.accept', $submission->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn-accept">Accept</button>
        </form>
    </div>
</section>
@endsection
