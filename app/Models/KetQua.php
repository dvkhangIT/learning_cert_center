<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KetQua extends Model
{
  use HasFactory, SoftDeletes;
  protected $table = 'ket_qua';
  protected $primaryKey = 'ma_kq';
  public $timestamps = true;
  const DELETED_AT = 'ngay_xoa';
  const CREATED_AT = 'ngay_tao';
  const UPDATED_AT = 'ngay_cap_nhat';
  protected $fillable = [
    'ma_cc','ma_hv',
    'diem_nghe',
    'diem_noi',
    'diem_doc',
    'diem_viet',
    'diem_tu_vung',
    'diem_ngu_phap_doc',
    'diem_trac_nghiem',
    'diem_thuc_hanh',
    'trang_thai',
  ];
  public function hocVien()
  {
    return $this->belongsTo(HocVien::class, 'ma_hv', 'ma_hv');
  }
  public function chungChi()
  {
    return $this->belongsTo(ChungChi::class, 'ma_cc', 'ma_cc');
  }
}
