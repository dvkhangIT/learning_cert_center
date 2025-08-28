@extends('tai_khoan.master')
@section('title', 'Quên mật khẩu')
@section('content')
  <div class="wrapper">
    <div
      class="authentication-forgot d-flex align-items-center justify-content-center">
      <div class="card forgot-box">
        <div class="card-body">
          <div class="p-3">
            <div class="text-center">
              <img src="{{ asset('assets/images/logo.png') }}" width="100"
                alt="" />
            </div>
            <h4 class="mt-5 font-weight-bold">Quên mật khẩu?</h4>
            <p class="text-muted">Nhập địa chỉ email đăng ký của bạn để đặt lại
              mật khẩu</p>
            <form action="{{ route('quen-mat-khau') }}" method="POST">
              @csrf
              <div class="my-4">
                <label class="form-label">Email</label>
                <input type="text"
                  class="form-control @error('email')
                    is-invalid
                @enderror"
                  value="{{ old('email') }}" name="email" />
                @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Xác nhận</button>
                <a href="{{ route('form-dang-nhap') }}" class="btn btn-light"><i
                    class='bx bx-arrow-back me-1'></i>Đăng nhập</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.querySelector('form').addEventListener('submit', function() {
      Swal.fire({
        title: 'Vui lòng chờ...',
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        }
      });
    });
  </script>
@endsection
