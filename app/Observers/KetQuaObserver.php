<?php

namespace App\Observers;

use App\Models\KetQua;

class KetQuaObserver
{

  public function saving(KetQua $ketQua): void
  {
    $loaiChungChi = $ketQua->chungChi?->loaiChungChi;

    if (!$loaiChungChi) {
      $ketQua->trang_thai = 'Chưa xét';
      return;
    }

    switch ($loaiChungChi->ten_loai_cc) {
      case 'Chứng nhận năng lực tiếng Anh CTUT':
        $ketQua->trang_thai = $this->kiemTraDiem($ketQua, ['diem_nghe', 'diem_doc'], 225);
        break;

      case 'Chứng nhận năng lực tiếng Anh tương đương bậc 3':
        $ketQua->trang_thai = $this->kiemTraDiem($ketQua, ['diem_nghe', 'diem_noi', 'diem_doc', 'diem_viet'], 5);
        break;

      case 'Chứng nhận năng lực tiếng Nhật tương đương N4':
        $ketQua->trang_thai = $this->kiemTraDiem($ketQua, ['diem_tu_vung', 'diem_ngu_phap_doc', 'diem_nghe'], 30);
        break;

      case 'Chứng chỉ ứng dụng CNTT cơ bản':
        $ketQua->trang_thai = $this->kiemTraDiem($ketQua, ['diem_trac_nghiem', 'diem_thuc_hanh'], 5);
        break;

      default:
        $ketQua->trang_thai = 'Chưa xét';
    }
  }
  private function kiemTraDiem(KetQua $ketQua, array $danhSachCotDiem, float $diemToiThieu): string
  {
    foreach ($danhSachCotDiem as $tenCot) {
      $diemHocVien = $ketQua->{$tenCot};
      if (is_null($diemHocVien)) {
        return 'Chưa xét';
      }
      if ($diemHocVien < $diemToiThieu) {
        return 'Không đạt';
      }
    }
    return 'Đạt';
  }
  /**
   * Handle the KetQua "created" event.
   */
  public function created(KetQua $ketQua): void
  {
    //
  }

  /**
   * Handle the KetQua "updated" event.
   */
  public function updated(KetQua $ketQua): void
  {
    //
  }

  /**
   * Handle the KetQua "deleted" event.
   */
  public function deleted(KetQua $ketQua): void
  {
    //
  }

  /**
   * Handle the KetQua "restored" event.
   */
  public function restored(KetQua $ketQua): void
  {
    //
  }

  /**
   * Handle the KetQua "force deleted" event.
   */
  public function forceDeleted(KetQua $ketQua): void
  {
    //
  }
}
