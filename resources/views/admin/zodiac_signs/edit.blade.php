@extends('admin.layout')

@section('title', 'Chỉnh sửa Cung hoàng đạo')

@section('content')
<h2>✏️ Chỉnh sửa cung hoàng đạo</h2>

<form action="{{ route('admin.zodiac_signs.update', $zodiacSign) }}" method="POST">
  @csrf @method('PUT')
  <div class="mb-3">
    <label>Tên</label>
    <input type="text" name="name" class="form-control" value="{{ $zodiacSign->name }}" required>
  </div>
  <div class="mb-3">
    <label>Biểu tượng</label>
    <input type="text" name="symbol" class="form-control" value="{{ $zodiacSign->symbol }}">
  </div>
  <div class="mb-3">
    <label>Ngày bắt đầu</label>
    <input type="date" name="start_date" class="form-control" value="{{ $zodiacSign->start_date }}" required>
  </div>
  <div class="mb-3">
    <label>Ngày kết thúc</label>
    <input type="date" name="end_date" class="form-control" value="{{ $zodiacSign->end_date }}" required>
  </div>
  <div class="mb-3">
    <label>Mô tả</label>
    <textarea name="description" class="form-control">{{ $zodiacSign->description }}</textarea>
  </div>
  <button class="btn btn-primary">Cập nhật</button>
  <a href="{{ route('admin.zodiac_signs.index') }}" class="btn btn-secondary">Hủy</a>
</form>
@endsection
