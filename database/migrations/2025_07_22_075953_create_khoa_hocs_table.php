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
    Schema::create('khoa_hoc', function (Blueprint $table) {
      $table->id('ma_kh');
      $table->foreignId('ma_tk')->constrained('tai_khoan', 'ma_tk')->onDelete('cascade');
      $table->string('ten_kh');
      $table->timestamp('ngay_cap_tao')->nullable();
      $table->timestamp('ngay_cap_nhat')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('khoa_hocs');
  }
};
