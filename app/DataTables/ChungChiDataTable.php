<?php

namespace App\DataTables;

use App\DataTables\Traits\DefaultConfig;
use App\Models\ChungChi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ChungChiDataTable extends DataTable
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
        $btnEdit = '<a href="' . route('quan-ly.chung-chi.form-sua-chung-chi', $query->ma_cc) . '" title="Sửa chứng chỉ" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>';
        $btnDelete = '<a href="' . route('quan-ly.chung-chi.xoa-chung-chi', $query->ma_cc) . '" title="Xóa chứng chỉ" class="delete-item btn btn-outline-danger btn-sm mx-1"><i class="fa-solid fa-trash"></i></a>';
        return $btnEdit . $btnDelete;
      })
      ->addColumn('ngay_tao', function ($query) {
        return Carbon::parse($query->ngay_tao)->format('d/m/Y');
      })
      ->addColumn('ngay_cap_nhat', function ($query) {
        return Carbon::parse($query->ngay_cap_nhat)->format('d/m/Y');
      })
      ->addColumn('ngay_bat_dau', function ($query) {
        return Carbon::parse($query->ngay_bat_dau)->format('d/m/Y');
      })
      ->addColumn('ngay_ket_thuc', function ($query) {
        return Carbon::parse($query->ngay_ket_thuc)->format('d/m/Y');
      })
      ->addColumn('ngay_vao_so', function ($query) {
        return Carbon::parse($query->ngay_vao_so)->format('d/m/Y');
      })
      ->rawColumns(['action', 'ngay_tao', 'ngay_cap_nhat', 'ngay_bat_dau', 'ngay_ket_thuc', 'ngay_vao_so'])
      ->setRowId('ma_cc');
  }

  /**
   * Get query source of dataTable.
   *
   * @param \App\Models\ChungChi $model
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function query(ChungChi $model): QueryBuilder
  {
    return $model->newQuery();
  }

  /**
   * Optional method if you want to use html builder.
   *
   * @return \Yajra\DataTables\Html\Builder
   */
  public function html(): HtmlBuilder
  {
    return $this->applyDefaultHtmlConfig($this->builder(), 'chungchi-table', false)
      ->columns($this->getColumns())
      ->minifiedAjax()
      //->dom('Bfrtip')
      ->orderBy(0)
      ->responsive(true)
      ->selectStyleSingle();
  }

  /**
   * Get the dataTable columns definition.
   *
   * @return array
   */
  public function getColumns(): array
  {
    return [
      Column::make('ma_cc')->title('Mã chứng chỉ')->type('string'),
      Column::make('ten_cc')->title('Chứng chỉ'),
      Column::make('so_hieu')->title('Số hiệu'),
      Column::make('ngay_vao_so')->title('Vào sổ'),
      Column::make('so_vao_so')->title('Số vào sổ'),
      Column::make('ngay_bat_dau')->title('Bắt đầu'),
      Column::make('ngay_ket_thuc')->title('Kết thúc'),
      Column::make('ngay_tao')->title('Ngày tạo'),
      Column::make('ngay_cap_nhat')->title('Cập nhật'),
      Column::computed('action')->title('Thao tác')
        ->exportable(false)
        ->printable(false)
        ->width(100)
        ->addClass('text-center'),
    ];
  }

  /**
   * Get filename for export.
   *
   * @return string
   */
  protected function filename(): string
  {
    return 'ChungChi_' . date('YmdHis');
  }
}
