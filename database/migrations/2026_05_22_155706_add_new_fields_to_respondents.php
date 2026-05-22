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
        Schema::table('respondents', function (Blueprint $table) {
            // Relasi ke Lookups
            $table->foreignId('campus_id')->nullable()->after('perguruan_tinggi')->constrained()->nullOnDelete();
            $table->foreignId('competency_scheme_id')->nullable()->after('skema_sertifikasi')->constrained()->nullOnDelete();
            $table->string('skema_sertifikasi_lainnya')->nullable()->after('competency_scheme_id');
            
            // Pertanyaan Pekerjaan Baru
            $table->string('pekerjaan_dimulai_setelah_lulus')->nullable()->after('bekerja_seminggu_terakhir');
            $table->integer('waktu_tunggu_kerja')->nullable()->after('pekerjaan_dimulai_setelah_lulus');
            $table->string('gaji_perbandingan_umr')->nullable()->after('gaji_bulanan');
            
            // ISCO & ISIC Pekerjaan Utama
            $table->string('isco_code')->nullable()->after('jenis_pekerjaan');
            $table->string('isco_title_en')->nullable()->after('isco_code');
            $table->string('isco_title_id')->nullable()->after('isco_title_en');
            
            $table->string('isic_code')->nullable()->after('bidang_perusahaan');
            $table->string('isic_title_en')->nullable()->after('isic_code');
            $table->string('isic_title_id')->nullable()->after('isic_title_en');
            
            // Pekerjaan Tambahan
            $table->string('punya_pekerjaan_tambahan')->nullable()->after('isic_title_id');
            $table->string('status_pekerjaan_tambahan')->nullable()->after('punya_pekerjaan_tambahan');
            $table->string('pekerjaan_tambahan_isco_code')->nullable()->after('status_pekerjaan_tambahan');
            $table->string('pekerjaan_tambahan_isco_title_en')->nullable()->after('pekerjaan_tambahan_isco_code');
            $table->string('pekerjaan_tambahan_isco_title_id')->nullable()->after('pekerjaan_tambahan_isco_title_en');
            $table->integer('jumlah_jam_kerja_tambahan')->nullable()->after('pekerjaan_tambahan_isco_title_id');
            
            // Pekerjaan Sebelumnya (Untuk yang Tidak Bekerja)
            $table->string('pernah_bekerja_sebelumnya_lain')->nullable()->after('pernah_bekerja_sebelumnya');
            $table->string('pekerjaan_sebelumnya_isco_code')->nullable()->after('pernah_bekerja_sebelumnya_lain');
            $table->string('pekerjaan_sebelumnya_isco_title_en')->nullable()->after('pekerjaan_sebelumnya_isco_code');
            $table->string('pekerjaan_sebelumnya_isco_title_id')->nullable()->after('pekerjaan_sebelumnya_isco_title_en');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('respondents', function (Blueprint $table) {
            $table->dropForeign(['campus_id']);
            $table->dropForeign(['competency_scheme_id']);
            
            $table->dropColumn([
                'campus_id',
                'competency_scheme_id',
                'skema_sertifikasi_lainnya',
                'pekerjaan_dimulai_setelah_lulus',
                'waktu_tunggu_kerja',
                'gaji_perbandingan_umr',
                'isco_code',
                'isco_title_en',
                'isco_title_id',
                'isic_code',
                'isic_title_en',
                'isic_title_id',
                'punya_pekerjaan_tambahan',
                'status_pekerjaan_tambahan',
                'pekerjaan_tambahan_isco_code',
                'pekerjaan_tambahan_isco_title_en',
                'pekerjaan_tambahan_isco_title_id',
                'jumlah_jam_kerja_tambahan',
                'pernah_bekerja_sebelumnya_lain',
                'pekerjaan_sebelumnya_isco_code',
                'pekerjaan_sebelumnya_isco_title_en',
                'pekerjaan_sebelumnya_isco_title_id'
            ]);
        });
    }
};
