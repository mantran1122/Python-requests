@extends('admin.layout')

@section('title', 'Thêm thông tin sinh')

@section('content')
<h2 class="mb-3">➕ Thêm mới thông tin sinh</h2>

<form action="{{ route('admin.birthinfos.store') }}" method="POST">
  @csrf

  <div class="mb-3">
    <label>Tên:</label>
    <input type="text" name="name" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Ngày sinh:</label>
    <input type="date" name="birth_date" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Giờ sinh:</label>
    <input type="time" name="birth_time" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Nơi sinh:</label>
    <input type="text" name="birth_place" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Giới tính:</label>
    <select name="gender" class="form-control" required>
      <option value="male">Nam</option>
      <option value="female">Nữ</option>
    </select>
  </div>

  <div class="mb-3">
    <label>Người dùng (tuỳ chọn):</label>
    <select name="user_id" class="form-control">
      <option value="">Không gán</option>
      @foreach($users as $user)
        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
      @endforeach
    </select>
  </div>

  <button class="btn btn-success">Lưu</button>
</form>
@endsection
