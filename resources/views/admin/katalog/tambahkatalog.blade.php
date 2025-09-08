@extends('admin.partials.sidebar')

@section('title', 'Tambah Katalog')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin/katalog/tambahkatalog.css') }}">
<style>
/* Toggle Switch */
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 24px;
}
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  transition: 0.4s;
  border-radius: 24px;
}
.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: 0.4s;
  border-radius: 50%;
}
input:checked + .slider {
  background-color: #4CAF50;
}
input:checked + .slider:before {
  transform: translateX(26px);
}
.kategori-item {
  margin-bottom: 20px;
  padding: 15px;
  border: 1px solid #ddd;
  border-radius: 8px;
}
.kategori-item h3 {
  margin-bottom: 10px;
}
.kategori-item input[type="text"] {
  width: 100%;
  padding: 8px 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}
</style>
@endsection

@section('content')
<div class="tambahkatalog-container">
    <div class="header">
        <a href="{{ url('/admin/katalog') }}" class="btn btn-back">⬅ Kembali</a>
        <button type="button" class="btn btn-add" id="tambahKategori">+ Tambah Katalog</button>
    </div>

    <h2>Tambah Katalog</h2>

    <form action="{{ url('/admin/katalog/store') }}" method="POST">
    @csrf
    <div id="kategoriWrapper">
        <div class="kategori-item">
            <h3>Kategori 1</h3>
            <input type="text" name="kategori[0][nama]" placeholder="Nama Kategori" required>
            <label class="switch">
                <input type="checkbox" name="kategori[0][aktif]" value="1" checked>
                <span class="slider"></span>
            </label>
        </div>
    </div>
    <button type="submit" class="btn submit">Simpan</button>
</form>

</div>
@endsection

@section('scripts')
<script>
document.getElementById('tambahKategori').addEventListener('click', function () {
    const wrapper = document.getElementById('kategoriWrapper');
    const index = wrapper.children.length;

    const kategoriDiv = document.createElement('div');
    kategoriDiv.classList.add('kategori-item');
    kategoriDiv.innerHTML = `
        <h3>Kategori ${index + 1}</h3>
        <input type="text" name="kategori[${index}][nama]" placeholder="Nama Kategori" required>
        <label class="switch">
            <input type="checkbox" name="kategori[${index}][aktif]" value="1" checked>
            <span class="slider"></span>
        </label>
    `;
    wrapper.appendChild(kategoriDiv);
});
</script>
@endsection
