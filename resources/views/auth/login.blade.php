@extends('auth.master')
@section('content')
  <div class="wrapper">
    <div
      class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
      <div class="container">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
          <div class="col mx-auto">
            <div class="card mb-0">
              <div class="card-body">
                <div class="p-4">
                  @if (Session::has('success'))
                    <div class="alert alert-success">
                      {{ Session::get('success') }}
                    </div>
                  @endif
                  @if (Session::has('error'))
                    <div class="alert alert-danger">
                      {{ Session::get('error') }}
                    </div>
                  @endif
                  <div class="mb-3 text-center">
                    <img src="{{ asset('assets/images/logo.png') }}"
                      width="60" alt="" />
                  </div>
                  <div class="text-center mb-4 text-uppercase">
                    <h5 class="">đăng nhập hệ thống</h5>
                  </div>
                  <div class="form-body">
                    <form action="{{ route('authenticate') }}" method="POST"
                      class="row g-3">
                      @csrf
                      <div class="col-12">
                        <label for="inputEmailAddress"
                          class="form-label">Email</label>
                        <input type="email"
                          class="form-control @error('email')
                              error
                          @enderror"
                          id="inputEmailAddress" name="email"
                          placeholder="Nhập email">
                        @error('email')
                          <p class="error mt-1">
                            {{ $message }}
                          </p>
                        @enderror
                      </div>
                      <div class="col-12">
                        <label for="inputChoosePassword" class="form-label">Mật
                          khẩu</label>
                        <div class="input-group" id="show_hide_password">
                          <input type="password" name="mat_khau"
                            class="form-control border-end-0 @error('mat_khau') error @enderror"
                            id="inputChoosePassword" placeholder="Nhập mật khẩu">
                          <a href="javascript:;"
                            @error('mat_khau')
                                style="border-color: #ea5455"
                            @enderror
                            class="input-group-text bg-transparent"><i
                              class='bx bx-hide'></i>
                          </a>
                        </div>
                        @error('mat_khau')
                          <p class="error mt-1">
                            {{ $message }}
                          </p>
                        @enderror
                      </div>
                      <div class="col-md-6">

                      </div>
                      <div class="col-md-6 text-end"> <a
                          href="{{ route('forgot.password') }}">Quên mật
                          khẩu?</a>
                      </div>
                      <div class="col-12">
                        <div class="d-grid">
                          <button type="submit" class="btn btn-primary">Đăng
                            nhập</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--end row-->
      </div>
    </div>
  </div>
@endsection
