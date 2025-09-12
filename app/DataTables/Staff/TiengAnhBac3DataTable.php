<?php

namespace App\DataTables\Staff;

use App\DataTables\Traits\DefaultConfig;
use App\Models\ChungChi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TiengAnhBac3DataTable extends DataTable
{
  use DefaultConfig;

  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
    return (new EloquentDataTable($query))
      ->addColumn('action', function ($query) {
        $btnEdit = '<a href="' . route('nhan-vien.ket-qua.form-sua-ket-qua', $query->ma_cc) . '" title="Nhập điểm" class="btn btn-custom-color btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>';
        return $btnEdit;
      })
      ->editColumn('ket_qua', function ($query) {
        return $query->trang_thai ?? 'Chưa xét';
      })
      ->addColumn('ten_hoc_vien', function ($query) { return $query->hocVien->hoten_hv . ' (' . $query->hocVien->ma_hv . ')'; })
      ->orderColumn('ten_hoc_vien', function ($query, $direction) { $query->orderBy('hoc_vien.hoten_hv', $direction); })
      ->addColumn('ma_chung_chi', function ($query) { return $query->ma_cc; })
      ->addColumn('ngay_tao', function ($query) {
        return $query->ket_qua_ngay_tao ? Carbon::parse($query->ket_qua_ngay_tao)->format('d/m/Y') : '-';
      })
      ->addColumn('ngay_cap_nhat', function ($query) {
        return $query->ket_qua_ngay_cap_nhat ? Carbon::parse($query->ket_qua_ngay_cap_nhat)->format('d/m/Y') : '-';
      })
      ->rawColumns(['action'])
      ->setRowId('ma_cc');
  }

  public function query(ChungChi $model): QueryBuilder
  {
    return $model->newQuery()
      ->with('loaiChungChi', 'hocVien', 'ketQua')
      ->leftJoin('hoc_vien', 'chung_chi.ma_hv', '=', 'hoc_vien.ma_hv')
      ->leftJoin('ket_qua', 'chung_chi.ma_cc', '=', 'ket_qua.ma_cc')
      ->where('chung_chi.ma_loai_cc', 2)
      ->orderBy('chung_chi.ma_cc', 'asc')
      ->select('chung_chi.*', 'ket_qua.diem_nghe', 'ket_qua.diem_noi', 'ket_qua.diem_doc', 'ket_qua.diem_viet', 'ket_qua.trang_thai', 'ket_qua.ma_kq', 'ket_qua.ngay_tao as ket_qua_ngay_tao', 'ket_qua.ngay_cap_nhat as ket_qua_ngay_cap_nhat');
  }

  public function html(): HtmlBuilder
  {
    return $this->applyDefaultHtmlConfig($this->builder(), 'tienganhbac3-staff-table', true)
      ->columns($this->getColumns())
      ->minifiedAjax()
      ->orderBy(1)
      ->selectStyleSingle()
      ->buttons([
        Button::make('excel')->exportOptions(['columns' => ':not(.no-export)'])->text('<i class="fa-solid fa-file-excel me-1"></i> Xuất Excel'),
        Button::make('print')->exportOptions(['columns' => ':not(.no-export)'])->text('<i class="fa-solid fa-print me-1"></i> In bảng')
      ]);
  }

  public function getColumns(): array
  {
    return [
      Column::make('ma_cc')->title('#')->type('string'),
      Column::computed('ten_hoc_vien')->title('Học viên/Mã học viên')->orderable(true),
      Column::computed('ma_chung_chi')->title('Mã chứng chỉ'),
      Column::make('diem_nghe')->title('Nghe'),
      Column::make('diem_noi')->title('Nói'),
      Column::make('diem_doc')->title('Đọc'),
      Column::make('diem_viet')->title('Viết'),
      Column::computed('ket_qua')->title('Kết quả')->addClass('text-center'),
      Column::computed('ngay_tao')->title('Ngày tạo'),
      Column::computed('ngay_cap_nhat')->title('Cập nhật'),
      Column::computed('action')->title('Thao tác')->exportable(false)->printable(false)->width(150)->addClass('text-center no-export'),
    ];
  }

  protected function filename(): string { return 'TiengAnhBac3Staff_' . date('YmdHis'); }
}


