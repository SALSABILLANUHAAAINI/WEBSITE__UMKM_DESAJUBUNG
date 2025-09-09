@extends('admin.partials.sidebar')
@section('title', 'Tambah Produk')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/produk/tambahProduk.css') }}">
@endsection

@section('content')
<div class="produk-form-container">
    <h1 class="title">Tambah Produk</h1>

    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" class="produk-form">
        @csrf

        <label for="nama_produk">Nama Produk</label>
        <input type="text" name="nama_produk" id="nama_produk" required>

        <label for="harga">Harga</label>
        <input type="number" name="harga" id="harga" required>

        <label for="umkm_id">UMKM</label>
        <select name="umkm_id" id="umkm_id" required>
            <option value="">-- Pilih UMKM --</option>
            @foreach($umkms as $umkm)
                <option value="{{ $umkm->id }}">{{ $umkm->nama_umkm }}</option>
            @endforeach
        </select>

        <label for="katalog_id">Katalog</label>
        <select name="katalog_id" id="katalog_id" required>
            <option value="">-- Pilih Katalog --</option>
            @foreach($katalogs as $katalog)
                <option value="{{ $katalog->id }}">{{ $katalog->name }}</option>
            @endforeach
        </select>

        <label for="deskripsi">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi"></textarea>

        <label for="gambar">Gambar Produk</label>
        <input type="file" name="gambar" id="gambar">

        <button type="submit" class="btn add">Simpan</button>
    </form>
</div>
@endsection
