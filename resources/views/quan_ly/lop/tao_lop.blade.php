@extends('layouts.master')
@section('css')
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection
@section('content')
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Lớp</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i
                class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Tạo lớp
          </li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <a class="btn btn-custom-color"
        href="{{ route('quan-ly.lop.danh-sach-lop') }}">
        <i class="fa-solid fa-arrow-left"></i>
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-6 mx-auto">
      <div class="card">
        <div class="card-body p-4">
          <form id="create-user-form" action="{{ route('quan-ly.lop.luu-lop') }}"
            class="row g-3 needs-validation" method="POST">
            @csrf
            <div class="col-md-12">
              <label for="ten_lop" class="form-label">Tên lớp</label>
              <input type="text" id="ten_lop"
                class="form-control @error('ten_lop')
                  is-invalid
              @enderror"
                name="ten_lop" value="{{ old('ten_lop') }}">
              @error('ten_lop')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="col-md-12">
              <label for="single-select-field" class="form-label">Khóa học</label>
              <select
                class="form-select @error('ma_kh')
                  is-invalid
              @enderror"
                id="single-select-field" name="ma_kh"
                data-placeholder="Chọn khóa học">
                <option></option>
                @foreach ($courses as $course)
                  <option value="{{ $course->ma_kh }}">
                    {{ $course->ten_kh }}</option>
                @endforeach
              </select>
              @error('ma_kh')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="col-md-12">
              <label class="form-label">Ngày bắt đầu</label>
              <input type="text"
                class="datepicker form-control @error('ngay_bat_dau')
                  is-invalid
              @enderror"
                name="ngay_bat_dau" id="ngay_bat_dau" placeholder="Chọn ngày"
                value="">
              @error('ngay_bat_dau')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="col-md-12">
              <label class="form-label">Ngày kết thúc</label>
              <input type="text"
                class="datepicker form-control @error('ngay_ket_thuc')
                  is-invalid
              @enderror"
                name="ngay_ket_thuc" id="ngay_ket_thuc" placeholder="Chọn ngày"
                value="">
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
@push('scripts')
  <link rel="stylesheet"
    href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
  <script
    src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js">
  </script>
@endpush
@section('scripts')
  <script
    src=" https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/vn.js"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
  </script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/i18n/vi.js">
  </script>
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
    $.fn.select2.defaults.set('language', {
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
    });
  </script>
@endsection
