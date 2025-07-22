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
    Schema::create('lop', function (Blueprint $table) {
      $table->id('ma_lop');
      $table->foreignId('ma_kh')->constrained('khoa_hoc', 'ma_kh')->onDelete('cascade');
      $table->string('ten_lop');
      $table->date('ngay_bat_dau');
      $table->date('ngay_ket_thuc');
      $table->timestamp('ngay_cap_tao')->nullable();
      $table->timestamp('ngay_cap_nhat')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('lops');
  }
};
