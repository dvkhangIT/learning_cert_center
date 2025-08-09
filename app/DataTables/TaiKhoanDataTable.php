<?php

namespace App\DataTables;

use App\DataTables\Traits\DefaultConfig;
use App\Models\TaiKhoan;
use Carbon\Carbon;
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
      ->addColumn('action', function ($query) {
        $btnEdit = '<a href="' . route('quan-ly.tai-khoan.sua-tai-khoan', $query->ma_tk) . '" title="Sửa tài khoản" class="btn btn-custom-color btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>';
        $btnDelete = '<a href="' . route('quan-ly.tai-khoan.xoa-tai-khoan', $query->ma_tk) . '" title="Xóa tài khoản" class="delete-item btn btn-outline-danger btn-sm mx-1"><i class="fa-solid fa-trash"></i></a>';
        $btnReset = '<a href="' . route('quan-ly.tai-khoan.khoi-phuc-mat-khau-tai-khoan', $query->ma_tk) . '" title="Khôi phục mật khẩu" class="reset-password btn btn-outline-success btn-sm"><i class="fa-solid fa-arrow-rotate-right"></i></a>';
        return $btnEdit . $btnDelete . $btnReset;
      })
      ->addColumn('trang_thai', function ($query) {
        if ($query->trang_thai == 1) {
          return '<div class="form-check form-switch d-flex justify-content-center align-items-center">
          <input data-id="' . $query->ma_tk . '" class="change-status form-check-input" checked type="checkbox" role="switch" id="flexSwitchCheckDefault1">
          </div>';
        } else {
          return '<div class="form-check form-switch d-flex justify-content-center align-items-center">
          <input data-id="' . $query->ma_tk . '" class="change-status form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault1">
          </div>';
        }
      })
      ->addColumn('ngay_tao', function ($query) {
        return Carbon::parse($query->ngay_tao)->format('d/m/Y');
      })
      ->addColumn('ngay_cap_nhat', function ($query) {
        return Carbon::parse($query->ngay_cap_nhat)->format('d/m/Y');
      })
      ->rawColumns(['trang_thai', 'action', 'ngay_tao', 'ngay_cap_nhat'])
      ->setRowId('id');
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(TaiKhoan $model): QueryBuilder
  {
    return $model->where('vai_tro', 'nhanvien')->newQuery();
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
      ->responsive(true) //
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
      Column::make('ma_tk')->title('#')->addClass('text-center')->width(50),
      Column::make('ho_ten')->title('Họ tên'),
      Column::make('email')->title('Email'),
      Column::make('vai_tro')->title('Vai trò')->addClass('text-center'),
      Column::make('trang_thai')->title('Trạng thái')->addClass('text-center')->width(150),
      Column::make('ngay_tao')->title('Ngày tạo'),
      Column::make('ngay_cap_nhat')->title('Ngày sửa'),
      Column::computed('action')
        ->title('Thao tác')
        ->exportable(false)
        ->printable(false)
        ->width(200)
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
