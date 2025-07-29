@extends('auth.master')
@section('content')
  <div class="wrapper">
    <div
      class="authentication-reset-password d-flex align-items-center justify-content-center">
      <div class="container">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
          <div class="col mx-auto">
            <div class="card">
              <div class="card-body">
                <div class="p-4">
                  <div class="mb-4 text-center">
                    <img src="assets/images/logo-icon.png" width="60"
                      alt="">
                  </div>
                  <div class="text-start mb-4">
                    <h5 class="">Mật khẩu mới</h5>
                    <p class="mb-0">Chúng tôi đã nhận được yêu cầu đặt lại mật
                      khẩu của bạn. Vui lòng nhập mật khẩu mới của bạn!</p>
                  </div>
                  <form action="{{ route('process.reset.password') }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{ $tokenString }}"
                      name="token">
                    <div class="mb-3 mt-4">
                      <label class="form-label">Mật khẩu mới</label>
                      <input type="password"
                        class="form-control @error('new_password')
                    is-invalid @enderror"
                        name="new_password">
                      @error('new_password')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="mb-4">
                      <label class="form-label">Xác nhận mật khẩu</label>
                      <input type="password"
                        class="form-control @error('confirm_password')
                            is-invalid @enderror"
                        name="confirm_password">
                      @error('confirm_password')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="d-grid gap-2">
                      <button type="submit" class="btn btn-primary">Cập
                        nhật</button>
                      <a href="{{ route('login') }}" class="btn btn-light"><i
                          class="bx bx-arrow-back mr-1"></i>Đăng nhập</a>
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
@endsection
