@extends('layouts.master')
@section('title', 'Thống kê')
@section('content')
  <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
    <div class="col">
      <div class="card radius-10 border-start border-0 border-4 border-info">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Số lượng học viên</p>
              <h4 class="my-1 text-info">{{ $hocVien }}</h4>
            </div>
            <div
              class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto">
              <i class="fadeIn animated bx bx-group"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10 border-start border-0 border-4 border-danger">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Số lượng khóa học</p>
              <h4 class="my-1 text-danger">{{ $khoaHoc }}</h4>
            </div>
            <div
              class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto">
              <i class="fadeIn animated bx bx-book"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10 border-start border-0 border-4 border-success">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Số lượng lớp</p>
              <h4 class="my-1 text-success">{{ $countLop }}</h4>
            </div>
            <div
              class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
              <i class="bx bx-category"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card radius-10 border-start border-0 border-4 border-warning">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div>
              <p class="mb-0 text-secondary">Số lượng chứng chỉ</p>
              <h4 class="my-1 text-warning">{{ $chungChi }}</h4>
            </div>
            <div
              class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto">
              <i class="fadeIn animated bx bx-award"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!--end row-->

  <div class="row">
    <div class="col-12 col-lg-12 d-flex">
      <div class="card radius-10 w-100">
        <div class="card-header">
          <div class="d-flex align-items-center justify-content-center">
            <h6 class="mb-0">Thông kê kết quả theo lớp</h6>
          </div>
        </div>
        <div class="card-body">
          <canvas id="ketQuaChart"></canvas>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script>
    const ctx = document.getElementById('ketQuaChart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: @json($labels),
        datasets: [{
            label: 'Đạt',
            data: @json($datDat),
            backgroundColor: '#0e4582'
          },
          {
            label: 'Không đạt',
            data: @json($datKhongDat),
            backgroundColor: 'rgba(255, 99, 132, 0.7)'
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
          duration: 1500, // thời gian chạy animation
          easing: 'easeOutBounce', // hiệu ứng bật
        },
        transitions: {
          show: {
            animations: {
              x: {
                from: 0
              },
              y: {
                from: 0
              }
            }
          },
          hide: {
            animations: {
              x: {
                to: 0
              },
              y: {
                to: 0
              }
            }
          }
        },
        scales: {
          x: {
            stacked: false
          },
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 1,
              callback: function(value) {
                return Number.isInteger(value) ? value : null;
              }
            }
          }
        }
      }
    });
  </script>
@endsection
