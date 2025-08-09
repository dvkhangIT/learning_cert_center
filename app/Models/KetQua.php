<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KetQua extends Model
{
  use HasFactory;
  protected $table = 'ket_qua';
  protected $primaryKey = 'ma_kq';
  public $timestamps = false;
  public function hocVien()
  {
    return $this->belongsTo(HocVien::class, 'ma_hv', 'ma_hv');
  }
}
