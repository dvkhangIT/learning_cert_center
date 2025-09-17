@extends('layouts.master')
@section('content')
  <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Chứng chỉ</div>
    <div class="ps-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
      </nav>
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
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
  <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
  {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
  <script>
    document.addEventListener('click', function (e) {
      const btn = e.target.closest('.update-status');
      if (!btn) return;
      const id = btn.getAttribute('data-id');
      const status = btn.getAttribute('data-status');
      fetch(`{{ url('nhan-vien/ket-qua') }}/${id}/cap-nhat-trang-thai`, {
        method: 'PATCH',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json'
        },
        body: JSON.stringify({ trang_thai: status })
      }).then(r => r.json()).then(data => {
        if (data.status === 'success') {
          window.LaravelDataTables['tienganhctut-table']?.ajax?.reload();
        }
      });
    });
  </script>
@endpush


