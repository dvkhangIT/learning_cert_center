<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhoaHoc extends Model
{
  use HasFactory;
  protected $table = 'khoa_hoc';
  protected $primaryKey = 'ma_kh';
  public $timestamps = false;
  public function taiKhoan()
  {
    return $this->belongsTo(TaiKhoan::class, 'ma_tk', 'ma_tk');
  }
}
