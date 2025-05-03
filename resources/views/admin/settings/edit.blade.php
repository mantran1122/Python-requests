@extends('admin.layout')

@section('title', 'Cài đặt chung')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow space-y-4">

  @if(session('success'))
  <div class="px-4 py-2 bg-green-100 text-green-800 rounded">
    {{ session('success') }}
  </div>
  @endif

  <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf

    <div>
      <label for="site_name" class="block font-medium mb-1">Tên website</label>
      <input type="text" name="site_name" id="site_name"
             value="{{ old('site_name', $siteName) }}"
             class="w-full border rounded px-3 py-2 @error('site_name') border-red-500 @enderror">
      @error('site_name')
      <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="site_logo" class="block font-medium mb-1">Logo website</label>
      <div class="flex items-center space-x-4">
        <img src="{{ $siteLogo }}" alt="Logo" class="h-16 w-16 object-contain border">
        <input type="file" name="site_logo" id="site_logo"
               class="@error('site_logo') border-red-500 @enderror">
      </div>
      @error('site_logo')
      <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
      Lưu cài đặt
    </button>
  </form>
</div>
@endsection
