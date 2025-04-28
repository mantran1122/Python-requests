@extends('layouts.app')

@section('title', 'Thông tin cá nhân')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white text-black p-6 rounded shadow">
  <h2 class="text-xl font-bold mb-6 text-center text-purple-700">✏️ Cập nhật thông tin cá nhân</h2>

  @if (session('status'))
    <div class="mb-4 text-green-600 font-semibold">{{ session('status') }}</div>
  @endif

  <form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PATCH')

    <div class="mb-4">
      <label class="block font-medium mb-1">Tên</label>
      <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
        class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring focus:border-indigo-500">
    </div>

    <div class="mb-4">
  <label class="block font-medium mb-1">Email</label>
  <input type="email" value="{{ auth()->user()->email }}"
    class="w-full bg-gray-100 border border-gray-300 px-4 py-2 rounded cursor-not-allowed text-gray-600" readonly>
</div>


    <div class="flex justify-end">
      <button type="submit"
        class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-4 py-2 rounded">
        Lưu thay đổi
      </button>
    </div>
  </form>
</div>
@endsection
