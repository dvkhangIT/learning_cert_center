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
    Schema::create('hoc_vien_lop', function (Blueprint $table) {
      $table->id('ma_hocvien_lop');
      $table->foreignId('ma_hv')->constrained('hoc_vien', 'ma_hv')->onDelete('cascade');
      $table->foreignId('ma_lop')->constrained('lop', 'ma_lop')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('hoc_vien_lops');
  }
};
