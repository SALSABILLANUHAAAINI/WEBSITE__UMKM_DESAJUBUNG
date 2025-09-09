@extends('admin.partials.sidebar')
@section('title', 'Edit Produk')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/produk/produk.css') }}">

<div class="produk-container">
    <h1 class="produk-title">Edit Produk</h1>

    <form action="{{ route('admin.product.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" value="{{ $product->nama_produk }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" value="{{ $product->harga }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $product->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label>UMKM</label>
            <select name="umkm_id" class="form-control" required>
                @foreach($umkms as $umkm)
                    <option value="{{ $umkm->id }}" @if($umkm->id == $product->umkm_id) selected @endif>
                        {{ $umkm->nama_umkm }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Katalog</label>
            <select name="katalog_id" class="form-control" required>
                @foreach($katalogs as $k)
                    <option value="{{ $k->id }}" @if($k->id == $product->katalog_id) selected @endif>
                        {{ $k->nama_katalog }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Gambar Produk</label><br>
            @if($product->product_image)
                <img src="{{ asset('storage/'.$product->product_image) }}" width="120" class="mb-2"><br>
            @endif
            <input type="file" name="product_image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn add">Update</button>
        <a href="{{ route('admin.product.index') }}" class="btn edit">Batal</a>
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
