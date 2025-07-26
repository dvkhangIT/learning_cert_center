<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Str;

class TaiKhoanSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $faker = Faker::create();
    foreach (range(1, 30) as $i) {
      DB::table('tai_khoan')->insert([
        'ho_ten' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'mat_khau' => bcrypt('12345'),
        'vai_tro' => $faker->randomElement(['quanly', 'nhanvien']),
        'trang_thai' => 1,
        'remember_token' => Str::random(10),
        'ngay_cap_tao' => now(),
        'ngay_cap_nhat' => now(),
      ]);
    }
  }
}
