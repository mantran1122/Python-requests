<nav x-data="{ open: false }" class="bg-gradient-to-r from-purple-800 to-indigo-900 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            {{-- Logo + tên app --}}
            <div class="flex items-center space-x-3">
                <a href="{{ route('home') }}">
                    <img src="/image/astro-icon.png" alt="Logo" class="w-8 h-8">
                </a>
                <span class="text-white font-bold text-lg">Chiêm Tinh Vui</span>
            </div>

            {{-- Menu chính --}}
            <div class="hidden sm:flex items-center space-x-6 text-white text-sm font-medium">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-white hover:text-pink-300">
                    Trang chủ
                </x-nav-link>
                <x-nav-link :href="route('love.form')" :active="request()->routeIs('love.form')" class="text-white hover:text-pink-300">
                    Tình yêu
                </x-nav-link>
                <x-nav-link :href="route('chart')" class="text-white hover:text-pink-300">
                    Bản đồ sao
                </x-nav-link>
                <x-nav-link :href="route('dream')" class="text-white hover:text-pink-300">
                    Giấc mơ
                </x-nav-link>
            </div>

            {{-- Dropdown user (PC) --}}
<div class="hidden sm:flex items-center space-x-4 text-white text-sm">
    @auth
    <div class="flex items-center space-x-3">
        <span>👋 Xin chào, {{ Auth::user()->name }}</span>

        <a id="coinBalance" href="{{ route('recharge.form') }}" class="ml-6 text-white font-semibold text-black font-semibold px-3 py-1 rounded-full text-sm hover:underline">
        💰 {{ Auth::user()->coinBalance() }} coins
</a>


        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-3 py-1 border border-white rounded hover:bg-white hover:text-purple-800 transition">
                Đăng xuất
            </button>
        </form>
    </div>
    @else
        <a href="{{ route('login') }}" class="hover:text-pink-300">Đăng nhập</a>
    @endauth
</div>


            {{-- Hamburger icon mobile --}}
            <div class="sm:hidden">
                <button @click="open = ! open" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Menu responsive --}}
    <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden bg-indigo-950 text-white">
        <div class="px-4 py-3 space-y-2">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                Trang chủ
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('love.form')" :active="request()->routeIs('love.form')">
                Tình yêu
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('chart')">
                Bản đồ sao
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('dream')">
                Giấc mơ
            </x-responsive-nav-link>
        </div>

        {{-- User menu mobile --}}
        @auth
        <div class="border-t border-purple-600 px-4 py-3 text-sm">
            <div class="mb-2">👤 {{ Auth::user()->name }}</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="underline text-pink-300">Đăng xuất</button>
            </form>
        </div>
        @endauth
    </div>
</nav>
