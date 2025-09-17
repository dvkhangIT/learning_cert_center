<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HocVienLop extends Model
{
  use HasFactory;
  protected $table = 'hoc_vien_lop';
  public $timestamps = false;
  protected $fillable = [
    'ma_hv',
    'ma_lop'
  ];
}
