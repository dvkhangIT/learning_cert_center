<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HocVien extends Model
{
  use HasFactory;
  protected $table = 'hoc_vien';
  protected $primaryKey = 'ma_hv';
  const CREATED_AT = 'ngay_tao';
  const UPDATED_AT = 'ngay_cap_nhat';
  protected $fillable = [
    'hoten_hv',
    'ngay_sinh',
    'noi_sinh',
    'gioi_tinh'
  ];
  public function lop()
  {
    return $this->belongsToMany(Lop::class, 'hoc_vien_lop', 'ma_hv', 'ma_lop');
  }
}
