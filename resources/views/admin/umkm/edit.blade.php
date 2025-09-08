@extends('admin.partials.sidebar')
@section('title', 'Edit UMKM')
@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/umkm/tambahumkm.css') }}">

<div class="umkm-container">
  <h1 class="title">Edit UMKM</h1>

  <form action="{{ route('admin.umkm.update', $umkm->id) }}" method="POST" enctype="multipart/form-data" class="umkm-form">
    @csrf
    @method('PUT') {{-- penting: agar route update jalan --}}

    <!-- Nama UMKM -->
    <div class="form-group">
      <label for="nama_umkm">Nama UMKM</label>
      <input type="text" id="nama_umkm" name="nama_umkm" class="form-input"
             value="{{ old('nama_umkm', $umkm->nama_umkm) }}" required>
    </div>

    <!-- Owner -->
    <div class="form-group">
      <label for="owner">Nama Pemilik</label>
      <input type="text" id="owner" name="owner" class="form-input"
             value="{{ old('owner', $umkm->owner) }}" required>
    </div>

    <!-- Upload Logo -->
    <div class="form-group">
      <label for="logo">Upload Logo</label>
      @if($umkm->logo)
        <div>
          <img src="{{ asset('storage/'.$umkm->logo) }}" alt="Logo" width="80">
        </div>
      @endif
      <input type="file" id="logo" name="logo" class="file-input">
    </div>

    <!-- Upload Gambar -->
    <div class="form-group">
      <label for="gambar">Upload Gambar</label>
      @if($umkm->gambar)
        <div>
          <img src="{{ asset('storage/'.$umkm->gambar) }}" alt="Gambar UMKM" width="150">
        </div>
      @endif
      <input type="file" id="gambar" name="gambar" class="file-input">
    </div>

    <!-- Deskripsi -->
    <div class="form-group">
      <label for="deskripsi">Deskripsi</label>
      <textarea id="deskripsi" name="deskripsi" class="form-input" rows="4">{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
    </div>

    <!-- Alamat -->
    <div class="form-group">
      <label for="alamat">Alamat</label>
      <textarea id="alamat" name="alamat" class="form-input" rows="2">{{ old('alamat', $umkm->alamat) }}</textarea>
    </div>

    <!-- Kontak -->
    <div class="form-group">
      <label for="kontak">Kontak</label>
      <input type="text" id="kontak" name="kontak" class="form-input"
             value="{{ old('kontak', $umkm->kontak) }}">
    </div>

    <!-- Link Maps -->
    <div class="form-group">
      <label for="gmaps">Link Google Maps</label>
      <input type="url" id="gmaps" name="gmaps" class="form-input"
             value="{{ old('gmaps', $umkm->gmaps) }}">
    </div>

    <!-- Social Media -->
    <div class="form-group">
      <label for="social">Sosial Media</label>
      <input type="url" id="social" name="social" class="form-input"
             value="{{ old('social', $umkm->social) }}">
    </div>

    <!-- Store Link -->
    <div class="form-group">
      <label for="store">Toko Offline</label>
      <input type="url" id="store" name="store" class="form-input"
             value="{{ old('store', $umkm->store) }}">
    </div>

    <!-- Tombol -->
    <div class="form-actions">
      <a href="{{ route('admin.umkm.index') }}" class="btn cancel">Batal</a>
      <button type="submit" class="btn submit">Update</button>
    </div>
  </form>
</div>

@endsection
