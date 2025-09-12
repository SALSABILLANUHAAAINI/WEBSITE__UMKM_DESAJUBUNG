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
                    <input type="text" name="nama_umkm" value="{{ old('nama_umkm') }}" required placeholder="Masukkan nama UMKM">
                </div>
                <div class="form-group">
                    <label>Nama Pemilik / Penanggung Jawab*</label>
                    <input type="text" name="owner" value="{{ old('owner') }}" required placeholder="Masukkan nama pemilik">
                </div>
            </div>

            <div class="form-group">
                <label>Alamat UMKM*</label>
                <textarea name="alamat" rows="2" required placeholder="Contoh: Jalan Raya No.10, Desa Jubung">{{ old('alamat') }}</textarea>
            </div>

            <div class="form-group">
                <label>Deskripsi UMKM*</label>
                <textarea name="deskripsi" rows="3" required placeholder="Tuliskan deskripsi singkat UMKM">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label>Kontak / WhatsApp*</label>
                    <input type="text" name="kontak" value="{{ old('kontak') }}" required placeholder="Contoh: 08123456789">
                </div>
                <div class="form-group upload-area">
                    <label>Gambar UMKM (maks 2MB, JPG/PNG)</label>
                    <input type="file" name="gambar" accept="image/png,image/jpeg">
                    <div class="single-preview"></div>
                </div>
            </div>

            <div class="form-group">
                <label>Link Google Maps</label>
                <input type="text" name="gmaps" value="{{ old('gmaps') }}"
                    placeholder="Masukkan URL Google Maps, misal: https://goo.gl/maps/xxxx">
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label>Sosial Media / Marketplace</label>
                    <input type="text" name="social" value="{{ old('social') }}"
                        placeholder="Contoh: https://instagram.com/nama_umkm atau https://shopee.co.id/nama_toko">
                </div>
                <div class="form-group">
                    <label>Lokasi Penjualan Offline</label>
                    <input type="text" name="store" value="{{ old('store') }}"
                        placeholder="Contoh: Jalan Raya No. 10, Desa Jubung">
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
                        <input type="text" name="product[]" required placeholder="Nama produk">
                    </div>
                    <div class="form-group">
                        <label>Harga Produk*</label>
                        <input type="text" name="price[]" required placeholder="Harga, misal: 25000">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Produk*</label>
                        <textarea name="description[]" rows="3" required placeholder="Deskripsi produk">{{ old('description.0') }}</textarea>
                    </div>
                    <div class="form-group upload-area">
                        <label>Foto Produk (maks 2MB, JPG/PNG)</label>
                        <input type="file" name="product_images[0][]" multiple accept="image/png,image/jpeg" class="product-file-input">
                        <div class="preview-grid"></div>
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

<script>
(() => {
    const MAX_SIZE = 2 * 1024 * 1024;
    const ALLOWED = ["image/jpeg","image/png"];

    // Preview gambar UMKM
    document.querySelectorAll('input[name="gambar"]').forEach(input => {
        input.addEventListener('change', e => {
            const file = e.target.files[0];
            const container = e.target.closest('.upload-area').querySelector('.single-preview');
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
            const container = e.target.closest('.upload-area').querySelector('.preview-grid');
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
                el.closest('.upload-area').querySelector('.preview-grid').innerHTML='';
            } else el.value='';
        });
        const btn=document.createElement('button');
        btn.type='button'; btn.textContent='×';
        btn.className='remove-btn';
        btn.addEventListener('click',()=>clone.remove());
        clone.style.position='relative';
        clone.appendChild(btn);
        wrapper.appendChild(clone);
        attachPreview(clone.querySelector('.product-file-input'));
        index++;
    });

    // 🔹 Cek produk kosong sebelum submit
    document.querySelector('.service-form').addEventListener('submit', e => {
        const items = document.querySelectorAll('#productWrapper .product-item');
        items.forEach(item => {
            const name = item.querySelector('input[name^="product"]').value.trim();
            const price = item.querySelector('input[name^="price"]').value.trim();
            const desc = item.querySelector('textarea[name^="description"]').value.trim();

            // kalau semua kosong, hapus block produk
            if(!name && !price && !desc){
                item.remove();
            }
        });
    });
})();
</script>
@endsection
