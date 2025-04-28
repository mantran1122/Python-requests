@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-800 to-indigo-900 py-10 px-4">
    <div class="max-w-5xl mx-auto bg-white bg-opacity-10 backdrop-blur-md rounded-2xl shadow-2xl p-8 md:p-10 text-white">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-10">
            💖 Tính Toán Tình Yêu 💖 <br>
            <span class="text-lg font-light">Hãy nhập thông tin của hai bạn để khám phá định mệnh tình yêu ✨</span>
        </h2>

        <form action="{{ route('love.analyze') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Người A --}}
                <div>
                    <h3 class="text-xl font-semibold mb-4">🧑 Người A</h3>
                    <div class="space-y-4">
                        <x-astro-input label="Tên" name="person_a[name]" />
                        <x-astro-input label="Địa điểm sinh" name="person_a[location]" />
                        <x-astro-input label="Giờ sinh (ví dụ: 14:00)" name="person_a[time]" />
                        <x-astro-input label="Ngày sinh (dd/mm/yyyy)" name="person_a[date]" />
                    </div>
                </div>

                {{-- Người B --}}
                <div>
                    <h3 class="text-xl font-semibold mb-4">👩 Người B</h3>
                    <div class="space-y-4">
                        <x-astro-input label="Tên" name="person_b[name]" />
                        <x-astro-input label="Địa điểm sinh" name="person_b[location]" />
                        <x-astro-input label="Giờ sinh (ví dụ: 14:00)" name="person_b[time]" />
                        <x-astro-input label="Ngày sinh (dd/mm/yyyy)" name="person_b[date]" />
                    </div>
                </div>
            </div>

            <div class="text-center mt-10">
                <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white text-lg px-8 py-3 rounded-full shadow-md transition-all duration-300">
                    🔮 Phân tích ngay
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
