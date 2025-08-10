<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoaiChungChiSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Xóa dữ liệu cũ để tránh trùng lặp khi chạy lại seeder
    DB::table('loai_chung_chi')->delete();

    // Thêm dữ liệu mới dựa trên mô tả của bạn
    DB::table('loai_chung_chi')->insert([
      [
        'ten_loai_cc' => 'Chứng nhận năng lực tiếng Anh CTUT',
        'cau_hinh_diem' => json_encode(['diem_nghe', 'diem_doc']),
        'ngay_tao' => now(),
        'ngay_cap_nhat' => now(),
      ],
      [
        'ten_loai_cc' => 'Chứng nhận năng lực tiếng Anh tương đương bậc 3',
        'cau_hinh_diem' => json_encode(['diem_nghe', 'diem_noi', 'diem_doc', 'diem_viet']),
        'ngay_tao' => now(),
        'ngay_cap_nhat' => now(),
      ],
      [
        'ten_loai_cc' => 'Chứng nhận năng lực tiếng Nhật tương đương N4',
        'cau_hinh_diem' => json_encode(['diem_tu_vung', 'diem_ngu_phap_doc', 'diem_nghe']),
        'ngay_tao' => now(),
        'ngay_cap_nhat' => now(),
      ],
      [
        'ten_loai_cc' => 'Chứng chỉ ứng dụng CNTT căn bản',
        'cau_hinh_diem' => json_encode(['diem_trac_nghiem', 'diem_thuc_hanh']),
        'ngay_tao' => now(),
        'ngay_cap_nhat' => now(),
      ],
    ]);
  }
}
