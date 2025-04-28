<nav class="w-full bg-purple-800 flex justify-end items-center px-6 py-4 shadow-md">
    <ul class="flex items-center space-x-6">
        <li>
            <a href="{{ route('admin.dashboard') }}" class="text-white text-lg font-semibold hover:underline">
                Admin Panel
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
               class="text-white text-lg font-semibold hover:underline">
                Đăng xuất
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </li>
    </ul>
</nav>
