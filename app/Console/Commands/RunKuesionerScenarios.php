<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Livewire\FormKuisioner;
use App\Models\Respondent;
use Illuminate\Validation\ValidationException;

class RunKuesionerScenarios extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kuesioner:test-scenarios';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run positive scenarios (dummy2-dummy5) and negative validation tests directly in the SQLite database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("==================================================");
        $this->info("STARTING KUESIONER TRACER STUDY AUTOMATED TESTING");
        $this->info("==================================================");

        $results = [];
        $discrepancies = [];

        // Clean existing dummy respondents first to ensure re-runs succeed
        $deleted = Respondent::whereIn('email', [
            'dummy2@gmail.com',
            'dummy3@gmail.com',
            'dummy4@gmail.com',
            'dummy5@gmail.com',
            'dummy_invalid@gmail.com'
        ])->delete();
        if ($deleted > 0) {
            $this->warn("Cleaned {$deleted} old dummy respondents from database.");
        }

        // ==========================================
        // 1. RUNNING POSITIVE SCENARIOS
        // ==========================================

        // --- SKENARIO 1 ---
        $this->info("\nRunning Skenario 1: dummy2@gmail.com (Jalur Maksimal)");
        try {
            $form = new FormKuisioner();
            $form->mount();

            // Step 1
            $form->currentStep = 1;
            $form->email = 'dummy2@gmail.com';
            $form->nama = 'Dummy Two';
            $form->jenis_kelamin = 'Laki-Laki';
            $form->usia = 28;
            $form->status_pernikahan = 'Menikah';
            $form->punya_anak = 'Ya';
            $form->jumlah_anak = 2;
            $form->selectedProvince = '32'; // Jawa Barat
            $form->updatedSelectedProvince('32');
            $form->selectedCity = '3273'; // Kota Bandung
            $form->updatedSelectedCity('3273');
            $form->tipe_tempat_tinggal = 'Perkotaan';

            $form->nextStep(); // Validate Step 1 and advance to Step 2
            $this->info("-> Step 1 validated successfully. Current step: " . $form->currentStep);

            // Step 2
            $form->pendidikan_tertinggi = 'Sarjana (S1)';
            $form->campus_id = 157; // AKPINDO-STEIN
            $form->updatedCampusId(157);
            $form->program_studi = 'Teknik Informatika';
            $form->tahun_lulus = 2021;
            $form->ipk = 3.75;
            $form->melanjutkan_pendidikan = 'Tidak';
            $form->pernah_sertifikasi_lsp = 'Ya';
            $form->dapat_sertifikat_bnsp = 'Ya';
            $form->competency_scheme_id = 1868; // Baker

            $form->nextStep(); // Validate Step 2 and advance to Step 3
            $this->info("-> Step 2 validated successfully. Current step: " . $form->currentStep);

            // Step 3
            $form->bekerja_seminggu_terakhir = 'Ya';
            $form->pekerjaan_dimulai_setelah_lulus = 'Ya';
            $form->waktu_tunggu_kerja = 3;
            $form->status_pekerjaan = 'Karyawan/pegawai/buruh';
            $form->gaji_bulanan = 12500000;
            $form->updatedGajiBulanan(12500000);
            $form->gaji_perbandingan_umr = 'Lebih besar dari UMR';
            $form->tahun_mulai_bekerja = 2022;

            $form->isco_l1 = '1';
            $form->updatedIscoL1('1');
            $form->isco_l2 = '13';
            $form->updatedIscoL2('13');
            $form->isco_l3 = '133';
            $form->updatedIscoL3('133');
            $form->isco_l4 = '1330';
            $form->updatedIscoL4('1330');

            $form->jumlah_jam_kerja = 45;
            $form->ada_lembur = 'Ya';
            $form->nama_perusahaan = 'PT Solusi Teknologi Indonesia';
            $form->jenis_perusahaan = 'Perusahaan/institusi berorientasi profit (PT, CV, UD, BUMN, BUMD)';
            $form->jumlah_karyawan = '20 s.d 99 karyawan (usaha menengah)';
            
            $form->selectedIsicSector = 'K';
            $form->updatedSelectedIsicSector('K');
            $form->isic_code = 'K2';
            $form->updatedIsicCode('K2');

            $form->punya_pekerjaan_tambahan = 'Ya';
            $form->status_pekerjaan_tambahan = 'Berusaha sendiri/wiraswasta';
            
            $form->pekerjaan_tambahan_isco_l1 = '2';
            $form->updatedPekerjaanTambahanIscoL1('2');
            $form->pekerjaan_tambahan_isco_l2 = '25';
            $form->updatedPekerjaanTambahanIscoL2('25');
            $form->pekerjaan_tambahan_isco_l3 = '251';
            $form->updatedPekerjaanTambahanIscoL3('251');
            $form->pekerjaan_tambahan_isco_l4 = '2512';
            $form->updatedPekerjaanTambahanIscoL4('2512');

            $form->jumlah_jam_kerja_tambahan = 10;
            $form->pernah_bekerja_sebelumnya_lain = 'Tidak';

            $form->nextStep(); // Validate Step 3 and advance to Step 4
            $this->info("-> Step 3 validated successfully. Current step: " . $form->currentStep);

            // Step 4
            $form->kesesuaian_bidang_ijazah = 'Sangat Sesuai';
            $form->kesesuaian_jenjang_pendidikan = 'Jenjang pendidikan saya sudah sesuai dengan pekerjaan ini';
            $form->jenjang_paling_sesuai = 'Strata 1';
            $form->bnsp_mudahkan_dapat_kerja = 'Sangat Mendukung';
            $form->perusahaan_hargai_bnsp = 'Sangat menyambut baik';
            $form->bnsp_tingkatkan_karir = 'Sangat Berdampak Terhadap Peningkatan Karir';
            $form->bnsp_tingkatkan_gaji = 'Berdampak Terhadap Peningkatan Pendapatan/Gaji';
            $form->kesesuaian_bidang_bnsp = 'Ya';
            $form->jabatan_sebelum_bnsp = 'Junior Programmer';
            $form->jabatan_setelah_bnsp = 'Senior Developer / Team Lead';

            $form->submit();
            $this->info("-> Step 4 submitted successfully.");
            
            $saved = Respondent::where('email', 'dummy2@gmail.com')->first();
            if ($saved) {
                $this->info("[SUCCESS] Skenario 1 saved to database. ID: " . $saved->id);
                $results['Skenario 1'] = 'SUCCESS';
            } else {
                $this->error("[FAILED] Skenario 1 submitted but not found in database.");
                $results['Skenario 1'] = 'FAILED_DATABASE';
            }

        } catch (ValidationException $e) {
            $this->error("[FAILED] Skenario 1 failed validation: " . json_encode($e->errors()));
            $results['Skenario 1'] = 'FAILED_VALIDATION';
        } catch (\Exception $e) {
            $this->error("[FAILED] Skenario 1 exception: " . $e->getMessage());
            $results['Skenario 1'] = 'FAILED_EXCEPTION';
        }

        // --- SKENARIO 2 ---
        $this->info("\nRunning Skenario 2: dummy3@gmail.com (Jalur Wiraswasta Freelance)");
        try {
            $form = new FormKuisioner();
            $form->mount();

            // Step 1
            $form->currentStep = 1;
            $form->email = 'dummy3@gmail.com';
            $form->nama = 'Dummy Three';
            $form->jenis_kelamin = 'Perempuan';
            $form->usia = 25;
            $form->status_pernikahan = 'Belum Menikah';
            $form->punya_anak = 'Tidak';
            $form->selectedProvince = '31'; // DKI Jakarta
            $form->updatedSelectedProvince('31');
            $form->selectedCity = '3174'; // Jakarta Selatan
            $form->updatedSelectedCity('3174');
            $form->tipe_tempat_tinggal = 'Perkotaan';

            $form->nextStep();
            $this->info("-> Step 1 validated successfully. Current step: " . $form->currentStep);

            // Step 2
            $form->pendidikan_tertinggi = 'Diploma 3';
            $form->campus_id = 157;
            $form->updatedCampusId(157);
            $form->program_studi = 'Desain Grafis';
            $form->tahun_lulus = 2022;
            $form->ipk = 3.40;
            $form->melanjutkan_pendidikan = 'Tidak';
            $form->pernah_sertifikasi_lsp = 'Ya';
            $form->dapat_sertifikat_bnsp = 'Ya';
            $form->competency_scheme_id = 'other';
            $form->skema_sertifikasi_lainnya = 'Skema Desainer Grafis Madya';

            $form->nextStep();
            $this->info("-> Step 2 validated successfully. Current step: " . $form->currentStep);

            // Step 3
            $form->bekerja_seminggu_terakhir = 'Ya';
            $form->pekerjaan_dimulai_setelah_lulus = 'Ya';
            $form->waktu_tunggu_kerja = 2;
            $form->status_pekerjaan = 'Pekerja lepas non-pertanian';
            $form->gaji_bulanan = 6000000;
            $form->updatedGajiBulanan(6000000);
            $form->gaji_perbandingan_umr = 'Sebesar (sama atau mirip) dengan UMR';
            $form->tahun_mulai_bekerja = 2022;

            $form->isco_l1 = '2';
            $form->updatedIscoL1('2');
            $form->isco_l2 = '21';
            $form->updatedIscoL2('21');
            $form->isco_l3 = '216';
            $form->updatedIscoL3('216');
            $form->isco_l4 = '2166';
            $form->updatedIscoL4('2166');

            $form->jumlah_jam_kerja = 35; // No lembur
            $form->nama_perusahaan = 'Desain Mandiri Kreatif';
            $form->jenis_perusahaan = 'Wirausahawan/perusahaan sendiri/usaha rumahan';
            $form->jumlah_karyawan = '1 s.d 4 karyawan (usaha mikro/usaha rumahan)';
            
            $form->selectedIsicSector = 'N';
            $form->updatedSelectedIsicSector('N');
            $form->isic_code = 'N6';
            $form->updatedIsicCode('N6');

            $form->punya_pekerjaan_tambahan = 'Tidak';
            $form->pernah_bekerja_sebelumnya_lain = 'Tidak';

            $form->nextStep();
            $this->info("-> Step 3 validated successfully. Current step: " . $form->currentStep);

            // Step 4
            $form->kesesuaian_bidang_ijazah = 'Sesuai';
            $form->kesesuaian_jenjang_pendidikan = 'Jenjang pendidikan saya sudah sesuai dengan pekerjaan ini';
            $form->jenjang_paling_sesuai = 'Diploma 1, 2, atau 3';
            $form->bnsp_mudahkan_dapat_kerja = 'Cukup Mendukung';
            $form->perusahaan_hargai_bnsp = 'Menyambut baik';
            $form->bnsp_tingkatkan_karir = 'Berdampak Terhadap Peningkatan Karir';
            $form->bnsp_tingkatkan_gaji = 'Tidak Berdampak Terhadap Peningkatan Pendapatan/Gaji Sama Sekali';
            $form->kesesuaian_bidang_bnsp = 'Ya';
            $form->jabatan_sebelum_bnsp = 'Freelance Designer';
            $form->jabatan_setelah_bnsp = 'Lead Creative Designer';

            $form->submit();
            $this->info("-> Step 4 submitted successfully.");
            
            $saved = Respondent::where('email', 'dummy3@gmail.com')->first();
            if ($saved) {
                $this->info("[SUCCESS] Skenario 2 saved to database. ID: " . $saved->id);
                $results['Skenario 2'] = 'SUCCESS';
            } else {
                $this->error("[FAILED] Skenario 2 submitted but not found in database.");
                $results['Skenario 2'] = 'FAILED_DATABASE';
            }

        } catch (ValidationException $e) {
            $this->error("[FAILED] Skenario 2 failed validation: " . json_encode($e->errors()));
            $results['Skenario 2'] = 'FAILED_VALIDATION';
        } catch (\Exception $e) {
            $this->error("[FAILED] Skenario 2 exception: " . $e->getMessage());
            $results['Skenario 2'] = 'FAILED_EXCEPTION';
        }

        // --- SKENARIO 3 ---
        $this->info("\nRunning Skenario 3: dummy4@gmail.com (Jalur Menganggur, Pernah Bekerja, Sertifikasi Gagal)");
        try {
            $form = new FormKuisioner();
            $form->mount();

            // Step 1
            $form->currentStep = 1;
            $form->email = 'dummy4@gmail.com';
            $form->nama = 'Dummy Four';
            $form->jenis_kelamin = 'Laki-Laki';
            $form->usia = 32;
            $form->status_pernikahan = 'Menikah';
            $form->punya_anak = 'Ya';
            $form->jumlah_anak = 1;
            $form->selectedProvince = '33'; // Jawa Tengah
            $form->updatedSelectedProvince('33');
            $form->selectedCity = '3302'; // Banyumas
            $form->updatedSelectedCity('3302');
            $form->tipe_tempat_tinggal = 'Pedesaan';

            $form->nextStep();
            $this->info("-> Step 1 validated successfully. Current step: " . $form->currentStep);

            // Step 2
            $form->pendidikan_tertinggi = 'Diploma 4';
            $form->campus_id = 157;
            $form->updatedCampusId(157);
            $form->program_studi = 'Teknik Mesin';
            $form->tahun_lulus = 2018;
            $form->ipk = 3.15;
            $form->melanjutkan_pendidikan = 'Tidak';
            $form->pernah_sertifikasi_lsp = 'Ya';
            $form->dapat_sertifikat_bnsp = 'Tidak'; // Gagal sertifikasi

            $form->nextStep();
            $this->info("-> Step 2 validated successfully. Current step: " . $form->currentStep);

            // Step 3
            $form->bekerja_seminggu_terakhir = 'Tidak';
            $form->punya_pekerjaan_tapi_tidak_bekerja = 'Tidak';
            $form->pernah_bekerja_sebelumnya = 'Ya';
            
            $form->prev_isco_l1 = '7';
            $form->updatedPrevIscoL1('7');
            $form->prev_isco_l2 = '72';
            $form->updatedPrevIscoL2('72');
            $form->prev_isco_l3 = '722';
            $form->updatedPrevIscoL3('722');
            $form->prev_isco_l4 = '7223';
            $form->updatedPrevIscoL4('7223');
            
            $form->alasan_tidak_bekerja = 'Masih sedang mencari pekerjaan';

            $form->nextStep();
            $this->info("-> Step 3 validated successfully. Current step: " . $form->currentStep);

            // Step 4 (unemployed skips evaluation)
            $form->submit();
            $this->info("-> Step 4 submitted successfully.");
            
            $saved = Respondent::where('email', 'dummy4@gmail.com')->first();
            if ($saved) {
                $this->info("[SUCCESS] Skenario 3 saved to database. ID: " . $saved->id);
                $results['Skenario 3'] = 'SUCCESS';
            } else {
                $this->error("[FAILED] Skenario 3 submitted but not found in database.");
                $results['Skenario 3'] = 'FAILED_DATABASE';
            }

        } catch (ValidationException $e) {
            $this->error("[FAILED] Skenario 3 failed validation: " . json_encode($e->errors()));
            $results['Skenario 3'] = 'FAILED_VALIDATION';
        } catch (\Exception $e) {
            $this->error("[FAILED] Skenario 3 exception: " . $e->getMessage());
            $results['Skenario 3'] = 'FAILED_EXCEPTION';
        }

        // --- SKENARIO 4 ---
        $this->info("\nRunning Skenario 4: dummy5@gmail.com (Jalur Lulusan SMA, Menganggur Fresh Grad)");
        try {
            $form = new FormKuisioner();
            $form->mount();

            // Step 1
            $form->currentStep = 1;
            $form->email = 'dummy5@gmail.com';
            $form->nama = 'Dummy Five';
            $form->jenis_kelamin = 'Perempuan';
            $form->usia = 19;
            $form->status_pernikahan = 'Belum Menikah';
            $form->punya_anak = 'Tidak';
            $form->selectedProvince = '35'; // Jawa Timur
            $form->updatedSelectedProvince('35');
            $form->selectedCity = '3573'; // Malang
            $form->updatedSelectedCity('3573');
            $form->tipe_tempat_tinggal = 'Perkotaan';

            $form->nextStep();
            $this->info("-> Step 1 validated successfully. Current step: " . $form->currentStep);

            // Step 2
            $form->pendidikan_tertinggi = 'SMA/Sederajat';
            $form->nama_sekolah = 'SMAN 1 Malang';
            $form->pernah_sertifikasi_lsp = 'Tidak';

            $form->nextStep();
            $this->info("-> Step 2 validated successfully. Current step: " . $form->currentStep);

            // Step 3
            $form->bekerja_seminggu_terakhir = 'Tidak';
            $form->punya_pekerjaan_tapi_tidak_bekerja = 'Tidak';
            $form->pernah_bekerja_sebelumnya = 'Tidak';
            $form->alasan_tidak_bekerja = 'Sedang studi lanjut / tugas belajar';

            $form->nextStep();
            $this->info("-> Step 3 validated successfully. Current step: " . $form->currentStep);

            // Step 4 (unemployed skips evaluation)
            $form->submit();
            $this->info("-> Step 4 submitted successfully.");
            
            $saved = Respondent::where('email', 'dummy5@gmail.com')->first();
            if ($saved) {
                $this->info("[SUCCESS] Skenario 4 saved to database. ID: " . $saved->id);
                $results['Skenario 4'] = 'SUCCESS';
            } else {
                $this->error("[FAILED] Skenario 4 submitted but not found in database.");
                $results['Skenario 4'] = 'FAILED_DATABASE';
            }

        } catch (ValidationException $e) {
            $this->error("[FAILED] Skenario 4 failed validation: " . json_encode($e->errors()));
            $results['Skenario 4'] = 'FAILED_VALIDATION';
        } catch (\Exception $e) {
            $this->error("[FAILED] Skenario 4 exception: " . $e->getMessage());
            $results['Skenario 4'] = 'FAILED_EXCEPTION';
        }


        // ==========================================
        // 2. RUNNING NEGATIVE VALIDATION TESTS
        // ==========================================
        $this->info("\n==================================================");
        $this->info("RUNNING NEGATIVE VALIDATION TESTS");
        $this->info("==================================================");

        // --- NEGATIVE 1: Invalid Email Format ---
        $this->info("Testing Negative Case 1: Email format without '@'");
        try {
            $form = new FormKuisioner();
            $form->mount();
            $form->currentStep = 1;
            $form->email = 'dummy_invalid.com'; // Invalid
            $form->nama = 'Dummy Invalid';
            $form->jenis_kelamin = 'Laki-Laki';
            $form->usia = 25;
            $form->status_pernikahan = 'Belum Menikah';
            $form->punya_anak = 'Tidak';
            $form->selectedProvince = '32';
            $form->selectedCity = '3273';
            $form->tipe_tempat_tinggal = 'Perkotaan';
            
            $form->nextStep();
            $this->error("[DISCREPANCY] Email without '@' passed validation!");
            $discrepancies[] = "Email format without '@' was allowed to pass.";
        } catch (ValidationException $e) {
            $this->info("[PASS] Catch expected validation error for Email: " . $e->validator->errors()->first('email'));
        }

        // --- NEGATIVE 2: Age Boundaries (<15) ---
        $this->info("Testing Negative Case 2: Age boundary < 15 (value: 14)");
        try {
            $form = new FormKuisioner();
            $form->mount();
            $form->currentStep = 1;
            $form->email = 'dummy_age_low@gmail.com';
            $form->nama = 'Dummy Age Low';
            $form->jenis_kelamin = 'Laki-Laki';
            $form->usia = 14; // Too young
            $form->status_pernikahan = 'Belum Menikah';
            $form->punya_anak = 'Tidak';
            $form->selectedProvince = '32';
            $form->selectedCity = '3273';
            $form->tipe_tempat_tinggal = 'Perkotaan';

            $form->nextStep();
            $this->error("[DISCREPANCY] Age < 15 passed validation!");
            $discrepancies[] = "Age 14 (below 15) was allowed to pass.";
        } catch (ValidationException $e) {
            $this->info("[PASS] Catch expected validation error for Age (<15): " . $e->validator->errors()->first('usia'));
        }

        // --- NEGATIVE 3: Age Boundaries (>70) ---
        $this->info("Testing Negative Case 3: Age boundary > 70 (value: 71)");
        try {
            $form = new FormKuisioner();
            $form->mount();
            $form->currentStep = 1;
            $form->email = 'dummy_age_high@gmail.com';
            $form->nama = 'Dummy Age High';
            $form->jenis_kelamin = 'Laki-Laki';
            $form->usia = 71; // Too old
            $form->status_pernikahan = 'Belum Menikah';
            $form->punya_anak = 'Tidak';
            $form->selectedProvince = '32';
            $form->selectedCity = '3273';
            $form->tipe_tempat_tinggal = 'Perkotaan';

            $form->nextStep();
            $this->error("[DISCREPANCY] Age > 70 passed validation!");
            $discrepancies[] = "Age 71 (above 70) was allowed to pass.";
        } catch (ValidationException $e) {
            $this->info("[PASS] Catch expected validation error for Age (>70): " . $e->validator->errors()->first('usia'));
        }

        // --- NEGATIVE 4: IPK Boundaries (<2.50) ---
        $this->info("Testing Negative Case 4: IPK boundary < 2.50 (value: 2.49)");
        try {
            $form = new FormKuisioner();
            $form->mount();
            $form->currentStep = 2;
            $form->pendidikan_tertinggi = 'Sarjana (S1)';
            $form->campus_id = 157;
            $form->program_studi = 'Teknik Informatika';
            $form->tahun_lulus = 2022;
            $form->ipk = 2.49; // Too low
            $form->melanjutkan_pendidikan = 'Tidak';
            $form->pernah_sertifikasi_lsp = 'Tidak';

            $form->nextStep();
            $this->error("[DISCREPANCY] IPK < 2.50 passed validation!");
            $discrepancies[] = "IPK 2.49 (below 2.50) was allowed to pass.";
        } catch (ValidationException $e) {
            $this->info("[PASS] Catch expected validation error for IPK (<2.50): " . $e->validator->errors()->first('ipk'));
        }

        // --- NEGATIVE 5: IPK Boundaries (>4.00) ---
        $this->info("Testing Negative Case 5: IPK boundary > 4.00 (value: 4.01)");
        try {
            $form = new FormKuisioner();
            $form->mount();
            $form->currentStep = 2;
            $form->pendidikan_tertinggi = 'Sarjana (S1)';
            $form->campus_id = 157;
            $form->program_studi = 'Teknik Informatika';
            $form->tahun_lulus = 2022;
            $form->ipk = 4.01; // Too high
            $form->melanjutkan_pendidikan = 'Tidak';
            $form->pernah_sertifikasi_lsp = 'Tidak';

            $form->nextStep();
            $this->error("[DISCREPANCY] IPK > 4.00 passed validation!");
            $discrepancies[] = "IPK 4.01 (above 4.00) was allowed to pass.";
        } catch (ValidationException $e) {
            $this->info("[PASS] Catch expected validation error for IPK (>4.00): " . $e->validator->errors()->first('ipk'));
        }

        // --- NEGATIVE 6: Graduation Year Boundaries (<2015) ---
        $this->info("Testing Negative Case 6: Graduation Year < 2015 (value: 2014)");
        try {
            $form = new FormKuisioner();
            $form->mount();
            $form->currentStep = 2;
            $form->pendidikan_tertinggi = 'Sarjana (S1)';
            $form->campus_id = 157;
            $form->program_studi = 'Teknik Informatika';
            $form->tahun_lulus = 2014; // Too early
            $form->ipk = 3.50;
            $form->melanjutkan_pendidikan = 'Tidak';
            $form->pernah_sertifikasi_lsp = 'Tidak';

            $form->nextStep();
            $this->error("[DISCREPANCY] Graduation Year < 2015 passed validation!");
            $discrepancies[] = "Graduation Year 2014 was allowed to pass.";
        } catch (ValidationException $e) {
            $this->info("[PASS] Catch expected validation error for Graduation Year (<2015): " . $e->validator->errors()->first('tahun_lulus'));
        }

        // --- NEGATIVE 7: Graduation Year Boundaries (>2026) ---
        $this->info("Testing Negative Case 7: Graduation Year > 2026 (value: 2027)");
        try {
            $form = new FormKuisioner();
            $form->mount();
            $form->currentStep = 2;
            $form->pendidikan_tertinggi = 'Sarjana (S1)';
            $form->campus_id = 157;
            $form->program_studi = 'Teknik Informatika';
            $form->tahun_lulus = 2027; // Too late
            $form->ipk = 3.50;
            $form->melanjutkan_pendidikan = 'Tidak';
            $form->pernah_sertifikasi_lsp = 'Tidak';

            $form->nextStep();
            $this->error("[DISCREPANCY] Graduation Year > 2026 passed validation!");
            $discrepancies[] = "Graduation Year 2027 was allowed to pass.";
        } catch (ValidationException $e) {
            $this->info("[PASS] Catch expected validation error for Graduation Year (>2026): " . $e->validator->errors()->first('tahun_lulus'));
        }

        // --- NEGATIVE 8: Job Wait Time Boundaries (>60) ---
        $this->info("Testing Negative Case 8: Job Wait Time > 60 months (value: 61)");
        try {
            $form = new FormKuisioner();
            $form->mount();
            $form->currentStep = 3;
            $form->bekerja_seminggu_terakhir = 'Ya';
            $form->pekerjaan_dimulai_setelah_lulus = 'Ya';
            $form->waktu_tunggu_kerja = 61; // Too high
            $form->status_pekerjaan = 'Karyawan/pegawai/buruh';
            $form->gaji_bulanan = 5000000;
            $form->gaji_perbandingan_umr = 'Sebesar (sama atau mirip) dengan UMR';
            $form->tahun_mulai_bekerja = 2023;
            $form->isco_code = '2512';
            $form->jumlah_jam_kerja = 40;
            $form->nama_perusahaan = 'Test Corp';
            $form->jenis_perusahaan = 'Perusahaan/institusi berorientasi profit (PT, CV, UD, BUMN, BUMD)';
            $form->jumlah_karyawan = '5 s.d 19 karyawan (usaha kecil)';
            $form->isic_code = 'K2';
            $form->punya_pekerjaan_tambahan = 'Tidak';
            $form->pernah_bekerja_sebelumnya_lain = 'Tidak';

            $form->nextStep();
            $this->error("[DISCREPANCY] Job Wait Time > 60 passed validation!");
            $discrepancies[] = "Job Wait Time 61 months was allowed to pass.";
        } catch (ValidationException $e) {
            $this->info("[PASS] Catch expected validation error for Wait Time (>60): " . $e->validator->errors()->first('waktu_tunggu_kerja'));
        }

        // --- NEGATIVE 9: Jam Kerja Boundaries (>84) ---
        $this->info("Testing Negative Case 9: Working Hours > 84 hours/week (value: 85)");
        try {
            $form = new FormKuisioner();
            $form->mount();
            $form->currentStep = 3;
            $form->bekerja_seminggu_terakhir = 'Ya';
            $form->pekerjaan_dimulai_setelah_lulus = 'Ya';
            $form->waktu_tunggu_kerja = 3;
            $form->status_pekerjaan = 'Karyawan/pegawai/buruh';
            $form->gaji_bulanan = 5000000;
            $form->gaji_perbandingan_umr = 'Sebesar (sama atau mirip) dengan UMR';
            $form->tahun_mulai_bekerja = 2023;
            $form->isco_code = '2512';
            $form->jumlah_jam_kerja = 85; // Too high
            $form->ada_lembur = 'Ya';
            $form->nama_perusahaan = 'Test Corp';
            $form->jenis_perusahaan = 'Perusahaan/institusi berorientasi profit (PT, CV, UD, BUMN, BUMD)';
            $form->jumlah_karyawan = '5 s.d 19 karyawan (usaha kecil)';
            $form->isic_code = 'K2';
            $form->punya_pekerjaan_tambahan = 'Tidak';
            $form->pernah_bekerja_sebelumnya_lain = 'Tidak';

            $form->nextStep();
            $this->error("[DISCREPANCY] Working Hours > 84 passed validation!");
            $discrepancies[] = "Working Hours 85 was allowed to pass.";
        } catch (ValidationException $e) {
            $this->info("[PASS] Catch expected validation error for Working Hours (>84): " . $e->validator->errors()->first('jumlah_jam_kerja'));
        }

        // --- NEGATIVE 10: Numbers in Full Name ---
        $this->info("Testing Negative Case 10: Filling numbers in Full Name (value: 'Dummy 2')");
        try {
            $form = new FormKuisioner();
            $form->mount();
            $form->currentStep = 1;
            $form->email = 'dummy_name_numeric@gmail.com';
            $form->nama = 'Dummy 2'; // Contains numbers!
            $form->jenis_kelamin = 'Laki-Laki';
            $form->usia = 25;
            $form->status_pernikahan = 'Belum Menikah';
            $form->punya_anak = 'Tidak';
            $form->selectedProvince = '32';
            $form->selectedCity = '3273';
            $form->tipe_tempat_tinggal = 'Perkotaan';

            $form->nextStep();
            $this->error("[DISCREPANCY] Numbers in Full Name ('Dummy 2') passed validation!");
            $discrepancies[] = "Numbers in name ('Dummy 2') were allowed to pass.";
        } catch (ValidationException $e) {
            $this->info("[PASS] Catch expected validation error for Name (numbers): " . $e->validator->errors()->first('nama'));
        }

        // --- NEGATIVE 10a: Punctuation in Full Name ---
        $this->info("Testing Negative Case 10a: Filling punctuation in Full Name (value: 'Dummy, Jr.')");
        try {
            $form = new FormKuisioner();
            $form->mount();
            $form->currentStep = 1;
            $form->email = 'dummy_name_punct@gmail.com';
            $form->nama = 'Dummy, Jr.'; // Contains punctuation!
            $form->jenis_kelamin = 'Laki-Laki';
            $form->usia = 25;
            $form->status_pernikahan = 'Belum Menikah';
            $form->punya_anak = 'Tidak';
            $form->selectedProvince = '32';
            $form->selectedCity = '3273';
            $form->tipe_tempat_tinggal = 'Perkotaan';

            $form->nextStep();
            $this->error("[DISCREPANCY] Punctuation in Full Name ('Dummy, Jr.') passed validation!");
            $discrepancies[] = "Punctuation in name ('Dummy, Jr.') was allowed to pass.";
        } catch (ValidationException $e) {
            $this->info("[PASS] Catch expected validation error for Name (punctuation): " . $e->validator->errors()->first('nama'));
        }

        // --- NEGATIVE 11: Letters in Age ---
        $this->info("Testing Negative Case 11: Filling letters in Age (value: 'tiga puluh')");
        try {
            $form = new FormKuisioner();
            $form->mount();
            $form->currentStep = 1;
            $form->email = 'dummy_age_letters@gmail.com';
            $form->nama = 'Dummy Age Letters';
            $form->jenis_kelamin = 'Laki-Laki';
            $form->usia = 'tiga puluh'; // Letters!
            $form->status_pernikahan = 'Belum Menikah';
            $form->punya_anak = 'Tidak';
            $form->selectedProvince = '32';
            $form->selectedCity = '3273';
            $form->tipe_tempat_tinggal = 'Perkotaan';

            $form->nextStep();
            $this->error("[DISCREPANCY] Letters in Age passed validation!");
            $discrepancies[] = "Letters in Age ('tiga puluh') was allowed to pass.";
        } catch (ValidationException $e) {
            $this->info("[PASS] Catch expected validation error for Age (letters): " . $e->validator->errors()->first('usia'));
        }

        // --- NEGATIVE 12: Letters in IPK ---
        $this->info("Testing Negative Case 12: Filling letters in IPK (value: 'tiga koma lima')");
        try {
            $form = new FormKuisioner();
            $form->mount();
            $form->currentStep = 2;
            $form->pendidikan_tertinggi = 'Sarjana (S1)';
            $form->campus_id = 157;
            $form->program_studi = 'Teknik Informatika';
            $form->tahun_lulus = 2022;
            $form->ipk = 'tiga koma lima'; // Letters!
            $form->melanjutkan_pendidikan = 'Tidak';
            $form->pernah_sertifikasi_lsp = 'Tidak';

            $form->nextStep();
            $this->error("[DISCREPANCY] Letters in IPK passed validation!");
            $discrepancies[] = "Letters in IPK ('tiga koma lima') was allowed to pass.";
        } catch (ValidationException $e) {
            $this->info("[PASS] Catch expected validation error for IPK (letters): " . $e->validator->errors()->first('ipk'));
        }

        // --- NEGATIVE 13: Letters in Graduation Year ---
        $this->info("Testing Negative Case 13: Filling letters in Graduation Year (value: 'dua ribu dua puluh')");
        try {
            $form = new FormKuisioner();
            $form->mount();
            $form->currentStep = 2;
            $form->pendidikan_tertinggi = 'Sarjana (S1)';
            $form->campus_id = 157;
            $form->program_studi = 'Teknik Informatika';
            $form->tahun_lulus = 'dua ribu dua puluh'; // Letters!
            $form->ipk = 3.50;
            $form->melanjutkan_pendidikan = 'Tidak';
            $form->pernah_sertifikasi_lsp = 'Tidak';

            $form->nextStep();
            $this->error("[DISCREPANCY] Letters in Graduation Year passed validation!");
            $discrepancies[] = "Letters in Graduation Year ('dua ribu dua puluh') was allowed to pass.";
        } catch (ValidationException $e) {
            $this->info("[PASS] Catch expected validation error for Graduation Year (letters): " . $e->validator->errors()->first('tahun_lulus'));
        }

        // --- NEGATIVE 14: Letters in Job Wait Time ---
        $this->info("Testing Negative Case 14: Filling letters in Job Wait Time (value: 'tiga bulan')");
        try {
            $form = new FormKuisioner();
            $form->mount();
            $form->currentStep = 3;
            $form->bekerja_seminggu_terakhir = 'Ya';
            $form->pekerjaan_dimulai_setelah_lulus = 'Ya';
            $form->waktu_tunggu_kerja = 'tiga bulan'; // Letters!
            $form->status_pekerjaan = 'Karyawan/pegawai/buruh';
            $form->gaji_bulanan = 5000000;
            $form->gaji_perbandingan_umr = 'Sebesar (sama atau mirip) dengan UMR';
            $form->tahun_mulai_bekerja = 2023;
            $form->isco_code = '2512';
            $form->jumlah_jam_kerja = 40;
            $form->nama_perusahaan = 'Test Corp';
            $form->jenis_perusahaan = 'Perusahaan/institusi berorientasi profit (PT, CV, UD, BUMN, BUMD)';
            $form->jumlah_karyawan = '5 s.d 19 karyawan (usaha kecil)';
            $form->isic_code = 'K2';
            $form->punya_pekerjaan_tambahan = 'Tidak';
            $form->pernah_bekerja_sebelumnya_lain = 'Tidak';

            $form->nextStep();
            $this->error("[DISCREPANCY] Letters in Job Wait Time passed validation!");
            $discrepancies[] = "Letters in Job Wait Time ('tiga bulan') was allowed to pass.";
        } catch (ValidationException $e) {
            $this->info("[PASS] Catch expected validation error for Job Wait Time (letters): " . $e->validator->errors()->first('waktu_tunggu_kerja'));
        }

        // --- NEGATIVE 15: Letters in Working Hours ---
        $this->info("Testing Negative Case 15: Filling letters in Working Hours (value: 'empat puluh')");
        try {
            $form = new FormKuisioner();
            $form->mount();
            $form->currentStep = 3;
            $form->bekerja_seminggu_terakhir = 'Ya';
            $form->pekerjaan_dimulai_setelah_lulus = 'Ya';
            $form->waktu_tunggu_kerja = 3;
            $form->status_pekerjaan = 'Karyawan/pegawai/buruh';
            $form->gaji_bulanan = 5000000;
            $form->gaji_perbandingan_umr = 'Sebesar (sama atau mirip) dengan UMR';
            $form->tahun_mulai_bekerja = 2023;
            $form->isco_code = '2512';
            $form->jumlah_jam_kerja = 'empat puluh'; // Letters!
            $form->nama_perusahaan = 'Test Corp';
            $form->jenis_perusahaan = 'Perusahaan/institusi berorientasi profit (PT, CV, UD, BUMN, BUMD)';
            $form->jumlah_karyawan = '5 s.d 19 karyawan (usaha kecil)';
            $form->isic_code = 'K2';
            $form->punya_pekerjaan_tambahan = 'Tidak';
            $form->pernah_bekerja_sebelumnya_lain = 'Tidak';

            $form->nextStep();
            $this->error("[DISCREPANCY] Letters in Working Hours passed validation!");
            $discrepancies[] = "Letters in Working Hours ('empat puluh') was allowed to pass.";
        } catch (ValidationException $e) {
            $this->info("[PASS] Catch expected validation error for Working Hours (letters): " . $e->validator->errors()->first('jumlah_jam_kerja'));
        }

        // --- NEGATIVE 16: Invalid value in Dropdown ---
        $this->info("Testing Negative Case 16: Filling invalid option in Dropdown (value: 'Other' for jenis_kelamin)");
        try {
            $form = new FormKuisioner();
            $form->mount();
            $form->currentStep = 1;
            $form->email = 'dummy_gender_invalid@gmail.com';
            $form->nama = 'Dummy Gender Invalid';
            $form->jenis_kelamin = 'Other'; // Invalid option!
            $form->usia = 25;
            $form->status_pernikahan = 'Belum Menikah';
            $form->punya_anak = 'Tidak';
            $form->selectedProvince = '32';
            $form->selectedCity = '3273';
            $form->tipe_tempat_tinggal = 'Perkotaan';

            $form->nextStep();
            $this->error("[DISCREPANCY] Invalid gender option passed validation!");
            $discrepancies[] = "Invalid gender option ('Other') was allowed to pass.";
        } catch (ValidationException $e) {
            $this->info("[PASS] Catch expected validation error for Gender (invalid): " . $e->validator->errors()->first('jenis_kelamin'));
        }

        // ==========================================
        // 3. REPORTING RESULTS SUMMARY
        // ==========================================
        $this->info("\n==================================================");
        $this->info("TESTING RUN COMPLETED");
        $this->info("==================================================");
        
        $this->info("Scenario Execution Summary:");
        foreach ($results as $scen => $status) {
            if ($status === 'SUCCESS') {
                $this->line("- {$scen}: <info>{$status}</info>");
            } else {
                $this->line("- {$scen}: <error>{$status}</error>");
            }
        }

        $this->info("\nDiscrepancies / Anomalies Found:");
        if (empty($discrepancies)) {
            $this->info("No discrepancies found between validation code and update kuisioner.xlsx boundaries!");
        } else {
            foreach ($discrepancies as $disc) {
                $this->line("- <comment>{$disc}</comment>");
            }
        }
        $this->info("==================================================");
    }
}
