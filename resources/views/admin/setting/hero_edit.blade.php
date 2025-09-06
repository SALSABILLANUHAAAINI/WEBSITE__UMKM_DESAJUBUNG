@extends('admin.partials.sidebar')

@section('title', 'Hero Setting')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Halaman Hero</h1>

    <div class="bg-white p-6 rounded shadow-md">
        <h2 class="text-xl font-semibold">Judul Hero</h2>
        <p class="mt-2">Ini contoh deskripsi hero.</p>
        <a href="{{ route('admin.hero.edit') }}">Edit Hero</a>
    </div>
@endsection
