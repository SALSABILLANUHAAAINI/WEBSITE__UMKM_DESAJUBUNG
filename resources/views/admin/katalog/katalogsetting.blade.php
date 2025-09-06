@extends('admin.partials.sidebar')

@section('title', 'Katalog Setting')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/katalog/katalogsetting.css') }}">

<div class="katalog-container">

    <!-- Header -->
    <div class="katalog-header">
        <h2 class="katalog-title">Katalog Setting</h2>
        <a href="{{ route('admin.katalog.tambah') }}" class="btn tambah">➕ Tambah Kategori</a>
    </div>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-card">
            <h3 class="hero-title">{{ $heroKatalog->hero ?? 'Explore Our Clients' }}</h3>

            <!-- Form hero langsung -->
            <form action="{{ route('admin.katalog.hero.update') }}" method="POST" style="margin-top:10px;">
                @csrf
                @method('PUT')
                <input type="text" name="hero" value="{{ $heroKatalog->hero ?? '' }}" style="margin-right:10px; width:300px;">
                <button type="submit" class="btn edit">✏️ Simpan Hero</button>
            </form>
        </div>
    </div>

    <!-- Tabel Katalog -->
    <h3 class="title-sub">Daftar Kategori</h3>
    <table class="katalog-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Status Aktif</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($katalogs as $index => $k)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $k->name }}</td>
                <td>{{ $k->is_active ? '✅ Aktif' : '❌ Tidak Aktif' }}</td>
                <td>
                    <a href="{{ route('admin.katalog.edit', $k->id) }}" class="btn edit">Edit</a>
                    <form action="{{ route('admin.katalog.destroy', $k->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn hapus" onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">Belum ada katalog.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
