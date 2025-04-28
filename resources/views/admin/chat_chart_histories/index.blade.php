@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">📜 Lịch sử Chat Bản Đồ Sao</h1>
    <div class="mb-4 text-right text-lg font-semibold text-white">
    Tổng số tin nhắn: {{ $totalMessages }}
</div>

    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left">ID</th>
                    <th class="px-6 py-3 text-left">User</th>
                    <th class="px-6 py-3 text-left">Tin nhắn</th>
                    <th class="px-6 py-3 text-left">Thời gian</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach($histories as $history)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ $history->id }}</td>
                        <td class="px-6 py-4">{{ $history->user->name ?? 'Guest' }}</td>
                        <td class="px-6 py-4">{{ $history->message }}</td>
                        <td class="px-6 py-4">{{ $history->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $histories->links() }}
    </div>
</div>
@endsection
