@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-6">🗣️ Lịch sử trò chuyện</h2>

    <table class="w-full table-auto">
        <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                <th class="py-3 px-6">ID</th>
                <th class="py-3 px-6">User</th>
                <th class="py-3 px-6">Tin nhắn</th>
                <th class="py-3 px-6">Thời gian</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @foreach ($chats as $chat)
            <tr class="border-b">
                <td class="py-3 px-6">{{ $chat->id }}</td>
                <td class="py-3 px-6">{{ optional($chat->user)->name ?? 'Guest' }}</td>
                <td class="py-3 px-6">{{ Str::limit($chat->message, 100) }}</td>
                <td class="py-3 px-6">{{ $chat->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-6">
        {{ $chats->links() }} {{-- Phân trang --}}
    </div>
</div>
@endsection
