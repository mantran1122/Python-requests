@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-900 to-purple-800 py-10 px-4">
    <div class="max-w-4xl mx-auto bg-white bg-opacity-10 backdrop-blur-md rounded-2xl shadow-2xl p-8 md:p-10">
        <h2 class="text-3xl font-bold text-center mb-8 text-white">🔮 Phân tích bản đồ sao cá nhân</h2>

        <form action="{{ route('chart.analyze') }}" method="POST" class="text-black">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block mb-1 text-white">👤 Họ tên</label>
                    <input type="text" name="name" id="name" required
                        class="w-full px-4 py-2 rounded bg-white text-black placeholder-gray-600 shadow-sm ring-1 ring-gray-300">
                </div>

                <div>
                    <label for="birth_place" class="block mb-1 text-white">📍 Nơi sinh</label>
                    <select name="birth_place" id="birth_place" required
                        class="w-full px-4 py-2 rounded bg-white text-black shadow-sm ring-1 ring-gray-300">
                        <option value="">-- Chọn tỉnh thành --</option>
                        <option value="Hà Nội">Hà Nội</option>
                        <option value="TP.HCM">TP.HCM</option>
                        <option value="Đà Nẵng">Đà Nẵng</option>
                        <option value="Hải Phòng">Hải Phòng</option>
                        <option value="Cần Thơ">Cần Thơ</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-white">📅 Ngày sinh</label>
                    <div class="flex gap-2">
                        <select name="birth_day" required
                            class="w-full px-2 py-2 rounded bg-white text-black shadow-sm ring-1 ring-gray-300">
                            <option value="">Ngày</option>
                            @for ($i = 1; $i <= 31; $i++)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <select name="birth_month" required
                            class="w-full px-2 py-2 rounded bg-white text-black shadow-sm ring-1 ring-gray-300">
                            <option value="">Tháng</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <select name="birth_year" required
                            class="w-full px-2 py-2 rounded bg-white text-black shadow-sm ring-1 ring-gray-300">
                            <option value="">Năm</option>
                            @for ($i = 1950; $i <= 2025; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div>
                    <label for="birth_time" class="block mb-1 text-white">⏰ Giờ sinh</label>
                    <select name="birth_time" id="birth_time" required
                        class="w-full px-4 py-2 rounded bg-white text-black shadow-sm ring-1 ring-gray-300">
                        <option value="">-- Chọn giờ sinh --</option>
                        @for ($h = 0; $h <= 23; $h++)
                            @foreach ([0, 30] as $m)
                                <option value="{{ str_pad($h,2,'0',STR_PAD_LEFT) }}:{{ str_pad($m,2,'0',STR_PAD_LEFT) }}">
                                    {{ str_pad($h,2,'0',STR_PAD_LEFT) }}:{{ str_pad($m,2,'0',STR_PAD_LEFT) }}
                                </option>
                            @endforeach
                        @endfor
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block mb-1 text-white">🔭 Chọn hệ thống chiêm tinh</label>
                    <div class="flex gap-6">
                        <label class="inline-flex items-center text-white">
                            <input type="radio" name="chart_type" value="vedas" class="text-pink-500" required>
                            <span class="ml-2">Vệ Đà (Vedas)</span>
                        </label>
                        <label class="inline-flex items-center text-white">
                            <input type="radio" name="chart_type" value="western" class="text-blue-500" required>
                            <span class="ml-2">Phương Tây (Western)</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="text-center mt-10">
                <button type="submit"
                    class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-full shadow-md transition">
                    🚀 Phân tích ngay
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
