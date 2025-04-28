@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6 text-black">🧾 Giao dịch chờ duyệt</h2>

    @foreach ($transactions as $tx)
    <div class="bg-white rounded shadow-md p-4 mb-4">
        <div class="text-gray-800">
            <p><strong>User:</strong> {{ $tx->user->name }} (ID: {{ $tx->user_id }})</p>
            <p><strong>Số tiền:</strong> {{ number_format($tx->amount) }} VNĐ</p>
            <p><strong>Thời gian:</strong> {{ $tx->created_at->format('H:i d/m/Y') }}</p>
        </div>

        <form action="{{ route('admin.transactions.approve', $tx->id) }}" method="POST" class="mt-3">
            @csrf
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                ✅ Duyệt và cộng coins
            </button>
        </form>
    </div>
    @endforeach

    @if ($transactions->isEmpty())
        <p class="text-gray-400 text-center">Không có giao dịch nào cần duyệt.</p>
    @endif
</div>
@endsection
