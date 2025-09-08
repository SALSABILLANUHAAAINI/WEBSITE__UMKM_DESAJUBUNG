@extends('admin.partials.sidebar')
@section('title', 'Tambah UMKM')
@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/umkm/tambahumkm.css') }}">

<div class="umkm-container">
  <h1 class="title">Tambah UMKM</h1>

  <form action="{{ route('admin.umkm.store') }}" method="POST" enctype="multipart/form-data" class="umkm-form">
    @csrf

    <!-- Nama UMKM -->
    <div class="form-group">
      <label for="nama_umkm">Nama UMKM</label>
      <input type="text" id="nama_umkm" name="nama_umkm" class="form-input @error('nama_umkm') is-invalid @enderror" placeholder="Masukkan nama UMKM" value="{{ old('nama_umkm') }}" required>
      @error('nama_umkm')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <!-- Owner -->
    <div class="form-group">
      <label for="owner">Nama Pemilik</label>
      <input type="text" id="owner" name="owner" class="form-input @error('owner') is-invalid @enderror" placeholder="Nama pemilik UMKM" value="{{ old('owner') }}" required>
      @error('owner')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <!-- Upload Logo -->
    <div class="form-group">
      <label for="logo">Upload Logo</label>
      <input type="file" id="logo" name="logo" class="file-input @error('logo') is-invalid @enderror">
      @error('logo')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <!-- Upload Gambar -->
    <div class="form-group">
      <label for="gambar">Upload Gambar</label>
      <input type="file" id="gambar" name="gambar" class="file-input @error('gambar') is-invalid @enderror">
      @error('gambar')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <!-- Deskripsi -->
    <div class="form-group">
      <label for="deskripsi">Deskripsi</label>
      <textarea id="deskripsi" name="deskripsi" class="form-input @error('deskripsi') is-invalid @enderror" rows="4" placeholder="Tulis deskripsi UMKM...">{{ old('deskripsi') }}</textarea>
      @error('deskripsi')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <!-- Alamat -->
    <div class="form-group">
      <label for="alamat">Alamat</label>
      <textarea id="alamat" name="alamat" class="form-input @error('alamat') is-invalid @enderror" rows="2" placeholder="Masukkan alamat UMKM...">{{ old('alamat') }}</textarea>
      @error('alamat')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <!-- Kontak -->
    <div class="form-group">
      <label for="kontak">Kontak</label>
      <input type="text" id="kontak" name="kontak" class="form-input @error('kontak') is-invalid @enderror" placeholder="Nomor HP / WhatsApp / Email" value="{{ old('kontak') }}">
      @error('kontak')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <!-- Link Maps -->
    <div class="form-group">
      <label for="gmaps">Link Google Maps</label>
      <input type="url" id="gmaps" name="gmaps" class="form-input @error('gmaps') is-invalid @enderror" placeholder="https://goo.gl/maps/..." value="{{ old('gmaps') }}">
      @error('gmaps')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <!-- Social Media -->
    <div class="form-group">
      <label for="social">Sosial Media</label>
      <input type="url" id="social" name="social" class="form-input @error('social') is-invalid @enderror" placeholder="https://instagram.com/..." value="{{ old('social') }}">
      @error('social')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <!-- Store Link -->
    <div class="form-group">
      <label for="store">Toko Offline</label>
      <input type="text" id="store" name="store" class="form-input @error('store') is-invalid @enderror" placeholder="https://shopee.co.id/..." value="{{ old('store') }}">
      @error('store')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <!-- Tombol -->
    <div class="form-actions">
      <a href="{{ route('admin.umkm.index') }}" class="btn cancel">Batal</a>
      <button type="submit" class="btn submit"> Simpan</button>
    </div>
  </form>
</div>

@endsection
