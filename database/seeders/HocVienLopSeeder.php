<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class HocVienLopSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $faker = Faker::create();
    foreach (range(1, 30) as $i) {
      DB::table('hoc_vien_lop')->insert([
        'ma_hocvien_lop' => $i,
        'ma_hv' => rand(1, 20),
        'ma_lop' => rand(1, 10),
      ]);
    }
  }
}
