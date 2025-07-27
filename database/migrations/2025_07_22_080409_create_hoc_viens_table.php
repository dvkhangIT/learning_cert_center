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
    Schema::create('hoc_vien', function (Blueprint $table) {
      $table->id('ma_hv');
      $table->string('hoten_hv');
      $table->date('ngay_sinh');
      $table->string('noi_sinh');
      $table->enum('gioi_tinh', ['nam', 'nu']);
      $table->timestamp('ngay_tao')->nullable();
      $table->timestamp('ngay_cap_nhat')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('hoc_viens');
  }
};
