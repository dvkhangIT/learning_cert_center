<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('tai_khoan', function (Blueprint $table) {
      $table->id('ma_tk');
      $table->string('ho_ten');
      $table->string('email');
      $table->string('mat_khau');
      $table->enum('vai_tro', ['quanly', 'nhanvien'])->default('nhanvien');
      $table->enum('trang_thai', [1, 0])->default(1);
      $table->timestamp('ngay_tao')->nullable();
      $table->timestamp('ngay_cap_nhat')->nullable();
    });
    DB::table('tai_khoan')->insert([
      'ho_ten' => 'Quản trị viên',
      'email' => 'admin@gmail.com',
      'mat_khau' => Hash::make('12345'),
      'vai_tro' => 'quanly',
      'trang_thai' => 1,
      'ngay_tao' => now(),
      'ngay_cap_nhat' => now(),
    ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('tai_khoans');
  }
};
