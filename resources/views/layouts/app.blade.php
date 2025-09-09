<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UMKM Desa Jubung')</title>

    {{-- Memanggil Bootstrap dari CDN sebagai fondasi dasar styling --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Memanggil file CSS global utama Anda. Pastikan file ini ada. --}}
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

    {{-- Slot ini akan diisi oleh CSS spesifik dari halaman lain (seperti halaman katalog, dll) --}}
    @yield('styles')
</head>
<body>

    {{-- Memuat komponen Navbar --}}
    @include('user.partials.navbar')

    {{-- Konten utama dari setiap halaman akan dimuat di sini --}}
    <main>
        @yield('content')
    </main>

    {{-- Memuat komponen Footer --}}
    @include('user.partials.footer')

    {{-- Slot untuk JavaScript spesifik dari halaman lain --}}
    @yield('scripts')

</body>
</html>