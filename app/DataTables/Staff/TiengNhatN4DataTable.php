<?php

namespace App\DataTables\Staff;

use App\DataTables\Traits\DefaultConfig;
use App\Models\KetQua;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TiengNhatN4DataTable extends DataTable
{
  use DefaultConfig;

  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
    return (new EloquentDataTable($query))
      ->addColumn('action', function ($query) {
        $btnEdit = '<a href="' . route('nhan-vien.ket-qua.form-sua-ket-qua', $query->ma_kq) . '" title="Nhập điểm" class="btn btn-custom-color btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>';
        return $btnEdit;
      })
      ->editColumn('ket_qua', function ($query) {
        return $query->trang_thai ?? 'Chưa xét';
      })
      ->addColumn('ten_hoc_vien', function ($query) { return $query->hocVien->hoten_hv; })
      ->orderColumn('ten_hoc_vien', function ($query, $direction) { $query->orderBy('hoc_vien.hoten_hv', $direction); })
      ->addColumn('ten_chung_chi', function ($query) { return $query->chungChi->ten_cc; })
      ->addColumn('ngay_tao', function ($query) { return Carbon::parse($query->ngay_tao)->format('d/m/Y'); })
      ->addColumn('ngay_cap_nhat', function ($query) { return Carbon::parse($query->ngay_cap_nhat)->format('d/m/Y'); })
      ->rawColumns(['action', 'ngay_tao', 'ngay_cap_nhat'])
      ->setRowId('ma_kq');
  }

  public function query(KetQua $model): QueryBuilder
  {
    return $model->newQuery()
      ->with('chungChi.loaiChungChi', 'hocVien')
      ->leftJoin('hoc_vien', 'ket_qua.ma_hv', '=', 'hoc_vien.ma_hv')
      ->whereHas('chungChi.loaiChungChi', function ($query) {
        $query->where('ten_loai_cc', 'Chứng nhận năng lực tiếng Nhật tương đương N4');
      });
  }

  public function html(): HtmlBuilder
  {
    return $this->applyDefaultHtmlConfig($this->builder(), 'tiengnhatn4-staff-table', true)
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
      Column::make('ma_kq')->title('#')->type('string'),
      Column::computed('ten_hoc_vien')->title('Học viên')->orderable(true),
      Column::computed('ten_chung_chi')->title('Chứng chỉ'),
      Column::make('diem_tu_vung')->title('Từ vựng'),
      Column::make('diem_ngu_phap_doc')->title('Ngữ pháp - Đọc'),
      Column::make('diem_nghe')->title('Nghe'),
      Column::computed('ket_qua')->title('Kết quả')->addClass('text-center'),
      Column::make('ngay_tao')->title('Ngày tạo'),
      Column::make('ngay_cap_nhat')->title('Cập nhật'),
      Column::computed('action')->title('Thao tác')->exportable(false)->printable(false)->width(150)->addClass('text-center no-export'),
    ];
  }

  protected function filename(): string { return 'TiengNhatN4Staff_' . date('YmdHis'); }
}


