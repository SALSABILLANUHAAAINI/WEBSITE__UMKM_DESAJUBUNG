@extends('layouts.app')

@section('title', 'Katalog UMKM Desa Jubung')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/user/katalog/index.css') }}">
@endsection

@section('content')
<div class="katalog-container">

    {{-- Judul --}}
    <h1 class="katalog-title">{{ $heroKatalog->hero ?? 'Explore Our Clients' }}</h1>

    <!-- Toolbar: kategori dropdown + search -->
    <div class="katalog-toolbar">
        {{-- Dropdown kategori --}}
        <div class="kategori-dropdown">
            <button id="kategoriToggle" class="kategori-btn">Kategori ▾</button>
            <ul id="kategoriMenu" class="kategori-menu">
                <li><button class="kat-btn is-active" data-filter="all">Semua</button></li>
                @foreach($katalogs as $katalog)
                    @if($katalog->is_active)
                        <li>
                            <button class="kat-btn" data-filter="{{ strtolower($katalog->name) }}">
                                {{ $katalog->name }}
                            </button>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>

        <!-- Search -->
        <div class="katalog-search">
            <input type="text" id="katalogSearch" class="katalog-search-input" placeholder="Cari produk..." aria-label="Cari produk">
            <button type="button" class="katalog-search-clear" aria-label="Bersihkan pencarian" title="Bersihkan">×</button>
        </div>
    </div>

    {{-- Grid produk --}}
    <div class="katalog-grid">
        @forelse($products as $product)
            <div class="katalog-card"
                data-nama="{{ $product->nama_produk }}"
                data-harga="Rp {{ number_format($product->harga, 0, ',', '.') }}"
                data-toko="{{ $product->umkm->nama_umkm ?? '-' }}"
                data-gambar="{{ $product->product_image ? asset($product->product_image) : asset('images/sample-produk.jpg') }}"
                data-kategori="{{ strtolower($product->katalog->name ?? 'lainnya') }}">

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

    <!-- Modal produk -->
    <div id="produkModal" class="modal">
        <div class="modal-content">
            <span class="modal-close">&times;</span>
            <img id="modalImg" src="" alt="">
            <h2 id="modalNama"></h2>
            <p id="modalHarga"></p>
            <p id="modalToko"></p>
        </div>
    </div>

    <!-- Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function(){
        const cards = document.querySelectorAll('.katalog-card');
        const input = document.getElementById('katalogSearch');
        const clearBtn = document.querySelector('.katalog-search-clear');
        const katBtns = document.querySelectorAll('.kat-btn');

        // Modal
        const modal = document.getElementById('produkModal');
        const modalImg = document.getElementById('modalImg');
        const modalNama = document.getElementById('modalNama');
        const modalHarga = document.getElementById('modalHarga');
        const modalToko = document.getElementById('modalToko');
        const closeBtn = document.querySelector('.modal-close');

        cards.forEach(card => {
            card.addEventListener('click', () => {
                modalImg.src = card.dataset.gambar;
                modalNama.textContent = card.dataset.nama;
                modalHarga.textContent = "Harga: " + card.dataset.harga;
                modalToko.textContent = "Toko: " + card.dataset.toko;
                modal.style.display = 'flex';
            });
        });
        closeBtn.addEventListener('click', () => modal.style.display = 'none');
        window.addEventListener('click', (e) => { if(e.target === modal){ modal.style.display = 'none'; }});

        // Dropdown kategori
        const toggleBtn = document.getElementById('kategoriToggle');
        const menu = document.getElementById('kategoriMenu');

        toggleBtn.addEventListener('click', () => menu.classList.toggle('show'));
        document.addEventListener('click', (e) => { if(!e.target.closest('.kategori-dropdown')) menu.classList.remove('show'); });

        // Filter kategori
        katBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                katBtns.forEach(b => b.classList.remove('is-active'));
                btn.classList.add('is-active');
                toggleBtn.textContent = "Kategori: " + btn.textContent + " ▾";

                const filter = btn.dataset.filter;
                cards.forEach(card => {
                    const kat = card.dataset.kategori;
                    card.style.display = (filter === 'all' || kat === filter) ? '' : 'none';
                });
                menu.classList.remove('show');
            });
        });

        // Filter search
        function filterSearch(){
            const q = (input.value || '').trim().toLowerCase();
            cards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                const matchesSearch = title.includes(q);
                const matchesCategory = card.style.display !== 'none'; // Respect category filter
                card.style.display = matchesSearch && matchesCategory ? '' : 'none';
            });
            clearBtn.style.display = q ? 'inline' : 'none';
        }
        input.addEventListener('input', filterSearch);
        clearBtn.addEventListener('click', () => { input.value=''; filterSearch(); input.focus(); });
        filterSearch();
    });
    </script>
</div>
@endsection
