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
    Schema::create('ket_qua', function (Blueprint $table) {
      $table->id('ma_kq');
      $table->foreignId('ma_cc')->constrained('chung_chi', 'ma_cc')->onDelete('cascade');
      $table->float('diem_nghe')->nullable();
      $table->float('diem_doc')->nullable();
      $table->float('diem_noi')->nullable();
      $table->float('diem_viet')->nullable();
      $table->float('diem_tu_vung')->nullable();
      $table->float('diem_ngu_phap_doc')->nullable();
      $table->float('diem_trac_nghiem')->nullable();
      $table->float('diem_thuc_hanh')->nullable();
      $table->timestamp('ngay_cap_tao')->nullable();
      $table->timestamp('ngay_cap_nhat')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('ket_quas');
  }
};
