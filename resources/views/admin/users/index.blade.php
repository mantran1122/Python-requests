@extends('admin.layout')

@section('title', 'Quản lý người dùng')

@section('content')
<h2 class="mb-4">📋 Danh sách người dùng</h2>

@if (session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="GET" class="mb-3">
  <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm..." class="form-control" />
</form>

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Tên</th>
      <th>Email</th>
      <th>Ngày tạo</th>
      <th>Hành động</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr>
      <td>{{ $user->id }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>{{ $user->created_at->format('d/m/Y') }}</td>
      <td>
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-primary">Sửa</a>
        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Xoá người dùng này?')">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger">Xoá</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="mt-3">
  {{ $users->withQueryString()->links() }}
</div>
@endsection
