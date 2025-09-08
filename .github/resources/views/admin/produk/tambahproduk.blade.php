@extends('admin.partials.sidebar')
@section('title', 'Tambah Produk')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/produk/tambahProduk.css') }}">
<style>
#preview img {
    max-width: 150px;
    margin-top: 10px;
}
#drop-area {
    border: 2px dashed #ccc;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    border-radius: 8px;
    transition: background 0.3s;
}
#drop-area:hover {
    background: #f9f9f9;
}
</style>
@endsection

@section('content')
<div class="produk-container">
    <h1 class="title">Tambah Produk</h1>

    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data" class="produk-form">
        @csrf

        <div class="form-group">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" id="nama_produk" name="nama_produk" class="form-input"
                   placeholder="Masukkan nama produk" value="{{ old('nama_produk') }}" required>
        </div>

        <div class="form-group">
            <label for="harga">Harga Produk</label>
            <input type="number" id="harga" name="harga" class="form-input"
                   placeholder="Masukkan harga produk" value="{{ old('harga') }}" required>
        </div>

        <div class="form-group">
            <label for="umkm_id">Pilih UMKM</label>
            <select id="umkm_id" name="umkm_id" class="form-input" required>
                <option value="">-- Pilih UMKM --</option>
                @foreach($umkms as $umkm)
                    <option value="{{ $umkm->id }}" {{ old('umkm_id') == $umkm->id ? 'selected' : '' }}>
                        {{ $umkm->nama_umkm }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="katalog_id">Pilih Kategori</label>
            <select id="katalog_id" name="katalog_id" class="form-input" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($katalogs as $katalog)
                    <option value="{{ $katalog->id }}" {{ old('katalog_id') == $katalog->id ? 'selected' : '' }}>
                        {{ $katalog->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi Produk</label>
            <textarea id="deskripsi" name="deskripsi" class="form-input" rows="4"
                      placeholder="Tulis deskripsi produk...">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="form-group">
            <label for="gambar">Upload Gambar</label>
            <div class="upload-box" id="drop-area" onclick="document.getElementById('gambar').click()">
                <p id="drop-text">Drag & drop untuk upload<br>atau klik untuk pilih</p>
                <input type="file" id="gambar" name="gambar" class="file-input" accept="image/*">
                <div id="preview"></div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn submit">✅ Simpan</button>
            <a href="{{ route('admin.produk.index') }}" class="btn cancel">❌ Batal</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
const gambarInput = document.getElementById('gambar');
const preview = document.getElementById('preview');
const dropText = document.getElementById('drop-text');

gambarInput.addEventListener('change', function() {
    preview.innerHTML = '';
    if(this.files && this.files[0]){
        const file = this.files[0];
        const info = document.createElement('p');
        info.textContent = 'File dipilih: ' + file.name;
        preview.appendChild(info);

        const reader = new FileReader();
        reader.onload = function(e){
            const img = document.createElement('img');
            img.src = e.target.result;
            preview.appendChild(img);
        }
        reader.readAsDataURL(file);
        dropText.style.display = 'none';
    } else {
        dropText.style.display = 'block';
    }
});
</script>
@endsection
