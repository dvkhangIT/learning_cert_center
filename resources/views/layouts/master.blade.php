<!DOCTYPE html>
<html lang="en">

  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}"
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
    {{-- dataTables css --}}
    <link rel="stylesheet"
      href="{{ asset('assets/dataTables/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet"
      href="https://cdn.datatables.net/responsive/3.0.5/css/responsive.dataTables.min.css">
    {{-- <link rel="stylesheet"
      href="https://cdn.datatables.net/buttons/3.2.4/css/buttons.dataTables.min.css"> --}}

    {{-- toastr --}}
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">

    {{-- icon --}}
    <link rel="stylesheet"
      href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    @yield('css')
    {{-- custom css --}}
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <title>CTUT | @yield('title', $title ?? '')</title>
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
          @yield('content')
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
    {{-- dataTables js --}}
    <script src="{{ asset('assets/dataTables/dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/dataTables/dataTables.bootstrap5.min.js') }}">
    </script>
    <script
      src="https://cdn.datatables.net/responsive/3.0.5/js/dataTables.responsive.min.js">
    </script>
    <script
      src="https://cdn.datatables.net/buttons/3.2.4/js/dataTables.buttons.min.js">
    </script>
    <script src="https://cdn.datatables.net/buttons/3.2.4/js/buttons.html5.min.js">
    </script>
    <script src="https://cdn.datatables.net/buttons/3.2.4/js/buttons.print.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js">
    </script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
    </script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    <script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
    <script>
      // $(document).ready(function() {
      //   $.ajaxSetup({
      //     headers: {
      //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //     }
      //   });
      // });
      $(document).ready(function() {
        $('body').on('click', '.delete-item', function(e) {
          e.preventDefault();
          let url = $(this).attr('href');
          Swal.fire({
            title: "Bạn có chắc chắn xóa không?",
            text: "Bạn sẽ không thể khôi phục lại!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Xóa",
            cancelButtonText: 'Hủy',
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                type: "POST",
                url: url,
                data: {
                  _method: 'DELETE',
                  _token: $('meta[name="csrf-token"]').attr(
                    'content')
                },
                success: function(data) {
                  if (data.status == 'success') {
                    Swal.fire({
                      title: "Đã xóa!",
                      text: data.message,
                      icon: "success"
                    });
                    window.location.reload();
                  } else if (data.status == 'error') {
                    Swal.fire({
                      title: "Không thể xóa!",
                      text: data.message,
                      icon: "error",
                    });
                  }
                }
              });
            }
          });
        })
      });
    </script>
    {{-- <script>
      $(document).ready(function() {
        $('#menu').metisMenu();
      });
    </script> --}}
    @stack('scripts')
    @yield('scripts')
  </body>

</html>
