<nav class="navbar" role="navigation" aria-label="Primary">
  <div class="container navbar__row">
    <input type="checkbox" id="nav-toggle" class="nav-toggle" aria-label="Toggle menu">
    <label for="nav-toggle" class="nav-burger" aria-hidden="true">
      <span></span><span></span><span></span>
    </label>

    <a href="{{ url('/') }}" class="logo">
      <span class="logo__title">UMKM Desa Jubung</span>
      <span class="logo__sub">Produk Lokal • Digital</span>
    </a>

    <ul class="nav-links">
      <li><a href="{{ url('/umkm') }}">UMKM</a></li>
      <li><a href="{{ url('/about') }}">Tentang</a></li>
      <li><a href="{{ url('/service') }}">Service</a></li>
      <li><a href="{{ url('/katalog') }}">Katalog</a></li>
    </ul>

    <a href="{{ url('/admin/login') }}" class="admin-icon" title="Admin Login">
      <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none"
           stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
        <circle cx="12" cy="7" r="4"></circle>
      </svg>
      <span class="admin-text">Admin</span>
    </a>
  </div>
</nav>
