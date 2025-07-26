<?php

namespace App\DataTables;

use App\DataTables\Traits\DefaultConfig;
use App\Models\TaiKhoan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TaiKhoanDataTable extends DataTable
{
  use DefaultConfig;
  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
    return (new EloquentDataTable($query))
      ->addColumn('action', 'taikhoan.action')
      ->setRowId('id');
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(TaiKhoan $model): QueryBuilder
  {
    return $model->newQuery();
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    $builder = $this->applyDefaultHtmlConfig($this->builder(), 'taikhoan-table', false);
    return $builder
      ->columns($this->getColumns())
      ->orderBy(0)
      // ->dom('Bfrtip')
      ->selectStyleSingle()
      ->buttons([
        Button::make('excel')
          ->text('Xuất Excel'),
        Button::make('csv')
          ->text('Tải CSV'),
        Button::make('pdf')
          ->text('Xuất PDF'),
        Button::make('print')
          ->text('In bảng'),
      ]);
  }

  /**
   * Get the dataTable columns definition.
   */
  public function getColumns(): array
  {
    return [
      Column::make('ma_tk')->title('Mã TK')->addClass('text-center'),
      Column::make('ho_ten')->title('Họ tên'),
      Column::make('email')->title('Email'),
      Column::make('vai_tro')->title('Vai trò')->addClass('text-center'),
      Column::make('trang_thai')->title('Trạng thái')->addClass('text-center'),
      Column::computed('action')
        ->title('Hành động')
        ->exportable(false)
        ->printable(false)
        ->width(60)
        ->addClass('text-center'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'TaiKhoan_' . date('YmdHis');
  }
}
