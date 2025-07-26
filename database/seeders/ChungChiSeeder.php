<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ChungChiSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $faker = Faker::create();
    foreach (range(1, 15) as $i) {
      DB::table('chung_chi')->insert([
        'ma_hv' => rand(1, 20),
        'ten_cc' => 'CC ' . $faker->word,
        'so_hieu' => 'SH-' . $faker->unique()->numerify('###'),
        'so_vao_so' => $faker->unique()->numerify('CC-###'),
        'ngay_vao_so' => $faker->dateTimeBetween('-1 month', 'now'),
        'ngay_bat_dau' => $faker->dateTimeBetween('-3 months', '-2 months'),
        'ngay_ket_thuc' => $faker->dateTimeBetween('-2 months', 'now'),
        'ngay_cap_tao' => now(),
        'ngay_cap_nhat' => now(),
      ]);
    }
  }
}
