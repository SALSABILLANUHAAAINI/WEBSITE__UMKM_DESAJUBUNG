@extends('admin.partials.sidebar')
@section('title', 'Produk Setting')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/produk/produk.css') }}">
@endsection

@section('content')
<div class="produk-container">
    <h1 class="title">Daftar Produk</h1>

    <!-- Header aksi: Pencarian + Tambah Produk -->
    <div class="produk-actions" style="display: flex; gap: 1rem; margin: 1rem 0; align-items: center;">
        <form action="{{ route('admin.product.index') }}" method="GET" style="display: flex; gap: 0.5rem; flex: 1;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                style="padding: 0.5rem 0.75rem; border-radius: 0.5rem; border: 1px solid #d1d5db; width: 100%;">
            <button type="submit"
                style="background: var(--primary); color: #fff; padding: 0.5rem 1rem; border-radius: 0.5rem; border: none; cursor: pointer;">Cari</button>
        </form>

        <a href="{{ route('admin.product.create') }}" class="btn add">Tambah Produk</a>
    </div>

    <div class="produk-grid">
        @forelse($products as $product)
            <div class="produk-card">
                <img src="{{ $product->product_image ? asset('storage/'.$product->product_image) : asset('images/sample-produk.jpg') }}"
                    alt="{{ $product->nama_produk }}" class="produk-img">

                <div class="produk-body">
                    <h3 class="produk-nama">{{ $product->nama_produk }}</h3>
                    <p class="produk-desc">{{ $product->umkm->nama_umkm ?? '-' }}</p>
                    <p class="produk-desc harga">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                </div>

                <div class="produk-btn-group">
                    <a href="{{ route('admin.product.edit', $product->id) }}" class="btn edit">Edit</a>

                    <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn hapus" onclick="return confirm('Yakin hapus produk ini?')">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <p>Belum ada produk yang ditambahkan.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="pagination">
        {{ $products->links() }}
    </div>
</div>
@endsection
