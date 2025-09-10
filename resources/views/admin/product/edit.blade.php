@extends('admin.partials.sidebar')
@section('title', 'Edit Produk')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/produk/tambahProduk.css') }}">
@endsection

@section('content')
<div class="produk-container">
    <h1 class="title">Edit Produk</h1>

    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="produk-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" id="nama_produk" name="nama_produk" class="form-input"
                   placeholder="Masukkan nama produk" value="{{ old('nama_produk', $product->nama_produk) }}" required>
        </div>

        <div class="form-group">
            <label for="harga">Harga Produk</label>
            <input type="number" id="harga" name="harga" class="form-input"
                   placeholder="Masukkan harga produk" value="{{ old('harga', $product->harga) }}" required>
        </div>

        <div class="form-group">
            <label for="umkm_id">Pilih UMKM</label>
            <select id="umkm_id" name="umkm_id" class="form-input" required>
                <option value="">-- Pilih UMKM --</option>
                @foreach($umkms as $umkm)
                    <option value="{{ $umkm->id }}" {{ (old('umkm_id', $product->umkm_id) == $umkm->id) ? 'selected' : '' }}>
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
                    <option value="{{ $katalog->id }}" {{ (old('katalog_id', $product->katalog_id) == $katalog->id) ? 'selected' : '' }}>
                        {{ $katalog->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group full-width">
            <label for="deskripsi">Deskripsi Produk</label>
            <textarea id="deskripsi" name="deskripsi" class="form-input" rows="4"
                      placeholder="Tulis deskripsi produk...">{{ old('deskripsi', $product->deskripsi) }}</textarea>
        </div>

        <div class="form-group full-width">
            <label for="gambar">Upload Gambar</label>
            <div class="upload-box" id="drop-area" onclick="document.getElementById('gambar').click()">
                <p id="drop-text">Drag & drop untuk upload<br>atau klik untuk pilih</p>
                <input type="file" id="gambar" name="gambar" class="file-input" accept="image/*">
                <div id="preview" style="margin-top:10px;">
                    @if($product->product_image)
                        <img src="{{ asset($product->product_image) }}" style="max-width:200px;">
                    @endif
                </div>
            </div>
        </div>

        <div class="form-actions full-width">
            <a href="{{ route('admin.product.index') }}" class="btn cancel">Batal</a>
            <button type="submit" class="btn submit">Update</button>
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
            img.style.maxWidth = '150px';
            img.style.marginTop = '10px';
            preview.appendChild(img);
        }
        reader.readAsDataURL(file);
        dropText.style.display = 'none';
    } else {
        dropText.style.display = 'block';
        @if($product->product_image)
            const img = document.createElement('img');
            img.src = "{{ asset($product->product_image) }}";
            img.style.maxWidth = '200px';
            preview.appendChild(img);
        @endif
    }
});
</script>
@endsection
