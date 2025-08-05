<?php

namespace App\DataTables;

use App\DataTables\Traits\DefaultConfig;
use App\Models\Lop;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LopDataTable extends DataTable
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
        // $btnEdit = '<a href="' . route('admin.class.edit', $query->ma_lop) . '" title="Sửa tài khoản" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>';
        // $btnDelete = '<a href="' . route('admin.class.destroy', $query->ma_lop) . '" title="Xóa tài khoản" class="delete-item btn btn-outline-danger btn-sm mx-1"><i class="fa-solid fa-trash"></i></a>';
        $btnMore = '<div class="dropdown">
											<button class="btn-outline-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false">•••</button>
											<ul class="dropdown-menu">
												<li><a class="dropdown-item btn" href="' . route('admin.class.edit', $query->ma_lop) . '">Sửa thông tin lớp</a>
												</li>
												<li><a class="delete-item dropdown-item btn" href="' . route('admin.class.destroy', $query->ma_lop) . '" >Xóa lớp</a>
												</li>
												<li><a data-bs-toggle="modal"
                        data-bs-target="#themHocVienModal"
                        data-ma-lop="' . $query->ma_lop . '" class="btn dropdown-item">Thêm học viên</a>
												</li>
											</ul>
										</div>';
        return $btnMore;
      })
      ->addColumn('ngay_tao', function ($query) {
        return \Carbon\Carbon::parse($query->ngay_tao)->format('d/m/Y');
      })
      ->addColumn('ngay_cap_nhat', function ($query) {
        return \Carbon\Carbon::parse($query->ngay_cap_nhat)->format('d/m/Y');
      })
      ->addColumn('ngay_bat_dau', function ($query) {
        return \Carbon\Carbon::parse($query->ngay_bat_dau)->format('d/m/Y');
      })
      ->addColumn('ngay_ket_thuc', function ($query) {
        return \Carbon\Carbon::parse($query->ngay_ket_thuc)->format('d/m/Y');
      })
      ->addColumn('ma_kh', function ($query) {
        return $query->khoaHoc->ten_kh;
      })
      ->filterColumn('ma_kh', function ($query, $keyword) {
        $query->whereHas('khoaHoc', function ($q) use ($keyword) {
          $q->where('ten_kh', 'like', "%{$keyword}%");
        });
      })
      ->rawColumns(['ngay_tao', 'ngay_cap_nhat', 'action', 'ngay_bat_dau', 'ngay_ket_thuc', 'ten_kh'])
      ->setRowId('id');
  }

  /**
   * Get query source of dataTable.
   *
   * @param \App\Models\Lop $model
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function query(Lop $model): QueryBuilder
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
    $builder = $this->applyDefaultHtmlConfig($this->builder(), 'lop-table', true);
    return $builder
      ->columns($this->getColumns())
      ->minifiedAjax()
      ->orderBy(0)
      ->responsive(true) //
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
      Column::make('ma_lop')->title('#')->type('string'),
      Column::make('ten_lop')->title('Lớp'),
      Column::make('ma_kh')->title('Khóa học')->searchable(true)->orderable(true),
      Column::make('ngay_bat_dau')->title('Bắt đầu'),
      Column::make('ngay_ket_thuc')->title('Kết thúc'),
      Column::make('ngay_tao')->title('Ngày tạo'),
      Column::make('ngay_cap_nhat')->title('Cập nhật'),
      Column::computed('action')->title('Thao tác')
        ->exportable(false)
        ->printable(false)
        ->width(100)
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
    return 'Lop_' . date('YmdHis');
  }
}
