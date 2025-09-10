@extends('layouts.app')

@section('title', 'Service UMKM Desa Jubung')

@section('content')
<section class="service-section">
    <link rel="stylesheet" href="{{ asset('css/user/service/service.css') }}">

    <!-- HEADER -->
    <div class="service-header">
        @if($settings)
            <h1 class="service-title">{{ $settings->judul_hero }}</h1>
            <p class="service-subtitle">{{ $settings->subjudul_hero }}</p>
        @else
            <h1 class="service-title">Service UMKM Desa Jubung</h1>
            <p class="service-subtitle">Silakan isi form berikut untuk mendaftarkan UMKM Anda.</p>
        @endif
    </div>

    <!-- FORM -->
    <form action="{{ route('service.submit') }}" method="POST" class="service-form" enctype="multipart/form-data" id="serviceForm">
        @csrf

        <!-- 1. Data UMKM -->
        <div class="form-block">
            <h2 class="block-title">1. Data UMKM</h2>
            <div class="grid-2">
                <div class="form-group">
                    <label for="brand">Nama UMKM*</label>
                    <input type="text" id="brand" name="nama_umkm" value="{{ old('nama_umkm') }}" required>
                </div>
                <div class="form-group">
                    <label for="owner">Nama Pemilik / Penanggung Jawab*</label>
                    <input type="text" id="owner" name="owner" value="{{ old('owner') }}" required>
                </div>
            </div>
            <div class="form-group">
                <label for="address">Alamat UMKM*</label>
                <textarea id="address" name="alamat" rows="2" required>{{ old('alamat') }}</textarea>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi UMKM*</label>
                <textarea id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi') }}</textarea>
            </div>
            <div class="grid-2">
                <div class="form-group">
                    <label for="phone">Kontak / WhatsApp*</label>
                    <input type="text" id="phone" name="kontak" value="{{ old('kontak') }}" required>
                </div>
                <div class="form-group">
                    <label for="umkm_logo">Logo UMKM (JPEG/PNG, maks 2MB)</label>
                    <input type="file" id="umkm_logo" name="logo" accept="image/png,image/jpeg,image/jpg">
                    <div class="single-preview" id="umkmLogoPreview">
                        <img src="{{ isset($umkm) && $umkm->logo 
                            ? asset('umkm_logos/' . basename($umkm->logo)) 
                            : asset('images/dummy5.PNG') }}" 
                            alt="{{ $umkm->nama_umkm ?? 'Logo UMKM' }}" class="thumb">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="gmaps">Link Google Maps (opsional)</label>
                <input type="text" id="gmaps" name="gmaps" value="{{ old('gmaps') }}">
            </div>
            <div class="grid-2">
                <div class="form-group">
                    <label for="social">Sosial Media / Marketplace</label>
                    <input type="text" id="social" name="social" value="{{ old('social') }}">
                </div>
                <div class="form-group">
                    <label for="store">Lokasi Penjualan Offline</label>
                    <input type="text" id="store" name="store" value="{{ old('store') }}">
                </div>
            </div>
        </div>

        <!-- 2. Data Produk -->
        <div class="form-block">
            <h2 class="block-title">2. Data Produk</h2>
            <div id="productWrapper">
                <div class="grid-2 product-item" style="position:relative;">
                    <div class="form-group">
                        <label>Nama Produk*</label>
                        <input type="text" name="product[]" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Produk*</label>
                        <input type="text" name="price[]" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Produk*</label>
                        <textarea name="description[]" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Foto Produk</label>
                        <input type="file" name="product_images[0][]" multiple accept="image/png,image/jpeg,image/jpg">
                        <div class="preview-grid">
                            <img src="{{ asset('images/dummy5.PNG') }}" alt="Produk">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="addProduct" class="btn-add">Tambah Produk</button>
        </div>

        <!-- Submit -->
        <div class="form-actions">
            <button type="submit" class="btn-submit">Kirim Data</button>
        </div>
    </form>
</section>

<!-- JS Preview & Produk Dinamis -->
<script>
(() => {
    const MAX_SIZE = 2 * 1024 * 1024;
    const ALLOWED = ["image/jpeg","image/png","image/jpg"];

    const umkmLogoInput = document.getElementById('umkm_logo');
    const umkmLogoPreview = document.getElementById('umkmLogoPreview');
    if(umkmLogoInput){
        umkmLogoInput.addEventListener('change', () => {
            umkmLogoPreview.innerHTML = '';
            const file = umkmLogoInput.files[0];
            if(!file) return;
            if(!ALLOWED.includes(file.type) || file.size > MAX_SIZE){
                alert('Format harus JPG/PNG dan ukuran maks 2MB.');
                umkmLogoInput.value='';
                return;
            }
            const img = document.createElement('img');
            img.className = 'thumb';
            img.src = URL.createObjectURL(file);
            umkmLogoPreview.appendChild(img);
        });
    }

    const productWrapper = document.getElementById('productWrapper');
    const addProductBtn = document.getElementById('addProduct');
    let productIndex = 1;

    addProductBtn.addEventListener('click', ()=>{
        const firstProduct = document.querySelector('.product-item');
        const template = firstProduct.cloneNode(true);

        const inputs = template.querySelectorAll('input,textarea');
        inputs.forEach(input => {
            if(input.name.includes('product_images')) {
                input.name = `product_images[${productIndex}][]`;
                input.value = '';
                template.querySelector('.preview-grid').innerHTML = '<img src="{{ asset("images/dummy5.PNG") }}" alt="Produk">';
            } else {
                input.value = '';
            }
        });

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'remove-btn';
        removeBtn.textContent = '×';
        removeBtn.style.cssText = "position:absolute;top:-10px;right:-10px;background:#000;color:#fff;border:none;border-radius:50%;width:24px;height:24px;cursor:pointer;";
        removeBtn.addEventListener('click', ()=> template.remove());
        template.style.position = "relative";
        template.appendChild(removeBtn);

        productWrapper.prepend(template);
        productIndex++;
    });
})();
</script>
@endsection
