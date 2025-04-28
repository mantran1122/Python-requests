@extends('admin.layout')

@section('title', 'Bảng điều khiển')

@section('content')
  <div class="min-h-screen bg-gradient-to-br from-purple-900 to-indigo-900 py-10 px-4 text-white">

    <div class="max-w-7xl mx-auto">
    <h2 class="text-3xl font-bold mb-8 text-center">📊 Bảng điều khiển quản trị</h2>

    {{-- Thống kê chính --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- LLM Configurations -->
      <div class="bg-gradient-to-br from-cyan-500 to-blue-500 text-white rounded-xl p-5 shadow-lg">
      <div class="flex items-center justify-between">
        <div>
        <p class="mt-1">Cấu hình LLM</p>
        </div>
        <i class="fas fa-robot text-3xl"></i> <!-- icon robot -->
      </div>
      <a href="{{ route('admin.llm-configurations.index') }}"
        class="text-sm text-white/80 hover:underline mt-4 inline-block">
        Quản lý LLM →
      </a>
      </div>

      <!-- Cung hoàng đạo -->
      <div class="bg-gradient-to-br from-indigo-600 to-purple-600 text-white rounded-xl p-5 shadow-lg">
      <div class="flex items-center justify-between">
        <div>
        <p class="mt-1">Cung hoàng đạo</p>
        </div>
        <i class="fas fa-star text-3xl"></i>
      </div>
      <a href="{{ route('admin.zodiac_signs.index') }}"
        class="text-sm text-white/80 hover:underline mt-4 inline-block">Xem thêm →</a>
      </div>

      <!-- Giấc mơ -->
      <div class="bg-gradient-to-br from-pink-500 to-rose-500 text-white rounded-xl p-5 shadow-lg">
      <div class="flex items-center justify-between">
        <div>
        <p class="mt-1">Giấc mơ phổ biến</p>
        </div>
        <i class="fas fa-moon text-3xl"></i>
      </div>
      <a href="#" class="text-sm text-white/80 hover:underline mt-4 inline-block">Xem thêm →</a>
      </div>

      <!-- Lượt tra cứu -->
      <div class="bg-gradient-to-br from-yellow-400 to-yellow-600 text-white rounded-xl p-5 shadow-lg">
      <div class="flex items-center justify-between">
        <div>
        <p class="mt-1">Lịch sử trò chuyệntình duyên</p>
        </div>
        <i class="fas fa-search text-3xl"></i>
      </div>
      <a href="{{ route('admin.chat-histories.index') }}"
        class="text-sm text-white/80 hover:underline mt-4 inline-block">Xem thêm →</a>
      </div>

      <div class="bg-gradient-to-br from-yellow-400 to-yellow-600 text-white rounded-xl p-5 shadow-lg">
      <div class="flex items-center justify-between">
        <div>
        <p class="mt-1">Lịch sử trò chuyện bảng đồ</p>
        </div>
        <i class="fas fa-search text-3xl"></i>
      </div>
      <a href="{{ route('admin.chat-histories.index') }}"
        class="text-sm text-white/80 hover:underline mt-4 inline-block">Xem thêm →</a>
      </div>

      <!-- Thành viên mới -->
      <div class="bg-gradient-to-br from-red-500 to-pink-600 text-white rounded-xl p-5 shadow-lg">
      <div class="flex items-center justify-between">
        <div>
        <p class="mt-1">Thành viên mới</p>
        </div>
        <i class="fas fa-users text-3xl"></i>
      </div>
      <a href="{{ route('admin.users.index') }}" class="text-sm text-white/80 hover:underline mt-4 inline-block">Xem
        thêm →</a>
      </div>
    </div>

    {{-- Kết quả chiêm tinh --}}
    <div class="mt-10">
      <div class="bg-gradient-to-br from-pink-400 to-fuchsia-600 text-white rounded-xl p-5 shadow-lg max-w-sm">
      <div class="flex items-center justify-between">
        <div>
        <p class="mt-1">Kết quả chiêm tinh</p>
        </div>
        <i class="fas fa-magic text-3xl"></i>
      </div>
      <a href="{{ route('admin.astrology_results.index') }}"
        class="text-sm text-white/80 hover:underline mt-4 inline-block">Xem thêm →</a>
      </div>
    </div>

    {{-- Duyệt giao dịch nạp tiền --}}
    <div class="mt-10">
      <div class="bg-gradient-to-br from-green-400 to-emerald-600 text-white rounded-xl p-5 shadow-lg max-w-sm">
      <div class="flex items-center justify-between">
        <div>
        <h3 class="text-2xl font-bold">{{ \App\Models\Transaction::where('status', 'pending')->count() }}</h3>
        <p class="mt-1">Giao dịch chờ duyệt</p>
        </div>
        <i class="fas fa-wallet text-3xl"></i>
      </div>
      <a href="{{ route('admin.transactions.index') }}"
        class="text-sm text-white/80 hover:underline mt-4 inline-block">Duyệt giao dịch →</a>
      </div>
    </div>


    {{-- Biểu đồ --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 mt-4">
  {{-- Box 1: Lượt tra cứu --}}
  <div class="col-span-1">
    <div class="bg-gradient-to-br from-indigo-600 to-purple-700 text-white rounded-lg shadow-lg p-6 h-80 hover:scale-105 transition-all duration-300">
      <h4 class="mb-3 text-xl font-semibold">📊 Lượt tra cứu 7 ngày qua</h4>
      <div class="relative w-full h-full">
        <canvas id="chartTraCuu"></canvas>
      </div>
    </div>
  </div>

  {{-- Box 2: Người dùng mới --}}
  <div class="col-span-1">
    <div class="bg-gradient-to-br from-green-400 to-emerald-500 text-white rounded-lg shadow-lg p-6 h-80 hover:scale-105 transition-all duration-300">
      <h4 class="mb-3 text-xl font-semibold">🧑‍💼 Người dùng mới theo tháng</h4>
      <div class="relative w-full h-full">
        <canvas id="chartUser"></canvas>
      </div>
    </div>
  </div>
</div>






    {{-- PDF xuất báo cáo --}}
    <div class="mt-8 text-end">
      <a href="{{ route('admin.export.pdf') }}"
      class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow">
      <i class="fas fa-file-pdf"></i> Xuất báo cáo PDF
      </a>
    </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const chartTraCuu = document.getElementById('chartTraCuu');
    new Chart(chartTraCuu, {
      type: 'line',
      data: {
        labels: {!! json_encode($traCuuTheoNgay->keys()) !!},
        datasets: [{
          label: 'Lượt tra cứu',
          data: {!! json_encode($traCuuTheoNgay->values()) !!},
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderColor: '#36A2EB',
          borderWidth: 2,
          tension: 0.3
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              color: 'white', // Thay đổi màu chữ của trục Y cho dễ đọc
              font: {
                size: 14, // Tăng kích thước chữ
                weight: 'bold' // Đặt chữ đậm
              }
            }
          },
          x: {
            ticks: {
              color: 'white', // Thay đổi màu chữ của trục X cho dễ đọc
              font: {
                size: 14, // Tăng kích thước chữ
                weight: 'bold' // Đặt chữ đậm
              }
            }
          }
        },
        plugins: {
          legend: {
            labels: {
              color: 'white', // Đổi màu chữ của chú thích
              font: {
                size: 14, // Tăng kích thước chữ chú thích
                weight: 'bold' // Đặt chữ đậm
              }
            }
          }
        }
      }
    });

    const chartUser = document.getElementById('chartUser');
    new Chart(chartUser, {
      type: 'bar',
      data: {
        labels: {!! json_encode($userTheoThang->keys()) !!},
        datasets: [{
          label: 'Người dùng mới',
          data: {!! json_encode($userTheoThang->values()) !!},
          backgroundColor: '#FF6384',
          borderColor: '#FF6384',
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              color: 'white', // Thay đổi màu chữ của trục Y cho dễ đọc
              font: {
                size: 14, // Tăng kích thước chữ
                weight: 'bold' // Đặt chữ đậm
              }
            }
          },
          x: {
            ticks: {
              color: 'white', // Thay đổi màu chữ của trục X cho dễ đọc
              font: {
                size: 14, // Tăng kích thước chữ
                weight: 'bold' // Đặt chữ đậm
              }
            }
          }
        },
        plugins: {
          legend: {
            labels: {
              color: 'white', // Đổi màu chữ của chú thích
              font: {
                size: 14, // Tăng kích thước chữ chú thích
                weight: 'bold' // Đặt chữ đậm
              }
            }
          }
        }
      }
    });
  </script>
@endpush
