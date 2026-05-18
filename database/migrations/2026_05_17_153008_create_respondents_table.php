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
        Schema::create('respondents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            
            // Bagian 1: Demografi
            $table->string('nama');
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->integer('usia');
            $table->enum('status_pernikahan', ['Belum Menikah', 'Menikah', 'Bercerai']);
            $table->enum('punya_anak', ['Ya', 'Tidak'])->nullable();
            $table->integer('jumlah_anak')->nullable();
            
            // Wilayah (Laravolt Codes)
            $table->string('province_code');
            $table->string('city_code');
            $table->string('district_code')->nullable();
            $table->string('village_code')->nullable();
            $table->enum('tipe_tempat_tinggal', ['Pedesaan', 'Perkotaan']);
            
            // Bagian 2: Pendidikan
            $table->string('pendidikan_tertinggi');
            $table->string('nama_sekolah')->nullable();
            $table->string('perguruan_tinggi')->nullable();
            $table->string('program_studi')->nullable();
            $table->integer('tahun_lulus')->nullable();
            
            // Bagian 3: Sertifikasi Kompetensi
            $table->enum('pernah_sertifikasi_lsp', ['Ya', 'Tidak']);
            $table->enum('dapat_sertifikat_bnsp', ['Ya', 'Tidak'])->nullable();
            $table->string('skema_sertifikasi')->nullable();
            
            // Bagian 4: Pekerjaan
            $table->enum('bekerja_seminggu_terakhir', ['Ya', 'Tidak'])->nullable();
            $table->enum('punya_pekerjaan_tapi_tidak_bekerja', ['Ya', 'Tidak'])->nullable();
            $table->enum('pernah_bekerja_sebelumnya', ['Ya', 'Tidak'])->nullable();
            $table->string('alasan_tidak_bekerja')->nullable();
            $table->string('status_pekerjaan')->nullable();
            $table->decimal('gaji_bulanan', 15, 2)->nullable();
            $table->integer('tahun_mulai_bekerja')->nullable();
            $table->integer('jumlah_jam_kerja')->nullable();
            $table->enum('ada_lembur', ['Ya', 'Tidak'])->nullable();
            $table->string('jenis_pekerjaan')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respondents');
    }
};
