@extends('layouts.app')

@section('title', 'Service UMKM Desa Jubung')

@section('content')
<section class="service-section">
    <link rel="stylesheet" href="{{ asset('css/user/service/service.css') }}">

    <!-- HEADER -->
    <div class="service-header">
        @if($settings && $settings->judul_hero)
            <h1 class="service-title">{{ $settings->judul_hero }}</h1>
            <p class="service-subtitle">{{ $settings->subjudul_hero }}</p>
        @else
            <h1 class="service-title">Service UMKM Desa Jubung</h1>
            <p class="service-subtitle">Silakan isi form berikut untuk mendaftarkan UMKM Anda.</p>
        @endif
    </div>

    <form action="{{ route('service.submit') }}" method="POST" class="service-form" enctype="multipart/form-data">
        @csrf

        <!-- Data UMKM -->
        <div class="form-block">
            <h2 class="block-title">1. Data UMKM</h2>
            <div class="grid-2">
                <div class="form-group">
                    <label>Nama UMKM*</label>
                    <input type="text" name="nama_umkm" value="{{ old('nama_umkm') }}" required>
                </div>
                <div class="form-group">
                    <label>Nama Pemilik / Penanggung Jawab*</label>
                    <input type="text" name="owner" value="{{ old('owner') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label>Alamat UMKM*</label>
                <textarea name="alamat" rows="2" required>{{ old('alamat') }}</textarea>
            </div>

            <div class="form-group">
                <label>Deskripsi UMKM*</label>
                <textarea name="deskripsi" rows="3" required>{{ old('deskripsi') }}</textarea>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label>Kontak / WhatsApp*</label>
                    <input type="text" name="kontak" value="{{ old('kontak') }}" required>
                </div>
                <div class="form-group">
                    <label>Gambar UMKM (maks 2MB)</label>
                    <input type="file" name="gambar" accept="image/png,image/jpeg">
                    <div class="single-preview">
                        <img src="{{ asset('images/dummy5.PNG') }}" class="thumb" alt="Gambar UMKM">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Link Google Maps</label>
                <input type="text" name="gmaps" value="{{ old('gmaps') }}">
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label>Sosial Media / Marketplace</label>
                    <input type="text" name="social" value="{{ old('social') }}">
                </div>
                <div class="form-group">
                    <label>Lokasi Penjualan Offline</label>
                    <input type="text" name="store" value="{{ old('store') }}">
                </div>
            </div>
        </div>

        <!-- Data Produk -->
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
                        <input type="file" name="product_images[0][]" multiple accept="image/png,image/jpeg" class="product-file-input">
                        <div class="preview-grid">
                            <img src="{{ asset('images/dummy5.PNG') }}" class="preview-thumb" alt="Produk">
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" id="addProduct" class="btn-add">Tambah Produk</button>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Kirim Data</button>
        </div>
    </form>
</section>

<style>
.single-preview img.thumb, .preview-grid img.preview-thumb {
    min-height: 170px;
    max-height: 204px;
    width: auto;
    object-fit: contain;
    display: block;
    margin: 0 auto;
}

.preview-grid { display:flex; gap:10px; flex-wrap:wrap; }
</style>

<script>
(() => {
    const MAX_SIZE = 2 * 1024 * 1024;
    const ALLOWED = ["image/jpeg","image/png"];

    // Preview gambar UMKM
    document.querySelectorAll('input[name="gambar"]').forEach(input => {
        input.addEventListener('change', e => {
            const file = e.target.files[0];
            const container = e.target.nextElementSibling;
            container.innerHTML = '';
            if(file && ALLOWED.includes(file.type) && file.size <= MAX_SIZE){
                const img = document.createElement('img');
                img.className='thumb';
                img.src=URL.createObjectURL(file);
                container.appendChild(img);
            } else {
                alert('Format harus JPG/PNG & ukuran maks 2MB');
                e.target.value='';
            }
        });
    });

    // Preview produk
    const attachPreview = input => {
        input.addEventListener('change', e => {
            const container = e.target.closest('.form-group').querySelector('.preview-grid');
            container.innerHTML='';
            Array.from(e.target.files).forEach(file => {
                const img=document.createElement('img');
                img.className='preview-thumb';
                img.src=URL.createObjectURL(file);
                container.appendChild(img);
            });
        });
    };
    document.querySelectorAll('.product-file-input').forEach(attachPreview);

    // Tambah produk dinamis
    const wrapper=document.getElementById('productWrapper');
    let index=1;
    document.getElementById('addProduct').addEventListener('click',()=>{
        const clone=wrapper.querySelector('.product-item').cloneNode(true);
        clone.querySelectorAll('input,textarea').forEach(el=>{
            if(el.name.includes('product_images')){
                el.name=`product_images[${index}][]`;
                el.value='';
                el.closest('.form-group').querySelector('.preview-grid').innerHTML=
                '<img src="{{ asset("images/dummy5.PNG") }}" class="preview-thumb" alt="Produk">';
            } else el.value='';
        });
        const btn=document.createElement('button');
        btn.type='button'; btn.textContent='×';
        btn.style.cssText="position:absolute;top:-10px;right:-10px;background:#000;color:#fff;border:none;border-radius:50%;width:24px;height:24px;cursor:pointer;";
        btn.addEventListener('click',()=>clone.remove());
        clone.style.position='relative';
        clone.appendChild(btn);
        wrapper.appendChild(clone);
        attachPreview(clone.querySelector('.product-file-input'));
        index++;
    });
})();
</script>
@endsection
