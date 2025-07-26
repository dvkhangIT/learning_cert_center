<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class KetQuaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $faker = Faker::create();
    foreach (range(1, 15) as $i) {
      DB::table('ket_qua')->insert([
        'ma_cc' => $i,
        'diem_nghe' => rand(50, 100),
        'diem_doc' => rand(50, 100),
        'diem_noi' => rand(50, 100),
        'diem_viet' => rand(50, 100),
        'diem_tu_vung' => rand(50, 100),
        'diem_ngu_phap_doc' => rand(50, 100),
        'diem_trac_nghiem' => rand(1, 10),
        'diem_thuc_hanh' => rand(1, 10),
        'ngay_cap_tao' => now(),
        'ngay_cap_nhat' => now(),
      ]);
    }
  }
}
