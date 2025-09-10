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
    <div class="katalog-toolbar">
        <form method="GET" action="{{ route('katalog') }}" class="filter-form">
            {{-- Search --}}
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Cari produk..." class="katalog-search-input">

            {{-- Dropdown kategori --}}
            <select name="kategori" class="katalog-select">
                <option value="semua" {{ request('kategori')=='semua' ? 'selected' : '' }}>Semua</option>
                @foreach($katalogs as $katalog)
                    @if($katalog->is_active)
                        <option value="{{ strtolower($katalog->name) }}" 
                            {{ request('kategori')==strtolower($katalog->name) ? 'selected' : '' }}>
                            {{ $katalog->name }}
                        </option>
                    @endif
                @endforeach
            </select>

            <button type="submit" class="btn-submit">Filter</button>
        </form>
    </div>

    {{-- Grid produk --}}
    <div class="katalog-grid">
        @forelse($products as $product)
            <div class="katalog-card">
                <img src="{{ $product->product_image ? asset($product->product_image) : asset('images/sample-produk.jpg') }}" alt="{{ $product->nama_produk }}">
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

    <!-- Pagination -->
    <div class="pagination">
    {{ $products->links('vendor.pagination.custom') }}
</div>

    {{-- Modal produk --}}
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
</div>

{{-- Script: modal, filter JS --}}
<script>
document.addEventListener('DOMContentLoaded', function(){
    const cards = document.querySelectorAll('.katalog-card');
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
    window.addEventListener('click', (e) => { if(e.target === modal) modal.style.display = 'none'; });
});
</script>
@endsection
