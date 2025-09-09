@extends('admin.partials.sidebar')
@section('title', 'Daftar Produk')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/produk/produk.css') }}">

<div class="container">
    <h1 class="mb-3">Daftar Produk</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.product.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>UMKM</th>
                <th>Katalog</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>
                    @if($product->product_image)
                        <img src="{{ asset('storage/'.$product->product_image) }}" 
                             alt="{{ $product->nama_produk }}" 
                             width="80" class="img-thumbnail">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>
                <td>{{ $product->nama_produk }}</td>
                <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                <td>{{ $product->umkm->nama_umkm }}</td>
                <td>{{ $product->katalog->nama_katalog }}</td>
                <td>
                    <a href="{{ route('admin.product.edit', $product) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.product.destroy', $product) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus produk ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
</div>
@endsection
