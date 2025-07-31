<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class KhoaHocSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $faker = Faker::create();

    // ⚠️ Kiểm tra có ít nhất 1 tài khoản để gán vào ma_tk
    $taiKhoanIds = DB::table('tai_khoan')->pluck('ma_tk');

    // Nếu chưa có tài khoản, dừng lại
    if ($taiKhoanIds->isEmpty()) {
      $this->command->error('❌ Không có tài khoản nào trong bảng `tai_khoan`, hãy chạy TaiKhoanSeeder trước.');
      return;
    }

    // Sinh 5 khóa học
    foreach (range(1, 20) as $i) {
      DB::table('khoa_hoc')->insert([
        'ma_tk' => $faker->randomElement($taiKhoanIds),  // ✅ Gán đúng khoá ngoại
        'ten_kh' => 'Khóa ' . ucfirst($faker->word),
        'ngay_tao' => now(),
        'ngay_cap_nhat' => now(),
      ]);
    }
  }
}
