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
      <a class="btn btn-outline-primary" href="#"><i
          class="fa-solid fa-plus"></i>Tạo tài
        khoản</a>
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
@endsection
@push('scripts')
  <link rel="stylesheet"
    href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
  <script
    src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js">
  </script>
  <script src="/vendor/datatables/buttons.server-side.js"></script>
  {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
