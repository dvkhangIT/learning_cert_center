@extends('layouts.master')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
  <div class="breadcrumb-title pe-3">Chi tiết chứng chỉ</div>
</div>

<div class="card">
  <div class="card-body">
    <h4>{{ $chungChi->ten_cc }}</h4>
    <p>Số hiệu: {{ $chungChi->so_hieu }} | Số vào sổ: {{ $chungChi->so_vao_so }}</p>
    <p>Học viên: {{ $chungChi->hocVien->ten_hv ?? '—' }}</p>
    <p>Trạng thái: {{ $chungChi->ketQua->trang_thai ?? 'Chưa xét' }}</p>

    <div class="mt-3">
      <a class="btn btn-primary" href="{{ route('nhan-vien.chung-chi.form-nhap-diem', $chungChi->ma_cc) }}">Nhập/Sửa điểm</a>
      <a class="btn btn-success" href="{{ route('nhan-vien.chung-chi.in-pdf', $chungChi->ma_cc) }}">In chứng chỉ</a>
    </div>
  </div>
</div>
@endsection
