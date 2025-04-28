<aside class="w-64 min-h-screen bg-gradient-to-br from-purple-700 to-indigo-800 p-6 flex flex-col">
    <div class="text-2xl font-bold text-white mb-10 text-center">
        Admin Panel
    </div>

    <nav class="flex-1">
        <ul class="space-y-4">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 text-white hover:bg-purple-600 px-4 py-3 rounded transition">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 text-white hover:bg-purple-600 px-4 py-3 rounded transition">
                    <i class="fas fa-users"></i>
                    <span>Quản lý Users</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.chat-histories.index') }}" class="flex items-center gap-3 text-white hover:bg-purple-600 px-4 py-3 rounded transition">
                    <i class="fas fa-comments"></i>
                    <span>Lịch sử Chat</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.llm-configurations.index') }}" class="flex items-center gap-3 text-white hover:bg-purple-600 px-4 py-3 rounded transition">
                    <i class="fas fa-cogs"></i>
                    <span>Cấu hình LLM</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
