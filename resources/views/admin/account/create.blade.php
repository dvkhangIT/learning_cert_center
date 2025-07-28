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
          <li class="breadcrumb-item active" aria-current="page">Tạo tài khoản
          </li>
        </ol>
      </nav>
    </div>
    <div class="ms-auto">
      <a class="btn btn-outline-primary"
        href="{{ route('admin.account.index') }}">
        <i class="fa-solid fa-arrow-left"></i>
      </a>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-6 mx-auto">
      <div class="card">
        <div class="card-body p-4">
          <form id="create-user-form" action="{{ route('admin.account.store') }}"
            class="create-user-form row g-3 needs-validation" method="POST">
            @csrf
            <div class="col-md-12">
              <label for="input3" class="form-label">Họ và tên</label>
              <input type="text" value="{{ old('ho_ten') }}"
                class="form-control @error('ho_ten')
                  is-invalid
              @enderror"
                name="ho_ten" id="input3">
              @error('ho_ten')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="col-md-12">
              <label for="input4" class="form-label">Email</label>
              <input type="email"
                class="form-control @error('email')
                    is-invalid
              @enderror"
                id="input4" name="email" value="{{ old('email') }}">
              @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="col-md-12">
              <div class="d-md-flex d-grid align-items-center gap-3">
                <button id="submit-btn" type="submit"
                  class="btn btn-primary px-4">Lưu</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.getElementById('create-user-form').addEventListener('submit',
      function() {
        document.getElementById('submit-btn').disabled = true;
        document.getElementById('submit-btn').innerText = 'Đang xử lý...';
      });
  </script>
@endsection
@push('scripts')
  <link rel="stylesheet"
    href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
  <script
    src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js">
  </script>
@endpush
