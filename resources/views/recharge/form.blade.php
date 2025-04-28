@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-900 to-indigo-900 py-12 px-4 text-white">
    <div class="max-w-lg mx-auto bg-white bg-opacity-10 backdrop-blur-md rounded-2xl shadow-2xl p-8">
        <h2 class="text-3xl font-bold text-center mb-6">🔋 Nạp Coins</h2>

        <p class="text-center mb-4">📌 Hệ thống sử dụng <strong>Coins</strong> để tạo bản đồ sao và trò chuyện với AI.<br>
        💸 <strong>10.000 VNĐ = 10 Coins</strong> – Mỗi thao tác tốn 1 Coin.</p>

        <div class="bg-white text-black rounded-xl p-4 text-center mb-6">
            <h3 class="text-lg font-semibold mb-1">Quét mã QR để chuyển khoản</h3>
            <img src="{{ asset('image/qr.png') }}" alt="QR code" class="w-48 h-48 mx-auto mb-2">
            <p><strong>Nội dung chuyển khoản:</strong></p>
            <div class="font-mono bg-gray-200 text-black px-3 py-1 rounded inline-block">
                {{ 'wkt_' . auth()->user()->id }}
            </div>
        </div>

        <form method="POST" action="{{ route('recharge.submit') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm mb-1">Số tiền đã chuyển (VNĐ):</label>
                <input type="number" name="amount_vnd" class="w-full px-4 py-2 rounded text-black" required>
            </div>

            <button type="submit"
                class="w-full bg-pink-500 hover:bg-pink-600 text-white font-semibold py-2 rounded">
                ✅ Tôi đã chuyển khoản
            </button>
        </form>
    </div>
</div>
@endsection
