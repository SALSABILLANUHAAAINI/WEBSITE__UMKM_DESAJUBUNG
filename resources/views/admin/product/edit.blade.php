@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Produk</h1>

    <form action="{{ route('admin.product.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" 
                   value="{{ $product->nama_produk }}" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" 
                   value="{{ $product->harga }}" required>
        </div>

        <div class="mb-3">
            <label for="umkm_id" class="form-label">UMKM</label>
            <select name="umkm_id" class="form-control" required>
                @foreach($umkms as $umkm)
                    <option value="{{ $umkm->id }}" {{ $umkm->id == $product->umkm_id ? 'selected' : '' }}>
                        {{ $umkm->nama_umkm }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="katalog_id" class="form-label">Katalog</label>
            <select name="katalog_id" class="form-control" required>
                @foreach($katalogs as $katalog)
                    <option value="{{ $katalog->id }}" {{ $katalog->id == $product->katalog_id ? 'selected' : '' }}>
                        {{ $katalog->nama_katalog }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Produk</label><br>
            <div id="preview">
                <img src="{{ asset('storage/'.$product->product_image) }}" 
                     alt="{{ $product->nama_produk }}" 
                     width="120" class="img-thumbnail mb-2">
            </div>
            <input type="file" name="gambar" id="gambar" class="form-control">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $product->deskripsi }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const gambarInput = document.getElementById('gambar');
    const previewContainer = document.getElementById('preview');
    const originalPreviewHTML = previewContainer.innerHTML;

    gambarInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewContainer.innerHTML = `<img src="${e.target.result}" 
                                               alt="Preview Gambar Baru" 
                                               style="max-width: 200px;" class="img-thumbnail">`;
            }
            reader.readAsDataURL(file);
        } else {
            previewContainer.innerHTML = originalPreviewHTML;
        }
    });
</script>
@endsection
