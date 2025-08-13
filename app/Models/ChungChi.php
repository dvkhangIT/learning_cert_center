<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChungChi extends Model
{
  use HasFactory;
  protected $table = 'chung_chi';
  protected $primaryKey = 'ma_cc';
  public $timestamps = false;
  public function hocVien()
  {
    return $this->belongsTo(HocVien::class, 'ma_hv');
  }

  public function ketQua()
  {
    return $this->hasOne(KetQua::class, 'ma_cc');
  }
  public function loaiChungChi()
  {
    return $this->belongsTo(LoaiChungChi::class, 'ma_loai_cc', 'ma_loai_cc');
  }
}
