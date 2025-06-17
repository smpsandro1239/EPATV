<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>Dashboard</h1>
    @if(auth()->user()->role === 'student')
        @include('partials.student')
    @elseif(auth()->user()->role === 'company')
        @include('partials.company')
    @endif
</body>
</html>
