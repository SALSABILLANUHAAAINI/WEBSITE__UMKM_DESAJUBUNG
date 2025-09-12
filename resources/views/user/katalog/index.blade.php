@extends('layouts.app')

@section('title', 'Katalog UMKM Desa Jubung')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/user/katalog/index.css') }}">
@endsection

@section('content')
<div class="katalog-container">

    {{-- Judul --}}
    <h1 class="katalog-title">{{ $heroKatalog->hero ?? 'Explore Our Clients' }}</h1>

    {{-- Toolbar: kategori dropdown + search --}}
    <form method="GET" action="{{ route('katalog') }}" class="katalog-toolbar">
        @php
            $selectedCategory = request('kategori') ?? 'all';
            $searchQuery = request('search') ?? '';
        @endphp

        {{-- Dropdown kategori --}}
        <div class="kategori-dropdown">
            <button type="button" id="kategoriToggle" class="kategori-btn">
                Kategori: {{ ucfirst($selectedCategory) }} ▾
            </button>
            <ul id="kategoriMenu" class="kategori-menu">
                <li>
                    <button type="submit" name="kategori" value="all" class="kat-btn {{ $selectedCategory=='all'?'is-active':'' }}">
                        Semua
                    </button>
                </li>
                @foreach($katalogs as $katalog)
                    @if($katalog->is_active)
                        <li>
                            <button type="submit" name="kategori" value="{{ strtolower($katalog->name) }}" 
                                    class="kat-btn {{ strtolower($katalog->name)==$selectedCategory?'is-active':'' }}">
                                {{ $katalog->name }}
                            </button>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

        {{-- Search --}}
        <div class="katalog-search">
    <input type="text" name="search" id="katalogSearch" class="katalog-search-input"
           value="{{ $searchQuery }}" placeholder="Cari produk...">
    {{-- <button type="submit" class="katalog-search-btn">Cari</button> --}}
</div>

    </form>

    {{-- Grid produk --}}
    <div class="katalog-grid">
        @forelse($products as $product)
            <div class="katalog-card"
                 data-nama="{{ $product->nama_produk }}"
                 data-harga="Rp {{ number_format($product->harga, 0, ',', '.') }}"
                 data-toko="{{ $product->umkm->nama_umkm ?? '-' }}"
                 data-gambar="{{ $product->product_image ? asset($product->product_image) : asset('images/sample-produk.jpg') }}"
                 data-kategori="{{ strtolower($product->katalog->name ?? 'lainnya') }}"
                 data-deskripsi="{{ $product->deskripsi ?? 'Tidak ada deskripsi' }}">
                <img src="{{ $product->product_image ? asset($product->product_image) : asset('images/sample-produk.jpg') }}" 
                     alt="{{ $product->nama_produk }}">
                <div class="katalog-info">
                    <h3>{{ $product->nama_produk }}</h3>
                    <p class="produk-umkm">{{ $product->umkm->nama_umkm ?? '-' }}</p>
                    <p class="produk-harga">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                </div>
            </div>
        @empty
            <p class="text-center col-span-full">Belum ada produk yang tersedia saat ini.</p>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="pagination">
        {{ $products->appends(['kategori'=>request('kategori'),'search'=>request('search')])->links('vendor.pagination.custom') }}
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

    {{-- Script modal --}}
    <script>
    document.addEventListener('DOMContentLoaded', function(){
        const cards = document.querySelectorAll('.katalog-grid .katalog-card');
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

        // Dropdown toggle
        const toggleBtn = document.getElementById('kategoriToggle');
        const menu = document.getElementById('kategoriMenu');
        toggleBtn.addEventListener('click', () => menu.classList.toggle('show'));
        document.addEventListener('click', e => {
            if(!e.target.closest('.kategori-dropdown')) menu.classList.remove('show');
        });
        const searchInput = document.getElementById('katalogSearch');

    let typingTimer;
    const typingDelay = 500; // delay 500ms setelah user berhenti mengetik

    searchInput.addEventListener('keyup', () => {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => {
            // submit form otomatis
            searchInput.form.submit();
        }, typingDelay);
    });
    </script>
</div>
@endsection