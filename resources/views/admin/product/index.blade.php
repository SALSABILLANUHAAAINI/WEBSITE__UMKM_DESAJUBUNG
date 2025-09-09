@extends('admin.partials.sidebar')
@section('title', 'Daftar Produk')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/produk/produk.css') }}">

<div class="produk-container">
    <div class="produk-header">
        <h1 class="produk-title">Daftar Produk</h1>
        <div class="produk-actions">
            <a href="{{ route('admin.product.create') }}" class="btn add">Tambah Produk</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="produk-grid">
        @foreach($products as $product)
            <div class="produk-card">
                <img src="{{ $product->product_image ? asset('storage/'.$product->product_image) : asset('images/no-image.png') }}"
                     alt="{{ $product->nama_produk }}"
                     class="produk-img">

                <div class="produk-body">
                    <div class="produk-nama">{{ $product->nama_produk }}</div>
                    <div class="produk-desc harga">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
                    <div class="produk-desc">{{ $product->umkm->nama_umkm }}</div>
                    <div class="produk-desc">{{ $product->katalog->nama_katalog }}</div>
                </div>

                <div class="produk-btn-group">
                    <a href="{{ route('admin.product.edit', $product) }}" class="btn edit">Edit</a>
                    <form action="{{ route('admin.product.destroy', $product) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn hapus" onclick="return confirm('Yakin hapus produk ini?')">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div style="margin-top:20px">
        {{ $products->links() }}
    </div>
</div>
@endsection
