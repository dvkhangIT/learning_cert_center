<?php

namespace App\DataTables;

use App\DataTables\Traits\DefaultConfig;
use App\Models\KhoaHoc;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KhoaHocDataTable extends DataTable
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
        $btnEdit = '<a href="' . route('admin.course.update', $query->ma_kh) . '" title="Sửa tài khóa học" data-bs-toggle="modal"
        data-bs-target="#editCourse" data-name="' . $query->ten_kh . '" class="edit-item btn btn-outline-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>';
        $btnDelete = '<a href="' . route('admin.account.destroy', $query->ma_kh) . '" title="Xóa tài khoản" class="delete-item btn btn-outline-danger btn-sm mx-1"><i class="fa-solid fa-trash"></i></a>';
        return $btnEdit . $btnDelete;
      })
      ->addColumn('ngay_tao', function ($query) {
        return \Carbon\Carbon::parse($query->ngay_tao)->format('d/m/Y');
      })
      ->addColumn('ngay_cap_nhat', function ($query) {
        return \Carbon\Carbon::parse($query->ngay_cap_nhat)->format('d/m/Y');
      })
      ->addColumn('ma_tk', function ($query) {
        return $query->taikhoan->ho_ten;
      })
      ->rawColumns(['action', 'ngay_tao', 'ngay_cap_nhat', 'ma_tk'])
      ->setRowId('id');
  }

  /**
   * Get query source of dataTable.
   *
   * @param \App\Models\KhoaHoc $model
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function query(KhoaHoc $model): QueryBuilder
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
    $builder = $this->applyDefaultHtmlConfig($this->builder(), 'khoahoc-table', true);
    return $builder
      ->columns($this->getColumns())
      ->minifiedAjax()
      ->orderBy(0)
      ->selectStyleSingle()
      ->buttons([
        Button::make('excel')
          ->text('Xuất Excel')
          ->exportOptions([
            'columns' => ':not(.no-export)'
          ]),
        Button::make('print')
          ->text('In bảng')
          ->exportOptions([
            'columns' => ':not(.no-export)'
          ]),
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

      Column::make('ma_kh')->title('#')->type('string'),
      Column::make('ten_kh')->title('Khóa học'),
      Column::computed('ma_tk')->title('Người tạo'),
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
    return 'KhoaHoc_' . date('YmdHis');
  }
}
