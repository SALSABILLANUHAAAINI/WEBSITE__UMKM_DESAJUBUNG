@extends('layouts.app')

@section('title', 'Katalog UMKM Desa Jubung')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/user/katalog/index.css') }}">
@endsection

@section('content')
<div class="katalog-container">

    {{-- Judul --}}
    <h1 class="katalog-title">{{ $heroKatalog->hero ?? 'Explore Our Clients' }}</h1>

    {{-- Toolbar --}}
    <div class="katalog-toolbar">

        {{-- Dropdown kategori (server-side) --}}
        @php $selectedCategory = request('kategori') ?? 'all'; @endphp
        <div class="kategori-dropdown">
            <form method="GET" action="{{ route('katalog') }}">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <select name="kategori" class="katalog-select" onchange="this.form.submit()">
                    <option value="all" {{ $selectedCategory=='all'?'selected':'' }}>Semua</option>
                    @foreach($katalogs as $katalog)
                        @if($katalog->is_active)
                            <option value="{{ strtolower($katalog->name) }}" 
                                    {{ strtolower($katalog->name)==$selectedCategory?'selected':'' }}>
                                {{ $katalog->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </form>
        </div>

        {{-- Search (client-side) --}}
        <div class="katalog-search">
            <input type="text" id="katalogSearch" class="katalog-search-input"
                   placeholder="Cari produk...">
            <button type="button" class="katalog-search-clear" title="Bersihkan">×</button>
        </div>

    </div>

    {{-- Grid produk --}}
    <div class="katalog-grid">
        @forelse($products as $product)
            <div class="katalog-card"
                 data-nama="{{ $product->nama_produk }}"
                 data-harga="Rp {{ number_format($product->harga,0,',','.') }}"
                 data-toko="{{ $product->umkm->nama_umkm ?? '-' }}"
                 data-gambar="{{ $product->product_image ? asset($product->product_image) : asset('images/sample-produk.jpg') }}"
                 data-kategori="{{ strtolower($product->katalog->name ?? 'lainnya') }}"
                 data-deskripsi="{{ $product->deskripsi ?? 'Tidak ada deskripsi' }}">
                <img src="{{ $product->product_image ? asset($product->product_image) : asset('images/sample-produk.jpg') }}" 
                     alt="{{ $product->nama_produk }}">
                <div class="katalog-info">
                    <h3>{{ $product->nama_produk }}</h3>
                    <p class="produk-umkm">{{ $product->umkm->nama_umkm ?? '-' }}</p>
                    <p class="produk-harga">Rp {{ number_format($product->harga,0,',','.') }}</p>
                </div>
            </div>
        @empty
            <p class="text-center col-span-full">Belum ada produk yang tersedia saat ini.</p>
        @endforelse
    </div>

    {{-- Pagination (server-side) --}}
    <div class="pagination">
        {{ $products->appends(['kategori'=>request('kategori')])->links('vendor.pagination.custom') }}
    </div>

    {{-- Modal Produk --}}
    <div id="produkModal" class="modal">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <img id="modalImg" src="" alt="">
            <h2 id="modalNama"></h2>
            <p id="modalHarga"></p>
            <p id="modalToko"></p>
            <p id="modalDeskripsi"></p>
        </div>
    </div>

    {{-- Script: live search + modal --}}
    <script>
    document.addEventListener('DOMContentLoaded', function(){
        const input = document.getElementById('katalogSearch');
        const clearBtn = document.querySelector('.katalog-search-clear');
        const cards = document.querySelectorAll('.katalog-grid .katalog-card');

        function filterProducts() {
            const query = input.value.trim().toLowerCase();
            cards.forEach(card => {
                const title = card.dataset.nama.toLowerCase();
                card.style.display = title.includes(query) ? '' : 'none';
            });
            clearBtn.style.display = query ? 'inline' : 'none';
        }

        input.addEventListener('input', filterProducts);
        clearBtn.addEventListener('click', () => {
            input.value = '';
            filterProducts();
            input.focus();
        });

        // Modal
        const modal = document.getElementById('produkModal');
        const modalImg = document.getElementById('modalImg');
        const modalNama = document.getElementById('modalNama');
        const modalHarga = document.getElementById('modalHarga');
        const modalToko = document.getElementById('modalToko');
        const modalDeskripsi = document.getElementById('modalDeskripsi');
        const closeBtn = document.querySelector('.modal-close');

        cards.forEach(card => {
            card.addEventListener('click', () => {
                modalImg.src = card.dataset.gambar;
                modalNama.textContent = card.dataset.nama;
                modalHarga.textContent = "Harga: " + card.dataset.harga;
                modalToko.textContent = "Toko: " + card.dataset.toko;
                modalDeskripsi.textContent = card.dataset.deskripsi;
                modal.style.display = 'flex';
            });
        });

        closeBtn.addEventListener('click', () => modal.style.display = 'none');
        window.addEventListener('click', e => { if(e.target === modal) modal.style.display = 'none'; });
    });
    </script>

</div>
@endsection
