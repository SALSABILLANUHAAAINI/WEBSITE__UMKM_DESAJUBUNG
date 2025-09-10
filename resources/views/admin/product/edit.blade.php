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
        <div class="upload-box" id="drop-area" onclick="document.getElementById('gambar').click()">
            <p id="drop-text">Drag & drop untuk upload<br>atau klik untuk pilih</p>
            <input type="file" name="gambar" id="gambar" class="file-input" accept="image/*">
            <div id="preview" style="margin-top:10px;">
                @if($product->product_image)
                    <img src="{{ asset($product->product_image) }}" style="max-width:200px;">
                @endif
            </div>
        </div>

        <button type="submit" class="btn edit" style="margin-top:1rem;">Update</button>
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
