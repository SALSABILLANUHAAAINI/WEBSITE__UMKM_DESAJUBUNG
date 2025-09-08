@extends('admin.partials.sidebar')
@section('title', 'Tentang Kami Setting')
@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/tentang.css') }}">

<div class="tentang-container">
    <h1 class="title-page">Tentang Kami - Admin Setting</h1>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.tentang.update') }}" method="POST" enctype="multipart/form-data" class="home-form">
        @csrf

        <!-- Hero Section -->
        <div class="form-group">
            <label for="hero">Hero Section</label>
            <input type="text" id="hero" name="hero" class="form-input"
                   value="{{ old('hero', $tentang->hero ?? '') }}" required>
            @error('hero') <p class="error">{{ $message }}</p> @enderror
        </div>

        <!-- Gambar 1 -->
        <div class="form-group">
            <label for="image1">Gambar 1</label>
            <img id="preview1"
                src="{{ isset($tentang->image1) ? asset('storage/'.$tentang->image1) : '' }}"
                width="150" class="mb-2"
                style="{{ isset($tentang->image1) ? '' : 'display:none;' }}">

            <div id="drop1" class="upload-box">
                <p>Klik atau drag gambar 1</p>
            </div>
            <input type="file" id="image1" name="image1" class="file-input" style="display:none;">
            @error('image1') <p class="error">{{ $message }}</p> @enderror
        </div>

        <!-- Gambar 2 -->
        <div class="form-group">
            <label for="image2">Gambar 2</label>
            <img id="preview2"
                src="{{ isset($tentang->image2) ? asset('storage/'.$tentang->image2) : '' }}"
                width="150" class="mb-2"
                style="{{ isset($tentang->image2) ? '' : 'display:none;' }}">

            <div id="drop2" class="upload-box">
                <p>Klik atau drag gambar 2</p>
            </div>
            <input type="file" id="image2" name="image2" class="file-input" style="display:none;">
            @error('image2') <p class="error">{{ $message }}</p> @enderror
        </div>

        <!-- Judul & Deskripsi 1 -->
        <div class="form-group">
            <label for="title1">Judul 1</label>
            <input type="text" id="title1" name="title1" class="form-input"
                   value="{{ old('title1', $tentang->title1 ?? '') }}">
        </div>
        <div class="form-group">
            <label for="desc1">Deskripsi 1</label>
            <textarea id="desc1" name="desc1" class="form-input" rows="4" required>{{ old('desc1', $tentang->desc1 ?? '') }}</textarea>
        </div>

        <!-- Judul & Deskripsi 2 -->
        <div class="form-group">
            <label for="title2">Judul 2</label>
            <input type="text" id="title2" name="title2" class="form-input"
                   value="{{ old('title2', $tentang->title2 ?? '') }}">
        </div>
        <div class="form-group">
            <label for="desc2">Deskripsi 2</label>
            <textarea id="desc2" name="desc2" class="form-input" rows="4">{{ old('desc2', $tentang->desc2 ?? '') }}</textarea>
        </div>

        <!-- Judul & Deskripsi Website -->
        <div class="form-group">
            <label for="title3">Judul 3</label>
            <input type="text" id="title3" name="title3" class="form-input"
                   value="{{ old('title3', $tentang->title3 ?? '') }}">
        </div>
        <div class="form-group">
            <label for="webdesc">Deskripsi Website</label>
            <textarea id="webdesc" name="webdesc" class="form-input" rows="3">{{ old('webdesc', $tentang->webdesc ?? '') }}</textarea>
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

handleDropArea("drop1", "image1", "preview1");
handleDropArea("drop2", "image2", "preview2");
</script>

@endsection
