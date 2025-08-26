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

class HocVienTrongLopDataTable extends DataTable
{
  use DefaultConfig;
  /**
   * Build DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   * @return \Yajra\DataTables\EloquentDataTable
   */
  protected $ma_lop;

  public function setMaLop($ma_lop)
  {
    $this->ma_lop = $ma_lop;
  }
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
    $ma_lop = $this->ma_lop;
    return (new EloquentDataTable($query))
      ->addColumn('action', function ($query) use ($ma_lop) {
        $btnDelete = '<a href="' . route('lop.hoc-vien.xoa', [$ma_lop, $query->ma_hv]) . '" title="Xóa học viên ra khỏi lớp" class="delete-item btn btn-outline-danger btn-sm mx-1"><i class="fa-solid fa-trash"></i></a>';
        return  $btnDelete;
      })
      ->addColumn('ngay_sinh', function ($query) {
        return \Carbon\Carbon::parse($query->ngay_sinh)->format('d/m/Y');
      })
      ->addColumn('gioi_tinh', function ($query) {
        if ($query->gioi_tinh == 'nam') {
          return 'Nam';
        } else if ($query->gioi_tinh == 'nu') {
          return "Nữ";
        }
      })
      ->rawColumns(['ngay_sinh', 'action'])
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
    return $model->whereHas('lop', function ($q) {
      $q->where('lop.ma_lop', $this->ma_lop);
    });
  }

  /**
   * Optional method if you want to use html builder.
   *
   * @return \Yajra\DataTables\Html\Builder
   */
  public function html(): HtmlBuilder
  {
    $builder = $this->applyDefaultHtmlConfig($this->builder(), 'hocvientronglop-table', true);
    return $builder
      ->columns($this->getColumns())
      ->minifiedAjax()
      //->dom('Bfrtip')
      ->orderBy(0)
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
      Column::make('ma_hv')->title('Mã học viên')->type('string')->width(150),
      Column::make('hoten_hv')->title('Họ tên'),
      Column::make('ngay_sinh')->title('Ngày sinh'),
      Column::make('noi_sinh')->title('Nơi sinh'),
      Column::make('gioi_tinh')->title('Giới tính'),
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
    return 'HocVienTrongLop_' . date('YmdHis');
  }
}
