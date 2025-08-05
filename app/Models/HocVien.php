<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HocVien extends Model
{
  use HasFactory;
  protected $table = 'hoc_vien';
  protected $primaryKey = 'ma_hv';
  public $timestamps = false;
  public function lop()
  {
    return $this->belongsToMany(Lop::class, 'hoc_vien_lop', 'ma_hv', 'ma_lop');
  }
}
