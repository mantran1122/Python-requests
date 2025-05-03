@extends('admin.layout')

@section('title', 'Bảng điều khiển')

@section('content')
<div class="min-h-screen bg-gray-900 text-gray-200 py-10 px-6">

  <div class="max-w-7xl mx-auto">
    <h2 class="text-3xl font-bold mb-8 text-center">📊 Bảng điều khiển quản trị</h2>

{{-- Thống kê chính: flex row 5 item --}}
<div class="flex flex-row flex-nowrap gap-10 overflow-x-auto">
  <!-- Cài đặt chung -->
  <div class="flex-shrink-0 w-60 bg-white rounded-2xl p-5 shadow-md flex flex-col justify-between">
    <div class="flex items-center">
      <i class="fas fa-cog text-3xl text-indigo-500 mr-3"></i>
      <p class="text-lg font-semibold">Cài đặt chung</p>
    </div>
    <div class="mt-4 text-sm text-gray-600">
      <p><strong>Tên site:</strong> {{ $siteName }}</p>
      <img src="{{ $siteLogo }}" alt="Logo hiện tại" class="mt-2 h-8 w-auto object-contain border">
    </div>
    <a href="{{ route('admin.settings.edit') }}"
       class="mt-4 self-start text-sm text-indigo-500 hover:underline">
      Chỉnh sửa →
    </a>
  </div>

  <!-- Cấu hình LLM -->
  <div class="flex-shrink-0 w-60 bg-white rounded-2xl p-5 shadow-md">
    <div class="flex items-center justify-between">
      <p class="text-lg font-semibold">Cấu hình LLM</p>
      <i class="fas fa-robot text-3xl text-blue-400"></i>
    </div>
    <a href="{{ route('admin.llm-configurations.index') }}"
       class="mt-4 inline-block text-sm text-blue-400 hover:underline">
      Quản lý LLM →
    </a>
  </div>

  <!-- Cung hoàng đạo -->
  <div class="flex-shrink-0 w-60 bg-white rounded-2xl p-5 shadow-md">
    <div class="flex items-center justify-between">
      <p class="text-lg font-semibold">Cung hoàng đạo</p>
      <i class="fas fa-star text-3xl text-yellow-400"></i>
    </div>
    <a href="{{ route('admin.zodiac_signs.index') }}"
       class="mt-4 inline-block text-sm text-yellow-400 hover:underline">
      Xem thêm →
    </a>
  </div>

  <!-- Giấc mơ phổ biến -->
  <div class="flex-shrink-0 w-60 bg-white rounded-2xl p-5 shadow-md">
    <div class="flex items-center justify-between">
      <p class="text-lg font-semibold">Giấc mơ phổ biến</p>
      <i class="fas fa-moon text-3xl text-purple-400"></i>
    </div>
    <a href="#"
       class="mt-4 inline-block text-sm text-purple-400 hover:underline">
      Xem thêm →
    </a>
  </div>

  <!-- Lịch sử tình duyên -->
  <div class="flex-shrink-0 w-60 bg-white rounded-2xl p-5 shadow-md">
    <div class="flex items-center justify-between">
      <p class="text-lg font-semibold">Lịch sử tình duyên</p>
      <i class="fas fa-heart text-3xl text-red-400"></i>
    </div>
    <a href="{{ route('admin.chat-histories.index') }}"
       class="mt-4 inline-block text-sm text-red-400 hover:underline">
      Xem thêm →
    </a>
  </div>
</div>

    {{-- Kết quả chiêm tinh + Giao dịch --}}
    <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 gap-6">
      <div class="bg-gray-800 rounded-xl p-5 shadow-md">
        <div class="flex items-center justify-between">
          <p class="text-lg font-medium">Kết quả chiêm tinh</p>
          <i class="fas fa-magic text-3xl text-green-400"></i>
        </div>
        <a href="{{ route('admin.astrology_results.index') }}"
           class="mt-4 inline-block text-sm text-green-300 hover:underline">
          Xem thêm →
        </a>
      </div>
      <div class="bg-gray-800 rounded-xl p-5 shadow-md">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="text-2xl font-bold">{{ \App\Models\Transaction::where('status','pending')->count() }}</h3>
            <p class="text-base">Giao dịch chờ duyệt</p>
          </div>
          <i class="fas fa-wallet text-3xl text-green-400"></i>
        </div>
        <a href="{{ route('admin.transactions.index') }}"
           class="mt-4 inline-block text-sm text-green-300 hover:underline">
          Duyệt giao dịch →
        </a>
      </div>
    </div>

    {{-- Biểu đồ --}}
    <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 gap-6">
      <div class="bg-gray-800 rounded-lg p-6 shadow-md h-80">
        <h4 class="mb-3 text-xl font-semibold">📊 Lượt tra cứu 7 ngày qua</h4>
        <canvas id="chartTraCuu"></canvas>
      </div>
      <div class="bg-gray-800 rounded-lg p-6 shadow-md h-80">
        <h4 class="mb-3 text-xl font-semibold">🧑‍💼 Người dùng mới theo tháng</h4>
        <canvas id="chartUser"></canvas>
      </div>
    </div>

    {{-- Xuất PDF --}}
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
            color: '#374151',       // gray-700
            font: {
              size: 14,
              weight: 'bold'
            }
          },
          grid: {
            color: '#E5E7EB'        // gray-200 grid lines
          }
        },
        x: {
          ticks: {
            color: '#374151',
            font: {
              size: 14,
              weight: 'bold'
            }
          },
          grid: {
            color: '#E5E7EB'
          }
        }
      },
      plugins: {
        legend: {
          labels: {
            color: '#374151',
            font: {
              size: 14,
              weight: 'bold'
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
        backgroundColor: '#F87171', // red-400
        borderColor: '#F87171',
        borderWidth: 2
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            color: '#374151',
            font: {
              size: 14,
              weight: 'bold'
            }
          },
          grid: {
            color: '#E5E7EB'
          }
        },
        x: {
          ticks: {
            color: '#374151',
            font: {
              size: 14,
              weight: 'bold'
            }
          },
          grid: {
            color: '#E5E7EB'
          }
        }
      },
      plugins: {
        legend: {
          labels: {
            color: '#374151',
            font: {
              size: 14,
              weight: 'bold'
            }
          }
        }
      }
    }
  });
</script>
@endpush

