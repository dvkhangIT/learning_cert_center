<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class HocVienSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $faker = Faker::create();
    foreach (range(1, 20) as $i) {
      DB::table('hoc_vien')->insert([
        'hoten_hv' => $faker->name,
        'ngay_sinh' => $faker->date('Y-m-d', '-18 years'),
        'noi_sinh' => $faker->city,
        'gioi_tinh' => $faker->randomElement(['Nam', 'Nữ']),
        'ngay_tao' => now(),
        'ngay_cap_nhat' => now(),
      ]);
    }
  }
}
