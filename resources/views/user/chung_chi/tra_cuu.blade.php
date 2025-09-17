@extends('layouts.master')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
  <div class="breadcrumb-title pe-3">Tra cứu chứng chỉ</div>
</div>

<div class="card">
  <div class="card-body">
    <form action="{{ route('nhan-vien.chung-chi.tra-cuu') }}" method="POST" class="row g-3">
      @csrf
      <div class="col-md-4">
        <label>Số hiệu</label>
        <input type="text" name="so_hieu" class="form-control" value="{{ old('so_hieu') }}">
      </div>
      <div class="col-md-4">
        <label>Số vào sổ</label>
        <input type="text" name="so_vao_so" class="form-control" value="{{ old('so_vao_so') }}">
      </div>
      <div class="col-md-4 d-flex align-items-end">
        <button class="btn btn-primary">Tra cứu</button>
      </div>
    </form>
  </div>
</div>

@if(isset($results))
  <div class="card mt-3">
    <div class="card-body">
      @if($results->isEmpty())
        <div>Không tìm thấy chứng chỉ.</div>
      @else
        <table class="table">
          <thead><tr><th>#</th><th>Số hiệu</th><th>Số vào sổ</th><th>Học viên</th><th>Trạng thái</th><th>Thao tác</th></tr></thead>
          <tbody>
            @foreach($results as $r)
              <tr>
                <td>{{ $r->ma_cc }}</td>
                <td>{{ $r->so_hieu }}</td>
                <td>{{ $r->so_vao_so }}</td>
                <td>{{ $r->hocVien->ten_hv ?? '—' }}</td>
                <td>{{ $r->ketQua->trang_thai ?? 'Chưa xét' }}</td>
                <td>
                  <a class="btn btn-sm btn-info" href="{{ route('nhan-vien.chung-chi.show', $r->ma_cc) }}">Xem</a>
                  <a class="btn btn-sm btn-primary" href="{{ route('nhan-vien.chung-chi.form-nhap-diem', $r->ma_cc) }}">Nhập điểm</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>
  </div>
@endif
@endsection
