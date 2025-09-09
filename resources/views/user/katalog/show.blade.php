@extends('layouts.app')

@section('title', 'Katalog UMKM Desa Jubung')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user/katalog/index.css') }}">
@endsection

@section('content')
<div class="katalog-container">

    {{-- Judul --}}
    <h1 class="katalog-title">Katalog UMKM Desa Jubung</h1>

    <!-- ===== Toolbar Pencarian & Kategori ===== -->
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

      <div class="katalog-categories scrollable" aria-label="Filter kategori">
        <button type="button" class="kat-chip is-active" data-cat="semua">Semua</button>
        <button type="button" class="kat-chip" data-cat="makanan">Makanan</button>
        <button type="button" class="kat-chip" data-cat="minuman">Minuman</button>
        <button type="button" class="kat-chip" data-cat="fashion">Fashion</button>
        <button type="button" class="kat-chip" data-cat="kerajinan">Kerajinan</button>
        <button type="button" class="kat-chip" data-cat="lainnya">Lainnya</button>
      </div>
    </div>

    <!-- ===== Daftar Produk ===== -->
    <div class="katalog-grid">
        @forelse($products as $product)
            <div class="katalog-card" data-category="{{ $product->kategori ?? 'lainnya' }}">
                <img src="{{ $product->product_image 
                    ? asset('storage/products/' . $product->product_image) 
                    : asset('images/dummy5.PNG') }}" 
                    alt="{{ $product->nama_produk }}">
                <div class="katalog-info">
                    <h3>{{ $product->nama_produk }}</h3>
                    <a href="{{ route('katalog.show', $product->id) }}" class="btn-detail">Lihat Detail</a>
                </div>
            </div>
        @empty
            <div class="katalog-card" data-category="lainnya">
                <img src="{{ asset('images/dummy5.PNG') }}" alt="Produk Dummy">
                <div class="katalog-info">
                    <h3>Produk Belum Tersedia</h3>
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- ===== Script filter pencarian + kategori ===== -->
<script>
document.addEventListener('DOMContentLoaded', function(){
  const input = document.getElementById('katalogSearch');
  const clearBtn = document.querySelector('.katalog-search-clear');
  const cards = document.querySelectorAll('.katalog-grid .katalog-card');
  const chips = document.querySelectorAll('.katalog-categories .kat-chip');

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
