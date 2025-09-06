@extends('admin.partials.sidebar')

@section('title', 'Tentang Kami Setting')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/tentang.css') }}">

<h1 class="title-page">Tentang Kami - Admin Setting</h1>

<form action="{{ route('admin.tentang.update') }}" method="POST" enctype="multipart/form-data" class="form-tentang">
    @csrf

    <!-- Hero Section -->
    <div class="form-group">
        <label for="hero">Hero Section</label>
        <input type="text" id="hero" name="hero" value="{{ old('hero', $tentang->hero ?? '') }}" required>
    </div>

    <!-- Upload Gambar 1 -->
    <div class="form-group">
        <label for="image1">Gambar 1</label>
        <input type="file" id="image1" name="image1" accept="image/*">
        @if(isset($tentang->image1))
            <div class="preview-image">
                <img id="preview1" src="{{ asset('storage/'.$tentang->image1) }}" alt="Gambar 1" width="150">
            </div>
        @else
            <div class="preview-image">
                <img id="preview1" src="" alt="" width="150" style="display:none;">
            </div>
        @endif
    </div>

    <!-- Upload Gambar 2 -->
    <div class="form-group">
        <label for="image2">Gambar 2</label>
        <input type="file" id="image2" name="image2" accept="image/*">
        @if(isset($tentang->image2))
            <div class="preview-image">
                <img id="preview2" src="{{ asset('storage/'.$tentang->image2) }}" alt="Gambar 2" width="150">
            </div>
        @else
            <div class="preview-image">
                <img id="preview2" src="" alt="" width="150" style="display:none;">
            </div>
        @endif
    </div>

    <!-- Judul 1 & Deskripsi 1 -->
    <div class="form-group">
        <label for="title1">Judul 1</label>
        <input type="text" id="title1" name="title1" value="{{ old('title1', $tentang->title1 ?? '') }}">
    </div>
    <div class="form-group">
        <label for="desc1">Deskripsi 1</label>
        <textarea id="desc1" name="desc1" rows="4" required>{{ old('desc1', $tentang->desc1 ?? '') }}</textarea>
    </div>

    <!-- Judul 2 & Deskripsi 2 -->
    <div class="form-group">
        <label for="title2">Judul 2</label>
        <input type="text" id="title2" name="title2" value="{{ old('title2', $tentang->title2 ?? '') }}">
    </div>
    <div class="form-group">
        <label for="desc2">Deskripsi 2</label>
        <textarea id="desc2" name="desc2" rows="4">{{ old('desc2', $tentang->desc2 ?? '') }}</textarea>
    </div>

    <!-- Judul 3 & Deskripsi Website -->
    <div class="form-group">
        <label for="title3">Judul 3</label>
        <input type="text" id="title3" name="title3" value="{{ old('title3', $tentang->title3 ?? '') }}">
    </div>
    <div class="form-group">
        <label for="webdesc">Deskripsi Website</label>
        <textarea id="webdesc" name="webdesc" rows="3">{{ old('webdesc', $tentang->webdesc ?? '') }}</textarea>
    </div>

    <!-- Tombol Submit -->
    <div class="form-actions">
        <button type="submit" class="btn-submit">Simpan Data</button>
    </div>
</form>

<!-- Script Preview Gambar -->
<script>
    function readURL(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById(previewId);
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.getElementById('image1').addEventListener('change', function() {
        readURL(this, 'preview1');
    });
    document.getElementById('image2').addEventListener('change', function() {
        readURL(this, 'preview2');
    });
</script>
@endsection
