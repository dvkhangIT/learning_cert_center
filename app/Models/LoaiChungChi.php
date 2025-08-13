<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiChungChi extends Model
{
  use HasFactory;
  protected $table = 'loai_chung_chi';
  protected $primaryKey = 'ma_loai_cc';
  public $timestamps = false;
  protected $casts = [
    'cau_hinh_diem' => 'array',
  ];
  public function loaiChungChi()
  {
    return $this->belongsTo(LoaiChungChi::class, 'ma_loai_cc');
  }
  public function getRouteNameAttribute(): ?string
  {
    switch ($this->ten_loai_cc) {
      case 'Chứng nhận năng lực tiếng Anh CTUT':
        return 'quan-ly.ket-qua.tieng-anh-ctut';

      case 'Chứng nhận năng lực tiếng Anh tương đương bậc 3':
        return 'quan-ly.ket-qua.tieng-anh-bac-3';

      case 'Chứng nhận năng lực tiếng Nhật tương đương N4':
        return 'quan-ly.ket-qua.tieng-nhat-n4';

      case 'Chứng chỉ ứng dụng CNTT cơ bản':
        return 'quan-ly.ket-qua.cntt-co-ban';

      default:
        return null;
    }
  }
}
