@extends('layouts.admin')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">LLM Configurations</h1>
        <a href="{{ route('admin.llm-configurations.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Create New</a>
    </div>

    <div class="bg-white rounded shadow p-6">
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Provider</th>
                    <th class="px-4 py-2">Model</th>
                    <th class="px-4 py-2">Active</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($configs as $config)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $config->name }}</td>
                    <td class="px-4 py-2">{{ ucfirst($config->provider) }}</td>
                    <td class="px-4 py-2">{{ $config->model }}</td>
                    <td class="px-4 py-2">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" {{ $config->active ? 'checked' : '' }} onchange="toggleActive({{ $config->id }})" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-green-500"></div>
                            <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition peer-checked:translate-x-full"></div>
                        </label>
                    </td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('admin.llm-configurations.edit', $config) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.llm-configurations.destroy', $config) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?');" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Toggle Active AJAX --}}
<script>
function toggleActive(id) {
    fetch(`/admin/llm-configurations/${id}/toggle-active`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Toggled successfully');
        } else {
            alert('Failed to toggle active');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error toggling active state.');
    });
}
</script>

@endsection
