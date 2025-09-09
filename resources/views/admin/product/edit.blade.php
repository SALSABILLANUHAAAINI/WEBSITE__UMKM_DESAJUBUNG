@extends('admin.partials.sidebar')
@section('title', 'Edit Produk')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/produk/tambahProduk.css') }}">
@endsection

@section('content')
<div class="produk-form-container">
    <h1 class="title">Edit Produk</h1>

    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="produk-form">
        @csrf
        @method('PUT')

        <label for="nama_produk">Nama Produk</label>
        <input type="text" name="nama_produk" id="nama_produk" value="{{ $product->nama_produk }}" required>

        <label for="harga">Harga</label>
        <input type="number" name="harga" id="harga" value="{{ $product->harga }}" required>

        <label for="umkm_id">UMKM</label>
        <select name="umkm_id" id="umkm_id" required>
            @foreach($umkms as $umkm)
                <option value="{{ $umkm->id }}" {{ $umkm->id == $product->umkm_id ? 'selected' : '' }}>
                    {{ $umkm->nama_umkm }}
                </option>
            @endforeach
        </select>

        <label for="katalog_id">Katalog</label>
        <select name="katalog_id" id="katalog_id" required>
            @foreach($katalogs as $katalog)
                <option value="{{ $katalog->id }}" {{ $katalog->id == $product->katalog_id ? 'selected' : '' }}>
                    {{ $katalog->name }}
                </option>
            @endforeach
        </select>

        <label for="deskripsi">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi">{{ $product->deskripsi }}</textarea>

        <label for="gambar">Gambar Produk</label>
        @if($product->product_image)
            <div style="margin-bottom: 1rem;">
                <img src="{{ asset('storage/'.$product->product_image) }}" alt="{{ $product->nama_produk }}" style="max-width: 200px;">
            </div>
        @endif
        <input type="file" name="gambar" id="gambar">

        <button type="submit" class="btn edit">Update</button>
    </form>
</div>
@endsection
