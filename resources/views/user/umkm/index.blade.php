@extends('layouts.app')

@section('title', 'UMKM Desa Jubung')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user/umkm/index.css') }}">
@endsection

@section('content')

<!-- UMKM LIST SECTION -->
<section class="umkm-section py-12">
    <div class="container mx-auto px-6">
        <h2 class="umkm-title text-3xl font-bold mb-8 text-center">
    {{ $heroUmkm->hero ?? 'Berbagai Macam UMKM Desa Jubung' }}
</h2>

        <div class="umkm-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($umkms as $umkm)
                <div class="umkm-card bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ $umkm->gambar ? asset('storage/'.$umkm->gambar) : asset('images/dummy1.png') }}"
                         alt="{{ $umkm->nama_umkm }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="umkm-name text-xl font-semibold mb-2">{{ $umkm->nama_umkm }}</h3>
                        <p class="umkm-desc text-gray-600 mb-4">{{ Str::limit($umkm->deskripsi, 150) }}</p>
                        <a href="{{ route('umkm.show', $umkm->id) }}"
                           class="btn-detail inline-block px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                           Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-center col-span-full">Belum ada data UMKM.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection
