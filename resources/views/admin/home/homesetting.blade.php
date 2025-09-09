@extends('admin.partials.sidebar')
@section('title', 'Home Setting')
@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/homesetting.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

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
            <img id="preview-kiri"
                 src="{{ isset($home->gambar_kiri) ? asset('home_images/'.$home->gambar_kiri) : '' }}"
                 width="150" class="mb-2"
                 style="{{ isset($home->gambar_kiri) ? '' : 'display:none;' }}">

            <div id="drop-left" class="upload-box">
                <p>Klik atau drag gambar kiri</p>
            </div>
            <input type="file" id="gambar_kiri" name="gambar_kiri" class="file-input" style="display:none;">
            @error('gambar_kiri') <p class="error">{{ $message }}</p> @enderror
        </div>

        <!-- Gambar Kanan -->
        <div class="form-group">
            <label for="gambar_kanan">Gambar Kanan</label>
            <img id="preview-kanan"
                 src="{{ isset($home->gambar_kanan) ? asset('home_images/'.$home->gambar_kanan) : '' }}"
                 width="150" class="mb-2"
                 style="{{ isset($home->gambar_kanan) ? '' : 'display:none;' }}">

            <div id="drop-right" class="upload-box">
                <p>Klik atau drag gambar kanan</p>
            </div>
            <input type="file" id="gambar_kanan" name="gambar_kanan" class="file-input" style="display:none;">
            @error('gambar_kanan') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn submit">Simpan</button>
        </div>
    </form>
</div>

<script>
function handleDropArea(dropId, inputId, previewId) {
    const dropArea = document.getElementById(dropId);
    const fileInput = document.getElementById(inputId);
    const previewImg = document.getElementById(previewId);

    if(!dropArea) return;

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
        updatePreview(fileInput, previewImg, dropArea);
    });

    fileInput.addEventListener("change", () => {
        updatePreview(fileInput, previewImg, dropArea);
    });
}

function updatePreview(fileInput, previewImg, dropArea) {
    if (fileInput.files.length > 0) {
        const file = fileInput.files[0];
        dropArea.querySelector("p").textContent = file.name;
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.style.display = 'block';
            previewImg.src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
}

// Pasang handler untuk kiri dan kanan
handleDropArea("drop-left", "gambar_kiri", "preview-kiri");
handleDropArea("drop-right", "gambar_kanan", "preview-kanan");
</script>

@endsection
