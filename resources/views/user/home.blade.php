@extends('layouts.app')

@section('title', 'Home')

@section('content')

{{-- Hero Section --}}
<section class="umkm-section py-12">
    <div class="umkm-container flex flex-col lg:flex-row items-center justify-between gap-8 px-6 lg:px-16">
        <!-- Left Image -->
        <div class="umkm-image flex-1">
           <img src="{{ asset('images/dummy16.jpg') }}" alt="Produk Dummy" class="rounded-xl shadow-lg">
        </div>

        <!-- Text Content -->
        <div class="umkm-text flex-1 text-center lg:text-left">
            <h3 class="sub-title text-lg font-semibold text-gray-600">Usaha Mikro, Kecil, dan Menengah</h3>
            <h1 class="main-title text-3xl lg:text-4xl font-bold mt-4 leading-relaxed">
                WEBSITE UMKM HADIR UNTUK MEMBERIKAN INFORMASI DAN INSPIRASI
            </h1>
            <p class="goal-text text-xl text-blue-700 font-semibold mt-4">MEMBANGUN UMKM LEBIH BERDAYA</p>
            <p class="desc-text text-gray-700 mt-6 leading-relaxed">
                Di website ini terdapat berbagai UMKM serta informasi seputar dunia usaha mikro, kecil, dan menengah.
                Kami hadir untuk memberikan wawasan dan inspirasi bagi perkembangan UMKM di Indonesia.
            </p>
        </div>

        <!-- Right Image -->
        <div class="umkm-image flex-1">
            <img src="{{ asset('images/dummy17.jpg') }}" alt="Produk Dummy" class="rounded-xl shadow-lg">
        </div>
    </div>
</section>

{{-- Logo Slider --}}
<section class="logo-slider py-10 bg-gray-50">
    <div class="slider-track flex items-center justify-center gap-8 overflow-x-auto px-6">

        <div class="slide flex-shrink-0">
            <img src="{{ asset('images/dummy1.PNG') }}"
                 alt="Logo Dummy 1"
                 class="rounded-full shadow-md object-cover">
        </div>

        <div class="slide flex-shrink-0">
            <img src="{{ asset('images/dummy2.png') }}"
                 alt="Logo Dummy 2"
                 class="rounded-full shadow-md object-cover">
        </div>

        <div class="slide flex-shrink-0">
            <img src="{{ asset('images/dummy3.PNG') }}"
                 alt="Logo Dummy 3"
                 class="rounded-full shadow-md object-cover">
        </div>

    </div>
</section>


{{-- Highlight UMKM --}}
<section class="highlight" style="background-image: url('{{ asset('images/dummy14.jpg') }}');">
    <div class="highlight-box">
        <h2>UMKM Desa Jubung</h2>
        <p>
            UMKM Desa Jubung adalah jantung perekonomian masyarakat Jubung.
            Dengan berbagai produk lokal yang unik, mulai dari kerajinan tangan,
            kuliner tradisional, hingga inovasi baru yang terus bermunculan,
            UMKM Jubung tidak hanya memperkuat kemandirian warga,
            tetapi juga menjadi daya tarik bagi pengunjung dari luar daerah.
        </p>
        <a href="{{ url('/umkm') }}" class="btn">Lihat Selengkapnya</a>
    </div>

</section>
{{-- Katalog UMKM --}}
<section class="py-16 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6">
      <h2 class="text-2xl md:text-3xl font-bold text-center mb-10 uppercase tracking-wide">
          Katalog Produk UMKM
      </h2>

      {{-- Pakai CSS katalog --}}
      <link rel="stylesheet" href="{{ asset('css/user/katalog/index.css') }}">

      {{-- Ambil struktur katalog-container dari katalog.blade, tapi tanpa toolbar & modal --}}
      <div class="katalog-container">
          <div class="katalog-grid">
              <div class="katalog-card"
                   data-kategori="minuman"
                   data-nama="Pawon Cupik"
                   data-harga="Rp 25.000"
                   data-toko="Pawon Cupik Official"
                   data-gambar="{{ asset('images/dummy9.PNG') }}">
                  <img src="{{ asset('images/dummy9.PNG') }}" alt="Pawon Cupik">
                  <div class="katalog-info">
                      <h3>Pawon Cupik</h3>
                  </div>
              </div>

              <div class="katalog-card"
                   data-kategori="barang"
                   data-nama="Mocci Nayya"
                   data-harga="Rp 30.000"
                   data-toko="Mocci Nayya Store"
                   data-gambar="{{ asset('images/dummy10.PNG') }}">
                  <img src="{{ asset('images/dummy10.PNG') }}" alt="Mocci Nayya">
                  <div class="katalog-info">
                      <h3>Mocci Nayya</h3>
                  </div>
              </div>

              <div class="katalog-card"
                   data-kategori="makanan"
                   data-nama="Trigapuri"
                   data-harga="Rp 20.000"
                   data-toko="Trigapuri Food"
                   data-gambar="{{ asset('images/dummy11.PNG') }}">
                  <img src="{{ asset('images/dummy11.PNG') }}" alt="Trigapuri">
                  <div class="katalog-info">
                      <h3>Trigapuri</h3>
                  </div>
              </div>

              <div class="katalog-card"
                   data-kategori="makanan"
                   data-nama="Warung Bu Romlah"
                   data-harga="Rp 10.000"
                   data-toko="Warung Bu Romlah"
                   data-gambar="{{ asset('images/dummy12.PNG') }}">
                  <img src="{{ asset('images/dummy12.PNG') }}" alt="Warung Bu Romlah">
                  <div class="katalog-info">
                      <h3>Warung Bu Romlah</h3>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>

{{-- Dynamic UMKM Cards --}}<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl md:text-3xl font-bold text-center mb-10 uppercase tracking-wide">
            Berbagai Macam UMKM Desa Jubung
        </h2>
 <link rel="stylesheet" href="{{ asset('css/user/umkm/index.css') }}">

        <div class="umkm-grid">
            {{-- UMKM 1 --}}
            <div class="umkm-card">
                <img src="{{ asset('images/dummy1.PNG') }}" alt="UMKM 1">
                   <div class="umkm-info">
                <h3 class="umkm-name">J-WASH</h3>
                <p class="umkm-desc">J-Wash hadir dengan berbagai pilihan minuman yang siap memanjakan tenggorokan dan bikin suasana makin adem. Menu andalannya tentu saja Es Teler 🥥🍈, perpaduan segar buah-buahan pilihan dengan sensasi manis dan creamy yang pas di lidah. Tersedia dalam kemasan kecil dan besar, jadi bisa dinikmati sendiri atau bareng teman dan keluarga. Selain itu, ada juga Es Jeruk 🍊 yang manis-segar, Es Teh 🧊 yang klasik dan menyegarkan, Jus Buah 🍓 yang sehat, dan Es Buah segar penuh vitamin.
</p></div>
                <a href="{{ url('/umkm/show') }}" class="btn-detail">Lihat Detail</a>
            </div>

            {{-- UMKM 2 --}}
            <div class="umkm-card">
                <img src="{{ asset('images/dummy2.PNG') }}" alt="UMKM 2">
                   <div class="umkm-info">
                <h3 class="umkm-name">TRIGAPURI</h3>
                <p class="umkm-desc">TRIGAPURI adalah surga belanja bagi siapa saja yang suka variasi. Di sini, satu tempat bisa memanjakan lidah sekaligus memenuhi kebutuhan harian. Untuk urusan dapur, ada bumbu jadi praktis yang siap mempercepat masakan, sambal ketan yang pedasnya bikin nagih, dan dawet segar yang pas dinikmati siang hari.</p>
                </div>
                <a href="{{ url('/umkm/show') }}" class="btn-detail">Lihat Detail</a>
            </div>

            {{-- UMKM 3 --}}
            <div class="umkm-card">
                <img src="{{ asset('images/dummy3.PNG') }}" alt="UMKM 3">
                  <div class="umkm-info">
                <h3 class="umkm-name">KEDAI ALEE</h3>
                <p class="umkm-desc">Kedai ale menjual berbagai macam jajanan pasar dengan rasa manis dan gurih sederhana, membangkitkan nostalgia masa kecil dan hangatnya suasana kampung.</p>
                </div>
                <a href="{{ url('/umkm/show') }}" class="btn-detail">Lihat Detail</a>
            </div>
        </div>
    </div>
</section>

@endsection
