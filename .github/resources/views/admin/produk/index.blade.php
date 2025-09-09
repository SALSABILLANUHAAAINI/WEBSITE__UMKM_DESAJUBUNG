@extends('admin.partials.sidebar')
@section('title', 'Produk Setting')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/produk/produk.css') }}">

<div class="produk-container">
    <h1 class="title">Daftar Produk</h1>

    <div class="actions">
        <a href="{{ route('admin.product.tambah') }}" class="btn add">➕ Tambah Produk</a>
    </div>

    {{-- Grid Produk --}}
    <div class="produk-grid">
        @forelse($products as $product)
            <div class="produk-card">
                <img src="{{ $product->product_image ? asset('storage/'.$product->product_image) : asset('images/sample-produk.jpg') }}"
                     alt="{{ $product->nama_produk }}" class="produk-img">

                <div class="produk-info">
                    <h3>{{ $product->nama_produk }}</h3>
                    <p class="umkm">{{ $product->umkm->nama_umkm ?? '-' }}</p>
                    <p class="harga">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                </div>

                <div class="produk-actions">
                    <a href="{{ route('admin.product.edit', $product->id) }}" class="btn small edit">✏️ Edit</a>

                    <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn small delete" onclick="return confirm('Yakin hapus produk ini?')">🗑️ Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <p>Belum ada produk yang ditambahkan.</p>
        @endforelse
    </div>
</div>
@endsection
