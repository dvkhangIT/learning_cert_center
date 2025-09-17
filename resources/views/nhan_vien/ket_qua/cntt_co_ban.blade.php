@extends('layouts.master')
@section('content')
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Chứng chỉ</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page">Chứng chỉ ứng dụng CNTT cơ bản</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="card"><div class="card-body">{{ $dataTable->table() }}</div></div>
@endsection
@push('scripts')
  {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
  <script>
    document.addEventListener('change', function (e) {
      const select = e.target.closest('.ket-qua-select');
      if (!select) return;
      const id = select.getAttribute('data-id');
      const status = select.value;
      fetch(`{{ url('nhan-vien/ket-qua') }}/${id}/cap-nhat-trang-thai`, {
        method: 'PATCH', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
        body: JSON.stringify({ trang_thai: status })
      }).then(r => r.json()).then(data => { if (data && data.status === 'success' && window.toastr) toastr.success('Cập nhật trạng thái thành công!', ' '); })
        .catch(() => { if (window.toastr) toastr.error('Cập nhật thất bại, vui lòng thử lại!', ' '); });
    });
  </script>
@endpush


