<!DOCTYPE html>
<html>
<head>
    <title>EPATV Job Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>Welcome to EPATV Job Portal</h1>
    @if (Route::has('login'))
        <a href="{{ route('login') }}">Login</a>
        @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
        @endif
    @endif
</body>
</html>
