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
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      
      <form action="{{ route('nhan-vien.chung-chi.tra-cuu.post') }}" method="post" class="row g-3 align-items-end">
        @csrf
        <div class="col-md-3">
          <label class="form-label">Số hiệu chứng chỉ</label>
          <input type="text" name="so_hieu" class="form-control @error('so_hieu') is-invalid @enderror" 
                 value="{{ old('so_hieu', request('so_hieu')) }}" 
                 >
        </div>
        <div class="col-md-3">
          <label class="form-label">Số vào sổ</label>
          <input type="text" name="so_vao_so" class="form-control @error('so_vao_so') is-invalid @enderror" 
                 value="{{ old('so_vao_so', request('so_vao_so')) }}" 
                 >
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
          <div class="row g-3 align-items-start">
            <div class="col-md-3"><strong>Loại chứng chỉ:</strong> {{ $cc->loaiChungChi->ten_loai_cc ?? '-' }}</div>
            <div class="col-md-3"><strong>Học viên:</strong> {{ $cc->hocVien->hoten_hv ?? '-' }}</div>
            <div class="col-md-2"><strong>Số hiệu:</strong> {{ $cc->so_hieu }}</div>
            <div class="col-md-2"><strong>Số vào sổ:</strong> {{ $cc->so_vao_so }}</div>
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


