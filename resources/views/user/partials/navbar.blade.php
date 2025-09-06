<nav class="navbar">
    <div class="container">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="logo">UMKM Desa Jubung</a>

        <!-- Navigasi -->
        <ul class="nav-links">
            <li><a href="{{ url('/umkm') }}">UMKM</a></li>
            <li><a href="{{ url('/about') }}">Tentang</a></li>
            <li><a href="{{ url('/service') }}">Service</a></li>
            <li><a href="{{ url('/katalog') }}">Katalog</a></li>
        </ul>

        <!-- Icon Admin -->
        <a href="{{ url('/admin/login') }}" class="admin-icon" title="Admin Login">
            <svg xmlns="http://www.w3.org/2000/svg"
                 width="28" height="28" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="feather feather-user">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
        </a>
    </div>
</nav>
