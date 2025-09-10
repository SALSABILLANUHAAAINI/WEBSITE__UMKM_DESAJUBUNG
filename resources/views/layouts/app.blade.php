<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UMKM Desa Jubung')</title>

    {{-- CSS global --}}
    {{-- Pastikan urutan ini benar. app.css harus memuat semua style lain --}}
    <link rel="stylesheet" href="{{ asset('css/user/app.css') }}">
    
    <!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<script src="{{ asset('js/navbar.js') }}" defer></script>


    {{-- File CSS admin tidak perlu dimuat di halaman user --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/admin/login.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/admin/sidebar.css') }}"> --}}

    {{-- JS global --}}
    <script src="{{ asset('js/app.js') }}" defer></script>

    {{-- CSS tambahan khusus halaman (jika ada) --}}
    @yield('styles')
</head>
<body>

    {{-- Navbar --}}
    @include('user.partials.navbar')

    {{-- Konten utama --}}
    <main class="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('user.partials.footer')

    {{-- Script tambahan khusus halaman (jika ada) --}}
    @yield('scripts')

</body>
</html>
