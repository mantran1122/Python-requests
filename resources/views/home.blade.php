<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $siteName ?? 'Chiêm Tinh Vui' }}</title>
  <link rel="icon" href="{{ $siteLogo ?? asset('image/icon.png') }}" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    body {
      font-family: 'Unbounded', sans-serif;
      color: #E5E7EB;
      background: none;
    }

    .hero-bg {
      background:
        linear-gradient(rgba(13, 13, 43, 0.6), rgba(13, 13, 43, 0.6)),
        url("{{ asset('image/anhnen2.jpg') }}") no-repeat center center fixed;
      background-size: cover;
    }
  </style>
</head>

<body class="min-h-screen flex flex-col">

  <!-- Header -->
  <section class="hero-bg text-center py-20 px-4 bg-transparent flex-grow">
    <header class="flex justify-between items-center p-6 pt-0.5 bg-transparent">
    <div class="flex items-center space-x-2">
      <img 
        src="{{ $siteLogo ?? asset('image/icon.png') }}" 
        alt="Logo" 
        class="h-10 w-10 rounded-full"
      >
      <h1 class="text-2xl font-bold text-white">
        {{ $siteName ?? 'Chiêm Tinh Vui' }}
      </h1>
    </div>
      <nav class="space-x-4 flex items-center">
        <a href="{{ auth()->check() ? route('chart') : route('login') }}" class="hover:text-purple-300">Bảng đồ sao</a>
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
        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100 border-b border-gray-200 text-left">
          Thông tin cá nhân
        </a>
        <a href="{{ route('password.change') }}" class="block px-4 py-2 hover:bg-gray-100 border-b border-gray-200 text-left">
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
        class="ml-6 text-white font-semibold px-3 py-1 rounded-full text-sm hover:underline">
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

    <!-- Flash message -->
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

    <section class="text-center py-20 px-6 bg-transparent flex-grow">
      <h2 class="text-5xl font-bold mb-6">Khám phá vũ trụ bên trong bạn ✨</h2>
      <p class="text-lg max-w-xl mx-auto mb-8">Phân tích tình yêu, tạo biểu đồ sao chỉ với một cú click!</p>
      <a href="{{ auth()->check() ? route('chart') : route('login') }}"
        class="bg-purple-600 hover:bg-purple-700 text-white py-3 px-6 rounded-full text-lg font-semibold transition">
        Bắt đầu ngay
      </a>
    </section>
    <section class="py-16 px-6 bg-transparent">
  <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 text-center">
    
    <!-- Biểu đồ sao -->
    <div>
      <h3 class="text-2xl font-semibold mb-2">🔭 Biểu đồ sao</h3>
      <p>Xem chi tiết biểu đồ sao cá nhân của bạn, bao gồm Ascendant, Midheaven và vị trí các hành tinh.</p>
    </div>

    <!-- Tình yêu trong chiêm tinh -->
    <div>
      <h3 class="text-2xl font-semibold mb-2">❤️ Tình yêu trong chiêm tinh</h3>
      <p>Phân tích mức độ hòa hợp và năng lượng tình yêu giữa bạn và đối phương dựa trên Synastry.</p>
    </div>

  </div>
</section>

  </section>

  <section id="about" class="py-16 px-6 bg-transparent text-black">
    <div class="max-w-4xl mx-auto text-center">
      <h2 class="text-4xl font-semibold mb-4">Về Chiêm Tinh Vui</h2>
      <p class="text-lg leading-relaxed">
        Chiêm Tinh Vui là nền tảng giúp bạn khám phá vũ trụ nội tâm qua các công cụ:
        <strong>Tử vi cá nhân</strong>, <strong>Bói Tarot</strong>, <strong>Giải mã giấc mơ</strong> và
        <strong>Tính toán tình yêu</strong>. Mỗi tính năng đều được thiết kế trực quan,
        dễ dùng, hỗ trợ bạn tìm ra thông điệp từ các vì sao và hiểu rõ bản thân hơn.
      </p>
      <p class="text-lg leading-relaxed mt-4">
        Với giao diện thân thiện, tích hợp Alpine.js và Tailwind CSS, chúng tôi cam kết
        mang đến trải nghiệm mượt mà trên mọi thiết bị. Hãy cùng “Chiêm Tinh Vui”
        khám phá những bí ẩn vũ trụ chỉ với một cú click!
      </p>
    </div>
  </section>

<!-- Our Services (rút gọn 6 mục) -->
<section id="services" class="py-16 px-6 bg-purple-100">
  <div class="max-w-6xl mx-auto text-center">
    <h2 class="text-4xl font-semibold mb-10 text-purple-700">🔭 Kiến thức Chiêm Tinh Toàn Diện</h2>
    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
      <!-- 1. Biểu đồ sao (Natal Chart) -->
      <div class="bg-purple-500 bg-opacity-20 p-6 rounded-2xl hover:bg-opacity-30 transition">
        <div class="text-5xl mb-4">🗺️</div>
        <h3 class="text-xl font-semibold mb-2 text-purple-800">Bảng Đồ Sao</h3>
        <p class="text-sm text-purple-700">Vẽ vị trí hành tinh, Ascendant & Midheaven tại thời điểm sinh.</p>
      </div>

      <!-- 2. Sun, Moon & Rising -->
      <div class="bg-purple-500 bg-opacity-20 p-6 rounded-2xl hover:bg-opacity-30 transition">
        <div class="text-5xl mb-4">🌞</div>
        <h3 class="text-xl font-semibold mb-2 text-purple-800">Mặt Trời & Mặt Trăng</h3>
        <p class="text-sm text-purple-700">Linh hồn (Sun), cảm xúc (Moon) và cách bạn xuất hiện (Rising).</p>
      </div>

      <!-- 3. 12 Nhà (Houses) -->
      <div class="bg-purple-500 bg-opacity-20 p-6 rounded-2xl hover:bg-opacity-30 transition">
        <div class="text-5xl mb-4">🏠</div>
        <h3 class="text-xl font-semibold mb-2 text-purple-800">12 Nhà</h3>
        <p class="text-sm text-purple-700">Mỗi nhà thể hiện lĩnh vực: tài chính, sự nghiệp, tình yêu…</p>
      </div>

      <!-- 4. Các Góc (Aspects) -->
      <div class="bg-purple-500 bg-opacity-20 p-6 rounded-2xl hover:bg-opacity-30 transition">
        <div class="text-5xl mb-4">🔗</div>
        <h3 class="text-xl font-semibold mb-2 text-purple-800">Các Góc</h3>
        <p class="text-sm text-purple-700">Conjunction, Opposition, Trine, Square… tác động lên năng lượng.</p>
      </div>

      <!-- 5. Synastry (Tình yêu) -->
      <div class="bg-purple-500 bg-opacity-20 p-6 rounded-2xl hover:bg-opacity-30 transition">
        <div class="text-5xl mb-4">❤️</div>
        <h3 class="text-xl font-semibold mb-2 text-purple-800">Synastry</h3>
        <p class="text-sm text-purple-700">So sánh hai bản đồ sao để đánh giá mức độ hòa hợp.</p>
      </div>

      <!-- 6. Transits & Progressions -->
      <div class="bg-purple-500 bg-opacity-20 p-6 rounded-2xl hover:bg-opacity-30 transition">
        <div class="text-5xl mb-4">🌠</div>
        <h3 class="text-xl font-semibold mb-2 text-purple-800">Transits & Progressions</h3>
        <p class="text-sm text-purple-700">Dự báo xu hướng & giai đoạn phát triển cá nhân.</p>
      </div>
    </div>

    <!-- Nút Xem thêm -->
    <div class="flex justify-center mt-8">
      <a href="{{ route('astrology.details') }}"
         class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-full text-lg font-medium transition">
        Xem thêm chi tiết
      </a>
    </div>
  </div>
</section>


  <!-- Chòm Sao Gallery -->
  <section id="constellations" class="py-16 px-6 bg-gray-100">
    <div class="max-w-6xl mx-auto">
      <!-- Tiêu đề -->
      <h2 class="text-2xl font-semibold text-center mb-10 text-gray-800">CHÒM SAO</h2>
      <!-- Grid 6 cột trên desktop, co giãn trên mobile -->
      <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-8 justify-items-center">

        <!-- Mỗi ô là một biểu tượng vòng tròn -->
        <div>
          <img src="{{ asset('image/Asset-2.png') }}" alt="Bạch Dương" class="w-16 h-16 rounded-full" />
        </div>
        <div>
          <img src="{{ asset('image/Asset-3.png') }}" alt="Kim Ngưu" class="w-16 h-16 rounded-full" />
        </div>
        <div>
          <img src="{{ asset('image/Asset-4.png') }}" alt="Song Tử" class="w-16 h-16 rounded-full" />
        </div>
        <div>
          <img src="{{ asset('image/Asset-5.png') }}" alt="Cự Giải" class="w-16 h-16 rounded-full" />
        </div>
        <div>
          <img src="{{ asset('image/Asset-6.png') }}" alt="Sư Tử" class="w-16 h-16 rounded-full" />
        </div>
        <div>
          <img src="{{ asset('image/Asset-7.png') }}" alt="Xử Nữ" class="w-16 h-16 rounded-full" />
        </div>

        <div>
          <img src="{{ asset('image/Asset-8.png') }}" alt="Thiên Bình" class="w-16 h-16 rounded-full" />
        </div>
        <div>
          <img src="{{ asset('image/Asset-9.png') }}" alt="Bọ Cạp" class="w-16 h-16 rounded-full" />
        </div>
        <div>
          <img src="{{ asset('image/Asset-10.png') }}" alt="Nhân Mã" class="w-16 h-16 rounded-full" />
        </div>
        <div>
          <img src="{{ asset('image/Asset-1.png') }}" alt="Ma Kết" class="w-16 h-16 rounded-full" />
        </div>
        <div>
          <img src="{{ asset('image/Asset-11.png') }}" alt="Bảo Bình" class="w-16 h-16 rounded-full" />
        </div>
        <div>
          <img src="{{ asset('image/Asset-12.png') }}" alt="Song Ngư" class="w-16 h-16 rounded-full" />
        </div>

      </div>
    </div>
  </section>
  <!-- Hành Tinh Gallery (2 hàng x 5 cột) -->
  <section id="planets" class="py-16 px-6 bg-gray-100">
    <div class="max-w-6xl mx-auto">

      <!-- Tiêu đề -->
      <h2 class="text-2xl font-semibold text-center mb-10 text-gray-800">HÀNH TINH</h2>

      <!-- Grid: mobile 2 cột, sm trở lên 5 cột -->
      <div class="grid grid-cols-2 sm:grid-cols-5 gap-8 justify-items-center">

        <!-- Mặt Trời -->
        <div class="flex flex-col items-center space-y-2">
          <span class="text-sm font-medium text-gray-800">MẶT TRỜI</span>
          <img src="{{ asset('image/sun-120x120.png') }}" alt="Mặt Trời" class="w-24 h-24 rounded-full object-cover" />
        </div>

        <!-- Mặt Trăng -->
        <div class="flex flex-col items-center space-y-2">
          <span class="text-sm font-medium text-gray-800">MẶT TRĂNG</span>
          <img src="{{ asset('image/moon-100x100.png') }}" alt="Mặt Trăng"
            class="w-24 h-24 rounded-full object-cover" />
        </div>

        <!-- Sao Thủy -->
        <div class="flex flex-col items-center space-y-2">
          <span class="text-sm font-medium text-gray-800">SAO THỦY</span>
          <img src="{{ asset('image/mer-100x100.png') }}" alt="Sao Thủy" class="w-24 h-24 rounded-full object-cover" />
        </div>

        <!-- Sao Kim -->
        <div class="flex flex-col items-center space-y-2">
          <span class="text-sm font-medium text-gray-800">SAO KIM</span>
          <img src="{{ asset('image/venus-100x100.png') }}" alt="Sao Kim" class="w-24 h-24 rounded-full object-cover" />
        </div>

        <!-- Sao Hỏa -->
        <div class="flex flex-col items-center space-y-2">
          <span class="text-sm font-medium text-gray-800">SAO HỎA</span>
          <img src="{{ asset('image/mars-100x100.png') }}" alt="Sao Hỏa" class="w-24 h-24 rounded-full object-cover" />
        </div>

        <!-- Sao Mộc -->
        <div class="flex flex-col items-center space-y-2">
          <span class="text-sm font-medium text-gray-800">SAO MỘC</span>
          <img src="{{ asset('image/jup-100x100.png') }}" alt="Sao Mộc" class="w-24 h-24 rounded-full object-cover" />
        </div>

        <!-- Sao Thổ -->
        <div class="flex flex-col items-center space-y-2">
          <span class="text-sm font-medium text-gray-800">SAO THỔ</span>
          <img src="{{ asset('image/saturn-200x200.png') }}" alt="Sao Thổ"
            class="w-24 h-24 rounded-full object-cover" />
        </div>

        <!-- Sao Thiên Vương -->
        <div class="flex flex-col items-center space-y-2">
          <span class="text-sm font-medium text-gray-800">SAO THIÊN VƯƠNG</span>
          <img src="{{ asset('image/uranus-100x100.png') }}" alt="Sao Thiên Vương"
            class="w-24 h-24 rounded-full object-cover" />
        </div>

        <!-- Sao Hải Vương -->
        <div class="flex flex-col items-center space-y-2">
          <span class="text-sm font-medium text-gray-800">SAO HẢI VƯƠNG</span>
          <img src="{{ asset('image/nep-100x100.png') }}" alt="Sao Hải Vương"
            class="w-24 h-24 rounded-full object-cover" />
        </div>

        <!-- Sao Diêm Vương -->
        <div class="flex flex-col items-center space-y-2">
          <span class="text-sm font-medium text-gray-800">SAO DIÊM VƯƠNG</span>
          <img src="{{ asset('image/pluto-100x100.png') }}" alt="Sao Diêm Vương"
            class="w-24 h-24 rounded-full object-cover" />
        </div>

      </div>
    </div>
  </section>



  <!-- Footer -->
  <footer class="bg-purple-800 text-gray-200">
    <div class="max-w-6xl mx-auto py-12 px-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

      <!-- About -->
      <div>
        <h3 class="text-xl font-semibold mb-4 text-white">Về Chiêm Tinh Vui</h3>
        <p class="text-sm leading-relaxed">
          Chiêm Tinh Vui giúp bạn khám phá vũ trụ nội tâm thông qua Tử vi, Tarot, Giải mã giấc mơ và Tình yêu.
          Giao diện thân thiện, hỗ trợ mọi thiết bị, mong mang lại trải nghiệm thú vị cho bạn.
        </p>
      </div>

      <!-- Quick Links -->
      <div>
        <h3 class="text-xl font-semibold mb-4 text-white">Liên Kết Nhanh</h3>
        <ul class="space-y-2 text-sm">
          <li><a href="{{ route('chart') }}" class="hover:underline">Bảng đồ sao</a></li>
          <li><a href="{{ route('love.form') }}" class="hover:underline">Tình yêu</a></li>
          <li><a href="{{ route('login') }}" class="hover:underline">Đăng nhập</a></li>
          <li><a href="{{ route('register') }}" class="hover:underline">Đăng ký</a></li>
          <li><a href="#about" class="hover:underline">Về chúng tôi</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div>
        <h3 class="text-xl font-semibold mb-4 text-white">Liên Hệ</h3>
        <ul class="space-y-2 text-sm">
          <li>Email: <a href="mailto:contact@chiemtinhvui.vn" class="hover:underline">contact@chiemtinhvui.vn</a></li>
          <li>Hotline: <a href="tel:+84901234567" class="hover:underline">+84 901 234 567</a></li>
          <li>Địa chỉ: 123 Đường Thiên Văn, Hà Nội</li>
        </ul>
      </div>

      <!-- Social Media -->
      <div>
        <h3 class="text-xl font-semibold mb-4 text-white">Kết Nối</h3>
        <div class="flex space-x-4">
          <a href="https://www.youtube.com/your-channel" target="_blank" class="hover:text-white">
            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
              <path
                d="M23.498 6.186a2.997 2.997 0 0 0-2.108-2.116C19.635 3.5 12 3.5 12 3.5s-7.635 0-9.39.57A2.997 2.997 0 0 0 .502 6.186C0 8.016 0 12 0 12s0 3.984.502 5.814a2.997 2.997 0 0 0 2.108 2.116c1.755.57 9.39.57 9.39.57s7.635 0 9.39-.57a2.997 2.997 0 0 0 2.108-2.116C24 15.984 24 12 24 12s0-3.984-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
            </svg>
          </a>
          <a href="#" class="hover:text-white"><svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
              <path
                d="M12 2.04c-5.52 0-9.96 4.48-9.96 9.96 0 4.41 3.59 8.07 8.06 8.86v-6.26h-2.42v-2.6h2.42v-1.98c0-2.4 1.44-3.74 3.63-3.74 1.05 0 2.16.18 2.16.18v2.37h-1.22c-1.2 0-1.57.75-1.57 1.52v1.65h2.68l-.43 2.6h-2.25v6.26c4.47-.79 8.06-4.45 8.06-8.86 0-5.48-4.44-9.96-9.96-9.96z" />
            </svg></a>
            <a href="https://twitter.com/your_username" target="_blank" class="hover:text-white">
  <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path d="M23.643 4.937c-.835.37-1.732.62-2.675.732a4.688 4.688 0 002.048-2.588 9.346 9.346 0 01-2.97 1.136 4.67 4.67 0 00-7.956 4.256A13.25 13.25 0 011.671 3.149a4.67 4.67 0 001.444 6.233 4.636 4.636 0 01-2.116-.584v.06a4.67 4.67 0 003.746 4.576 4.67 4.67 0 01-2.11.08 4.67 4.67 0 004.36 3.243 9.379 9.379 0 01-5.803 2.001c-.377 0-.75-.022-1.116-.065a13.223 13.223 0 007.164 2.097c8.592 0 13.29-7.117 13.29-13.29 0-.202-.005-.404-.014-.605a9.513 9.513 0 002.337-2.422z"/>
  </svg>
</a>


        </div>
      </div>

    </div>

    <!-- Bottom line -->
    <div class="border-t border-purple-700 mt-6 pt-6 text-center text-sm text-gray-400">
      © 2025 Chiêm Tinh Vui. All rights reserved.
    </div>
  </footer>


</body>

</html>