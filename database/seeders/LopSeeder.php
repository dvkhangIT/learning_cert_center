<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class LopSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $faker = Faker::create();
    foreach (range(1, 10) as $i) {
      DB::table('lop')->insert([
        'ma_kh' => rand(1, 5),
        'ten_lop' => 'Lớp ' . strtoupper($faker->randomLetter),
        'ngay_bat_dau' => $faker->dateTimeBetween('-2 months', '-1 month'),
        'ngay_ket_thuc' => $faker->dateTimeBetween('-1 month', '+1 month'),
        'ngay_tao' => now(),
        'ngay_cap_nhat' => now(),
      ]);
    }
  }
}
