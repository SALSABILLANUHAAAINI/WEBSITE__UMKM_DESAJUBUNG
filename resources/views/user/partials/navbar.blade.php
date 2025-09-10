<nav class="navbar" role="navigation" aria-label="Primary">
  <div class="navbar__wrap">

    <!-- Hamburger (mobile) -->
    <button class="hamburger" id="hamburgerBtn" aria-label="Menu">
      <span></span>
      <span></span>
      <span></span>
    </button>

    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo" aria-label="Beranda">
      <span class="logo__title">UMKM Desa Jubung</span>
      <span class="logo__sub">Produk Lokal • Digital</span>
    </a>

    <!-- Menu -->
    <div class="nav-menu" id="navMenu">
      <ul class="nav-links nav-left">
        <li><a href="{{ url('/umkm') }}">UMKM</a></li>
        <li><a href="{{ url('/about') }}">Tentang</a></li>
      </ul>

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

  </div>
</nav>
<script>
  // Toggle Hamburger Menu
  const hamburgerBtn = document.getElementById('hamburgerBtn');
  const navMenu = document.getElementById('navMenu');

  hamburgerBtn.addEventListener('click', () => {
    navMenu.classList.toggle('nav-menu--active');
    hamburgerBtn.classList.toggle('is-active');
  });