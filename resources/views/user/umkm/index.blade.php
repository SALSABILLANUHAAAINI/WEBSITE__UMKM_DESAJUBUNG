@extends('layouts.app')

@section('title', 'UMKM Desa Jubung')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/user/umkm/index.css') }}">
@endsection

@section('content')
<section class="umkm-section">
  <div class="container">
    <!-- Judul Hero -->
    <h2 class="umkm-title">
      {{ $heroUmkm->hero ?? 'Berbagai Macam UMKM Desa Jubung' }}
    </h2>

    <!-- Grid UMKM -->
    <div class="umkm-grid">
      @forelse($umkms as $umkm)
        <article class="umkm-card">
          <img
            src="{{ $umkm->gambar ? asset($umkm->gambar) : asset('images/dummy1.png') }}"
            alt="{{ $umkm->nama_umkm }}"
            class="umkm-cover"
          >
          <div class="umkm-body">
            <h3 class="umkm-name">{{ $umkm->nama_umkm }}</h3>
            <p class="umkm-desc">{{ Str::limit($umkm->deskripsi, 150) }}</p>
            <a href="{{ route('umkm.show', $umkm->id) }}" class="btn btn--primary">Lihat Detail</a>
          </div>
        </article>
      @empty
        <p class="empty-state">Belum ada data UMKM.</p>
      @endforelse
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper">
      {{ $umkms->links() }}
    </div>
  </div>
</section>
@endsection
