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
    Schema::create('loai_chung_chi', function (Blueprint $table) {
      $table->id('ma_loai_cc');
      $table->string('ten_loai_cc')->unique()->comment('Tên loại chứng chỉ, ví dụ: Tin học Căn bản');
      $table->json('cau_hinh_diem')->nullable()->comment('Mảng JSON chứa tên các cột điểm yêu cầu');
      $table->timestamp('ngay_tao')->nullable();
      $table->timestamp('ngay_cap_nhat')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('loai_chung_chis');
  }
};
