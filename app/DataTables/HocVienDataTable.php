<?php

namespace App\DataTables;

use App\DataTables\Traits\DefaultConfig;
use App\Models\HocVien;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class HocVienDataTable extends DataTable
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
        $btnEdit = '<a href="' . route('admin.account.edit', $query->ma_hv) . '" title="Sửa tài khoản" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>';
        $btnDelete = '<a href="' . route('admin.account.destroy', $query->ma_hv) . '" title="Xóa tài khoản" class="delete-item btn btn-outline-danger btn-sm mx-1"><i class="fa-solid fa-trash"></i></a>';
        $btnReset = '<a href="' . route('admin.account.reset-password', $query->ma_hv) . '" title="Khôi phục mật khẩu" class="reset-password btn btn-outline-success btn-sm"><i class="fa-solid fa-arrow-rotate-right"></i></a>';
        return $btnEdit . $btnDelete . $btnReset;
      })
      ->addColumn('lop', function ($query) {
        return $query->lop->map(function ($lop) {
          return '<span class="badge bg-success me-1">' . $lop->ten_lop . '</span>';
        })->implode(' ');
      })
      ->addColumn('ngay_tao', function ($query) {
        return \Carbon\Carbon::parse($query->ngay_tao)->format('d/m/Y');
      })
      ->addColumn('ngay_cap_nhat', function ($query) {
        return \Carbon\Carbon::parse($query->ngay_cap_nhat)->format('d/m/Y');
      })
      ->addColumn('ngay_sinh', function ($query) {
        return \Carbon\Carbon::parse($query->ngay_sinh)->format('d/m/Y');
      })
      ->rawColumns(['lop', 'action', 'ngay_tao', 'ngay_cap_nhat', 'ngay_sinh'])
      ->setRowId('ma_hv');
  }

  /**
   * Get query source of dataTable.
   *
   * @param \App\Models\HocVien $model
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function query(HocVien $model): QueryBuilder
  {
    return $model->with('lop')->newQuery();
  }

  /**
   * Optional method if you want to use html builder.
   *
   * @return \Yajra\DataTables\Html\Builder
   */
  public function html(): HtmlBuilder
  {
    $builder = $this->applyDefaultHtmlConfig($this->builder(), 'hocvien-table', true);
    return $builder
      ->columns($this->getColumns())
      ->minifiedAjax()
      ->orderBy(0)
      ->selectStyleSingle()
      ->buttons([
        Button::make('excel')
          ->exportOptions([
            'columns' => ':not(.no-export)'
          ])
          ->text('<i class="fa-solid fa-file-excel me-1"></i> Xuất Excel'),
        Button::make('print')
          // ->text('In bảng')
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
      Column::make('ma_hv')->title('#')->type('string'),
      Column::make('hoten_hv')->title('Họ tên'),
      Column::make('lop')->title('Lớp'),
      Column::make('ngay_sinh')->title('Ngày sinh'),
      Column::make('noi_sinh')->title('Nơi sinh'),
      Column::make('gioi_tinh')->title('Giới tính'),
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
    return 'HocVien_' . date('YmdHis');
  }
}
