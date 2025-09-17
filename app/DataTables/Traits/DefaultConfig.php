<?php

namespace App\DataTables\Traits;

use Yajra\DataTables\Html\Builder as HtmlBuilder;

trait DefaultConfig
{
  public function applyDefaultHtmlConfig(HtmlBuilder $builder, string $tableId, $hasButtons)
  {
    $dom = $hasButtons
      ? '<"top d-flex justify-content-between mb-2"Blf>rt<"bottom d-flex justify-content-end mt-3 mb-3"ip>'
      : '<"top d-flex justify-content-between mb-2"lf>rt<"bottom d-flex justify-content-end mt-3 mb-3"ip>';
    return $builder
      ->setTableId($tableId)
      ->minifiedAjax()
      ->parameters([
        'dom' => $dom,
        // 'dom' => '<"top d-flex justify-content-between mb-2"lf>rt<"bottom d-flex justify-content-end mt-3 mb-3"ip>',
        'language' => [
          'paginate' => [
            'first' => '<i class="fas fa-angle-double-left"></i>',
            'previous' => '<i class="fas fa-angle-left"></i>',
            'next' => '<i class="fas fa-angle-right"></i>',
            'last' => '<i class="fas fa-angle-double-right"></i>',
          ],
          'search' => 'Tìm kiếm',
          'lengthMenu' => '',
          'zeroRecords' => 'Không tìm thấy kết quả',
          'info' => '',
          'infoEmpty' => '',
          'infoFiltered' => '',
          'emptyTable' => "Không có dữ liệu",
        ],
      ])
      ->setTableAttribute('class', 'table table-bordered table-striped');
  }
}
