<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">



    {{-- Icon + Font --}}
    <title>{{ $siteName ?? 'Chiêm Tinh Vui' }} | Admin</title>
    <link rel="icon" href="{{ $siteLogo ?? asset('image/icon.png') }}" type="image/png" sizes="32x32">

    <link rel="apple-touch-icon" href="{{ asset('image/icon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Tailwind & Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Remove inline gradient styling --}}
</head>

<body class="flex bg-gray-900 text-gray-200 min-h-screen">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Nội dung --}}
    <div class="flex-1 p-6 ml-64">
        @yield('content')
    </div>

</body>
</html>