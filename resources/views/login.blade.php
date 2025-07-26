<!doctype html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('') }}assets/images/favicon-32x32.png"
      type="image/png" />
    <!--plugins-->
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}"
      rel="stylesheet" />
    <link
      href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}"
      rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}"
      rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}"
      rel="stylesheet">
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap"
      rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <title>Rocker - Bootstrap 5 Admin Dashboard Template</title>
  </head>

  <body class="">
    <!--wrapper-->
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
                          <label for="inputChoosePassword"
                            class="form-label">Mật khẩu</label>
                          <div class="input-group" id="show_hide_password">
                            <input type="password" name="mat_khau"
                              class="form-control border-end-0 @error('mat_khau') error @enderror"
                              id="inputChoosePassword"
                              placeholder="Nhập mật khẩu">
                            <a href="javascript:;"
                              @error('mat_khau')
                                style="border-color: #ea5455"
                            @enderror
                              class="input-group-text bg-transparent"><i
                                class='bx bx-hide'></i>
                            </a>
                          </div>
                          @error('password')
                            <p class="error mt-1">
                              {{ $message }}
                            </p>
                          @enderror
                        </div>
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6 text-end"> <a
                            href="authentication-forgot-password.html">Quên mật
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
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}">
    </script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}">
    </script>
    <script
      src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}">
    </script>
    <!--Password show & hide js -->
    <script>
      $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
          event.preventDefault();
          if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("bx-hide");
            $('#show_hide_password i').removeClass("bx-show");
          } else if ($('#show_hide_password input').attr("type") ==
            "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("bx-hide");
            $('#show_hide_password i').addClass("bx-show");
          }
        });
      });
    </script>
    <!--app JS-->
    <script src="{{ asset('assets/js/app.js') }}"></script>
  </body>

</html>
