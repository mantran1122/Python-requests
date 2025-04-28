@extends('admin.layout')
@section('title', 'Chỉnh sửa kết quả')

@section('content')
<h3 class="mb-4">Chỉnh sửa kết quả</h3>

<form method="POST" action="{{ route('admin.astrology_results.update', $astrology_result) }}">
  @csrf @method('PUT')
  <div class="mb-3">
    <label>Chọn người dùng</label>
    <select name="birth_info_id" class="form-control" required>
      @foreach($birthInfos as $info)
        <option value="{{ $info->id }}" @selected($astrology_result->birth_info_id == $info->id)>
          {{ $info->name }} - {{ $info->birth_date }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="mb-3">
    <label>Tiêu đề</label>
    <input type="text" name="title" class="form-control" value="{{ $astrology_result->title }}" required>
  </div>
  <div class="mb-3">
    <label>Nội dung</label>
    <textarea name="content" class="form-control" rows="6" required>{{ $astrology_result->content }}</textarea>
  </div>
  <button class="btn btn-primary">Cập nhật</button>
</form>
@endsection
