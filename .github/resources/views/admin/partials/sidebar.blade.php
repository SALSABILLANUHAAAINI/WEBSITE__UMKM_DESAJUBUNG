<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    {{-- CSS Utama --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- CSS Sidebar --}}
    <link rel="stylesheet" href="{{ asset('css/admin/sidebar.css') }}">

    {{-- CSS Khusus Halaman --}}
    @yield('styles')
</head>
<body>
    <div class="layout-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                Admin Panel
            </div>
           <nav class="sidebar-menu">
    <ul>
        <li><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
        <li><a href="{{ url('/admin/home') }}">Home Setting</a></li>
        <li><a href="{{ url('/admin/umkm') }}">UMKM Setting</a></li>
        <li><a href="{{ url('/admin/katalog') }}">Katalog Setting</a></li>
        <li><a href="{{ url('/admin/tentang') }}">Tentang Kami</a></li>
         <li><a href="{{ url('/admin/produk') }}">Produk Setting</a></li>
        <li><a href="{{ route('admin.service.settings') }}">Service Setting</a></li>
    </ul>
</nav>
            <div class="sidebar-footer">
                <a href="{{ url('/admin/logout') }}" class="logout-btn">Logout</a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    {{-- JS Khusus Halaman --}}
    @yield('scripts')
</body>
</html>
