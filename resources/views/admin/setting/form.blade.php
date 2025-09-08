@extends('admin.partials.sidebar')

@section('title', 'Service Setting')

@section('content')
<section class="service-section">

    {{-- CSS khusus --}}
    <link rel="stylesheet" href="{{ asset('css/admin/setting/form.css') }}">

    <!-- HEADER -->
    <div class="service-header">
        <h1 class="service-title">Service Setting Website</h1>
        <p class="service-subtitle">
            Silakan isi form berikut untuk mengatur konten service website Anda.
        </p>
    </div>
    <!-- FORM -->
<form action="{{ route('admin.service.settings.update') }}" method="POST" class="service-form">
    @csrf
    {{-- Kita tidak butuh @method('PUT') karena rute baru kita menggunakan POST --}}

    <div class="form-group">
        <label for="judul_hero">Judul Hero</label>
        {{-- Ganti name="title" menjadi "judul_hero" dan variabelnya menjadi $settings->judul_hero --}}
        <input type="text" id="judul_hero" name="judul_hero" value="{{ old('judul_hero', $settings->judul_hero ?? '') }}">
    </div>

    <div class="form-group">
        <label for="subjudul_hero">Subjudul Hero</label>
        {{-- Ganti name="subtitle" menjadi "subjudul_hero" dan variabelnya menjadi $settings->subjudul_hero --}}
        <textarea id="subjudul_hero" name="subjudul_hero" rows="3">{{ old('subjudul_hero', $settings->subjudul_hero ?? '') }}</textarea>
    </div>

    <div class="form-group">
        <button type="submit" class="btn-submit">Simpan Data</button>
    </div>
</form>


@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif


    <!-- CARD DINAMIS -->
    <div class="data-section mt-6">
        <h2 class="service-title">Data Submission UMKM</h2>

        <div class="card-container">
            @forelse($submissions as $sub)
                <div class="service-card
                    @if($sub->status == 'rejected') card-rejected @elseif($sub->status == 'pending') card-pending @endif">
                    <h3 class="card-title">{{ $sub->nama_umkm }}</h3>
                    <p class="card-desc">{{ $sub->deskripsi }}</p>
                    <p class="card-website">{{ $sub->social }}</p>
                    <p class="card-status">
                        Status:
                        @if($sub->status == 'pending') Pending
                        @elseif($sub->status == 'rejected') Ditolak
                        @endif
                    </p>
                    @if($sub->status == 'pending')
                        <a href="{{ route('admin.submissions.show', $sub->id) }}" class="btn-tinjau">Tinjau</a>
                    @endif
                </div>
            @empty
                <p>Tidak ada submission.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection
