@extends('layouts.app')

@section('title', 'Katalog UMKM Desa Jubung')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user/katalog/index.css') }}">
@endsection

@section('content')
<div class="katalog-container">

    {{-- Judul --}}
    <h1 class="katalog-title">Katalog UMKM Desa Jubung</h1>

    <!-- ===== Tambahan: Toolbar Pencarian (kiri) & Kategori (kanan) ===== -->
    <div class="katalog-toolbar">
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

      <!-- Kategori (kanan) -->
      <div class="katalog-categories scrollable" aria-label="Filter kategori">
        <button type="button" class="kat-chip is-active" data-cat="semua">Semua</button>
        <button type="button" class="kat-chip" data-cat="makanan">Makanan</button>
        <button type="button" class="kat-chip" data-cat="minuman">Minuman</button>
        <button type="button" class="kat-chip" data-cat="fashion">Fashion</button>
        <button type="button" class="kat-chip" data-cat="kerajinan">Kerajinan</button>
        <button type="button" class="kat-chip" data-cat="lainnya">Lainnya</button>
      </div>
    </div>
    <!-- ===== Akhir Tambahan ===== -->

    {{-- Card Produk Dummy --}}
    <div class="katalog-grid">

        <div class="katalog-card">
           <img src="{{ asset('images/dummy5.PNG') }}" alt="Produk Dummy">
            <div class="katalog-info">
                <h3>Keripik Angkasa</h3>
                <a href="{{ route('katalog.show') }}" class="btn-detail">Lihat Detail</a>
            </div>
        </div>

        <div class="katalog-card">
             <img src="{{ asset('images/dummy9.PNG') }}" alt="Produk 2">
            <div class="katalog-info">
                <h3>Pawon Cupik</h3>
                <a href="{{ route('katalog.show') }}" class="btn-detail">Lihat Detail</a>
            </div>
        </div>

        <div class="katalog-card">
            <img src="{{ asset('images/dummy10.PNG') }}" alt="Produk 3">
            <div class="katalog-info">
                <h3>Mocci Nayya</h3>
                <a href="{{ route('katalog') }}" class="btn-detail">Lihat Detail</a>
            </div>
        </div>

        <div class="katalog-card">
            <img src="{{ asset('images/dummy11.PNG') }}" alt="Produk 4">
            <div class="katalog-info">
                <h3>Trigapuri</h3>
                <a href="{{ route('katalog') }}" class="btn-detail">Lihat Detail</a>
            </div>
        </div>

        <div class="katalog-card">
           <img src="{{ asset('images/dummy12.PNG') }}" alt="Produk 4">
            <div class="katalog-info">
            <div class="katalog-info">
                <h3>Warung Bu Romlah</h3>
                <a href="{{ route('katalog') }}" class="btn-detail">Lihat Detail</a>
            </div>
        </div>

    </div>
</div>

<!-- ===== Tambahan: Script filter pencarian + kategori ===== -->
<script>
document.addEventListener('DOMContentLoaded', function(){
  const input = document.getElementById('katalogSearch');
  const clearBtn = document.querySelector('.katalog-search-clear');
  const cards = document.querySelectorAll('.katalog-grid .katalog-card');
  const chips = document.querySelectorAll('.katalog-categories .kat-chip');

  // === Pemetaan kategori (tanpa ubah HTML card) berdasarkan judul ===
  const rules = [
    { key: 'makanan',   words: ['keripik','cookies','brownies','kue','snack','roti','pawon','warung','moci','mocci','bakso','mie','nasi','sambal','pecel'] },
    { key: 'minuman',   words: ['kopi','teh','susu','jus','es','drink','latte'] },
    { key: 'fashion',   words: ['batik','baju','kaos','tas','sepatu','kain'] },
    { key: 'kerajinan', words: ['souvenir','kerajinan','handmade','ukir','anyam','gerabah'] },
  ];
  function inferCategoryFromTitle(title){
    const t = (title || '').toLowerCase();
    for (const r of rules){
      if (r.words.some(w => t.includes(w))) return r.key;
    }
    return 'lainnya';
  }

  // Tandai data-category tiap card
  cards.forEach(card => {
    const titleEl = card.querySelector('h3');
    const title = titleEl ? titleEl.textContent.trim() : '';
    card.dataset.category = inferCategoryFromTitle(title);
  });

  // State
  let selectedCategory = 'semua';

  function filter(){
    const q = (input?.value || '').trim().toLowerCase();

    cards.forEach(card => {
      const titleEl = card.querySelector('h3');
      const title = (titleEl ? titleEl.textContent : '').toLowerCase();
      const matchText = !q || title.includes(q);
      const matchCat  = (selectedCategory === 'semua') || ((card.dataset.category || 'lainnya') === selectedCategory);
      const show = matchText && matchCat;
      card.style.display = show ? '' : 'none';
    });

    if(clearBtn) clearBtn.style.display = q ? 'inline' : 'none';
  }

  // Search handlers
  input?.addEventListener('input', filter);
  clearBtn?.addEventListener('click', () => { input.value=''; filter(); input.focus(); });

  // Category chip handlers
  chips.forEach(chip => {
    chip.addEventListener('click', () => {
      chips.forEach(c => c.classList.remove('is-active'));
      chip.classList.add('is-active');
      selectedCategory = (chip.dataset.cat || 'semua');
      filter();
    });
  });

  // init
  filter();
});
</script>
@endsection
