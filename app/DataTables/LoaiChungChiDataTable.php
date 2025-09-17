<?php

namespace App\DataTables;

use App\DataTables\Traits\DefaultConfig;
use App\Models\LoaiChungChi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LoaiChungChiDataTable extends DataTable
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
        $btnEdit = '<a href="' . route('quan-ly.loai-chung-chi.form-sua-loai-chung-chi', $query->ma_loai_cc) . '" title="Sửa chứng chỉ" class="btn btn-custom-color btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>';
        $btnDelete = '<a href="' . route('quan-ly.loai-chung-chi.xoa-loai-chung-chi', $query->ma_loai_cc) . '" title="Xóa chứng chỉ" class="delete-item btn btn-outline-danger btn-sm mx-1"><i class="fa-solid fa-trash"></i></a>';
        return $btnEdit . $btnDelete;
      })
      ->addColumn('ngay_tao', function ($query) {
        return Carbon::parse($query->ngay_tao)->format('d/m/Y');
      })
      ->addColumn('ngay_cap_nhat', function ($query) {
        return Carbon::parse($query->ngay_cap_nhat)->format('d/m/Y');
      })
      ->addColumn('cau_hinh_diem', function ($query) {
        $html = '';

        // map mã -> tên hiển thị
        $map = [
          'diem_nghe' => 'Nghe',
          'diem_noi' => 'Nói',
          'diem_doc' => 'Đọc',
          'diem_viet' => 'Viết',
          'diem_tu_vung' => 'Từ vựng',
          'diem_ngu_phap_doc' => 'Ngữ pháp (đọc)',
          'diem_trac_nghiem' => 'Trắc nghiệm',
          'diem_thuc_hanh' => 'Thực hành',
        ];
        if (!empty($query->cau_hinh_diem)) {
          foreach ($query->cau_hinh_diem as $field) {
            $ten = $map[$field] ?? $field;
            $html .= '<span class="badge bg-success me-1">' . e($ten) . '</span>';
          }
        }
        return $html;
      })

      ->rawColumns(['action', 'ngay_tao', 'ngay_cap_nhat', 'cau_hinh_diem'])
      ->setRowId('ma_loai_cc');
  }

  /**
   * Get query source of dataTable.
   *
   * @param \App\Models\LoaiChungChi $model
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function query(LoaiChungChi $model): QueryBuilder
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

    return $this->applyDefaultHtmlConfig($this->builder(), 'loaichungchi-table', false)
      ->columns($this->getColumns())
      ->minifiedAjax()
      //->dom('Bfrtip')
      ->orderBy(0)
      ->selectStyleSingle()
      ->buttons([
        // Button::make('excel'),
        // Button::make('csv'),
        // Button::make('pdf'),
        // Button::make('print'),
        // Button::make('reload')
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

      Column::make('ma_loai_cc')->title('#'),
      Column::make('ten_loai_cc')->title('Loại chứng chỉ'),
      Column::make('cau_hinh_diem')->title('Cấu hình điểm'),
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
    return 'LoaiChungChi_' . date('YmdHis');
  }
}
