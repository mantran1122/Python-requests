@extends('admin.layout')

@section('title', 'Danh sách thông tin sinh')

@section('content')
<h2 class="mb-3">📅 Danh sách thông tin sinh</h2>

<a href="{{ route('admin.birthinfos.create') }}" class="btn btn-primary mb-3">+ Thêm mới</a>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Tên</th>
      <th>Ngày sinh</th>
      <th>Giờ sinh</th>
      <th>Giới tính</th>
      <th>Hành động</th>
    </tr>
  </thead>
  <tbody>
    @foreach($birthinfos as $info)
      <tr>
        <td>{{ $info->id }}</td>
        <td>{{ $info->name }}</td>
        <td>{{ $info->birth_date }}</td>
        <td>{{ $info->birth_time }}</td>
        <td>{{ $info->gender }}</td>
        <td>
          <a href="{{ route('admin.birthinfos.edit', $info) }}" class="btn btn-sm btn-warning">Sửa</a>
          <form action="{{ route('admin.birthinfos.destroy', $info) }}" method="POST" class="d-inline" onsubmit="return confirm('Xoá?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger">Xoá</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

{{ $birthinfos->links() }}
@endsection
