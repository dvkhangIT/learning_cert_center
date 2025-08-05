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
          <li class="breadcrumb-item active" aria-current="page">Danh sách lớp
          </li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <a class="btn btn-outline-primary"
        href="{{ route('admin.class.create') }}"><i
          class="fa-solid fa-plus"></i>Tạo lớp</a>
    </div>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            {{ $dataTable->table() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal thêm học viên -->
  <div class="modal fade" id="themHocVienModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thêm học viên vào lớp</h5>
          <button type="button" class="btn-close"
            data-bs-dismiss="modal"></button>
        </div>
        <form method="POST" action="" id="themHocVienForm">
          @csrf
          <div class="modal-body">
            <div class="col-md-12">
              <select id="hocVienSelect" class="form-select form-select-sm"
                data-placeholder="Chọn học viên" name="hoc_vien_id[]"
                id="small-bootstrap-class-multiple-field" multiple>
              </select>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  @endsection
  @section('scripts')
    <script
      src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
    </script>
    <script src="{{ asset('assets/plugins/select2/js/select2-custom.js') }}">
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
    <script>
      $(document).ready(function() {
        $('#themHocVienModal').on('show.bs.modal', function(event) {
          const button = $(event.relatedTarget);
          const maLop = button.data('ma-lop');
          const modal = $(this);
          // Cập nhật URL submit
          modal.find('#themHocVienForm').attr('action',
            `/admin/lop/luu-hoc-vien/${maLop}`);
          // Gọi API lấy danh sách học viên chưa có lớp này
          $.get(`/admin/lop/${maLop}/hoc-vien-chua-co`, function(data) {
            let html = '';
            data.forEach(hv => {
              html +=
                `<option value="${hv.ma_hv}">${hv.hoten_hv}</option>`;
            });
            const select = $('#hocVienSelect');
            select.html(html);
            // Re-initialize Select2
            select.select2({
              dropdownParent: modal
            });
          });
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
