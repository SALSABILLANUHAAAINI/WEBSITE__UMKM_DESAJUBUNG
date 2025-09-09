@extends('admin.partials.sidebar')
@section('title', 'Tambah Produk')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/produk/tambahproduk.css') }}">

<div class="produk-container">
    <h1 class="produk-title">Tambah Produk</h1>

    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>UMKM</label>
            <select name="umkm_id" class="form-control" required>
                @foreach($umkms as $umkm)
                    <option value="{{ $umkm->id }}">{{ $umkm->nama_umkm }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Katalog</label>
            <select name="katalog_id" class="form-control" required>
                @foreach($katalogs as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_katalog }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Gambar Produk</label>
            <input type="file" name="product_image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn add">Simpan</button>
        <a href="{{ route('admin.product.index') }}" class="btn edit">Batal</a>
    </form>
</div>
@endsection
