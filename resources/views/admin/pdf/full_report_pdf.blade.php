<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Báo cáo chiêm tinh</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { background: #f2f2f2; padding: 5px; margin-top: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
    </style>
</head>
<body>

<h1>Báo cáo toàn bộ dữ liệu trang Chiêm Tinh Vui</h1>
<h2>1. Thông tin sinh</h2>
<table>
    <thead>
        <tr><th>#</th><th>Tên</th><th>Ngày sinh</th><th>Giờ sinh</th><th>Giới tính</th><th>Nơi sinh</th></tr>
    </thead>
    <tbody>
        @foreach($birthInfos as $info)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $info->name }}</td>
                <td>{{ $info->birth_date }}</td>
                <td>{{ $info->birth_time }}</td>
                <td>{{ $info->gender }}</td>
                <td>{{ $info->birth_place }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h2>2. Kết quả chiêm tinh</h2>
<table>
    <thead>
        <tr><th>#</th><th>Thông tin sinh</th><th>Chi tiết</th><th>Ngày tạo</th></tr>
    </thead>
    <tbody>
        @foreach($astrologyResults as $res)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $res->birthInfo->name ?? 'N/A' }}</td>
                <td>{{ Str::limit($res->result, 100) }}</td>
                <td>{{ $res->created_at->format('d/m/Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h2>3. Cung hoàng đạo</h2>
<table>
    <thead>
        <tr><th>#</th><th>Tên</th><th>Ký hiệu</th><th>Mô tả</th></tr>
    </thead>
    <tbody>
        @foreach($zodiacs as $zodiac)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $zodiac->name }}</td>
                <td>{{ $zodiac->symbol }}</td>
                <td>{{ Str::limit($zodiac->description, 80) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
