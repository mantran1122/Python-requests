@extends('admin.layout')
@section('title', 'Kết quả chiêm tinh')

@section('content')
<h3 class="mb-4">Danh sách kết quả chiêm tinh</h3>
<a href="{{ route('admin.astrology_results.create') }}" class="btn btn-primary mb-3">+ Thêm kết quả</a>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Tiêu đề</th>
      <th>Người dùng</th>
      <th>Ngày tạo</th>
      <th>Thao tác</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($results as $result)
      <tr>
        <td>{{ $result->title }}</td>
        <td>{{ $result->birthInfo->name ?? 'Không rõ' }}</td>
        <td>{{ $result->created_at->format('d/m/Y') }}</td>
        <td>
          <a href="{{ route('admin.astrology_results.edit', $result) }}" class="btn btn-warning btn-sm">Sửa</a>
          <form action="{{ route('admin.astrology_results.destroy', $result) }}" method="POST" class="d-inline" onsubmit="return confirm('Xoá chứ?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm">Xoá</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
