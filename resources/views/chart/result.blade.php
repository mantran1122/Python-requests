@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-purple-900 to-indigo-900 py-12 px-4 text-white">
        <div class="max-w-3xl mx-auto bg-white bg-opacity-10 backdrop-blur-md rounded-2xl shadow-2xl p-8">
            <h2 class="text-3xl font-bold text-center mb-8">🔮 Kết quả bản đồ sao của {{ $name }}</h2>

            <div class="text-center">
                @if ($image)
                    <img src="{{ asset('images/charts/' . $image) }}" class="mx-auto rounded shadow-md" alt="Biểu đồ sao">
                @else
                    <p class="text-center text-red-500 mt-4">Không tìm thấy ảnh biểu đồ sao.</p>
                @endif

            </div>

            <div class="text-center mt-6">
                <a href="{{ route('chat.chart') }}"
                    class="inline-block bg-pink-500 hover:bg-pink-600 px-6 py-3 rounded-full text-white shadow-md transition">
                    💬 Trò chuyện với AI chiêm tinh
                </a>
            </div>
        </div>
    </div>
    <script>
    // Sau khi load trang, lưu tên ảnh vào localStorage
    @if ($image)
        localStorage.setItem('chart_image', '{{ $image }}');
    @endif
</script>

@endsection