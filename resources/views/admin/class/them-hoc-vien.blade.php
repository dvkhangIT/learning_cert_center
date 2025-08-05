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
          <li class="breadcrumb-item active" aria-current="page">Thêm học viên
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
          <div class="card-body p-4">
            <div class="form-body mt-4">
              <div class="row">
                <div class="col-lg-4">
                  <div class="border border-3 p-4 rounded">
                    <div class="row g-3">
                      <div class="col-12">
                        <form
                          action="{{ route('admin.class.luu-hoc-vien', $lop->ma_lop) }}"
                          method="POST"
                          class="create-user-form row g-3 needs-validation">
                          @csrf
                          <div class="col-md-12">
                            <select class="form-select form-select-sm"
                              data-placeholder="Chọn học viên"
                              name="hoc_vien_id[]"
                              id="small-bootstrap-class-multiple-field" multiple>
                              @foreach ($hocVien as $hv)
                                <option value="{{ $hv->ma_hv }}">
                                  {{ $hv->hoten_hv }}</option>
                              @endforeach
                            </select>
                            <p></p>
                          </div>
                      </div>
                      <div class="col-12">
                        <div class="d-grid">
                          <button type="submit"
                            class="btn btn-primary">Lưu</button>
                        </div>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8">
                  <h5>Danh sách học viên lớp: {{ $lop->ten_lop }}</h5>
                  <hr>
                  <div class="border border-2 rounded">
                    <table class="table table-bordered mb-0">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Lớp</th>
                          <th scope="col">Bắt đầu</th>
                          <th scope="col">Kết thúc</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($hocVien as $hv)
                          <tr>
                            <th scope="row">{{ $hv->ma_hv }}</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                </div>
              </div><!--end row-->
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script
    src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
  </script>
  <script src="{{ asset('assets/plugins/select2/js/select2-custom.js') }}">
  </script>
@endsection
