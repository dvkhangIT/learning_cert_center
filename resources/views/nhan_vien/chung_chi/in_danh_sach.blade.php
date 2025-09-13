@extends('layouts.master')
@section('content')
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Chứng chỉ</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page">In chứng chỉ</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Mã chứng chỉ</th>
                    <th>Chứng chỉ</th>
                    <th>Số hiệu</th>
                    <th>Vào sổ</th>
                    <th>Số vào sổ</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($chungChis as $cc)
                    <tr>
                      <td>{{ $cc->ma_cc }}</td>
                      <td>{{ $cc->loaiChungChi->ten_loai_cc ?? '-' }}</td>
                      <td>{{ $cc->so_hieu }}</td>
                      <td>{{ isset($cc->ngay_vao_so) ? \Carbon\Carbon::parse($cc->ngay_vao_so)->format('d/m/Y') : '-' }}</td>
                      <td>{{ $cc->so_vao_so }}</td>
                      <td>
                        <a href="{{ route('nhan-vien.chung-chi.in', $cc->ma_cc) }}" 
                           title="In chứng chỉ" 
                           class="btn btn-custom-color btn-sm">
                          <i class="fa-solid fa-print"></i>
                        </a>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" class="text-center">Không có chứng chỉ nào đạt để in</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
