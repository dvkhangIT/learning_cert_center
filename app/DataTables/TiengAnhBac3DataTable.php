<?php

namespace App\DataTables;

use App\DataTables\Traits\DefaultConfig;
use App\Models\KetQua;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TiengAnhBac3DataTable extends DataTable
{
  use DefaultConfig;
  /**
   * Build DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   * @return \Yajra\DataTables\EloquentDataTable
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
    return (new EloquentDataTable($query))
      ->addColumn('action', function ($query) {
        $btnEdit = '<a href="' . route('quan-ly.ket-qua.form-sua-ket-qua', $query->ma_kq) . '" title="Sửa học viên" class="btn btn-custom-color btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>';
        $btnDelete = '<a href="' . route('quan-ly.ket-qua.xoa-ket-qua', $query->ma_kq) . '" title="Xóa điểm" class="delete-item btn btn-outline-danger btn-sm mx-1"><i class="fa-solid fa-trash"></i></a>';
        return $btnEdit . $btnDelete;
      })
      ->addColumn('ten_hoc_vien', function ($query) {
        return $query->hocVien->hoten_hv;
      })
      ->orderColumn('ten_hoc_vien', function ($query, $direction) {
        $query->orderBy('hoc_vien.hoten_hv', $direction);
      })
      ->addColumn('ten_chung_chi', function ($query) {
        return $query->chungChi->loaiChungChi->ten_loai_cc;
      })
      ->addColumn('ket_qua', function ($query) {
        return $query->trang_thai;
      })
      ->addColumn('ngay_tao', function ($query) {
        return Carbon::parse($query->ngay_tao)->format('d/m/Y');
      })
      ->addColumn('ngay_cap_nhat', function ($query) {
        return Carbon::parse($query->ngay_cap_nhat)->format('d/m/Y');
      })
      ->rawColumns(['action', 'ngay_tao', 'ngay_cap_nhat'])
      ->setRowId('ma_kq');
  }

  /**
   * Get query source of dataTable.
   *
   * @param \App\Models\TiengAnhBac3 $model
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function query(KetQua $model): QueryBuilder
  {
    return $model->newQuery()
      ->with('chungChi.loaiChungChi', 'hocVien')
      ->leftJoin('hoc_vien', 'ket_qua.ma_hv', '=', 'hoc_vien.ma_hv')
      ->whereHas('chungChi.loaiChungChi', function ($query) {
        $query->where('ten_loai_cc', 'Chứng nhận năng lực tiếng Anh tương đương bậc 3');
      });
  }

  /**
   * Optional method if you want to use html builder.
   *
   * @return \Yajra\DataTables\Html\Builder
   */
  public function html(): HtmlBuilder
  {
    return $this->applyDefaultHtmlConfig($this->builder(), 'tienganhbac3-table', true)
      ->columns($this->getColumns())
      ->minifiedAjax()
      //->dom('Bfrtip')
      ->orderBy(1)
      ->selectStyleSingle()
      ->buttons([
        Button::make('excel')
          ->exportOptions([
            'columns' => ':not(.no-export)'
          ])
          ->text('<i class="fa-solid fa-file-excel me-1"></i> Xuất Excel'),
        Button::make('print')
          ->exportOptions([
            'columns' => ':not(.no-export)'
          ])
          ->text('<i class="fa-solid fa-print me-1"></i> In bảng')
      ]);
  }

  /**
   * Get the dataTable columns definition.
   *
   * @return array
   */
  public function getColumns(): array
  {
    return [
      Column::make('ma_kq')->title('#')->type('string'),
      Column::computed('ten_hoc_vien')->title('Học viên')->orderable(true)->width(150),
      Column::computed('ten_chung_chi')->title('Chứng chỉ'),
      Column::make('diem_nghe')->title('Điểm nghe'),
      Column::make('diem_noi')->title('Điểm nói'),
      Column::make('diem_doc')->title('Điểm đọc'),
      Column::make('diem_viet')->title('Điểm viết'),
      Column::computed('ket_qua')->title('Kết quả')->addClass('text-center'),
      Column::make('ngay_tao')->title('Ngày tạo'),
      Column::make('ngay_cap_nhat')->title('Cập nhật'),
      Column::computed('action')->title('Thao tác')
        ->exportable(false)
        ->printable(false)
        ->width(150)
        ->addClass('text-center no-export'),
    ];
  }

  /**
   * Get filename for export.
   *
   * @return string
   */
  protected function filename(): string
  {
    return 'TiengAnhBac3_' . date('YmdHis');
  }
}
