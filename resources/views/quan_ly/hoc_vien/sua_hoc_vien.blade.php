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
    <div class="breadcrumb-title pe-3">Học viên</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i
                class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Cập nhật học viên
          </li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <a class="btn btn-outline-primary"
        href="{{ route('quan-ly.hoc-vien.danh-sach-hoc-vien') }}">
        <i class="fa-solid fa-arrow-left"></i>
      </a>
    </div>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-xl-6 mx-auto">
        <div class="card">
          <div class="card-body p-4">
            <form method="POST"
              action="{{ route('quan-ly.hoc-vien.sua-hoc-vien', $hocVien->ma_hv) }}"
              class="row g-3">
              @csrf
              @method('PUT')
              <div class="col-md-12">
                <label for="input3" class="form-label">Họ tên</label>
                <input type="text"
                  value="{{ old('hoten_hv', $hocVien->hoten_hv) }}"
                  class="form-control @error('hoten_hv')
                    is-invalid
                @enderror"
                  id="input3" name="hoten_hv" placeholder="Họ tên học viên">
                @error('hoten_hv')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col-md-12">
                <label class="form-label">Ngày sinh</label>
                <input type="text"
                  class="datepicker form-control @error('ngay_sinh')
                  is-invalid
              @enderror"
                  name="ngay_sinh" id="ngay_sinh" placeholder="Chọn ngày"
                  value="{{ old('ngay_sinh', $hocVien->ngay_sinh) }}">
                @error('ngay_sinh')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col-md-12">
                <label class="form-label">Nơi sinh</label>
                <select
                  class="noi_sinh form-select @error('noi_sinh')
                    is-invalid
                @enderror"
                  id="single-select-field" data-placeholder="Chọn tỉnh/thành phố"
                  name="noi_sinh">
                  <option></option>
                </select>
                @error('noi_sinh')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col-md-12">
                @php
                  $gioiTinhCu = old('gioi_tinh', $hocVien->gioi_tinh ?? '');
                @endphp
                <label for="input6" class="form-label">Giới tính</label>
                <div class="d-flex align-items-center gap-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio"
                      name="gioi_tinh" id="nam" value="nam"
                      {{ $gioiTinhCu == 'nam' ? 'checked' : '' }}>
                    <label class="form-check-label" for="nam">
                      Nam
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio"
                      name="gioi_tinh" id="nu" value="nu"
                      {{ $gioiTinhCu == 'nu' ? 'checked' : '' }}>
                    <label class="form-check-label" for="nu">
                      Nữ
                    </label>
                  </div>
                </div>
                @error('gioi_tinh')
                  <div class="error">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="col-md-12">
                <div class="d-md-flex d-grid align-items-center gap-3">
                  <button type="submit" class="btn btn-primary px-4">Lưu</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script
    src=" https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/vn.js"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
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
    });
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
  {{-- api tỉnh thành phố --}}
  <script>
    $(document).ready(function() {
      let url = 'https://provinces.open-api.vn/api/v1/p/';
      let selectedProvince = "{{ $hocVien->noi_sinh }}";
      $.ajax({
        method: "get",
        url: url,
        success: function(response) {
          $('.noi_sinh').html('<option value=""></option>');
          response.forEach(function(province) {
            $('.noi_sinh').append(
              `<option value="${province.name}">${province.name}</option>`
            );
          })
          $('.noi_sinh').val(selectedProvince).trigger('change');
        },
        error: function() {
          alert("Không thể tải danh sách tỉnh/thành phố.");
        }
      });
    });
  </script>
@endsection
