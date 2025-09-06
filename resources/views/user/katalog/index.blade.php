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
        <!-- Dropdown kategori -->
        <div class="kategori-dropdown">
            <button id="kategoriToggle" class="kategori-btn">Kategori ▾</button>
            <ul id="kategoriMenu" class="kategori-menu">
                <li><button class="kat-btn is-active" data-filter="all">Semua</button></li>
                <li><button class="kat-btn" data-filter="makanan">Makanan</button></li>
                <li><button class="kat-btn" data-filter="minuman">Minuman</button></li>
                <li><button class="kat-btn" data-filter="barang">Barang</button></li>
            </ul>
        </div>

        <!-- Search -->
        <div class="katalog-search">
            <input
                type="text"
                id="katalogSearch"
                class="katalog-search-input"
                placeholder="Cari produk..."
                aria-label="Cari produk"
            />
            <button type="button" class="katalog-search-clear" aria-label="Bersihkan pencarian" title="Bersihkan">×</button>
        </div>
    </div>

    {{-- Grid produk --}}
    <div class="katalog-grid">

        <div class="katalog-card"
             data-kategori="makanan"
             data-nama="Keripik Angkasa"
             data-harga="Rp 15.000"
             data-toko="UMKM Angkasa"
             data-gambar="{{ asset('images/dummy5.PNG') }}">
            <img src="{{ asset('images/dummy5.PNG') }}" alt="Keripik Angkasa">
            <div class="katalog-info">
                <h3>Keripik Angkasa</h3>
            </div>
        </div>

        <div class="katalog-card"
             data-kategori="minuman"
             data-nama="Pawon Cupik"
             data-harga="Rp 25.000"
             data-toko="Pawon Cupik Official"
             data-gambar="{{ asset('images/dummy9.PNG') }}">
            <img src="{{ asset('images/dummy9.PNG') }}" alt="Pawon Cupik">
            <div class="katalog-info">
                <h3>Pawon Cupik</h3>
            </div>
        </div>

        <div class="katalog-card"
             data-kategori="barang"
             data-nama="Mocci Nayya"
             data-harga="Rp 30.000"
             data-toko="Mocci Nayya Store"
             data-gambar="{{ asset('images/dummy10.PNG') }}">
            <img src="{{ asset('images/dummy10.PNG') }}" alt="Mocci Nayya">
            <div class="katalog-info">
                <h3>Mocci Nayya</h3>
            </div>
        </div>

        <div class="katalog-card"
             data-kategori="makanan"
             data-nama="Trigapuri"
             data-harga="Rp 20.000"
             data-toko="Trigapuri Food"
             data-gambar="{{ asset('images/dummy11.PNG') }}">
            <img src="{{ asset('images/dummy11.PNG') }}" alt="Trigapuri">
            <div class="katalog-info">
                <h3>Trigapuri</h3>
            </div>
        </div>

        <div class="katalog-card"
             data-kategori="makanan"
             data-nama="Warung Bu Romlah"
             data-harga="Rp 10.000"
             data-toko="Warung Bu Romlah"
             data-gambar="{{ asset('images/dummy12.PNG') }}">
            <img src="{{ asset('images/dummy12.PNG') }}" alt="Warung Bu Romlah">
            <div class="katalog-info">
                <h3>Warung Bu Romlah</h3>
            </div>
        </div>

    </div>
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

  // === Modal ===
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

  // === Dropdown kategori ===
  const toggleBtn = document.getElementById('kategoriToggle');
  const menu = document.getElementById('kategoriMenu');

  toggleBtn.addEventListener('click', () => {
    menu.classList.toggle('show');
  });

  document.addEventListener('click', (e) => {
    if(!e.target.closest('.kategori-dropdown')){
      menu.classList.remove('show');
    }
  });

  // === Filter kategori ===
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

  // === Filter search ===
  function filterSearch(){
    const q = (input.value || '').trim().toLowerCase();
    cards.forEach(card => {
      const title = card.querySelector('h3').textContent.toLowerCase();
      card.style.display = title.includes(q) ? '' : 'none';
    });
    clearBtn.style.display = q ? 'inline' : 'none';
  }
  input.addEventListener('input', filterSearch);
  clearBtn.addEventListener('click', () => { input.value=''; filterSearch(); input.focus(); });
  filterSearch();
});
</script>
@endsection
