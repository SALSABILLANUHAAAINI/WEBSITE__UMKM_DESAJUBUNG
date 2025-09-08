@extends('admin.partials.sidebar')

@section('title', 'Setting UMKM')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/umkm/umkm.css') }}?v={{ time() }}">

<div class="produk-container">

    <!-- Header -->
    <div class="produk-header">
        <h1 class="produk-title">UMKM - Admin Setting</h1>
        <div class="produk-actions">
            <a href="{{ route('admin.umkm.create') }}" class="btn tambah">+ Tambah UMKM</a>
        </div>
    </div>


    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-card">
            <div class="hero-body">
                <h2 class="hero-title">Hero Section</h2>
                <p class="hero-desc">Teks yang tampil di halaman utama UMKM Desa Jubung.</p>
                <div class="hero-btn-group">
                    <button class="btn hero-edit" onclick="openHeroModal()">Edit Hero</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Hero -->
    <div id="heroModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeHeroModal()">&times;</span>
            <h2 class="modal-title">Edit Hero Section</h2>
            <p class="modal-subtitle">Ubah teks hero yang ditampilkan di halaman UMKM.</p>

            <form action="{{ route('admin.umkm.hero.update', $heroUmkm->id) }}" method="POST" class="modal-form">
                @csrf
                @method('PUT')
                <input type="text" name="hero" class="form-control" value="{{ $heroUmkm->hero ?? '' }}" placeholder="Masukkan teks hero UMKM">

                <div class="form-actions">
                    <button type="button" class="btn cancel" onclick="closeHeroModal()">Batal</button>
                    <button type="submit" class="btn submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>


<!-- Form Pencarian -->
<div class="search-container">
    <form action="{{ route('admin.umkm.index') }}" method="GET" class="search-form">
        <input type="text" name="search" class="search-input"
               placeholder="Cari UMKM..."
               value="{{ request('search') }}">
        <button type="submit" class="btn search-btn">Cari</button>
        @if(request('search'))
            <a href="{{ route('admin.umkm.index') }}" class="btn reset-btn">Reset</a>
        @endif
    </form>
</div>



    <!-- Daftar UMKM -->
    <div class="produk-list">
        @forelse($umkms as $umkm)
            <div class="produk-card">
                <img src="{{ $umkm->gambar ? asset('storage/'.$umkm->gambar) : 'https://via.placeholder.com/500x300?text=No+Image' }}"
                     alt="{{ $umkm->nama_umkm }}" class="produk-img">
                <div class="produk-body">
                    <h2 class="produk-nama">{{ $umkm->nama_umkm }}</h2>
                    <p class="produk-desc">{{ Str::limit($umkm->deskripsi, 150) }}</p>
                    <div class="produk-btn-group">
                        <a href="{{ route('admin.umkm.edit', $umkm->id) }}" class="btn edit">Edit</a>
                        <form action="{{ route('admin.umkm.destroy', $umkm->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn hapus" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>Belum ada data UMKM.</p>
        @endforelse
    </div>
</div>

<!-- Script Modal -->
<script>
function openHeroModal() {
    document.getElementById("heroModal").style.display = "flex";
}
function closeHeroModal() {
    document.getElementById("heroModal").style.display = "none";
}
</script>

@endsection
