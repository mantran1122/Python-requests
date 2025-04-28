<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Chiêm Tinh Vui - Admin')</title>

    {{-- Icon + Font --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('image/icon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('image/icon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Tailwind & Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: linear-gradient(to bottom right, #5b21b6, #312e81); /* Tím → xanh đậm */
            min-height: 100vh;
            color: white;
        }
    </style>
</head>

<body class="flex">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Nội dung --}}
    <div class="flex-1 p-6 ml-64">
        @yield('content')
    </div>

</body>
</html>
