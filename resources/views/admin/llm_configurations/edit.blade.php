@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Edit LLM Configuration</h1>

    <form method="POST" action="{{ route('admin.llm-configurations.update', $llmConfiguration) }}">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Name</label>
            <input type="text" name="name" value="{{ old('name', $llmConfiguration->name) }}" class="block w-full border-gray-300 rounded shadow-sm">
        </div>

        {{-- API Key --}}
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">API Key</label>
            <input type="text" name="api_key" value="{{ old('api_key', $llmConfiguration->api_key) }}" class="block w-full border-gray-300 rounded shadow-sm">
        </div>

        {{-- Model Dropdown --}}
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Model</label>
            <select name="model" class="block w-full border-gray-300 rounded shadow-sm">
                <option value="">-- Select Model --</option>
                <option value="gpt-3.5" {{ old('model', $llmConfiguration->model) == 'gpt-3.5' ? 'selected' : '' }}>gpt-3.5</option>
                <option value="gpt-4" {{ old('model', $llmConfiguration->model) == 'gpt-4' ? 'selected' : '' }}>gpt-4</option>
                <option value="gpt-4-turbo" {{ old('model', $llmConfiguration->model) == 'gpt-4-turbo' ? 'selected' : '' }}>gpt-4-turbo</option>
                <option value="gemini-1.5" {{ old('model', $llmConfiguration->model) == 'gemini-1.5' ? 'selected' : '' }}>gemini-1.5</option>
            </select>
        </div>

        {{-- Provider Radio --}}
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Provider</label>
            <div class="flex space-x-4 mt-2">
                <label class="inline-flex items-center">
                    <input type="radio" name="provider" value="openai" {{ old('provider', $llmConfiguration->provider) == 'openai' ? 'checked' : '' }} class="form-radio text-blue-600">
                    <span class="ml-2">OpenAI</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="provider" value="gemini" {{ old('provider', $llmConfiguration->provider) == 'gemini' ? 'checked' : '' }} class="form-radio text-blue-600">
                    <span class="ml-2">Gemini</span>
                </label>
            </div>
        </div>

        {{-- Active Toggle Switch --}}
        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">Active</label>
            <div class="relative inline-block w-12 mr-2 align-middle select-none transition duration-200 ease-in">
                <input type="checkbox" name="active" id="active" {{ old('active', $llmConfiguration->active) ? 'checked' : '' }} class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" />
                <label for="active" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
            </div>
        </div>

        {{-- Submit --}}
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Update
        </button>
    </form>
</div>

{{-- Toggle Switch Styling --}}
<style>
.toggle-checkbox:checked {
    right: 0;
    border-color: #68D391;
}
.toggle-checkbox:checked + .toggle-label {
    background-color: #68D391;
}
.toggle-checkbox {
    transition: all 0.3s ease-in-out;
    right: 6px;
}
.toggle-label {
    display: block;
    width: 34px;
    height: 14px;
    border-radius: 9999px;
    background-color: #ccc;
}
</style>
@endsection
