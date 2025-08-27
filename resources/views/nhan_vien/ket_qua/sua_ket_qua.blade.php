@extends('layouts.master')
@section('content')
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Chứng chỉ</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            {{ $ketQua->chungChi->loaiChungChi->ten_loai_cc }}
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-8 mx-auto">
      <div class="card">
        <div class="card-body p-4">
          <form action="{{ route('nhan-vien.ket-qua.sua-ket-qua', $ketQua->ma_kq) }}" class="row g-3 needs-validation" method="POST">
            @csrf
            @method('PUT')
            @foreach ($cacLoaiDiem as $maDiem => $tenDiem)
              <div class="col-md-6 mb-3">
                <label for="{{ $maDiem }}" class="form-label">{{ $tenDiem }}</label>
                <input type="text" id="{{ $maDiem }}" name="{{ $maDiem }}" class="form-control @error($maDiem) is-invalid @enderror" value="{{ old($maDiem, $ketQua->$maDiem) }}">
                @error($maDiem)
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            @endforeach
            <div class="col-md-12">
              <div class="d-md-flex d-grid align-items-center gap-3">
                <button id="submit-btn" type="submit" class="btn btn-primary px-4">Lưu</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

