{{-- resources/views/components/astro-input.blade.php --}}
@props(['label', 'name'])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-white mb-1">{{ $label }}</label>
    <input name="{{ $name }}" id="{{ $name }}"
           type="text"
           required
           class="w-full px-4 py-2 rounded-lg bg-white bg-opacity-20 text-white placeholder-white placeholder-opacity-70 focus:outline-none focus:ring-2 focus:ring-pink-400 transition"
           placeholder="{{ $label }}">
</div>
