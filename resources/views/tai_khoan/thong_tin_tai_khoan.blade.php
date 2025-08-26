@extends('layouts.master')
@section('css')
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection
@section('title', 'Đổi mật khẩu')
@section('content')
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Tài khoản</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i
                class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Thay đổi mật khẩu
          </li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <a class="btn btn-custom-color" href="javascript:history.back()">
        <i class="fa-solid fa-arrow-left"></i>
      </a>
    </div>
  </div>
  <div class="page-content">
    <div class="container">
      <div class="main-body">
        <div class="row">
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                  <img src="{{ asset('assets/images/user.jpg') }}" alt="Admin"
                    class="rounded-circle p-1" width="110">
                  <div class="mt-3">
                    <h4>{{ $user->ho_ten }}</h4>
                    <p class="text-secondary mb-1">
                      {{ $user->vai_tro == 'quanly' ? 'Quản lý' : 'Nhân viên' }}
                    </p>
                    <button class="btn btn-primary">Follow</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <h5 class="d-flex align-items-center mb-3">Thông tin tài khoản
                </h5>
                <form method="POST"
                  action="{{ route('cap-nhat-thong-tin-tai-khoan', $user->ma_tk) }}"
                  class="row g-3">
                  @csrf
                  @method('PUT')
                  <div class="col-md-12">
                    <label class="form-label">Họ tên</label>
                    <input type="text"
                      class="form-control @error('ho_ten')
                    is-invalid
                @enderror"
                      name="ho_ten" value="{{ old('ho_ten', $user->ho_ten) }}">
                    @error('ho_ten')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="col-md-12">
                    <label class="form-label">Email</label>
                    <input type="text"
                      class="form-control @error('email')
                    is-invalid
                @enderror"
                      name="email" value="{{ old('email', $user->email) }}">
                    @error('email')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                      <button type="submit"
                        class="btn btn-primary px-4">Lưu</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <h5 class="d-flex align-items-center mb-3">Đổi mật khẩu
                    </h5>
                    <div class="section-body">
                      <div class="row">
                        <div class="">
                          <div class="">
                            <div class="">
                              <form method="POST"
                                action="{{ route('luu-mat-khau') }}"
                                class="row g-3">
                                @csrf
                                <div class="col-md-12">
                                  <label class="form-label">Mật
                                    khẩu hiện tại</label>
                                  <input type="password"
                                    class="form-control @error('current_password')is-invalid @enderror"
                                    name="current_password">
                                  @error('current_password')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                  @enderror
                                </div>
                                <div class="col-md-12">
                                  <label class="form-label">Mật
                                    khẩu mới</label>
                                  <input type="password"
                                    class="form-control @error('new_password') is-invalid @enderror"
                                    name="new_password">
                                  @error('new_password')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                  @enderror
                                </div>
                                <div class="col-md-12">
                                  <label class="form-label">Xác
                                    nhận mật khẩu
                                    mới</label>
                                  <input type="password"
                                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                    name="new_password_confirmation">
                                  @error('new_password_confirmation')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                  @enderror
                                </div>
                                <div class="col-md-12">
                                  <div
                                    class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit"
                                      class="btn btn-primary px-4">Lưu</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
      $.ajax({
        method: "get",
        url: url,
        success: function(response) {
          const select = $('.noi_sinh');
          select.html('<option value=""></option>');
          response.forEach(function(province) {
            select.append(
              `<option value="${province.name}">${province.name}</option>`
            );
          });
          const oldValue = "{{ old('noi_sinh') }}";
          if (oldValue) {
            select.val(oldValue);
          }
        },
        error: function() {
          alert("Không thể tải danh sách tỉnh/thành phố.");
        }
      });
    });
  </script>
@endsection
