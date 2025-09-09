@extends('admin.partials.sidebar')
@section('title', 'Edit Produk')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/produk/tambahProduk.css') }}">
@endsection

@section('content')
<div class="produk-container">
    <h1 class="title">Edit Produk</h1>

    <form action="{{ route('admin.product.update', $product) }}" method="POST" enctype="multipart/form-data" class="produk-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" id="nama_produk" name="nama_produk" class="form-input"
                   value="{{ old('nama_produk', $product->nama_produk) }}" required>
        </div>

        <div class="form-group">
            <label for="harga">Harga Produk</label>
            <input type="number" id="harga" name="harga" class="form-input"
                   value="{{ old('harga', $product->harga) }}" required>
        </div>

        <div class="form-group">
            <label for="umkm_id">Pilih UMKM</label>
            <select id="umkm_id" name="umkm_id" class="form-input" required>
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
                @foreach($katalogs as $katalog)
                    <option value="{{ $katalog->id }}" {{ (old('katalog_id', $product->katalog_id) == $katalog->id) ? 'selected' : '' }}>
                        {{ $katalog->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group full-width">
            <label for="deskripsi">Deskripsi Produk</label>
            <textarea id="deskripsi" name="deskripsi" class="form-input" rows="4">{{ old('deskripsi', $product->deskripsi) }}</textarea>
        </div>

        <div class="form-group full-width">
            <label for="gambar">Upload Gambar (Kosongkan jika tidak ingin diubah)</label>
            <div id="preview" style="margin-bottom: 10px;">
                @if($product->product_image)
                    <img src="{{ asset('storage/'.$product->product_image) }}" alt="Gambar saat ini" style="max-width: 200px;">
                @endif
            </div>
            <input type="file" id="gambar" name="gambar" class="form-input" accept="image/*">
        </div>

        <div class="form-actions full-width">
            <a href="{{ route('admin.product.index') }}" class="btn cancel">Batal</a>
            <button type="submit" class="btn submit">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const gambarInput = document.getElementById('gambar');
    const previewContainer = document.getElementById('preview');
    // Simpan HTML asli dari kontainer preview saat halaman dimuat
    const originalPreviewHTML = previewContainer.innerHTML;

    gambarInput.addEventListener('change', function(event) {
        const file = event.target.files[0];

        if (file) {
            // Jika ada file baru yang dipilih, buat dan tampilkan preview-nya
            const reader = new FileReader();
            reader.onload = function(e) {
                // Hapus preview lama dan tampilkan yang baru
                previewContainer.innerHTML = `<img src="${e.target.result}" alt="Preview Gambar Baru" style="max-width: 200px;">`;
            }
            reader.readAsDataURL(file);
        } else {
            // Jika pemilihan file dibatalkan (input kosong),
            // kembalikan ke gambar asli yang ada saat halaman pertama kali dimuat.
            previewContainer.innerHTML = originalPreviewHTML;
        }
    });
</script>
@endsection