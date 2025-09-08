<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home')</title>

    {{-- CSS global --}}
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/sidebar.css') }}">

    {{-- JS global --}}
    <script src="{{ asset('js/app.js') }}" defer></script>

    {{-- CSS tambahan khusus halaman --}}
    @yield('styles')
</head>
<body>

    {{-- Navbar --}}
    @include('user.partials.navbar')

    {{-- Konten utama --}}
    <main >
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('user.partials.footer')

    {{-- Script tambahan khusus halaman --}}
    @yield('scripts')

</body>
</html>
