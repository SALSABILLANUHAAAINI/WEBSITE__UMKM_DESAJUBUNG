@extends('admin.partials.sidebar')

@section('title', 'Daftar UMKM')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/umkm/umkm.css') }}">

<div class="produk-container">

    {{-- Header + Tambah --}}
    <div class="produk-header">
        <h1 class="produk-title">Daftar UMKM</h1>
        <div class="produk-actions">
            <a href="{{ route('admin.umkm.create') }}" class="btn tambah">+ Tambah UMKM</a>
        </div>
    </div>

    {{-- Hero Section --}}
    <div class="hero-section">
        <div class="hero-card">
            <h2 class="hero-title">Hero UMKM</h2>
            <p class="hero-desc">{{ $heroUmkm->hero ?? 'Berbagai Macam UMKM Desa Jubung' }}</p>
            <div class="hero-btn-group">
                <button class="btn hero-edit" onclick="openHeroModal()">Edit Hero</button>
            </div>
        </div>
    </div>

    {{-- Modal Hero --}}
    <div id="heroModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeHeroModal()">&times;</span>
            <h3 class="modal-title">Edit Hero Section</h3>
            <p class="modal-subtitle">Ubah teks hero sesuai kebutuhan.</p>

            {{-- ========================================================= --}}
            {{-- INI BAGIAN YANG DIPERBAIKI --}}
            {{-- route() sekarang dipanggil tanpa parameter kedua ($hero->id) --}}
            <form action="{{ route('admin.umkm.hero.update') }}" method="POST">
            {{-- ========================================================= --}}

                @csrf
                @method('PUT')

                <input type="text" 
                       name="hero" 
                       class="form-control @error('hero') is-invalid @enderror" 
                       value="{{ old('hero', $heroUmkm->hero ?? '') }}" 
                       placeholder="Masukkan teks hero">

                @error('hero')
                    <p class="error-message" style="color:red; font-size: 14px; margin-top:5px;">
                        {{ $message }}
                    </p>
                @enderror

                <div class="form-actions">
                    <button type="button" class="btn cancel" onclick="closeHeroModal()">Batal</button>
                    <button type="submit" class="btn submit">Simpan</button>
                </div>
            </form>

        </div>
    </div>

    {{-- Search --}}
    <div class="search-container">
        <form action="{{ route('admin.umkm.index') }}" method="GET" class="search-form">
            <input type="text" name="search" class="search-input" placeholder="Cari UMKM..." value="{{ request('search') }}">
            <button type="submit" class="search-btn">Cari</button>
            <a href="{{ route('admin.umkm.index') }}" class="reset-btn">Reset</a>
        </form>
    </div>

    {{-- Grid UMKM --}}
    @if($umkms->count() > 0)
        <div class="produk-list">
            @foreach($umkms as $umkm)
                <div class="produk-card">
                    <img src="{{ $umkm->gambar ? asset($umkm->gambar) : asset('images/dummy1.png') }}" alt="{{ $umkm->nama_umkm }}" class="produk-img">
                    <div class="produk-body">
                        <h3 class="produk-nama">{{ $umkm->nama_umkm }}</h3>
                        <p class="produk-desc">{{ Str::limit($umkm->deskripsi, 80) }}</p>
                        <div class="produk-btn-group">
                            <a href="{{ route('admin.umkm.edit', $umkm->id) }}" class="btn edit">Edit</a>
                            <form action="{{ route('admin.umkm.destroy', $umkm->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus UMKM ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn hapus">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="pagination">
            {{ $umkms->links('vendor.pagination.custom') }}
        </div>
    @else
        <p class="empty">Belum ada UMKM yang terdaftar.</p>
    @endif
</div>

{{-- JS modal --}}
<script>
function openHeroModal() {
    document.getElementById('heroModal').style.display = 'flex';
}
function closeHeroModal() {
    document.getElementById('heroModal').style.display = 'none';
}
window.onclick = function(event) {
    const modal = document.getElementById('heroModal');
    if(event.target === modal) modal.style.display = 'none';
}
</script>
@endsection