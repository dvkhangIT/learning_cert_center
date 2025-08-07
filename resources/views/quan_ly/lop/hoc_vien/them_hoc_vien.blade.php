@extends('layouts.master')
@section('css')
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
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
          <li class="breadcrumb-item active" aria-current="page">Danh sách lớp:
            {{ $lop->ten_lop }}
          </li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <a class="btn btn-outline-primary"
        href="{{ route('quan-ly.lop.danh-sach-lop') }}">
        <i class="fa-solid fa-arrow-left"></i>
      </a>
    </div>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <form method="POST"
              action="{{ route('quan-ly.lop.luu-hoc-vien', $ma_lop) }}">
              @csrf
              <div class="modal-body">
                <div class="col-md-12 mb-2">
                  <select id="hocVienSelect"
                    class="form-select mb-3 @error('hoc_vien_id')
                  is-invalid
              @enderror"
                    id="single-select-field" data-placeholder="Chọn học viên"
                    name="hoc_vien_id[]" multiple>
                    @foreach ($hocVien as $hv)
                      <option value="{{ $hv->ma_hv }}">{{ $hv->hoten_hv }}
                      </option>
                    @endforeach
                  </select>
                  @error('hoc_vien_id')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                </div>
                <div class="">
                  <button type="submit" class="btn btn-primary px-3">Lưu</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-8">
        <div class="card">
          <div class="card-body">
            {{ $dataTable->table() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">
  </script>
  <script
    src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
  </script>
  <script>
    $(document).ready(function() {
      $('#hocVienSelect').select2({
        theme: 'bootstrap-5'
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
    });
  </script>
@endsection
@push('scripts')
  <link rel="stylesheet"
    href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
  <script
    src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js">
  </script>
  {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
