@extends('admin.layout')

@section('title', 'Thêm Cung hoàng đạo')

@section('content')
<h2>➕ Thêm cung hoàng đạo</h2>

<form action="{{ route('admin.zodiac_signs.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label>Tên</label>
    <input type="text" name="name" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Biểu tượng (VD: ♒)</label>
    <input type="text" name="symbol" class="form-control">
  </div>
  <div class="mb-3">
    <label>Ngày bắt đầu</label>
    <input type="date" name="start_date" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Ngày kết thúc</label>
    <input type="date" name="end_date" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Mô tả</label>
    <textarea name="description" class="form-control" rows="4"></textarea>
  </div>
  <button class="btn btn-success">Lưu</button>
  <a href="{{ route('admin.zodiac_signs.index') }}" class="btn btn-secondary">Quay lại</a>
</form>
@endsection

