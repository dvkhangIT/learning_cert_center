<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}"
      rel="stylesheet">
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap"
      rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <title>404</title>
  </head>

  <body>
    <!-- wrapper -->
    <div class="wrapper">
      <div class="error-404 d-flex align-items-center justify-content-center">
        <div class="container">
          <div class="card py-5">
            <div class="row g-0">
              <div class="col col-xl-5">
                <div class="card-body p-4">
                  <h1 class="display-1"><span class="text-primary">4</span><span
                      class="text-danger">0</span><span
                      class="text-success">4</span></h1>
                  <h2 class="font-weight-bold">Trang Không
                    Tồn Tại
                  </h2>
                  <p>Trang bạn đang truy cập không tồn tại, đã bị xóa hoặc địa
                    chỉ đã được thay đổi. Vui lòng quay lại trang trước hoặc đi
                    đến trang chủ.
                  </p>
                  <div class="mt-5"> <a
                      href="{{ route('quan-ly.tong-quan') }}"
                      class="btn btn-primary btn-lg px-md-5 radius-30">Trang
                      chủ</a>
                    <a href="#" onclick="history.back();"
                      class="btn btn-outline-dark btn-lg ms-3 px-md-5 radius-30">Trở
                      về</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-7">
                <img
                  src="https://cdn.searchenginejournal.com/wp-content/uploads/2019/03/shutterstock_1338315902.png"
                  class="img-fluid" alt="">
              </div>
            </div>
            <!--end row-->
          </div>
        </div>
      </div>
    </div>
    <!-- end wrapper -->
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
  </body>

</html>
