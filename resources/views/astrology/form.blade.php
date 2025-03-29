<!DOCTYPE html>
<html>
<head>
    <title>Thông tin chiêm tinh</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>Nhập thông tin chiêm tinh</h1>
    <form method="POST" action="/astrology">
        @csrf
        <label>Họ tên:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Ngày sinh:</label><br>
        <input type="date" name="birth_date" required><br><br>

        <label>Giờ sinh (tuỳ chọn):</label><br>
        <input type="time" name="birth_time"><br><br>

        <label>Giới tính:</label><br>
        <select name="gender" required>
            <option value="male">Nam</option>
            <option value="female">Nữ</option>
            <option value="other">Khác</option>
        </select><br><br>

        <label>Nơi sinh:</label><br>
        <input type="text" name="birth_place" required><br><br>

        <button type="submit">Gửi</button>
    </form>
</body>
</html>
