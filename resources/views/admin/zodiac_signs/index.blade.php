@extends('admin.layout')

@section('title', 'Quản lý Cung hoàng đạo')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2>Các cung hoàng đạo</h2>
  <a href="{{ route('admin.zodiac_signs.create') }}" class="btn btn-primary">➕ Thêm mới</a>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Tên</th>
      <th>Biểu tượng</th>
      <th>Ngày bắt đầu</th>
      <th>Ngày kết thúc</th>
      <th>Thao tác</th>
    </tr>
  </thead>
  <tbody>
    @foreach($zodiacs as $zodiac)
      <tr>
        <td>{{ $zodiac->id }}</td>
        <td>{{ $zodiac->name }}</td>
        <td>{{ $zodiac->symbol }}</td>
        <td>{{ $zodiac->start_date }}</td>
        <td>{{ $zodiac->end_date }}</td>
        <td>
          <a href="{{ route('admin.zodiac_signs.edit', $zodiac) }}" class="btn btn-sm btn-warning">✏️</a>
          <form action="{{ route('admin.zodiac_signs.destroy', $zodiac) }}" method="POST" class="d-inline" onsubmit="return confirm('Xác nhận xóa?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">🗑️</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
