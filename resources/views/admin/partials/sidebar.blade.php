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
        <aside class="sidebar">
            <div class="sidebar-header">
                Admin Panel
            </div>
            <nav class="sidebar-menu">
                <ul>
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('admin.home') }}">Home Setting</a></li>
                    <li><a href="{{ route('admin.umkm.index') }}">UMKM Setting</a></li>
                    <li><a href="{{ route('admin.katalog.index') }}">Katalog Setting</a></li>
                    <li><a href="{{ route('admin.tentang') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('admin.product.index') }}">Produk Setting</a></li>
                    <li><a href="{{ route('admin.service.settings') }}">Service Setting</a></li>
                </ul>
            </nav>
            <div class="sidebar-footer">
    {{-- Beri kelas 'profile-btn' yang sama gayanya dengan logout-btn --}}
    <a href="{{ route('admin.profile.edit') }}" class="footer-btn profile-btn">Edit Profil</a>

    {{-- Tombol Logout yang sudah benar --}}
    <a href="{{ route('admin.logout') }}" 
       class="footer-btn logout-btn" 
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
       Logout
    </a>
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
        </aside>

        <main class="main-content">
            @yield('content')
        </main>
    </div>

    {{-- JS Khusus Halaman --}}
    @yield('scripts')
</body>
</html>