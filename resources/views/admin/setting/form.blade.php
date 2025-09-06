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
<form action="{{ route('admin.hero.update') }}" method="POST" class="service-form">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="title">Judul Hero</label>
        <input type="text" id="title" name="title" value="{{ old('title', $hero->title ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="subtitle">Subjudul Hero</label>
        <textarea id="subtitle" name="subtitle" rows="3">{{ old('subtitle', $hero->subtitle ?? '') }}</textarea>
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
