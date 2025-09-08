@extends('admin.partials.sidebar')

@section('title', 'Edit Profil Admin')

@section('content')
<section class="service-section">

    {{-- Memanggil CSS KHUSUS untuk halaman profil --}}
    <link rel="stylesheet" href="{{ asset('css/admin/profile/edit.css') }}">

    <div class="service-header">
        <h1 class="service-title">Edit Profil Admin</h1>
        <p class="service-subtitle">
            Di sini Anda bisa mengubah detail akun Anda.
        </p>
    </div>

    <form action="{{ route('admin.profile.update') }}" method="POST" class="service-form">
        @csrf
        @method('PUT')

        {{-- Menampilkan pesan sukses jika ada --}}
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Menampilkan error validasi jika ada --}}
        @if ($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Input Nama --}}
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        {{-- Input Username (MENGGANTIKAN EMAIL) --}}
        <div class="form-group">
            <label for="username">Username (untuk login)</label>
            <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required>
        </div>

        <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 2rem 0;">

        <p style="font-weight: 600; font-size: 0.95rem; color: #111827; margin-bottom: 1.5rem;">
            Ubah Password <span style="font-weight: 400; color: #6b7280;">(Kosongkan jika tidak ingin mengubahnya)</span>
        </p>

        {{-- Input Password Baru --}}
        <div class="form-group">
            <label for="password">Password Baru</label>
            <input type="password" id="password" name="password">
        </div>

        {{-- Input Konfirmasi Password --}}
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password Baru</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>

        <div class="form-group">
            <button type="submit" class="btn-submit">Update Profil</button>
        </div>
    </form>

</section>
@endsection