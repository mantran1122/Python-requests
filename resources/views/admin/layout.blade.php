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
    /* Sidebar active link */
    .sidebar-link.active {
      background-color: #374151; /* bg-gray-700 */
      color: #000000;            /* black */
      font-weight: bold;
      border-radius: 0.5rem;     /* rounded-lg */
    }

    /* Sidebar hover */
    .sidebar-link:hover {
      background-color: rgba(55, 65, 81, 0.5); /* bg-gray-700/50 */
      color: #000000;
      border-radius: 0.5rem;
    }

    /* Topbar */
    .topbar {
      background-color: rgba(243, 244, 246, 0.5); /* gray-100/50 */
      border-bottom: 1px solid #E5E7EB; /* gray-200 */
    }
  </style>
</head>

<body class="min-h-screen flex bg-gray-200 text-gray-900 font-sans">

  {{-- Sidebar --}}
  <aside class="w-64 bg-gray-200 p-6 flex flex-col space-y-4">
    <div class="text-center text-2xl font-bold text-gray-900 mb-6">
      🔮 Chiêm Tinh Admin
    </div>
    <nav class="flex-1 flex flex-col space-y-2">
      <a href="{{ route('admin.dashboard') }}"
         class="sidebar-link px-4 py-3 flex items-center space-x-3 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fas fa-home text-gray-900"></i>
        <span>Dashboard</span>
      </a>
      <a href="{{ route('admin.users.index') }}"
         class="sidebar-link px-4 py-3 flex items-center space-x-3 {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <i class="fas fa-users text-gray-900"></i>
        <span>Người dùng</span>
      </a>
      <a href="{{ route('admin.zodiac_signs.index') }}"
         class="sidebar-link px-4 py-3 flex items-center space-x-3 {{ request()->routeIs('admin.zodiac_signs.*') ? 'active' : '' }}">
        <i class="fas fa-star text-gray-900"></i>
        <span>Cung hoàng đạo</span>
      </a>
      <a href="{{ route('admin.astrology_results.index') }}"
         class="sidebar-link px-4 py-3 flex items-center space-x-3 {{ request()->routeIs('admin.astrology_results.*') ? 'active' : '' }}">
        <i class="fas fa-magic text-gray-900"></i>
        <span>Kết quả chiêm tinh</span>
      </a>
      <a href="{{ route('admin.llm-configurations.index') }}"
         class="sidebar-link px-4 py-3 flex items-center space-x-3 {{ request()->routeIs('admin.llm-configurations.*') ? 'active' : '' }}">
        <i class="fas fa-cogs text-gray-900"></i>
        <span>Cấu hình LLM</span>
      </a>
    </nav>
    <form action="{{ route('logout') }}" method="POST" class="mt-auto">
      @csrf
      <button type="submit"
              class="w-full px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg font-semibold flex items-center justify-center space-x-2">
        <i class="fas fa-sign-out-alt"></i>
        <span>Đăng xuất</span>
      </button>
    </form>
  </aside>

  {{-- Main content --}}
  <div class="flex-1 flex flex-col">
    {{-- Topbar --}}
    <header class="topbar p-4 flex justify-between items-center text-gray-900">
      <h1 class="text-2xl font-bold">@yield('title', 'Dashboard')</h1>
      {{-- icons etc. --}}
    </header>

    {{-- Page Content --}}
    <main class="flex-1 p-6 bg-gray-50 overflow-y-auto">
      @yield('content')
    </main>
  </div>

  {{-- Scripts --}}
  @stack('scripts')
</body>
</html>