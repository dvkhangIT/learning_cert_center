<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lop extends Model
{
  use HasFactory;
  protected $table = 'lop';
  protected $primaryKey = 'ma_lop';
  public $timestamps = false;
  public function khoaHoc()
  {
    return $this->belongsTo(KhoaHoc::class, 'ma_kh', 'ma_kh');
  }
}
