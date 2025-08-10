<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KetQua extends Model
{
  use HasFactory;
  protected $table = 'ket_qua';
  protected $primaryKey = 'ma_kq';
  public $timestamps = true;
  const CREATED_AT = 'ngay_tao';
  const UPDATED_AT = 'ngay_cap_nhat';
  protected $fillable = [
    'diem_nghe',
    'diem_noi',
    'diem_doc',
    'diem_viet',
    'diem_tu_vung',
    'diem_ngu_phap_doc',
    'diem_trac_nghiem',
    'diem_thuc_hanh'
  ];
  public function hocVien()
  {
    return $this->belongsTo(HocVien::class, 'ma_hv', 'ma_hv');
  }
  public function chungChi()
  {
    return $this->belongsTo(ChungChi::class, 'ma_cc', 'ma_cc');
  }
  private function kiemTraDiem(array $danhSachCotDiem, float $diemToiThieu): string
  {
    foreach ($danhSachCotDiem as $tenCot) {
      $diemHocVien = $this->{$tenCot};
      if (is_null($diemHocVien)) {
        return 'Chưa xét';
      }
      if ($diemHocVien < $diemToiThieu) {
        return 'Không Đạt';
      }
    }
    return 'Đạt';
  }

  /**
   * KHAI BÁO ACCESSOR THEO CÚ PHÁP CŨ (getTênThuộcTínhAttribute)
   * Laravel sẽ tự động gọi hàm này khi bạn truy cập $ketQua->trang_thai
   */
  public function getTrangThaiAttribute()
  {
    // **Bước 1: Lấy thông tin về loại chứng chỉ**
    $loaiChungChi = $this->chungChi?->loaiChungChi;

    // Nếu không có thông tin loại chứng chỉ -> Chưa xét
    if (!$loaiChungChi) {
      return 'Chưa xét';
    }
    // **Bước 2: Dùng switch...case để áp dụng đúng quy tắc**
    switch ($loaiChungChi->ten_loai_cc) {
      case 'Chứng nhận năng lực tiếng Anh CTUT':
        return $this->kiemTraDiem(['diem_nghe', 'diem_doc'], 225);

      case 'Chứng nhận năng lực tiếng Anh tương đương bậc 3':
        return $this->kiemTraDiem(['diem_nghe', 'diem_noi', 'diem_doc', 'diem_viet'], 5);

      case 'Chứng nhận năng lực tiếng Nhật tương đương N4':
        return $this->kiemTraDiem(['diem_tu_vung', 'diem_ngu_phap_doc', 'diem_nghe'], 30);

      case 'Chứng chỉ ứng dụng CNTT cơ bản':
        return $this->kiemTraDiem(['diem_trac_nghiem', 'diem_thuc_hanh'], 5);

      default:
        return 'Chưa xét';
    }
  }
}
