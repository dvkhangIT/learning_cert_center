@extends('layouts.master')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
  <div class="breadcrumb-title pe-3">Nhập điểm</div>
</div>

<div class="card">
  <div class="card-body">
    <form action="{{ route('nhan-vien.chung-chi.luu-nhap-diem', $chungChi->ma_cc) }}" method="POST" class="row g-3">
      @csrf
      <div class="col-12">
        <h5>{{ $chungChi->ten_cc }} — {{ $chungChi->hocVien->ten_hv ?? '' }}</h5>
      </div>

      @foreach($cacLoaiDiem as $ma => $label)
        <div class="col-md-6">
          <label class="form-label">{{ $label }}</label>
          <input type="text" name="{{ $ma }}" class="form-control @error($ma) is-invalid @enderror" value="{{ old($ma, $chungChi->ketQua->{$ma} ?? '') }}">
          @error($ma) <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      @endforeach

      <div class="col-12">
        <button class="btn btn-primary">Lưu</button>
        <a href="{{ route('nhan-vien.chung-chi.show', $chungChi->ma_cc) }}" class="btn btn-secondary">Hủy</a>
      </div>
    </form>
  </div>
</div>
@endsection
