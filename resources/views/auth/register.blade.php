<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Đăng ký Chiêm Tinh Vui</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    /* Reset cơ bản */
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      background: #f5f5f5;
      color: #333;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    /* Container */
    .form-container {
      width: 100%;
      max-width: 400px;
      padding: 20px;
    }
    /* Card */
    .form-card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      padding: 30px;
    }
    /* Header */
    .form-header {
      text-align: center;
      margin-bottom: 24px;
    }
    .form-header img {
      height: 60px;
      width: 60px;
    }
    .form-header h2 {
      margin-top: 12px;
      font-size: 1.4rem;
      font-weight: bold;
      color: #222;
    }
    /* Group fields */
    .input-group {
      margin-bottom: 18px;
    }
    .input-group label {
      display: block;
      margin-bottom: 6px;
      font-size: 0.9rem;
    }
    .input-group input {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 0.95rem;
      transition: border-color .2s, box-shadow .2s;
    }
    .input-group input:focus {
      outline: none;
      border-color: #b39ddb;
      box-shadow: 0 0 0 3px rgba(179,157,219, .3);
    }
    /* Error messages */
    .error-text {
      margin-top: 4px;
      font-size: 0.85rem;
      color: #d32f2f;
    }
    /* Footer links */
    .form-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 20px;
      font-size: 0.9rem;
    }
    .form-footer a {
      color: #7e57c2;
      text-decoration: none;
    }
    .form-footer a:hover {
      text-decoration: underline;
    }
    /* Submit button */
    .btn-submit {
      width: 100%;
      padding: 12px;
      margin-top: 12px;
      background: #b39ddb;
      border: none;
      border-radius: 6px;
      color: #fff;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background .2s;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }
    .btn-submit:hover {
      background: #9575cd;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <div class="form-card">
      <div class="form-header">
        <img src="{{ asset('image/icon.png') }}" alt="Logo">
        <h2>Đăng ký Chiêm Tinh Vui</h2>
      </div>

      {{-- Session Status --}}
      @if(session('status'))
        <div class="error-text" style="text-align:center;">{{ session('status') }}</div>
      @endif

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="input-group">
          <label for="name">Họ & Tên</label>
          <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
          @error('name')
            <div class="error-text">{{ $message }}</div>
          @enderror
        </div>

        <!-- Email -->
        <div class="input-group">
          <label for="email">Email</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" required>
          @error('email')
            <div class="error-text">{{ $message }}</div>
          @enderror
        </div>

        <!-- Password -->
        <div class="input-group">
          <label for="password">Mật khẩu</label>
          <input id="password" type="password" name="password" required>
          @error('password')
            <div class="error-text">{{ $message }}</div>
          @enderror
        </div>

        <!-- Confirm Password -->
        <div class="input-group">
          <label for="password_confirmation">Xác nhận mật khẩu</label>
          <input id="password_confirmation" type="password" name="password_confirmation" required>
          @error('password_confirmation')
            <div class="error-text">{{ $message }}</div>
          @enderror
        </div>

        {{-- Footer --}}
        <div class="form-footer">
          <a href="{{ route('login') }}">Bạn đã có tài khoản?</a>
        </div>

        <button type="submit" class="btn-submit">
          <i class="fas fa-user-plus"></i> Đăng ký
        </button>
      </form>
    </div>
  </div>

</body>
</html>
