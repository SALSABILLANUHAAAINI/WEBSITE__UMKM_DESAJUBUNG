<nav class="navbar" role="navigation" aria-label="Primary">
  <div class="navbar__wrap">
    <!-- Kiri -->
    <ul class="nav-links nav-left">
      <li><a href="{{ url('/umkm') }}">UMKM</a></li>
      <li><a href="{{ url('/about') }}">Tentang</a></li>
    </ul>

    <!-- Logo Tengah -->
    <a href="{{ url('/') }}" class="logo" aria-label="Beranda">
      <span class="logo__title">UMKM Desa Jubung</span>
      <span class="logo__sub">Produk Lokal • Digital</span>
    </a>

    <!-- Kanan -->
    <div class="nav-right-group">
      <ul class="nav-links nav-right">
        <li><a href="{{ url('/service') }}">Service</a></li>
        <li><a href="{{ url('/katalog') }}">Katalog</a></li>
      </ul>
      <a href="{{ url('/admin/login') }}" class="admin-icon" title="Admin Login" aria-label="Admin Login">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
          <circle cx="12" cy="7" r="4"></circle>
        </svg>
      </a>
    </div>

    <!-- Tombol Hamburger (hanya mobile) -->
    <button class="hamburger" aria-label="Menu" aria-expanded="false">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </div>

  <!-- Dropdown Mobile (default tersembunyi) -->
  <div class="mobile-menu">
    <ul>
      <li><a href="{{ url('/umkm') }}">UMKM</a></li>
      <li><a href="{{ url('/about') }}">Tentang</a></li>
      <li><a href="{{ url('/service') }}">Service</a></li>
      <li><a href="{{ url('/katalog') }}">Katalog</a></li>
      <li><a href="{{ url('/admin/login') }}">Admin</a></li>
    </ul>
  </div>
</nav>
