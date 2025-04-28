@extends('admin.layout')

@section('title', 'Chỉnh sửa thông tin sinh')

@section('content')
<h2 class="mb-3">✏️ Chỉnh sửa thông tin sinh</h2>

<form action="{{ route('admin.birthinfos.update', $birthinfo) }}" method="POST">
  @csrf @method('PUT')

  <div class="mb-3">
    <label>Tên:</label>
    <input type="text" name="name" class="form-control" value="{{ $birthinfo->name }}" required>
  </div>

  <div class="mb-3">
    <label>Ngày sinh:</label>
    <input type="date" name="birth_date" class="form-control" value="{{ $birthinfo->birth_date }}" required>
  </div>

  <div class="mb-3">
    <label>Giờ sinh:</label>
    <input type="time" name="birth_time" class="form-control" value="{{ $birthinfo->birth_time }}" required>
  </div>

  <div class="mb-3">
    <label>Nơi sinh:</label>
    <input type="text" name="birth_place" class="form-control" value="{{ $birthinfo->birth_place }}" required>
  </div>

  <div class="mb-3">
    <label>Giới tính:</label>
    <select name="gender" class="form-control" required>
      <option value="male" @selected($birthinfo->gender === 'male')>Nam</option>
      <option value="female" @selected($birthinfo->gender === 'female')>Nữ</option>
    </select>
  </div>

  <div class="mb-3">
    <label>Người dùng:</label>
    <select name="user_id" class="form-control">
      <option value="">Không gán</option>
      @foreach($users as $user)
        <option value="{{ $user->id }}" @selected($birthinfo->user_id == $user->id)>
          {{ $user->name }} ({{ $user->email }})
        </option>
      @endforeach
    </select>
  </div>

  <button class="btn btn-primary">Cập nhật</button>
</form>
@endsection
