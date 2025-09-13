@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{ asset('assets/css/flatpickr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
  <link rel="stylesheet"
    href="{{ asset('assets/css/select2-bootstrap-5-theme.min.css') }}">
@endsection
@section('title', 'Tạo chưng chỉ')
@section('content')
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Chứng chỉ</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i
                class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Tạo chứng chỉ
          </li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <a class="btn btn-custom-color"
        href="{{ route('quan-ly.chung-chi.danh-sach-chung-chi') }}">
        <i class="fa-solid fa-arrow-left"></i>
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-8 mx-auto">
      <div class="card">
        <div class="card-body p-4">
          <form action="{{ route('quan-ly.chung-chi.luu-chung-chi') }}"
            class="row g-3 needs-validation" method="POST">
            @csrf
            <div class="col-md-12 mb-2">
              <label class="form-label">Loại chứng chỉ</label>
              <select id="chungChiSelect"
                class="form-select mb-3 @error('ma_loai_cc')
                  is-invalid @enderror"
                id="single-select-field" data-placeholder="Chọn loại chứng chỉ"
                name="ma_loai_cc">
                @foreach ($loaiChungChi as $lcc)
                  <option value=""></option>
                  <option
                    {{ old('ma_loai_cc') == $lcc->ma_loai_cc ? 'selected' : '' }}
                    value="{{ $lcc->ma_loai_cc }}">{{ $lcc->ten_loai_cc }}
                  </option>
                @endforeach
              </select>
              @error('ma_loai_cc')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-12 mb-2">
              <label class="form-label">Học viên</label>
              <select id="hocVienSelect"
                class="form-select mb-3 @error('ma_hv')
                  is-invalid @enderror"
                id="single-select-field" data-placeholder="Chọn học viên"
                name="ma_hv">
                @foreach ($hocVien as $hv)
                  <option value=""></option>
                  <option {{ old('ma_hv') == $hv->ma_hv ? 'selected' : '' }}
                    value="{{ $hv->ma_hv }}">{{ $hv->hoten_hv }}
                  </option>
                @endforeach
              </select>
              @error('ma_hv')
                <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="so_hieu" class="form-label">Số hiệu</label>
              <input type="text" id="so_hieu"
                class="form-control @error('so_hieu')
                  is-invalid
              @enderror"
                name="so_hieu" value="{{ old('so_hieu') }}">
              @error('so_hieu')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="so_vao_so" class="form-label">Số vào sổ</label>
              <input type="text" id="so_vao_so"
                class="form-control @error('so_vao_so')
                  is-invalid
              @enderror"
                name="so_vao_so" value="{{ old('so_vao_so') }}">
              @error('so_vao_so')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="col-md-12">
              <label class="form-label">Ngày vào sổ</label>
              <input type="text"
                class="datepicker form-control @error('ngay_vao_so')
                  is-invalid
              @enderror"
                name="ngay_vao_so" id="ngay_vao_so" placeholder="Chọn ngày"
                value="{{ old('ngay_vao_so') }}">
              @error('ngay_vao_so')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="col-md-6">
              <label class="form-label">Ngày bắt đầu</label>
              <input type="text"
                class="datepicker form-control @error('ngay_bat_dau')
                  is-invalid
              @enderror"
                name="ngay_bat_dau" id="ngay_bat_dau" placeholder="Chọn ngày"
                value="{{ old('ngay_bat_dau') }}">
              @error('ngay_bat_dau')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="col-md-6">
              <label class="form-label">Ngày kết thúc</label>
              <input type="text"
                class="datepicker form-control @error('ngay_ket_thuc')
                  is-invalid
              @enderror"
                name="ngay_ket_thuc" id="ngay_ket_thuc" placeholder="Chọn ngày"
                value="{{ old('ngay_ket_thuc') }}">
              @error('ngay_ket_thuc')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="col-md-12">
              <div class="d-md-flex d-grid align-items-center gap-3">
                <button id="submit-btn" type="submit"
                  class="btn btn-primary px-4">Lưu</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.getElementById('create-user-form').addEventListener('submit',
      function() {
        document.getElementById('submit-btn').disabled = true;
        document.getElementById('submit-btn').innerText = 'Đang xử lý...';
      });
  </script>
@endsection
@section('scripts')
  <script src="{{ asset('assets/js/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/js/vn.js') }}"></script>
  <script src="{{ asset('assets/js/select2.min.js') }}"></script>
  <script src="{{ asset('assets/js/vi.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/js/select2-custom.js') }}">
  </script>
  <script>
    $(document).ready(function() {
      flatpickr(".datepicker", {
        locale: "vn",
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d-m-Y",
      });
      let startPicker = flatpickr('#ngay_bat_dau', {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d-m-Y",
        locale: "vn",
        onChange: function(selectedDates, dateStr, instance) {
          console.log(selectedDates);
          if (selectedDates[0]) {
            endPicker.set("minDate", selectedDates[0]);
          }
        },
      });
      endPicker = flatpickr("#ngay_ket_thuc", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d-m-Y",
        locale: "vn",
        onChange: function(selectedDates, dateStr, instance) {
          if (selectedDates[0]) {
            startPicker.set("maxDate", selectedDates[0]);
          }
        }
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      $('#chungChiSelect').select2({
        theme: 'bootstrap-5',
        language: {
          errorLoading: function() {
            return "Không thể tải kết quả.";
          },
          inputTooLong: function(args) {
            var overChars = args.input.length - args.maximum;
            return "Vui lòng xóa bớt " + overChars + " ký tự";
          },
          inputTooShort: function(args) {
            var remainingChars = args.minimum - args.input.length;
            return "Vui lòng nhập thêm " + remainingChars + " ký tự";
          },
          loadingMore: function() {
            return "Đang tải thêm kết quả…";
          },
          maximumSelected: function(args) {
            return "Chỉ có thể chọn tối đa " + args.maximum + " mục";
          },
          noResults: function() {
            return "Không tìm thấy kết quả";
          },
          searching: function() {
            return "Đang tìm…";
          },
          removeAllItems: function() {
            return "Xóa tất cả các mục";
          }
        }
      });

      $('#hocVienSelect').select2({
        theme: 'bootstrap-5',
        language: {
          errorLoading: function() {
            return "Không thể tải kết quả.";
          },
          inputTooLong: function(args) {
            var overChars = args.input.length - args.maximum;
            return "Vui lòng xóa bớt " + overChars + " ký tự";
          },
          inputTooShort: function(args) {
            var remainingChars = args.minimum - args.input.length;
            return "Vui lòng nhập thêm " + remainingChars + " ký tự";
          },
          loadingMore: function() {
            return "Đang tải thêm kết quả…";
          },
          maximumSelected: function(args) {
            return "Chỉ có thể chọn tối đa " + args.maximum + " mục";
          },
          noResults: function() {
            return "Không tìm thấy kết quả";
          },
          searching: function() {
            return "Đang tìm…";
          },
          removeAllItems: function() {
            return "Xóa tất cả các mục";
          }
        }
      });
    });
  </script>
@endsection
