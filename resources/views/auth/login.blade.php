<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập Chiêm Tinh Vui</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        /* Reset cơ bản */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #f5f5f5;
            color: #333;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Container căn giữa */
        .login-container {
            width: 100%;
            max-width: 380px;
            padding: 0 20px;
            /* Cho hơi sát top, không quá cao */
            margin: auto;
            /* Căn giữa theo ngang */
        }

        .login-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 30px 20px 20px;
            /* Giảm padding-top lại nếu muốn */
        }

        .login-logo {
            text-align: center;
            margin-bottom: 24px;
            /* Khoảng cách xuống form */
        }

        .login-logo img {
            display: inline-block;
            width: 64px;
            /* Kích thước vừa phải */
            height: 64px;
            margin: 0 auto;
        }

        .login-title {
            margin-top: 12px;
            font-size: 1.3rem;
            font-weight: bold;
            color: #222;
        }


        /* Form nhóm trường */
        /* Wrapper cho icon và input */
        .input-group {
            position: relative;
            margin-bottom: 1rem;
        }

        /* Icon căn giữa chiều cao */
        .input-group .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 1rem;
            pointer-events: none;
        }

        /* Input: padding-left đủ rộng để nhường chỗ icon */
        .input-group input {
            width: 100%;
            padding: 10px 12px 10px 36px;
            /* top/right/bottom/left */
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 0.95rem;
            line-height: 1.4;
            /* giúp text căn giữa chiều cao */
            transition: border-color .2s, box-shadow .2s;
        }

        .input-group input:focus {
            outline: none;
            border-color: #b39ddb;
            box-shadow: 0 0 0 3px rgba(179, 157, 219, .3);
        }



        /* Checkbox & link */
        .options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .options label {
            display: inline-flex;
            align-items: center;
            cursor: pointer;
        }

        .options input[type="checkbox"] {
            margin-right: 6px;
            width: 16px;
            height: 16px;
            accent-color: #b39ddb;
        }

        .options a {
            color: #7e57c2;
            text-decoration: none;
        }

        .options a:hover {
            text-decoration: underline;
        }

        /* Nút submit */
        .btn-submit {
            width: 100%;
            padding: 12px;
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

        /* Thông báo lỗi / trạng thái */
        .session-status {
            margin-bottom: 16px;
            padding: 10px;
            background: #ffe8e8;
            color: #d32f2f;
            border-radius: 4px;
            font-size: 0.9rem;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-logo">
            <img src="{{ asset('image/icon.png') }}" alt="Logo">
            <div class="login-title">Đăng nhập Chiêm Tinh Vui</div>
        </div>

        @if(session('status'))
            <div class="session-status">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group" style="position: relative;">
                <label for="email">Email</label>
                <i class="fas fa-envelope input-icon"></i>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="you@example.com">
                @error('email')
                    <div style="color:#d32f2f;font-size:0.85rem;margin-top:4px;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="input-group" style="position: relative;">
                <label for="password">Mật khẩu</label>
                <i class="fas fa-lock input-icon"></i>
                <input id="password" type="password" name="password" required placeholder="••••••••">
                @error('password')
                    <div style="color:#d32f2f;font-size:0.85rem;margin-top:4px;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="options">
                <label>
                    <input type="checkbox" name="remember">
                    Nhớ đăng nhập
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
                @endif
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-sign-in-alt"></i>
                Đăng nhập
            </button>
        </form>
    </div>

</body>

</html>