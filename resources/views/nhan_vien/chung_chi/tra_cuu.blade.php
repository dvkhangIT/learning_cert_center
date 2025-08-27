@extends('layouts.master')
@section('content')
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Chứng chỉ</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page">Tra cứu chứng chỉ</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <form action="{{ url('nhan-vien/chung-chi/tra-cuu') }}" method="get" class="row g-3 align-items-end">
        <div class="col-md-3">
          <label class="form-label">Số hiệu chứng chỉ</label>
          <input type="text" name="so_hieu" class="form-control" value="{{ request('so_hieu') }}">
        </div>
        <div class="col-md-3">
          <label class="form-label">Số vào sổ</label>
          <input type="text" name="so_vao_so" class="form-control" value="{{ request('so_vao_so') }}">
        </div>
        <div class="col-md-3">
          <button class="btn btn-primary">Tìm kiếm</button>
        </div>
      </form>
    </div>
  </div>

  @if(!empty($results))
    @foreach($results as $cc)
      <div class="card mb-3">
        <div class="card-body">
          <div class="row g-3 align-items-center">
            <div class="col-md-3"><strong>Học viên:</strong> {{ $cc->hocVien->hoten_hv ?? '-' }}</div>
            <div class="col-md-3"><strong>Tên chứng chỉ:</strong> {{ $cc->ten_cc }}</div>
            <div class="col-md-2"><strong>Số hiệu:</strong> {{ $cc->so_hieu }}</div>
            <div class="col-md-2"><strong>Số vào sổ:</strong> {{ $cc->so_vao_so }}</div>
            <div class="col-md-2"><strong>Loại chứng chỉ:</strong> {{ $cc->loaiChungChi->ten_loai_cc ?? '-' }}</div>
            {{-- <div class="col-md-2"><strong>Ngày bắt đầu:</strong> {{ isset($cc->ngay_bat_dau) ? \Carbon\Carbon::parse($cc->ngay_bat_dau)->format('d/m/Y') : '-' }}</div>
            <div class="col-md-2"><strong>Ngày kết thúc:</strong> {{ isset($cc->ngay_ket_thuc) ? \Carbon\Carbon::parse($cc->ngay_ket_thuc)->format('d/m/Y') : '-' }}</div>
            <div class="col-md-2"><strong>Ngày tạo:</strong> {{ isset($cc->ngay_tao) ? \Carbon\Carbon::parse($cc->ngay_tao)->format('d/m/Y') : '-' }}</div> --}}
            <div class="col-md-2"><strong>Ngày cập nhật:</strong> {{ isset($cc->ngay_cap_nhat) ? \Carbon\Carbon::parse($cc->ngay_cap_nhat)->format('d/m/Y') : '-' }}</div>
            <div class="col-md-2"><strong>Kết quả hiện tại:</strong> {{ $cc->ketQua->trang_thai ?? 'Chưa xét' }}</div>
          </div>
        </div>
      </div>
    @endforeach
  @endif
@endsection

@push('scripts')
  <script>
    @if(isset($results))
      @if($results->count() > 0)
        if (window.toastr) toastr.success('Tìm thấy {{ $results->count() }} kết quả phù hợp.', ' ');
      @else
        if (window.toastr) toastr.warning('Không tìm thấy kết quả phù hợp. Vui lòng kiểm tra lại thông tin.', ' ');
      @endif
    @endif
  </script>
@endpush


