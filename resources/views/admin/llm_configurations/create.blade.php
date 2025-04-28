@extends('layouts.admin')

@section('title', isset($llmConfiguration) ? 'Chỉnh sửa LLM' : 'Tạo mới LLM')

@section('content')
<div class="max-w-xl mx-auto bg-white text-black p-8 rounded-xl shadow-lg mt-10">
    <h1 class="text-2xl font-bold text-center text-indigo-700 mb-6">
        {{ isset($llmConfiguration) ? '✏️ Chỉnh sửa cấu hình LLM' : '🧠 Tạo cấu hình LLM mới' }}
    </h1>

    <form method="POST" action="{{ isset($llmConfiguration) ? route('admin.llm-configurations.update', $llmConfiguration) : route('admin.llm-configurations.store') }}">
        @csrf
        @if(isset($llmConfiguration))
            @method('PUT')
        @endif

        {{-- Tên cấu hình --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Tên cấu hình</label>
            <input type="text" name="name" value="{{ old('name', $llmConfiguration->name ?? '') }}" class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring focus:border-indigo-500" required>
        </div>

        {{-- API Key --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">API Key</label>
            <input type="text" name="api_key" value="{{ old('api_key', $llmConfiguration->api_key ?? '') }}" class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring focus:border-indigo-500" required>
        </div>

        {{-- Model Dropdown --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Model</label>
            <select name="model" class="w-full border border-gray-300 px-4 py-2 rounded">
                <option value="">-- Chọn model --</option>
                @foreach (['gpt-3.5', 'gpt-4', 'gpt-4-turbo', 'gemini-1.5'] as $model)
                    <option value="{{ $model }}" {{ old('model', $llmConfiguration->model ?? '') == $model ? 'selected' : '' }}>{{ $model }}</option>
                @endforeach
            </select>
        </div>

        {{-- Provider Radio --}}
        <div class="mb-4">
            <label class="block font-semibold mb-2">Nhà cung cấp</label>
            <div class="flex items-center space-x-6">
                <label class="inline-flex items-center">
                    <input type="radio" name="provider" value="openai" {{ old('provider', $llmConfiguration->provider ?? '') == 'openai' ? 'checked' : '' }} class="form-radio text-indigo-600">
                    <span class="ml-2">OpenAI</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="provider" value="gemini" {{ old('provider', $llmConfiguration->provider ?? '') == 'gemini' ? 'checked' : '' }} class="form-radio text-indigo-600">
                    <span class="ml-2">Gemini</span>
                </label>
            </div>
        </div>

        {{-- Active Toggle --}}
        <div class="mb-6">
            <label class="block font-semibold mb-2">Kích hoạt</label>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="active" class="sr-only peer" {{ old('active', $llmConfiguration->active ?? false) ? 'checked' : '' }}>
                <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:bg-green-500"></div>
                <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition peer-checked:translate-x-full"></div>
            </label>
        </div>

        {{-- Submit --}}
        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 rounded transition">
            {{ isset($llmConfiguration) ? '💾 Cập nhật' : '✨ Tạo mới' }}
        </button>
    </form>
</div>
@endsection
