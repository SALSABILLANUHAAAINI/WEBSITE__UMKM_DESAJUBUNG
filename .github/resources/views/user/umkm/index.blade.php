@extends('layouts.app')

@section('title', 'UMKM Desa Jubung')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user/umkm/index.css') }}">
@endsection

@section('content')

<!-- UMKM LIST SECTION -->
<section class="umkm-section py-12 bg-gradient-to-r from-pink-100 via-pink-50 to-yellow-50">
    <div class="container mx-auto px-6">
        <!-- Judul di tengah -->
        <h2 class="umkm-title text-4xl font-bold mb-12 text-center text-pink-500">
            {{ $heroUmkm->hero ?? 'Berbagai Macam UMKM Desa Jubung' }}
        </h2>

        <!-- Grid UMKM -->
        <div class="umkm-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($umkms as $umkm)
                <div class="umkm-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                    <img src="{{ $umkm->gambar ? asset('storage/'.$umkm->gambar) : asset('images/dummy1.png') }}"
                         alt="{{ $umkm->nama_umkm }}"
                         class="w-full h-56 object-cover">
                    <div class="p-5">
                        <h3 class="umkm-name text-xl font-semibold mb-2">{{ $umkm->nama_umkm }}</h3>
                        <p class="umkm-desc text-gray-600 mb-4">{{ Str::limit($umkm->deskripsi, 150) }}</p>
                        <a href="{{ route('umkm.show', $umkm->id) }}"
                           class="inline-block px-4 py-2 bg-pink-500 text-white rounded-full hover:bg-pink-600 transition">
                           Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-center col-span-full text-gray-500">Belum ada data UMKM.</p>
            @endforelse
        </div>
    </div>
</section>

@endsection

