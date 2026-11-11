<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { font-family: sans-serif; background: #fdf2f8; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: #fff; padding: 32px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,.08); width: 320px; }
        h2 { text-align: center; color: #be185d; }
        input { width: 100%; padding: 10px; margin: 8px 0; border: 1px solid #f9a8d4; border-radius: 8px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #ec4899; color: #fff; border: 0; border-radius: 8px; cursor: pointer; margin-top: 8px; }
        .error { color: #dc2626; font-size: 14px; }
        .success { color: #16a34a; font-size: 14px; }
        a { color: #be185d; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="card">
    <h2>Login</h2>

    @if (session('success')) <p class="success">{{ session('success') }}</p> @endif
    @if ($errors->any()) <p class="error">{{ $errors->first() }}</p> @endif

    <form method="POST" action="/login">
        @csrf
        <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Masuk</button>
    </form>
    <p style="text-align:center;">Belum punya akun? <a href="/register">Daftar</a></p>
</div>
</body>
</html>