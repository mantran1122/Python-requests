@extends('admin.layout')
@section('title', 'Thêm kết quả chiêm tinh')

@section('content')
<h3 class="mb-4">Thêm kết quả chiêm tinh</h3>

<form method="POST" action="{{ route('admin.astrology_results.store') }}">
  @csrf
  <div class="mb-3">
    <label>Chọn người dùng</label>
    <select name="birth_info_id" class="form-control" required>
      @foreach($birthInfos as $info)
        <option value="{{ $info->id }}">{{ $info->name }} - {{ $info->birth_date }}</option>
      @endforeach
    </select>
  </div>
  <div class="mb-3">
    <label>Tiêu đề</label>
    <input type="text" name="title" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Nội dung</label>
    <textarea name="content" class="form-control" rows="6" required></textarea>
  </div>
  <button class="btn btn-primary">Lưu</button>
</form>
@endsection
