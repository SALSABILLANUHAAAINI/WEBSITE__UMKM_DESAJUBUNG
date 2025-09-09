@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Produk</h1>

    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">UMKM</label>
            <select name="umkm_id" class="form-control" required>
                @foreach($umkms as $umkm)
                    <option value="{{ $umkm->id }}">{{ $umkm->nama_umkm }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Katalog</label>
            <select name="katalog_id" class="form-control" required>
                @foreach($katalogs as $katalog)
                    <option value="{{ $katalog->id }}">{{ $katalog->nama_katalog }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Produk</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
            <div id="preview" class="mt-2"></div>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const gambarInput = document.getElementById('gambar');
    const preview = document.getElementById('preview');

    gambarInput.addEventListener('change', function() {
        preview.innerHTML = '';
        if (this.files && this.files[0]) {
            const file = this.files[0];
            const reader = new FileReader();
            reader.onload = function(e){
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '150px';
                img.classList.add('img-thumbnail');
                preview.appendChild(img);
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
