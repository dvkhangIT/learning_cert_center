<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TaiKhoan extends Authenticatable
{
  use Notifiable;
  protected $table = 'tai_khoan';
  protected $primaryKey = 'ma_tk';
  public $timestamps = false;

  protected $fillable = [
    'ho_ten',
    'email',
    'mat_khau',
    'vai_tro',
    'trang_thai',
    'remember_token'
  ];

  protected $hidden = [
    'mat_khau',
    'remember_token',
  ];

  public function getAuthPassword()
  {
    return $this->mat_khau;
  }
}
