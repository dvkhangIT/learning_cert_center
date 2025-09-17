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
        'ma_hv' => $i,
        'ma_cc' => $i,
        'diem_nghe' => 0,
        'diem_doc' => 0,
        'diem_noi' => 0,
        'diem_viet' => 0,
        'diem_tu_vung' => 0,
        'diem_ngu_phap_doc' => 0,
        'diem_trac_nghiem' => 0,
        'diem_thuc_hanh' => 0,
        'ngay_tao' => now(),
        'ngay_cap_nhat' => now(),
      ]);
    }
  }
}
