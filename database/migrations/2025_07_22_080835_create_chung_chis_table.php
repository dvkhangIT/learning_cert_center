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
    Schema::create('chung_chi', function (Blueprint $table) {
      $table->id('ma_cc');
      $table->foreignId('ma_hv')->nullable()->constrained('hoc_vien', 'ma_hv')->onDelete('cascade');
      $table->unsignedBigInteger('ma_loai_cc')->nullable();
      $table->foreign('ma_loai_cc')
        ->references('ma_loai_cc')
        ->on('loai_chung_chi')
        ->onDelete('set null');
      $table->string('so_hieu');
      $table->date('ngay_vao_so');
      $table->string('so_vao_so');
      $table->date('ngay_bat_dau');
      $table->date('ngay_ket_thuc');
      $table->timestamp('ngay_tao')->nullable();
      $table->timestamp('ngay_cap_nhat')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('chung_chis');
  }
};
