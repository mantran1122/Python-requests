<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chiêm Tinh Vui</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    body {
      font-family: 'Unbounded', sans-serif;
      background-color: #0d0d2b;
      color: #fff;
    }
  </style>
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('image/icon.png') }}">
  <link rel="apple-touch-icon" href="{{ asset('image/icon.png') }}">
</head>

<body>
  <!-- Header -->
  <header class="flex justify-between items-center p-6 bg-gradient-to-b from-purple-900 to-indigo-900">
    <h1 class="text-3xl font-bold">🔮 Chiêm Tinh Vui</h1>
    <nav class="space-x-4 flex items-center">
      <!-- <a href="{{ auth()->check() ? '#' : route('login') }}" class="hover:text-purple-300">Tử vi</a> -->
      <a href="{{ auth()->check() ? route('chart') : route('login') }}" class="hover:text-purple-300">Bảng đồ sao</a>
      <!-- <a href="{{ auth()->check() ? '#' : route('login') }}" class="hover:text-purple-300">Giấc mơ</a> -->
      <a href="{{ auth()->check() ? route('love.form') : route('login') }}" class="hover:text-purple-300">Tình yêu</a>

      @auth
      <div x-data="{ open: false }" class="relative ml-4">
      <button @click="open = !open"
        class="flex items-center space-x-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold px-4 py-2 rounded">
        <span>👤 {{ Auth::user()->name }}</span>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>

      <div x-show="open" @click.outside="open = false" x-transition
        class="absolute right-0 mt-2 w-56 bg-white text-black rounded shadow-lg z-50">
        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100 border-b border-gray-200">
        Thông tin cá nhân
        </a>
        <a href="{{ route('password.change') }}" class="block px-4 py-2 hover:bg-gray-100 border-b border-gray-200">
        Đổi mật khẩu
        </a>
        <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">
          Đăng xuất
        </button>
        </form>
      </div>
      </div>


      <a href="{{ route('recharge.form') }}"
      class="ml-6 text-white font-semibold text-black font-semibold px-3 py-1 rounded-full text-sm hover:underline">
      💰 {{ Auth::user()->coinBalance() }} coins
      </a>

      <form method="POST" action="{{ route('logout') }}" class="inline ml-2">
      @csrf
      <button type="submit"
        class="px-4 py-2 border border-white rounded hover:bg-white hover:text-purple-700 transition">
        Đăng xuất
      </button>
      </form>
    @else
      <a href="{{ route('login') }}"
      class="ml-6 px-4 py-2 border border-white text-white rounded hover:bg-white hover:text-purple-700 transition">
      Đăng nhập
      </a>
      <a href="{{ route('register') }}"
      class="ml-2 px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded transition">
      Đăng ký
      </a>
    @endauth
    </nav>
  </header>

  <!-- Thông báo flash -->
  @if (session('success'))
    <div x-data="{ show: true }" x-show="show"
    class="bg-green-100 border border-green-300 text-green-900 px-6 py-4 mx-4 mt-6 rounded relative flex justify-between items-center">
    <div class="flex items-center gap-2">
      <span class="text-lg">⏰</span>
      <span>{!! session('success') !!}</span>
    </div>
    <button @click="show = false"
      class="text-green-800 font-semibold hover:text-green-600 text-xl px-3 focus:outline-none">✖</button>
    </div>
  @endif

  <!-- Hero Section -->
  <section class="text-center py-20 px-6 bg-gradient-to-b from-indigo-900 to-purple-900">
    <h2 class="text-5xl font-bold mb-6">Khám phá vũ trụ bên trong bạn ✨</h2>
    <p class="text-lg max-w-xl mx-auto mb-8">Phân tích tình yêu, tạo biểu đồ sao chỉ với một cú click!</p>
    <a href="{{ auth()->check() ? route('chart') : route('login') }}"
      class="bg-purple-600 hover:bg-purple-700 text-white py-3 px-6 rounded-full text-lg font-semibold transition">
      Bắt đầu ngay
    </a>
  </section>

  <!-- Features -->
  <section class="py-16 px-6 bg-[#0a0a23]">
    <div class="max-w-6xl mx-auto grid md:grid-cols-4 gap-8 text-center">
      <div>
        <h3 class="text-2xl font-semibold mb-2">🔯 Tử vi cá nhân</h3>
        <p>Xem cung hoàng đạo và dự báo hôm nay</p>
      </div>
      <div>
        <h3 class="text-2xl font-semibold mb-2">🃏 Bói Tarot</h3>
        <p>Trải bài để nhận thông điệp vũ trụ gửi gắm</p>
      </div>
      <div>
        <h3 class="text-2xl font-semibold mb-2">🌙 Giải mã giấc mơ</h3>
        <p>Giải nghĩa những giấc mơ kỳ lạ và sâu sắc</p>
      </div>
      <div>
        <h3 class="text-2xl font-semibold mb-2">❤️ Tính toán tình yêu</h3>
        <p>Xem độ hợp giữa bạn và người ấy</p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="text-center py-6 bg-[#0a0a23] border-t border-purple-800">
    <p>© 2025 Chiêm Tinh Vui. All rights reserved.</p>
  </footer>
</body>

</html>