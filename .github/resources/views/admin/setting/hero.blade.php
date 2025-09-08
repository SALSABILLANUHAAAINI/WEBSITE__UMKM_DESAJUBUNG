@extends('admin.partials.sidebar')

@section('title', 'Edit Hero')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Hero</h1>

    <form action="{{ route('admin.hero.update') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')

        <div>
            <label for="judul">Judul</label>
            <input type="text" id="judul" name="judul" value="Judul Hero Lama">
        </div>

        <div>
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi">Deskripsi lama hero...</textarea>
        </div>

        <button type="submit">Simpan</button>
    </form>
@endsection
