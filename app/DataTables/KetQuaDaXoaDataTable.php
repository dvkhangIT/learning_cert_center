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

class KetQuaDaXoaDataTable extends DataTable
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
        $restoreUrl = route('quan-ly.ket-qua.khoi-phuc-ket-qua', $query->ma_kq);
        // Dùng helper function để tạo HTML cho các thẻ input ẩn
        $csrfField = csrf_field();
        $methodField = method_field('PATCH');
        // Tạo chuỗi HTML hoàn chỉnh
        $btnRestore = '
                <form action="' . $restoreUrl . '" method="POST" class="d-inline">
                    ' . $csrfField . '
                    ' . $methodField . '
                    <button type="submit" title="Khôi phục" class="btn btn-outline-success btn-sm mx-1">
                        <i class="fa-solid fa-arrow-rotate-right"></i>
                    </button>
                </form>';
        return $btnRestore;
      })
      ->addColumn('ten_hoc_vien', function ($query) {
        return $query->hocVien->hoten_hv;
      })
      ->orderColumn('ten_hoc_vien', function ($query, $direction) {
        $query->orderBy('hoc_vien.hoten_hv', $direction);
      })
      ->addColumn('ten_chung_chi', function ($query) {
        return $query->chungChi->ten_cc;
      })
      ->addColumn('ket_qua', function ($query) {
        return $query->trang_thai;
      })
      ->addColumn('ngay_xoa', function ($query) {
        return Carbon::parse($query->ngay_xoa)->format('d/m/Y');
      })
      ->rawColumns(['action', 'ngay_tao', 'ngay_cap_nhat'])
      ->setRowId('ma_kq');
  }

  /**
   * Get query source of dataTable.
   *
   * @param \App\Models\KetQuaDaXoa $model
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public function query(KetQua $model): QueryBuilder
  {
    return $model->newQuery()->onlyTrashed()
      ->with('chungChi.loaiChungChi', 'hocVien')
      ->leftJoin('hoc_vien', 'ket_qua.ma_hv', '=', 'hoc_vien.ma_hv');
  }

  /**
   * Optional method if you want to use html builder.
   *
   * @return \Yajra\DataTables\Html\Builder
   */
  public function html(): HtmlBuilder
  {
    return $this->applyDefaultHtmlConfig($this->builder(), 'ketquadaxoa-table', true)
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
      Column::computed('ten_hoc_vien')->title('Học viên')->orderable(true)->width(200),
      Column::computed('ten_chung_chi')->title('Chứng chỉ'),
      Column::make('diem_nghe')->title('Điểm nghe'),
      Column::make('diem_doc')->title('Điểm đọc'),
      Column::make('diem_noi')->title('Điểm nói'),
      Column::make('diem_viet')->title('Điểm viết'),
      Column::make('diem_tu_vung')->title('Điểm từ vựng'),
      Column::make('diem_ngu_phap_doc')->title('Điểm ngữ pháp - Đọc'),
      Column::make('diem_trac_nghiem')->title('Điểm trắc nghiệm'),
      Column::make('diem_thuc_hanh')->title('Điểm thực hành'),
      Column::computed('ket_qua')->title('Kết quả')->addClass('text-center'),
      Column::make('ngay_xoa')->title('Ngày xóa'),
      Column::computed('action')->title('Thao tác')
        ->exportable(false)
        ->printable(false)
        ->width(50)
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
    return 'KetQuaDaXoa_' . date('YmdHis');
  }
}
