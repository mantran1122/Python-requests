<!DOCTYPE html>
<html>
<head>
    <title>Kết quả chiêm tinh</title>
    <meta charset="utf-8">
</head>
<body>
    <h1>Kết quả chiêm tinh</h1>

    @php
        $result = json_decode($output, true);
    @endphp

    @if(isset($result['error']))
        <p>Lỗi: {{ $result['error'] }}</p>
    @else
        <p><strong>Họ tên:</strong> {{ $result['name'] }}</p>
        <p><strong>Cung hoàng đạo:</strong> {{ ucfirst($result['zodiac']) }}</p>
        <p><strong>Dự đoán hôm nay:</strong> {{ $result['horoscope'] }}</p>
    @endif

    <a href="/astrology">← Quay lại</a>
</body>
</html>
