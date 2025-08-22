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
    Schema::create('loai_chung_chi', function (Blueprint $table) {
      $table->id('ma_loai_cc');
      $table->string('ten_loai_cc')->unique()->comment('Tên loại chứng chỉ, ví dụ: Tin học Căn bản');
      $table->json('cau_hinh_diem')->nullable()->comment('Mảng JSON chứa tên các cột điểm yêu cầu');
      $table->timestamp('ngay_tao')->nullable();
      $table->timestamp('ngay_cap_nhat')->nullable();
    });
    DB::table('loai_chung_chi')->insert([
      [
        'ten_loai_cc' => 'Chứng nhận năng lực tiếng Anh CTUT',
        'cau_hinh_diem' => json_encode(['diem_nghe', 'diem_doc']),
        'ngay_tao' => now(),
        'ngay_cap_nhat' => now(),
      ],
      [
        'ten_loai_cc' => 'Chứng nhận năng lực tiếng Anh tương đương bậc 3',
        'cau_hinh_diem' => json_encode(['diem_nghe', 'diem_noi', 'diem_doc', 'diem_viet']),
        'ngay_tao' => now(),
        'ngay_cap_nhat' => now(),
      ],
      [
        'ten_loai_cc' => 'Chứng nhận năng lực tiếng Nhật tương đương N4',
        'cau_hinh_diem' => json_encode(['diem_tu_vung', 'diem_ngu_phap_doc', 'diem_nghe']),
        'ngay_tao' => now(),
        'ngay_cap_nhat' => now(),
      ],
      [
        'ten_loai_cc' => 'Chứng chỉ ứng dụng CNTT cơ bản',
        'cau_hinh_diem' => json_encode(['diem_trac_nghiem', 'diem_thuc_hanh']),
        'ngay_tao' => now(),
        'ngay_cap_nhat' => now(),
      ],
    ]);
  }



  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('loai_chung_chis');
  }
};
