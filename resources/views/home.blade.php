<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chiêm Tinh Vui</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Unbounded', sans-serif;
      background-color: #0d0d2b;
      color: #fff;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header class="flex justify-between items-center p-6 bg-gradient-to-b from-purple-900 to-indigo-900">
    <h1 class="text-3xl font-bold">🔮 Chiêm Tinh Vui</h1>
    <nav class="space-x-4">
    <nav class="space-x-4 flex items-center">
  <a href="#" class="hover:text-purple-300">Tử vi</a>
  <a href="#" class="hover:text-purple-300">Tarot</a>
  <a href="#" class="hover:text-purple-300">Giấc mơ</a>
  <a href="#" class="hover:text-purple-300">Tình yêu</a>

  @auth
    <span class="ml-6 text-white font-semibold">
      👋 Xin chào, {{ Auth::user()->name }}
    </span>
    <form method="POST" action="{{ route('logout') }}" class="inline ml-2">
      @csrf
      <button type="submit" class="px-4 py-2 border border-white rounded hover:bg-white hover:text-purple-700 transition">
        Đăng xuất
      </button>
    </form>
  @else
    <a href="/login" class="ml-6 px-4 py-2 border border-white text-white rounded hover:bg-white hover:text-purple-700 transition">
      Đăng nhập
    </a>
    <a href="/register" class="ml-2 px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded transition">
      Đăng ký
    </a>
  @endauth
</nav>

  </nav>
    </nav>
  </header>

  <!-- Hero Section -->
  <section class="text-center py-20 px-6 bg-gradient-to-b from-indigo-900 to-purple-900">
    <h2 class="text-5xl font-bold mb-6">Khám phá vũ trụ bên trong bạn ✨</h2>
    <p class="text-lg max-w-xl mx-auto mb-8">Nhận diện cung hoàng đạo, phân tích tình yêu, bói bài Tarot và nhiều hơn nữa chỉ với một cú click!</p>
    <a href="#" class="bg-purple-600 hover:bg-purple-700 text-white py-3 px-6 rounded-full text-lg font-semibold transition">Bắt đầu ngay</a>
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
