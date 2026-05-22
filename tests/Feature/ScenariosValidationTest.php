<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Campus;
use App\Models\CompetencyScheme;
use App\Models\Isco;
use App\Models\Isic;
use App\Models\Respondent;
use App\Livewire\FormKuisioner;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScenariosValidationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed Laravolt Indonesia records for testing
        \DB::table('indonesia_provinces')->insert([
            ['code' => '31', 'name' => 'DKI JAKARTA'],
            ['code' => '32', 'name' => 'JAWA BARAT'],
            ['code' => '33', 'name' => 'JAWA TENGAH'],
            ['code' => '35', 'name' => 'JAWA TIMUR'],
        ]);
        
        \DB::table('indonesia_cities')->insert([
            ['code' => '3174', 'province_code' => '31', 'name' => 'KOTA JAKARTA SELATAN'],
            ['code' => '3273', 'province_code' => '32', 'name' => 'KOTA BANDUNG'],
            ['code' => '3302', 'province_code' => '33', 'name' => 'KABUPATEN BANYUMAS'],
            ['code' => '3573', 'province_code' => '35', 'name' => 'KOTA MALANG'],
        ]);

        // Seed Lookups using DB inserts to preserve explicit IDs
        \DB::table('campuses')->insert([
            ['id' => 157, 'name' => 'AKPINDO-STEIN']
        ]);
        
        \DB::table('competency_schemes')->insert([
            ['id' => 1868, 'campus_id' => 157, 'name' => 'Baker']
        ]);

        // ISCO levels
        Isco::create(['level' => 1, 'code' => '1', 'title_en' => 'Managers', 'title_id' => 'Manajer']);
        Isco::create(['level' => 2, 'code' => '13', 'title_en' => 'Production and Specialized Services Managers', 'title_id' => 'Manajer Layanan Khusus']);
        Isco::create(['level' => 3, 'code' => '133', 'title_en' => 'Information and Communications Technology Services Managers', 'title_id' => 'Manajer IT']);
        Isco::create(['level' => 4, 'code' => '1330', 'title_en' => 'Information and Communications Technology Services Managers', 'title_id' => 'Manajer IT']);

        Isco::create(['level' => 1, 'code' => '2', 'title_en' => 'Professionals', 'title_id' => 'Profesional']);
        Isco::create(['level' => 2, 'code' => '25', 'title_en' => 'Information and Communications Technology Professionals', 'title_id' => 'Profesional TIK']);
        Isco::create(['level' => 3, 'code' => '251', 'title_en' => 'Software and Applications Developers and Analysts', 'title_id' => 'Pengembang Aplikasi']);
        Isco::create(['level' => 4, 'code' => '2512', 'title_en' => 'Software Developers', 'title_id' => 'Pengembang Perangkat Lunak']);

        Isco::create(['level' => 2, 'code' => '21', 'title_en' => 'Science and Engineering Professionals', 'title_id' => 'Profesional Sains']);
        Isco::create(['level' => 3, 'code' => '216', 'title_en' => 'Architects, Planners, Surveyors and Designers', 'title_id' => 'Desainer']);
        Isco::create(['level' => 4, 'code' => '2166', 'title_en' => 'Graphic and Multimedia Designers', 'title_id' => 'Desainer Grafis']);

        Isco::create(['level' => 1, 'code' => '7', 'title_en' => 'Craft and Related Trades Workers', 'title_id' => 'Pekerja Kerajinan']);
        Isco::create(['level' => 2, 'code' => '72', 'title_en' => 'Metal, Machinery and Related Trades Workers', 'title_id' => 'Pekerja Logam']);
        Isco::create(['level' => 3, 'code' => '722', 'title_en' => 'Blacksmiths, Toolmakers and Related Trades Workers', 'title_id' => 'Pembuat Perkakas']);
        Isco::create(['level' => 4, 'code' => '7223', 'title_en' => 'Metal Working Machine Tool Setters and Operators', 'title_id' => 'Operator Mesin Logam']);

        // ISIC levels
        Isic::create(['code' => 'K', 'title_en' => 'Financial and insurance activities', 'title_id' => 'Aktivitas Keuangan']);
        Isic::create(['code' => 'K2', 'title_en' => 'Insurance, reinsurance and pension funding', 'title_id' => 'Asuransi']);

        Isic::create(['code' => 'N', 'title_en' => 'Administrative and support service activities', 'title_id' => 'Aktivitas Administrasi']);
        Isic::create(['code' => 'N6', 'title_en' => 'Office administrative, office support and other business support activities', 'title_id' => 'Penyediaan Jasa Kantor']);
    }

    /**
     * Test Positive Skenario 1 (Jalur Maksimal)
     */
    public function test_positive_scenario_1()
    {
        Livewire::test(FormKuisioner::class)
            // Step 1
            ->set('currentStep', 1)
            ->set('email', 'dummy2@gmail.com')
            ->set('nama', 'Dummy Two')
            ->set('jenis_kelamin', 'Laki-Laki')
            ->set('usia', 28)
            ->set('status_pernikahan', 'Menikah')
            ->set('punya_anak', 'Ya')
            ->set('jumlah_anak', 2)
            ->set('selectedProvince', '32')
            ->set('selectedCity', '3273')
            ->set('tipe_tempat_tinggal', 'Perkotaan')
            ->call('nextStep')
            ->assertHasNoErrors()
            ->assertSet('currentStep', 2)

            // Step 2
            ->set('pendidikan_tertinggi', 'Sarjana (S1)')
            ->set('campus_id', 157)
            ->set('program_studi', 'Teknik Informatika')
            ->set('tahun_lulus', 2021)
            ->set('ipk', 3.75)
            ->set('melanjutkan_pendidikan', 'Tidak')
            ->set('pernah_sertifikasi_lsp', 'Ya')
            ->set('dapat_sertifikat_bnsp', 'Ya')
            ->set('competency_scheme_id', 1868)
            ->call('nextStep')
            ->assertHasNoErrors()
            ->assertSet('currentStep', 3)

            // Step 3
            ->set('bekerja_seminggu_terakhir', 'Ya')
            ->set('pekerjaan_dimulai_setelah_lulus', 'Ya')
            ->set('waktu_tunggu_kerja', 3)
            ->set('status_pekerjaan', 'Karyawan/pegawai/buruh')
            ->set('gaji_bulanan', 12500000)
            ->set('gaji_perbandingan_umr', 'Lebih besar dari UMR')
            ->set('tahun_mulai_bekerja', 2022)
            ->set('isco_l1', '1')
            ->set('isco_l2', '13')
            ->set('isco_l3', '133')
            ->set('isco_l4', '1330')
            ->set('jumlah_jam_kerja', 45)
            ->set('ada_lembur', 'Ya')
            ->set('nama_perusahaan', 'PT Solusi Teknologi Indonesia')
            ->set('jenis_perusahaan', 'Perusahaan/institusi berorientasi profit (PT, CV, UD, BUMN, BUMD)')
            ->set('jumlah_karyawan', '20 s.d 99 karyawan (usaha menengah)')
            ->set('selectedIsicSector', 'K')
            ->set('isic_code', 'K2')
            ->set('punya_pekerjaan_tambahan', 'Ya')
            ->set('status_pekerjaan_tambahan', 'Berusaha sendiri/wiraswasta')
            ->set('pekerjaan_tambahan_isco_l1', '2')
            ->set('pekerjaan_tambahan_isco_l2', '25')
            ->set('pekerjaan_tambahan_isco_l3', '251')
            ->set('pekerjaan_tambahan_isco_l4', '2512')
            ->set('jumlah_jam_kerja_tambahan', 10)
            ->set('pernah_bekerja_sebelumnya_lain', 'Tidak')
            ->call('nextStep')
            ->assertHasNoErrors()
            ->assertSet('currentStep', 4)

            // Step 4
            ->set('kesesuaian_bidang_ijazah', 'Sangat Sesuai')
            ->set('kesesuaian_jenjang_pendidikan', 'Jenjang pendidikan saya sudah sesuai dengan pekerjaan ini')
            ->set('jenjang_paling_sesuai', 'Strata 1')
            ->set('bnsp_mudahkan_dapat_kerja', 'Sangat Mendukung')
            ->set('perusahaan_hargai_bnsp', 'Sangat menyambut baik')
            ->set('bnsp_tingkatkan_karir', 'Sangat Berdampak Terhadap Peningkatan Karir')
            ->set('bnsp_tingkatkan_gaji', 'Berdampak Terhadap Peningkatan Pendapatan/Gaji')
            ->set('kesesuaian_bidang_bnsp', 'Ya')
            ->set('jabatan_sebelum_bnsp', 'Junior Programmer')
            ->set('jabatan_setelah_bnsp', 'Senior Developer / Team Lead')
            ->call('submit')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('respondents', [
            'email' => 'dummy2@gmail.com',
            'nama' => 'Dummy Two',
            'pendidikan_tertinggi' => 'Sarjana (S1)',
            'campus_id' => 157,
            'competency_scheme_id' => 1868,
            'bekerja_seminggu_terakhir' => 'Ya',
            'gaji_bulanan' => 12500000,
        ]);
    }

    /**
     * Test Positive Skenario 2 (Jalur Wiraswasta Freelance)
     */
    public function test_positive_scenario_2()
    {
        Livewire::test(FormKuisioner::class)
            // Step 1
            ->set('currentStep', 1)
            ->set('email', 'dummy3@gmail.com')
            ->set('nama', 'Dummy Three')
            ->set('jenis_kelamin', 'Perempuan')
            ->set('usia', 25)
            ->set('status_pernikahan', 'Belum Menikah')
            ->set('punya_anak', 'Tidak')
            ->set('selectedProvince', '31')
            ->set('selectedCity', '3174')
            ->set('tipe_tempat_tinggal', 'Perkotaan')
            ->call('nextStep')
            ->assertHasNoErrors()
            ->assertSet('currentStep', 2)

            // Step 2
            ->set('pendidikan_tertinggi', 'Diploma 3')
            ->set('campus_id', 157)
            ->set('program_studi', 'Desain Grafis')
            ->set('tahun_lulus', 2022)
            ->set('ipk', 3.40)
            ->set('melanjutkan_pendidikan', 'Tidak')
            ->set('pernah_sertifikasi_lsp', 'Ya')
            ->set('dapat_sertifikat_bnsp', 'Ya')
            ->set('competency_scheme_id', 'other')
            ->set('skema_sertifikasi_lainnya', 'Skema Desainer Grafis Madya')
            ->call('nextStep')
            ->assertHasNoErrors()
            ->assertSet('currentStep', 3)

            // Step 3
            ->set('bekerja_seminggu_terakhir', 'Ya')
            ->set('pekerjaan_dimulai_setelah_lulus', 'Ya')
            ->set('waktu_tunggu_kerja', 2)
            ->set('status_pekerjaan', 'Pekerja lepas non-pertanian')
            ->set('gaji_bulanan', 6000000)
            ->set('gaji_perbandingan_umr', 'Sebesar (sama atau mirip) dengan UMR')
            ->set('tahun_mulai_bekerja', 2022)
            ->set('isco_l1', '2')
            ->set('isco_l2', '21')
            ->set('isco_l3', '216')
            ->set('isco_l4', '2166')
            ->set('jumlah_jam_kerja', 35)
            ->set('nama_perusahaan', 'Desain Mandiri Kreatif')
            ->set('jenis_perusahaan', 'Wirausahawan/perusahaan sendiri/usaha rumahan')
            ->set('jumlah_karyawan', '1 s.d 4 karyawan (usaha mikro/usaha rumahan)')
            ->set('selectedIsicSector', 'N')
            ->set('isic_code', 'N6')
            ->set('punya_pekerjaan_tambahan', 'Tidak')
            ->set('pernah_bekerja_sebelumnya_lain', 'Tidak')
            ->call('nextStep')
            ->assertHasNoErrors()
            ->assertSet('currentStep', 4)

            // Step 4
            ->set('kesesuaian_bidang_ijazah', 'Sesuai')
            ->set('kesesuaian_jenjang_pendidikan', 'Jenjang pendidikan saya sudah sesuai dengan pekerjaan ini')
            ->set('jenjang_paling_sesuai', 'Diploma 1, 2, atau 3')
            ->set('bnsp_mudahkan_dapat_kerja', 'Cukup Mendukung')
            ->set('perusahaan_hargai_bnsp', 'Menyambut baik')
            ->set('bnsp_tingkatkan_karir', 'Berdampak Terhadap Peningkatan Karir')
            ->set('bnsp_tingkatkan_gaji', 'Tidak Berdampak Terhadap Peningkatan Pendapatan/Gaji Sama Sekali')
            ->set('kesesuaian_bidang_bnsp', 'Ya')
            ->set('jabatan_sebelum_bnsp', 'Freelance Designer')
            ->set('jabatan_setelah_bnsp', 'Lead Creative Designer')
            ->call('submit')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('respondents', [
            'email' => 'dummy3@gmail.com',
            'nama' => 'Dummy Three',
            'pendidikan_tertinggi' => 'Diploma 3',
            'skema_sertifikasi' => 'Skema Desainer Grafis Madya',
            'bekerja_seminggu_terakhir' => 'Ya',
        ]);
    }

    /**
     * Test Positive Skenario 3 (Jalur Menganggur, Pernah Bekerja, Sertifikasi Gagal)
     */
    public function test_positive_scenario_3()
    {
        Livewire::test(FormKuisioner::class)
            // Step 1
            ->set('currentStep', 1)
            ->set('email', 'dummy4@gmail.com')
            ->set('nama', 'Dummy Four')
            ->set('jenis_kelamin', 'Laki-Laki')
            ->set('usia', 32)
            ->set('status_pernikahan', 'Menikah')
            ->set('punya_anak', 'Ya')
            ->set('jumlah_anak', 1)
            ->set('selectedProvince', '33')
            ->set('selectedCity', '3302')
            ->set('tipe_tempat_tinggal', 'Pedesaan')
            ->call('nextStep')
            ->assertHasNoErrors()
            ->assertSet('currentStep', 2)

            // Step 2
            ->set('pendidikan_tertinggi', 'Diploma 4')
            ->set('campus_id', 157)
            ->set('program_studi', 'Teknik Mesin')
            ->set('tahun_lulus', 2018)
            ->set('ipk', 3.15)
            ->set('melanjutkan_pendidikan', 'Tidak')
            ->set('pernah_sertifikasi_lsp', 'Ya')
            ->set('dapat_sertifikat_bnsp', 'Tidak')
            ->call('nextStep')
            ->assertHasNoErrors()
            ->assertSet('currentStep', 3)

            // Step 3
            ->set('bekerja_seminggu_terakhir', 'Tidak')
            ->set('punya_pekerjaan_tapi_tidak_bekerja', 'Tidak')
            ->set('pernah_bekerja_sebelumnya', 'Ya')
            ->set('prev_isco_l1', '7')
            ->set('prev_isco_l2', '72')
            ->set('prev_isco_l3', '722')
            ->set('prev_isco_l4', '7223')
            ->set('alasan_tidak_bekerja', 'Masih sedang mencari pekerjaan')
            ->call('nextStep')
            ->assertHasNoErrors()
            ->assertSet('currentStep', 4)

            // Step 4
            ->call('submit')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('respondents', [
            'email' => 'dummy4@gmail.com',
            'nama' => 'Dummy Four',
            'pendidikan_tertinggi' => 'Diploma 4',
            'bekerja_seminggu_terakhir' => 'Tidak',
            'pernah_bekerja_sebelumnya' => 'Ya',
        ]);
    }

    /**
     * Test Positive Skenario 4 (Jalur Lulusan SMA, Menganggur Fresh Grad)
     */
    public function test_positive_scenario_4()
    {
        Livewire::test(FormKuisioner::class)
            // Step 1
            ->set('currentStep', 1)
            ->set('email', 'dummy5@gmail.com')
            ->set('nama', 'Dummy Five')
            ->set('jenis_kelamin', 'Perempuan')
            ->set('usia', 19)
            ->set('status_pernikahan', 'Belum Menikah')
            ->set('punya_anak', 'Tidak')
            ->set('selectedProvince', '35')
            ->set('selectedCity', '3573')
            ->set('tipe_tempat_tinggal', 'Perkotaan')
            ->call('nextStep')
            ->assertHasNoErrors()
            ->assertSet('currentStep', 2)

            // Step 2
            ->set('pendidikan_tertinggi', 'SMA/Sederajat')
            ->set('nama_sekolah', 'SMAN 1 Malang')
            ->set('pernah_sertifikasi_lsp', 'Tidak')
            ->call('nextStep')
            ->assertHasNoErrors()
            ->assertSet('currentStep', 3)

            // Step 3
            ->set('bekerja_seminggu_terakhir', 'Tidak')
            ->set('punya_pekerjaan_tapi_tidak_bekerja', 'Tidak')
            ->set('pernah_bekerja_sebelumnya', 'Tidak')
            ->set('alasan_tidak_bekerja', 'Sedang studi lanjut / tugas belajar')
            ->call('nextStep')
            ->assertHasNoErrors()
            ->assertSet('currentStep', 4)

            // Step 4
            ->call('submit')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('respondents', [
            'email' => 'dummy5@gmail.com',
            'nama' => 'Dummy Five',
            'pendidikan_tertinggi' => 'SMA/Sederajat',
            'nama_sekolah' => 'SMAN 1 Malang',
            'bekerja_seminggu_terakhir' => 'Tidak',
            'pernah_bekerja_sebelumnya' => 'Tidak',
        ]);
    }

    /**
     * Test Negative Cases (Validation Rules)
     */
    public function test_negative_validations()
    {
        // 1. Email format without '@'
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 1)
            ->set('email', 'dummy_invalid.com')
            ->call('nextStep')
            ->assertHasErrors(['email']);

        // 1a. Name containing numbers
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 1)
            ->set('nama', 'Dummy 2')
            ->call('nextStep')
            ->assertHasErrors(['nama']);

        // 1b. Name containing punctuation (like dots/commas)
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 1)
            ->set('nama', 'Dummy, Jr.')
            ->call('nextStep')
            ->assertHasErrors(['nama']);

        // 2. Age < 15
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 1)
            ->set('usia', 14)
            ->call('nextStep')
            ->assertHasErrors(['usia']);

        // 3. Age > 70
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 1)
            ->set('usia', 71)
            ->call('nextStep')
            ->assertHasErrors(['usia']);

        // 4. IPK < 2.50
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 2)
            ->set('pendidikan_tertinggi', 'Sarjana (S1)')
            ->set('campus_id', 157)
            ->set('program_studi', 'Teknik Informatika')
            ->set('tahun_lulus', 2022)
            ->set('ipk', 2.49)
            ->call('nextStep')
            ->assertHasErrors(['ipk']);

        // 5. IPK > 4.00
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 2)
            ->set('pendidikan_tertinggi', 'Sarjana (S1)')
            ->set('campus_id', 157)
            ->set('program_studi', 'Teknik Informatika')
            ->set('tahun_lulus', 2022)
            ->set('ipk', 4.01)
            ->call('nextStep')
            ->assertHasErrors(['ipk']);

        // 6. Graduation Year < 2015
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 2)
            ->set('pendidikan_tertinggi', 'Sarjana (S1)')
            ->set('campus_id', 157)
            ->set('program_studi', 'Teknik Informatika')
            ->set('tahun_lulus', 2014)
            ->set('ipk', 3.50)
            ->call('nextStep')
            ->assertHasErrors(['tahun_lulus']);

        // 7. Graduation Year > 2026
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 2)
            ->set('pendidikan_tertinggi', 'Sarjana (S1)')
            ->set('campus_id', 157)
            ->set('program_studi', 'Teknik Informatika')
            ->set('tahun_lulus', 2027)
            ->set('ipk', 3.50)
            ->call('nextStep')
            ->assertHasErrors(['tahun_lulus']);

        // 8. Job Wait Time > 60 months
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 3)
            ->set('bekerja_seminggu_terakhir', 'Ya')
            ->set('pekerjaan_dimulai_setelah_lulus', 'Ya')
            ->set('waktu_tunggu_kerja', 61)
            ->call('nextStep')
            ->assertHasErrors(['waktu_tunggu_kerja']);

        // 9. Jam Kerja > 84
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 3)
            ->set('bekerja_seminggu_terakhir', 'Ya')
            ->set('pekerjaan_dimulai_setelah_lulus', 'Ya')
            ->set('waktu_tunggu_kerja', 3)
            ->set('status_pekerjaan', 'Karyawan/pegawai/buruh')
            ->set('gaji_bulanan', 5000000)
            ->set('gaji_perbandingan_umr', 'Sebesar (sama atau mirip) dengan UMR')
            ->set('tahun_mulai_bekerja', 2023)
            ->set('isco_code', '2512')
            ->set('jumlah_jam_kerja', 85)
            ->call('nextStep')
            ->assertHasErrors(['jumlah_jam_kerja']);

        // 10. Letters in Age
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 1)
            ->set('usia', 'tiga puluh')
            ->call('nextStep')
            ->assertHasErrors(['usia']);

        // 11. Letters in IPK
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 2)
            ->set('pendidikan_tertinggi', 'Sarjana (S1)')
            ->set('campus_id', 157)
            ->set('program_studi', 'Teknik Informatika')
            ->set('tahun_lulus', 2022)
            ->set('ipk', 'tiga koma lima')
            ->call('nextStep')
            ->assertHasErrors(['ipk']);

        // 12. Letters in Graduation Year
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 2)
            ->set('pendidikan_tertinggi', 'Sarjana (S1)')
            ->set('campus_id', 157)
            ->set('program_studi', 'Teknik Informatika')
            ->set('tahun_lulus', 'dua ribu dua puluh')
            ->set('ipk', 3.50)
            ->call('nextStep')
            ->assertHasErrors(['tahun_lulus']);

        // 13. Letters in Job Wait Time
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 3)
            ->set('bekerja_seminggu_terakhir', 'Ya')
            ->set('pekerjaan_dimulai_setelah_lulus', 'Ya')
            ->set('waktu_tunggu_kerja', 'tiga bulan')
            ->call('nextStep')
            ->assertHasErrors(['waktu_tunggu_kerja']);

        // 14. Letters in Jam Kerja
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 3)
            ->set('bekerja_seminggu_terakhir', 'Ya')
            ->set('pekerjaan_dimulai_setelah_lulus', 'Ya')
            ->set('waktu_tunggu_kerja', 3)
            ->set('status_pekerjaan', 'Karyawan/pegawai/buruh')
            ->set('gaji_bulanan', 5000000)
            ->set('gaji_perbandingan_umr', 'Sebesar (sama atau mirip) dengan UMR')
            ->set('tahun_mulai_bekerja', 2023)
            ->set('isco_code', '2512')
            ->set('jumlah_jam_kerja', 'empat puluh')
            ->call('nextStep')
            ->assertHasErrors(['jumlah_jam_kerja']);

        // 15. Invalid value in Dropdown (jenis_kelamin = 'Other')
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 1)
            ->set('jenis_kelamin', 'Other')
            ->call('nextStep')
            ->assertHasErrors(['jenis_kelamin']);
    }
}
