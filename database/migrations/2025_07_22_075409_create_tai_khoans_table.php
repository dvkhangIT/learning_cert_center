<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
      $table->string('remember_token')->nullable();
      $table->timestamp('ngay_tao')->nullable();
      $table->timestamp('ngay_cap_nhat')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('tai_khoans');
  }
};
