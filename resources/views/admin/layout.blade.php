<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Chiêm Tinh Admin')</title>

  {{-- TailwindCSS --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  {{-- Icon fonts --}}
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  {{-- Favicon --}}
  <link rel="icon" href="{{ asset('image/icon.png') }}" type="image/png">

  <style>
    body {
      background: linear-gradient(to bottom right, #5b21b6, #3b0764);
      font-family: 'Inter', sans-serif;
      color: white;
    }
    .sidebar-link:hover {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 12px;
    }
    .sidebar-link.active {
      background: linear-gradient(to right, #8b5cf6, #7c3aed);
      color: white;
      font-weight: bold;
      border-radius: 12px;
    }
    .topbar {
      background: rgba(255,255,255,0.05);
      backdrop-filter: blur(10px);
    }
    #chartTraCuu, #chartUser {
      width: 100% !important;
      height: 320px !important;
    }
  </style>
</head>
<body class="min-h-screen flex">

  {{-- Sidebar --}}
  <aside class="w-64 bg-gradient-to-b from-indigo-900 to-indigo-700 p-4 flex flex-col gap-4">
    <div class="text-center text-2xl font-bold mb-6">
    🔮 Chiêm Tinh Admin
    </div>
    <nav class="flex flex-col gap-2">
      <a href="{{ route('admin.dashboard') }}" class="sidebar-link px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fas fa-home mr-2"></i> Dashboard
      </a>
      <a href="{{ route('admin.users.index') }}" class="sidebar-link px-4 py-3 {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <i class="fas fa-users mr-2"></i> Người dùng
      </a>
      <a href="{{ route('admin.zodiac_signs.index') }}" class="sidebar-link px-4 py-3 {{ request()->routeIs('admin.zodiac_signs.*') ? 'active' : '' }}">
        <i class="fas fa-star mr-2"></i> Cung hoàng đạo
      </a>
      <a href="{{ route('admin.astrology_results.index') }}" class="sidebar-link px-4 py-3 {{ request()->routeIs('admin.astrology_results.*') ? 'active' : '' }}">
        <i class="fas fa-magic mr-2"></i> Kết quả chiêm tinh
      </a>
      <a href="{{ route('admin.llm-configurations.index') }}" class="sidebar-link px-4 py-3 {{ request()->routeIs('admin.llm-configurations.*') ? 'active' : '' }}">
        <i class="fas fa-cogs mr-2"></i> Cấu hình LLM
      </a>
    </nav>
    <div class="mt-auto">
      <form action="{{ route('logout') }}" method="POST" class="text-center">
        @csrf
        <button type="submit" class="w-full mt-4 py-2 bg-red-500 hover:bg-red-600 rounded-lg font-semibold">
          <i class="fas fa-sign-out-alt mr-1"></i> Đăng xuất
        </button>
      </form>
    </div>
  </aside>

  {{-- Main content --}}
  <div class="flex-1 flex flex-col">
    {{-- Topbar --}}
    <header class="topbar p-4 flex justify-between items-center text-white">
      <h1 class="text-2xl font-bold">@yield('title', 'Chiêm Tinh Admin')</h1>
    </header>

    <main class="flex-1 p-6 overflow-y-auto">
      @yield('content')
    </main>
  </div>

  {{-- Chèn script --}}
  @stack('scripts')

</body>
</html>
