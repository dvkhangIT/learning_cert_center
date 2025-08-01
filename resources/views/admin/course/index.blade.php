@extends('layouts.master')
@section('name')
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Tài khoản</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i
                class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Danh sách tài khoản
          </li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <a data-bs-toggle="modal" data-bs-target="#createCourse"
        class="btn btn-outline-primary course-create"
        href="{{ route('admin.course.store') }}"><i
          class="fa-solid fa-plus"></i>Tạo khóa
        học</a>
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
  {{-- Modal update course --}}
  <div class="modal fade" id="updateCourse" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Sửa khóa học</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="update-course-form"
            class="create-user-form row g-3 needs-validation">
            @csrf
            @method('PUT')
            <div class="col-md-12">
              <label for="input3" class="form-label">Khóa học</label>
              <input id="ten_kh_edit" type="text" value=""
                class="form-control " name="ten_kh">
              <p></p>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary"
            data-bs-dismiss="modal">Hủy</button>
          <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  {{-- Modal create course --}}
  <div class="modal fade" id="createCourse" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tạo khóa học</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="create-course-form"
            class="create-user-form row g-3 needs-validation">
            @csrf
            <div class="col-md-12">
              <label for="input3" class="form-label">Khóa học</label>
              <input id="ten_kh_create" type="text" value=""
                class="form-control " name="ten_kh">
              <p></p>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary"
            data-bs-dismiss="modal">Hủy</button>
          <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script>
    // change status
    $(document).ready(function() {
      // Display an info toast with no title
      $('body').on('change', '.change-status', function(e) {
        let isChecked = $(this).is(':checked');
        let ma_tk = $(this).data('id');
        $.ajax({
          type: "POST",
          url: "{{ route('admin.account.change-status') }}",
          data: {
            _token: $('meta[name="csrf-token"]').attr(
              'content'),
            _method: 'PUT',
            trang_thai: isChecked,
            ma_tk: ma_tk,
          },
          success: function(data) {
            toastr.success(data.message, '');
          }
        });
      })

      // reset password
      $('body').on('click', '.reset-password', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        Swal.fire({
          title: "Bạn có chắc chắn khôi phục mật khẩu?",
          // text: "Bạn sẽ không thể khôi phục lại!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ok!",
          cancelButtonText: 'Hủy',
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire({
              title: 'Vui lòng chờ!...',
              allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
              }
            });
            $.ajax({
              type: "PUT",
              url: url,
              success: function(data) {
                if (data.status == 'success') {
                  Swal.fire({
                    title: "Thành công!",
                    text: data.message,
                    icon: "success"
                  });
                } else if (data.status == 'error') {
                  Swal.fire({
                    text: data.message,
                    icon: "error",
                  });
                }
              }
            });
          }
        });
      })
      console.log('object');
      console.log($.fn.dataTable.isDataTable('#khoahoc-table'));

      // update course
      $('body').on('click', '.update-item', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        $('#ten_kh_edit').val($(this).data('name'));
        $('#ten_kh_edit').removeClass('is-invalid')
          .siblings('p')
          .removeClass('invalid-feedback')
          .html('');
        $('#update-course-form').submit(function(e) {
          e.preventDefault();
          $.ajax({
            method: "PUT",
            url: url,
            data: $("#update-course-form").serializeArray(),
            dataType: "json",
            success: function(response) {
              if (response.status == true) {
                $('#ten_kh').removeClass('is-invalid')
                  .siblings('p')
                  .removeClass('invalid-feedback')
                  .html('')
                window.location.reload();
              } else {
                if (response.errors.ten_kh) {
                  $("#ten_kh_edit").addClass('is-invalid')
                    .siblings('p')
                    .addClass('invalid-feedback')
                    .html(response.errors.ten_kh)
                }
              }
            }
          });
        })
      });

      // create course
      let createUrl = '';
      $('body').on('click', '.course-create', function(e) {
        e.preventDefault();
        createUrl = $(this).attr('href')
        $('#ten_kh_create').removeClass('is-invalid')
          .siblings('p')
          .removeClass('invalid-feedback')
          .html('');
      })
      $('#create-course-form').submit(function(e) {
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: createUrl,
          data: $("#create-course-form").serializeArray(),
          dataType: "json",
          success: function(response) {
            if (response.status == true) {
              $('#ten_kh').removeClass('is-invalid')
                .siblings('p')
                .removeClass('invalid-feedback')
                .html('')
              window.location.reload();
            } else {
              if (response.errors.ten_kh) {
                $("#ten_kh_create").addClass('is-invalid')
                  .siblings('p')
                  .addClass('invalid-feedback')
                  .html(response.errors.ten_kh)
              }
            }
          }
        });
      });
      // end create course
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
