@extends('layouts.master')
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
              <h4 class="my-1 text-success">{{ $lop }}</h4>
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
    @foreach ($dataCharts as $chart)
      <div class="col-12 col-lg-6 d-flex">
        <div class="card radius-10 w-100">
          <div class="card-header">
            <div class="d-flex align-items-center">
              <div>
                <h6 class="mb-0"> {{ $chart['ten_loai'] }} — Kết quả từ
                  {{ $chart['start'] }} đến {{ $chart['end'] }}</h6>
              </div>
            </div>
          </div>
          <div class="card-body">
            <canvas id="{{ $chart['id'] }}" height="120"></canvas>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
@section('scripts')
  {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
  <script>
    @foreach ($dataCharts as $chart)
      new Chart(document.getElementById('{{ $chart['id'] }}').getContext('2d'), {
        type: 'bar',
        data: {
          labels: ['Đạt', 'Không đạt'],
          datasets: [{
            data: [Number({{ $chart['dat'] }}), Number(
              {{ $chart['khong_dat'] }})],
            backgroundColor: ['#4CAF50', '#F44336'],
            borderColor: ['#388E3C', '#D32F2F'],
            borderWidth: 1,
            borderRadius: 6
          }]
        },
        options: {
          indexAxis: 'y',
          responsive: true,
          plugins: {
            legend: {
              display: false
            },
            tooltip: {
              callbacks: {
                label: function(context) {
                  let total = context.dataset.data.reduce((a, b) => Number(
                    a) + Number(b), 0);
                  let value = Number(context.parsed.x); // giá trị của thanh
                  let percentage = total > 0 ? ((value / total) * 100)
                    .toFixed(1) + '%' : '0%';
                  let label = context.chart.data.labels[context
                    .dataIndex]; // Lấy đúng nhãn
                  return label + ': ' + value + ' (' + percentage + ')';
                }
              }
            }
          },
          scales: {
            x: {
              beginAtZero: true,
              ticks: {
                stepSize: 1
              }
            }
          }
        }
      });
    @endforeach
  </script>
@endsection
