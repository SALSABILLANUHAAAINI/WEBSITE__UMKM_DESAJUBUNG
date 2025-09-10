@extends('admin.partials.sidebar')

@section('title', 'Daftar UMKM')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/umkm/index.css') }}">

<div class="umkm-index-container">
    <div class="header">
        <h1>Daftar UMKM</h1>
        <a href="{{ route('admin.umkm.create') }}" class="btn add-btn">+ Tambah UMKM</a>
    </div>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-card">
            <h2>Hero UMKM</h2>
            <p>{{ $heroUmkm->hero ?? 'Berbagai Macam UMKM Desa Jubung' }}</p>
            <button class="btn hero-edit" onclick="openHeroModal()">Edit Hero</button>
        </div>
    </div>

    <!-- Modal Edit Hero -->
    <div id="heroModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeHeroModal()">&times;</span>
            <h2>Edit Hero Section</h2>
            <form action="{{ route('admin.umkm.hero.update', $heroUmkm->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="text" name="hero" value="{{ $heroUmkm->hero ?? '' }}" placeholder="Masukkan teks hero">
                <div class="form-actions">
                    <button type="button" class="btn cancel" onclick="closeHeroModal()">Batal</button>
                    <button type="submit" class="btn submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert error">{{ session('error') }}</div>
    @endif

    <!-- Grid UMKM -->
    @if($umkms->count() > 0)
    <div class="umkm-grid">
        @foreach($umkms as $umkm)
        <div class="umkm-card">
            <div class="umkm-image">
                <img src="{{ $umkm->gambar ? asset($umkm->gambar) : asset('images/dummy1.png') }}" alt="{{ $umkm->nama_umkm }}">
            </div>
            <div class="umkm-info">
                <h3>{{ $umkm->nama_umkm }}</h3>
                <p>{{ Str::limit($umkm->deskripsi, 60) }}</p>
            </div>
            <div class="umkm-actions">
                <a href="{{ route('admin.umkm.edit', $umkm->id) }}" class="btn edit-btn">Edit</a>
                <form action="{{ route('admin.umkm.destroy', $umkm->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus UMKM ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn delete-btn">Hapus</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <div class="pagination">
        {{ $umkms->links() }}
    </div>

    @else
        <p class="empty">Belum ada UMKM yang terdaftar.</p>
    @endif
</div>

<script>
function openHeroModal() {
    document.getElementById('heroModal').style.display = 'flex';
}
function closeHeroModal() {
    document.getElementById('heroModal').style.display = 'none';
}

// Tutup modal ketika klik di luar konten
window.onclick = function(event) {
    const modal = document.getElementById('heroModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>

@endsection
