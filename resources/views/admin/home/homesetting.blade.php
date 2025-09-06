@extends('admin.partials.sidebar')
@section('title', 'Home Setting')
@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/homesetting.css') }}">

<div class="home-container">
  <h1 class="title">Home Setting</h1>

  @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
  @endif

  <form action="{{ route('admin.home.update') }}" method="POST" enctype="multipart/form-data" class="home-form">
    @csrf

    <!-- Judul Utama -->
    <div class="form-group">
      <label for="judul">Judul Utama</label>
      <input type="text" id="judul" name="judul" class="form-input"
             value="{{ old('judul', $home->judul ?? '') }}" required>
      @error('judul') <p class="error">{{ $message }}</p> @enderror
    </div>

    <!-- Subjudul -->
    <div class="form-group">
      <label for="subjudul">Subjudul / Tagline</label>
      <input type="text" id="subjudul" name="subjudul" class="form-input"
             value="{{ old('subjudul', $home->subjudul ?? '') }}">
      @error('subjudul') <p class="error">{{ $message }}</p> @enderror
    </div>

    <!-- Deskripsi -->
    <div class="form-group">
      <label for="deskripsi">Deskripsi Singkat</label>
      <textarea id="deskripsi" name="deskripsi" class="form-input" rows="4">{{ old('deskripsi', $home->deskripsi ?? '') }}</textarea>
      @error('deskripsi') <p class="error">{{ $message }}</p> @enderror
    </div>

    <!-- Highlight -->
    <div class="form-group">
      <label for="highlight">Highlight Teks</label>
      <input type="text" id="highlight" name="highlight" class="form-input"
             value="{{ old('highlight', $home->highlight ?? '') }}">
      @error('highlight') <p class="error">{{ $message }}</p> @enderror
    </div>

    <!-- Gambar Kiri -->
    <div class="form-group">
      <label for="gambar_kiri">Gambar Kiri</label>
      @if(isset($home->gambar_kiri))
        <img src="{{ asset('storage/'.$home->gambar_kiri) }}" width="150" class="mb-2">
      @endif
      <input type="file" id="gambar_kiri" name="gambar_kiri" class="file-input">
      @error('gambar_kiri') <p class="error">{{ $message }}</p> @enderror
    </div>

    <!-- Gambar Kanan -->
    <div class="form-group">
      <label for="gambar_kanan">Gambar Kanan</label>
      @if(isset($home->gambar_kanan))
        <img src="{{ asset('storage/'.$home->gambar_kanan) }}" width="150" class="mb-2">
      @endif
      <input type="file" id="gambar_kanan" name="gambar_kanan" class="file-input">
      @error('gambar_kanan') <p class="error">{{ $message }}</p> @enderror
    </div>

    <div class="form-actions">
      <button type="submit" class="btn submit">✅ Simpan</button>
      <a href="javascript:history.back()" class="btn cancel">❌ Batal</a>
    </div>
  </form>
</div>

<script>
  function handleDropArea(dropId, inputId) {
    const dropArea = document.getElementById(dropId);
    const fileInput = document.getElementById(inputId);

    dropArea.addEventListener("click", () => fileInput.click());

    dropArea.addEventListener("dragover", (e) => {
      e.preventDefault();
      dropArea.classList.add("dragover");
    });

    dropArea.addEventListener("dragleave", () => {
      dropArea.classList.remove("dragover");
    });

    dropArea.addEventListener("drop", (e) => {
      e.preventDefault();
      dropArea.classList.remove("dragover");
      fileInput.files = e.dataTransfer.files;
      dropArea.querySelector("p").textContent = fileInput.files[0].name;
    });

    fileInput.addEventListener("change", () => {
      if (fileInput.files.length > 0) {
        dropArea.querySelector("p").textContent = fileInput.files[0].name;
      }
    });
  }

  handleDropArea("drop-left", "gambar_kiri");
  handleDropArea("drop-right", "gambar_kanan");
</script>

@endsection
