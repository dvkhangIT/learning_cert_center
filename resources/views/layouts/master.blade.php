<!doctype html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}"
      type="image/png" />
    <!--plugins-->
    <link
      href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}"
      rel="stylesheet" />
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
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <!-- Theme Style CSS -->

    <link rel="stylesheet" href="{{ asset('assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/semi-dark.css') }}" />
    <link rel="stylesheet"
      href="{{ asset('assets/css/header-colors.css') }}" />
    {{-- lib --}}
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">

    {{-- icon --}}
    <link rel="stylesheet"
      href="{{ asset('assets/fontawesome/css/all.min.css') }}">

    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <title>Quản lý chứng chỉ</title>
  </head>

  <body>
    <!--wrapper-->
    <div class="wrapper">
      <!--sidebar wrapper -->
      @include('layouts.sidebar')
      <!--end sidebar wrapper -->
      <!--start header -->
      @include('layouts.header')
      <!--end header -->
      <!--start page wrapper -->
      <div class="page-wrapper">
        <div class="page-content">
          @yield('name')

        </div>
      </div>
      <!--end page wrapper -->
      <!--start overlay-->
      <div class="overlay toggle-icon"></div>
      <!--end overlay-->
      <!--Start Back To Top Button-->
      <a href="javaScript:;" class="back-to-top"><i
          class='bx bxs-up-arrow-alt'></i></a>
      <!--End Back To Top Button-->
      <footer class="page-footer">
        <p class="mb-0">Copyright © 2022. All right reserved.</p>
      </footer>
    </div>
    <!--end wrapper-->
    <!-- search modal -->
    <div class="modal" id="SearchModal" tabindex="-1">
      <div
        class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-md-down">
        <div class="modal-content">
          <div class="modal-header gap-2">
            <div class="position-relative popup-search w-100">
              <input
                class="form-control form-control-lg ps-5 border border-3 border-primary"
                type="search" placeholder="Search">
              <span
                class="position-absolute top-50 search-show ms-3 translate-middle-y start-0 top-50 fs-4"><i
                  class='bx bx-search'></i></span>
            </div>
            <button type="button" class="btn-close d-md-none"
              data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="search-list">
              <p class="mb-1">Html Templates</p>
              <div class="list-group">
                <a href="javascript:;"
                  class="list-group-item list-group-item-action active align-items-center d-flex gap-2 py-1"><i
                    class='bx bxl-angular fs-4'></i>Best Html Templates</a>
                <a href="javascript:;"
                  class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                    class='bx bxl-vuejs fs-4'></i>Html5 Templates</a>
                <a href="javascript:;"
                  class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                    class='bx bxl-magento fs-4'></i>Responsive Html5
                  Templates</a>
                <a href="javascript:;"
                  class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                    class='bx bxl-shopify fs-4'></i>eCommerce Html
                  Templates</a>
              </div>
              <p class="mb-1 mt-3">Web Designe Company</p>
              <div class="list-group">
                <a href="javascript:;"
                  class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                    class='bx bxl-windows fs-4'></i>Best Html Templates</a>
                <a href="javascript:;"
                  class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                    class='bx bxl-dropbox fs-4'></i>Html5 Templates</a>
                <a href="javascript:;"
                  class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                    class='bx bxl-opera fs-4'></i>Responsive Html5
                  Templates</a>
                <a href="javascript:;"
                  class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                    class='bx bxl-wordpress fs-4'></i>eCommerce Html
                  Templates</a>
              </div>
              <p class="mb-1 mt-3">Software Development</p>
              <div class="list-group">
                <a href="javascript:;"
                  class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                    class='bx bxl-mailchimp fs-4'></i>Best Html Templates</a>
                <a href="javascript:;"
                  class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                    class='bx bxl-zoom fs-4'></i>Html5 Templates</a>
                <a href="javascript:;"
                  class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                    class='bx bxl-sass fs-4'></i>Responsive Html5
                  Templates</a>
                <a href="javascript:;"
                  class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                    class='bx bxl-vk fs-4'></i>eCommerce Html Templates</a>
              </div>
              <p class="mb-1 mt-3">Online Shoping Portals</p>
              <div class="list-group">
                <a href="javascript:;"
                  class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                    class='bx bxl-slack fs-4'></i>Best Html Templates</a>
                <a href="javascript:;"
                  class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                    class='bx bxl-skype fs-4'></i>Html5 Templates</a>
                <a href="javascript:;"
                  class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                    class='bx bxl-twitter fs-4'></i>Responsive Html5
                  Templates</a>
                <a href="javascript:;"
                  class="list-group-item list-group-item-action align-items-center d-flex gap-2 py-1"><i
                    class='bx bxl-vimeo fs-4'></i>eCommerce Html Templates</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end search modal -->
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
    <script
      src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}">
    </script>
    <script
      src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}">
    </script>
    <script src="{{ asset('assets/plugins/chartjs/js/chart.js') }}"></script>
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <!--app JS-->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
      new PerfectScrollbar(".app-container");
    </script>
    {{-- lib --}}
    <script src="{{ asset('assets/js/dataTables.min.js') }}"></script>

    <script
      src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js">
    </script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
    </script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js">
    </script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js">
    </script>
    @stack('scripts')
  </body>

</html>
