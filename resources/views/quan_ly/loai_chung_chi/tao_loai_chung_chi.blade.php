@extends('layouts.master')
@section('css')
  <link rel="stylesheet" href="{{ asset('assets/css/flatpickr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/select2-bootstrap-5-theme.min.css') }}">
@endsection
@section('title', 'Tạo chưng chỉ')
@section('content')
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Chứng chỉ</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Tạo loại chứng
            chỉ
          </li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <a class="btn btn-custom-color" href="{{ route('quan-ly.loai-chung-chi.danh-sach-loai-chung-chi') }}">
        <i class="fa-solid fa-arrow-left"></i>
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-8 mx-auto">
      <div class="card">
        <div class="card-body p-4">
          <form action="{{ route('quan-ly.loai-chung-chi.luu-loai-chung-chi') }}" class="row g-3 needs-validation"
            method="POST">
            @csrf
            <div class="col-md-12">
              <label for="ten_loai_cc" class="form-label">Chứng chỉ</label>
              <input type="text" id="ten_loai_cc"
                class="form-control @error('ten_loai_cc')
                  is-invalid
              @enderror"
                name="ten_loai_cc" value="{{ old('ten_loai_cc') }}">
              @error('ten_loai_cc')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <label class="">Cấu hình điểm</label>
            <div class="col-md-6">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="cau_hinh_diem[]" value="diem_nghe" id="diem_nghe"
                  {{ in_array('diem_nghe', old('cau_hinh_diem', [])) ? 'checked' : '' }}>
                <label for="diem_nghe">Nghe</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="cau_hinh_diem[]" value="diem_noi" id="diem_noi"
                  {{ in_array('diem_noi', old('cau_hinh_diem', [])) ? 'checked' : '' }}>
                <label for="diem_noi">Nói</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="cau_hinh_diem[]" value="diem_doc" id="diem_doc"
                  {{ in_array('diem_doc', old('cau_hinh_diem', [])) ? 'checked' : '' }}>
                <label for="diem_doc">Đọc</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="cau_hinh_diem[]" value="diem_viet" id="diem_viet"
                  {{ in_array('diem_viet', old('cau_hinh_diem', [])) ? 'checked' : '' }}>
                <label for="diem_viet">Viết</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="cau_hinh_diem[]" value="diem_tu_vung"
                  id="diem_tu_vung" {{ in_array('diem_tu_vung', old('cau_hinh_diem', [])) ? 'checked' : '' }}>
                <label for="diem_tu_vung">Từ vựng</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="cau_hinh_diem[]" value="diem_ngu_phap_doc"
                  id="diem_ngu_phap_doc" {{ in_array('diem_ngu_phap_doc', old('cau_hinh_diem', [])) ? 'checked' : '' }}>
                <label for="diem_ngu_phap_doc">Ngữ pháp (đọc)</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="cau_hinh_diem[]" value="diem_trac_nghiem"
                  id="diem_trac_nghiem" {{ in_array('diem_trac_nghiem', old('cau_hinh_diem', [])) ? 'checked' : '' }}>
                <label for="diem_trac_nghiem">Trắc nghiệm</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="cau_hinh_diem[]" value="diem_thuc_hanh"
                  id="diem_thuc_hanh" {{ in_array('diem_thuc_hanh', old('cau_hinh_diem', [])) ? 'checked' : '' }}>
                <label for="diem_thuc_hanh">Thực hành</label>
              </div>
            </div>
            @error('cau_hinh_diem')
              <div class="error-checkbox">{{ $message }}</div>
            @enderror
            <div class="col-md-12">
              <div class="d-md-flex d-grid align-items-center gap-3">
                <button id="submit-btn" type="submit" class="btn btn-primary px-4">Lưu</button>
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
  <script src="{{ asset('assets/plugins/select2/js/select2-custom.js') }}"></script>
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
    });
  </script>
@endsection
