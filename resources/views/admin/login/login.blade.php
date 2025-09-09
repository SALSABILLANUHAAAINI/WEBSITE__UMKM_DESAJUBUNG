<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/admin/login.css') }}">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login Admin</h2>

            @if($errors->any())
                <div class="alert-error">
                    {{ $errors->first('username') ?: $errors->first('captcha') }}
                </div>
            @endif

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

                {{-- KODE UNIK (CAPTCHA) --}}
                <div class="form-group">
                    <label>Kode Unik (Refresh dalam <span id="countdown-timer">60</span> detik)</label>

                    {{-- Kontainer baru untuk menata kode dan input --}}
                    <div class="captcha-wrapper">
                        <div class="captcha-code">{{ $captcha_code }}</div>
                        <input id="captcha" type="text" name="captcha" placeholder="Masukkan kode" required>
                    </div>
                </div>

                <button type="submit" class="btn-login">Login</button>
            </form>
        </div>
    </div>

    {{-- JAVASCRIPT UNTUK COUNTDOWN TIMER --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let timeLeft = 60;
            const countdownElement = document.getElementById('countdown-timer');

            const timer = setInterval(function() {
                timeLeft--;
                countdownElement.textContent = timeLeft;
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    location.reload();
                }
            }, 1000);
        });
    </script>
</body>
</html>