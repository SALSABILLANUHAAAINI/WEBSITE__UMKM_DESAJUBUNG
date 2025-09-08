<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    {{-- Kita panggil CSS khusus untuk halaman login --}}
    <link rel="stylesheet" href="{{ asset('css/admin/login.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login Admin</h2>

            {{-- Bagian ini akan menampilkan pesan error jika login gagal --}}
            {{-- Menampilkan pesan error jika login gagal --}}
@if($errors->any())
    <div class="alert-error">
        {{-- Mengambil pesan error spesifik, atau pesan umum jika ada error lain --}}
        {{ $errors->first('username') ?: $errors->first('captcha') ?: 'Terjadi kesalahan.' }}
    </div>
@endif

            {{-- Form ini sekarang aman dan berfungsi --}}
            <form action="{{ route('admin.login.submit') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="{{ old('username') }}" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
    </div>

    {{-- Jika Anda ingin menambahkan Captcha nanti, letakkan di sini --}}

    <button type="submit" class="btn-login">Login</button>
</form>
        </div>
    </div>
</body>
</html>