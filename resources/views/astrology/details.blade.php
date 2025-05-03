@extends('layouts.app')

@section('title', 'Chi tiết Chiêm Tinh')

@section('content')
  <style>
    /* --- Toàn cục --- */
    .astro-container {
      max-width: 800px;
      margin: 0 auto;
      padding: 40px 20px;
      font-family: "Helvetica Neue", Arial, sans-serif;
      color: #333;
      background-color: #fafafa;
    }
    h1, h2 {
      margin: 0;
      padding: 0;
    }
    /* --- Tiêu đề chính --- */
    .astro-title {
      font-size: 2.5rem;
      font-weight: bold;
      text-align: center;
      margin-bottom: 32px;
      background: linear-gradient(90deg,#8b5cf6,#ec4899);
      background-clip: text;
      -webkit-background-clip: text;
      color: transparent;
    }
    /* --- Đoạn mô tả đầu --- */
    .astro-intro {
      font-size: 1.125rem;
      line-height: 1.6;
      margin-bottom: 40px;
      text-align: center;
    }
    /* --- Card section chung --- */
    .astro-section {
      background-color: #fff;
      border-radius: 12px;
      padding: 24px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.08);
      margin-bottom: 32px;
      transition: transform .3s, box-shadow .3s;
    }
    .astro-section:hover {
      transform: translateY(-5px);
      box-shadow: 0 16px 30px rgba(0,0,0,0.12);
    }
    .astro-section h2 {
      position: relative;
      font-size: 1.5rem;
      margin-bottom: 16px;
      padding-left: 24px;
      color: #2c3e50;
    }
    .astro-section h2::before {
      content: "•";
      position: absolute;
      left: 0;
      top: 0;
      color: #8b5cf6;
      font-size: 1.5rem;
      line-height: 1;
    }
    .astro-section p,
    .astro-section ul {
      margin-bottom: 16px;
      line-height: 1.6;
      color: #555;
    }
    .astro-section ul {
      padding-left: 20px;
      list-style-type: disc;
    }
    /* --- Nút Quay lại --- */
    .back-btn {
      display: inline-block;
      padding: 12px 24px;
      background: linear-gradient(90deg,#ec4899,#8b5cf6);
      color: #fff;
      border-radius: 9999px;
      text-decoration: none;
      font-weight: 500;
      margin-top: 24px;
      transition: background .3s;
    }
    .back-btn:hover {
      background: linear-gradient(90deg,#d4468c,#a23fb7);
    }
  </style>

  <div class="astro-container">
    <h1 class="astro-title">🔭 Chi Tiết Chiêm Tinh Toàn Diện</h1>

    <p class="astro-intro">
      “Chiêm Tinh Vui” là nơi hội tụ kiến thức sâu rộng về chiêm tinh học—từ cơ bản như 12 cung hoàng đạo,
      12 nhà, các góc (aspects), đến nâng cao như transits, progressions, synastry, astrocartography…
    </p>

    <!-- 1. Lịch sử & Khái niệm cơ bản -->
    <section class="astro-section">
      <h2>1. Lịch sử & Khái niệm cơ bản</h2>
      <p>
        Chiêm tinh học có nguồn gốc cổ đại, từ Babylon, Ai Cập, Ấn Độ đến Hy Lạp… Tin rằng thiên thể
        tác động đến cuộc sống và tính cách con người.
      </p>
      <ul>
        <li><strong>Hoàng đạo (Zodiac):</strong> Vòng 360° chia 12 cung, mỗi cung 30°.</li>
        <li><strong>Sidereal vs. Tropical:</strong> Tính theo ngôi sao thật (Vedic) hoặc mặt trời nhiệt đới (Tây).</li>
        <li><strong>Ephemeris:</strong> Bảng tra vị trí hành tinh theo thời gian để lập chart.</li>
      </ul>
    </section>

    <!-- 2. Bảng Đồ Sao (Natal Chart) -->
    <section class="astro-section">
      <h2>2. Bảng Đồ Sao (Natal Chart)</h2>
      <p>
        Chart vẽ vị trí Hành Tinh, Mặt Trời, Mặt Trăng, Ascendant, Midheaven tại thời điểm sinh.
      </p>
      <ul>
        <li><strong>Ascendant (Nhà 1):</strong> Cách bạn thể hiện ra bên ngoài.</li>
        <li><strong>Midheaven (Nhà 10):</strong> Sự nghiệp, danh vọng.</li>
        <li><strong>Planets in Houses:</strong> Ví dụ Mars ở Nhà 7 ảnh hưởng đến hôn nhân.</li>
      </ul>
    </section>

    <!-- 3. 12 Cung Hoàng Đạo -->
    <section class="astro-section">
      <h2>3. 12 Cung Hoàng Đạo</h2>
      <ul>
        <li><strong>Bạch Dương (Aries):</strong> Dũng cảm, nhiệt huyết.</li>
        <li><strong>Kim Ngưu (Taurus):</strong> Kiên định, yêu thích sự ổn định.</li>
        <li><strong>Song Tử (Gemini):</strong> Thông minh, lanh lợi.</li>
        <li><strong>Cự Giải (Cancer):</strong> Nhạy cảm, chăm sóc.</li>
        <li><strong>Sư Tử (Leo):</strong> Lãnh đạo, hùng dũng.</li>
        <li><strong>Xử Nữ (Virgo):</strong> Tỉ mỉ, phân tích.</li>
        <li><strong>Thiên Bình (Libra):</strong> Cân bằng, công bằng.</li>
        <li><strong>Bọ Cạp (Scorpio):</strong> Mãnh liệt, bí ẩn.</li>
        <li><strong>Nhân Mã (Sagittarius):</strong> Phiêu lưu, lạc quan.</li>
        <li><strong>Ma Kết (Capricorn):</strong> Tham vọng, kỷ luật.</li>
        <li><strong>Bảo Bình (Aquarius):</strong> Sáng tạo, nhân đạo.</li>
        <li><strong>Song Ngư (Pisces):</strong> Trực giác, đồng cảm.</li>
      </ul>
    </section>

    <!-- 4. Các Góc (Aspects) -->
    <section class="astro-section">
      <h2>4. Các Góc (Aspects)</h2>
      <p>
        Mô tả tương tác hai hành tinh, quyết định năng lượng thuận/khó:
      </p>
      <ul>
        <li><strong>Conjunction (0°):</strong> Tích hợp mạnh mẽ.</li>
        <li><strong>Trine (120°):</strong> Hài hòa, thuận lợi.</li>
        <li><strong>Square (90°):</strong> Thử thách, căng thẳng.</li>
        <li><strong>Opposition (180°):</strong> Đối kháng, cân bằng.</li>
        <li><strong>Sextile (60°):</strong> Cơ hội, kết nối.</li>
      </ul>
    </section>

    <!-- 5. Transits & Progressions -->
    <section class="astro-section">
      <h2>5. Transits & Progressions</h2>
      <p>
        <strong>Transits:</strong> Vị trí hành tinh hiện tại so với natal, dự báo sự kiện.<br>
        <strong>Progressions:</strong> Mỗi ngày sau sinh = 1 năm đời người, chỉ ra giai đoạn phát triển.
      </p>
    </section>

    <!-- 6. Synastry (Hòa hợp tình yêu) -->
    <section class="astro-section">
      <h2>6. Synastry</h2>
      <p>
        So sánh hai chart cá nhân để đánh giá mức độ hòa hợp tình cảm, công việc, bạn bè…
      </p>
    </section>

    <!-- 7. Solar & Lunar Returns -->
    <section class="astro-section">
      <h2>7. Solar & Lunar Returns</h2>
      <ul>
        <li><strong>Solar Return:</strong> Chart ngày sinh nhật, dự báo cả năm.</li>
        <li><strong>Lunar Return:</strong> Chart hàng tháng, tập trung cảm xúc.</li>
      </ul>
    </section>

    <!-- 8. Astrocartography -->
    <section class="astro-section">
      <h2>8. Astrocartography</h2>
      <p>
        Bản đồ địa lý cho biết vị trí hành tinh mạnh nhất trên toàn cầu,
        hỗ trợ chọn nơi sinh sống, du lịch, công việc.
      </p>
    </section>

    <!-- 9. Arabic Parts (Lots) -->
    <section class="astro-section">
      <h2>9. Arabic Parts</h2>
      <p>
        Phần Tài Lộc, Phần Linh Hồn… tính theo công thức: <em>Asc + Moon − Sun</em>, v.v.
      </p>
    </section>

    <!-- 10. Horary Astrology -->
    <section class="astro-section">
      <h2>10. Horary Astrology</h2>
      <p>
        Giải đáp câu hỏi tức thời bằng chart tại thời điểm hỏi, ví dụ “Tôi có nên đầu tư?”.
      </p>
    </section>

    <!-- 11. Esoteric Astrology -->
    <section class="astro-section">
      <h2>11. Esoteric Astrology</h2>
      <p>
        Chiêm tinh huyền bí tập trung vào linh hồn, Nodes, nhiệm vụ tâm linh…
      </p>
    </section>

    <!-- 12. Medical Astrology -->
    <section class="astro-section">
      <h2>12. Medical Astrology</h2>
      <ul>
        <li>Mars ↔ Máu, mạch máu</li>
        <li>Jupiter ↔ Gan, mật</li>
        <li>Saturn ↔ Xương, răng</li>
        <li>Venus ↔ Thận, sinh sản</li>
        <li>Mercury ↔ Thần kinh, hô hấp</li>
      </ul>
    </section>

    <!-- 13. Financial Astrology -->
    <section class="astro-section">
      <h2>13. Financial Astrology</h2>
      <p>
        Phân tích chu kỳ hành tinh lớn (Jupiter–Saturn, Uranus–Pluto) trong chứng khoán, hàng hóa.
      </p>
    </section>

    <!-- 14. Mundane & Electional -->
    <section class="astro-section">
      <h2>14. Mundane & Electional Astrology</h2>
      <p>
        Dự báo xu hướng chính trị – kinh tế (Mundane) và chọn giờ đẹp cho sự kiện (Electional).
      </p>
    </section>

    <div style="text-align: center;">
      <a href="{{ url()->previous() }}" class="back-btn">← Quay lại</a>
    </div>
  </div>
@endsection
