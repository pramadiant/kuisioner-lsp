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

class FormKuisionerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed basic Laravolt Indonesia records for testing Step 1
        \DB::table('indonesia_provinces')->insert([
            ['code' => '11', 'name' => 'ACEH'],
            ['code' => '12', 'name' => 'SUMATERA UTARA']
        ]);
        \DB::table('indonesia_cities')->insert([
            ['code' => '1101', 'province_code' => '11', 'name' => 'KABUPATEN ACEH SELATAN'],
            ['code' => '1201', 'province_code' => '12', 'name' => 'KABUPATEN TAPANULI TENGAH']
        ]);

        // Seed basic lookups
        Campus::create(['id' => 1, 'name' => 'Universitas Indonesia']);
        CompetencyScheme::create(['id' => 1, 'campus_id' => 1, 'name' => 'Skema Programmer']);
        
        // Seed ISCO level 1 and 4 for testing
        Isco::create(['level' => 1, 'code' => '2', 'title_en' => 'Professionals', 'title_id' => 'Profesional']);
        Isco::create(['level' => 2, 'code' => '25', 'title_en' => 'Information and Communications Technology Professionals', 'title_id' => 'Profesional Teknologi Informasi dan Komunikasi']);
        Isco::create(['level' => 3, 'code' => '251', 'title_en' => 'Software and Applications Developers and Analysts', 'title_id' => 'Pengembang dan Analis Perangkat Lunak dan Aplikasi']);
        Isco::create(['level' => 4, 'code' => '2512', 'title_en' => 'Software Developers', 'title_id' => 'Pengembang Perangkat Lunak']);

        // Seed ISIC
        Isic::create(['code' => 'J', 'title_en' => 'Information and communication', 'title_id' => 'Informasi dan komunikasi']);
        Isic::create(['code' => 'J62', 'title_en' => 'Computer programming, consultancy and related activities', 'title_id' => 'Aktivitas pemrograman komputer, konsultasi dan kegiatan ybdi']);
    }

    public function test_it_can_render_the_form_component()
    {
        Livewire::test(FormKuisioner::class)
            ->assertStatus(200)
            ->assertSet('currentStep', 0);
    }

    public function test_step_0_advances_to_step_1_without_errors()
    {
        Livewire::test(FormKuisioner::class)
            ->assertSet('currentStep', 0)
            ->call('nextStep')
            ->assertHasNoErrors()
            ->assertSet('currentStep', 1);
    }

    public function test_step_1_requires_basic_demographics()
    {
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 1)
            ->call('nextStep')
            ->assertHasErrors([
                'email' => 'required',
                'nama' => 'required',
                'jenis_kelamin' => 'required',
                'usia' => 'required',
                'status_pernikahan' => 'required',
                'punya_anak' => 'required',
                'selectedProvince' => 'required',
                'selectedCity' => 'required',
                'tipe_tempat_tinggal' => 'required',
            ])
            ->assertSet('currentStep', 1);
    }

    public function test_step_1_validates_email_uniqueness()
    {
        Respondent::create([
            'email' => 'existing@example.com',
            'nama' => 'John Existing',
            'jenis_kelamin' => 'Laki-Laki',
            'usia' => 30,
            'status_pernikahan' => 'Belum Menikah',
            'punya_anak' => 'Tidak',
            'province_code' => '11',
            'city_code' => '1101',
            'tipe_tempat_tinggal' => 'Perkotaan',
            'pendidikan_tertinggi' => 'Sarjana (S1)',
            'pernah_sertifikasi_lsp' => 'Tidak',
        ]);

        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 1)
            ->set('email', 'existing@example.com')
            ->call('nextStep')
            ->assertHasErrors(['email' => 'unique'])
            ->assertSet('currentStep', 1);
    }

    public function test_step_1_conditional_validation_for_children()
    {
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 1)
            ->set('punya_anak', 'Ya')
            ->call('nextStep')
            ->assertHasErrors(['jumlah_anak' => 'required']);

        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 1)
            ->set('punya_anak', 'Tidak')
            ->call('nextStep')
            ->assertHasNoErrors(['jumlah_anak']);
    }

    public function test_step_1_success_advances_to_step_2()
    {
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 1)
            ->set('email', 'test@example.com')
            ->set('nama', 'Budi Santoso')
            ->set('jenis_kelamin', 'Laki-Laki')
            ->set('usia', 25)
            ->set('status_pernikahan', 'Belum Menikah')
            ->set('punya_anak', 'Tidak')
            ->set('selectedProvince', '11')
            ->set('selectedCity', '1101')
            ->set('tipe_tempat_tinggal', 'Perkotaan')
            ->call('nextStep')
            ->assertHasNoErrors()
            ->assertSet('currentStep', 2);
    }

    public function test_step_2_validates_ipk_and_graduation_year_boundaries()
    {
        // IPK too low (2.49)
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 2)
            ->set('pendidikan_tertinggi', 'Sarjana (S1)')
            ->set('campus_id', 1)
            ->set('program_studi', 'Teknik Informatika')
            ->set('tahun_lulus', 2022)
            ->set('ipk', 2.49)
            ->set('melanjutkan_pendidikan', 'Tidak')
            ->set('pernah_sertifikasi_lsp', 'Tidak')
            ->call('nextStep')
            ->assertHasErrors(['ipk' => 'min'])
            ->assertSet('currentStep', 2);

        // IPK too high (4.01)
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 2)
            ->set('pendidikan_tertinggi', 'Sarjana (S1)')
            ->set('campus_id', 1)
            ->set('program_studi', 'Teknik Informatika')
            ->set('tahun_lulus', 2022)
            ->set('ipk', 4.01)
            ->set('melanjutkan_pendidikan', 'Tidak')
            ->set('pernah_sertifikasi_lsp', 'Tidak')
            ->call('nextStep')
            ->assertHasErrors(['ipk' => 'max'])
            ->assertSet('currentStep', 2);

        // Tahun lulus too early (2014)
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 2)
            ->set('pendidikan_tertinggi', 'Sarjana (S1)')
            ->set('campus_id', 1)
            ->set('program_studi', 'Teknik Informatika')
            ->set('tahun_lulus', 2014)
            ->set('ipk', 3.50)
            ->set('melanjutkan_pendidikan', 'Tidak')
            ->set('pernah_sertifikasi_lsp', 'Tidak')
            ->call('nextStep')
            ->assertHasErrors(['tahun_lulus' => 'min'])
            ->assertSet('currentStep', 2);

        // Tahun lulus too late (2027)
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 2)
            ->set('pendidikan_tertinggi', 'Sarjana (S1)')
            ->set('campus_id', 1)
            ->set('program_studi', 'Teknik Informatika')
            ->set('tahun_lulus', 2027)
            ->set('ipk', 3.50)
            ->set('melanjutkan_pendidikan', 'Tidak')
            ->set('pernah_sertifikasi_lsp', 'Tidak')
            ->call('nextStep')
            ->assertHasErrors(['tahun_lulus' => 'max'])
            ->assertSet('currentStep', 2);

        // Valid boundary checks
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 2)
            ->set('pendidikan_tertinggi', 'Sarjana (S1)')
            ->set('campus_id', 1)
            ->set('program_studi', 'Teknik Informatika')
            ->set('tahun_lulus', 2015)
            ->set('ipk', 2.50)
            ->set('melanjutkan_pendidikan', 'Tidak')
            ->set('pernah_sertifikasi_lsp', 'Tidak')
            ->call('nextStep')
            ->assertHasNoErrors();
            
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 2)
            ->set('pendidikan_tertinggi', 'Sarjana (S1)')
            ->set('campus_id', 1)
            ->set('program_studi', 'Teknik Informatika')
            ->set('tahun_lulus', 2026)
            ->set('ipk', 4.00)
            ->set('melanjutkan_pendidikan', 'Tidak')
            ->set('pernah_sertifikasi_lsp', 'Tidak')
            ->call('nextStep')
            ->assertHasNoErrors();
    }

    public function test_spelling_of_salary_updates_automatically()
    {
        Livewire::test(FormKuisioner::class)
            ->set('gaji_bulanan', 12500000)
            ->assertSet('gaji_terbilang', 'Dua Belas Juta Lima Ratus Ribu Rupiah')
            ->set('gaji_bulanan', 450000)
            ->assertSet('gaji_terbilang', 'Empat Ratus Lima Puluh Ribu Rupiah')
            ->set('gaji_bulanan', '')
            ->assertSet('gaji_terbilang', '');
    }

    public function test_campus_and_competency_scheme_cascades()
    {
        Livewire::test(FormKuisioner::class)
            ->set('campus_id', 1)
            ->assertCount('competencySchemes', 1)
            ->set('campus_id', null)
            ->assertCount('competencySchemes', 0);
    }

    public function test_submits_entire_form_correctly()
    {
        Livewire::test(FormKuisioner::class)
            ->set('currentStep', 1)
            // Step 1
            ->set('email', 'john@example.com')
            ->set('nama', 'John Doe')
            ->set('jenis_kelamin', 'Laki-Laki')
            ->set('usia', 30)
            ->set('status_pernikahan', 'Menikah')
            ->set('punya_anak', 'Ya')
            ->set('jumlah_anak', 2)
            ->set('selectedProvince', '11')
            ->set('selectedCity', '1101')
            ->set('tipe_tempat_tinggal', 'Perkotaan')
            ->call('nextStep')
            
            // Step 2
            ->set('pendidikan_tertinggi', 'Sarjana (S1)')
            ->set('campus_id', 1)
            ->set('program_studi', 'Teknik Komputer')
            ->set('tahun_lulus', 2020)
            ->set('ipk', 3.80)
            ->set('melanjutkan_pendidikan', 'Tidak')
            ->set('pernah_sertifikasi_lsp', 'Ya')
            ->set('dapat_sertifikat_bnsp', 'Ya')
            ->set('competency_scheme_id', 1)
            ->call('nextStep')

            // Step 3 (Working)
            ->set('bekerja_seminggu_terakhir', 'Ya')
            ->set('pekerjaan_dimulai_setelah_lulus', 'Ya')
            ->set('waktu_tunggu_kerja', 3)
            ->set('status_pekerjaan', 'Pegawai Swasta')
            ->set('gaji_bulanan', 15000000)
            ->set('gaji_perbandingan_umr', 'Lebih Tinggi')
            ->set('tahun_mulai_bekerja', 2021)
            ->set('isco_l1', '2')
            ->set('isco_l2', '25')
            ->set('isco_l3', '251')
            ->set('isco_l4', '2512')
            ->set('jumlah_jam_kerja', 40)
            ->set('nama_perusahaan', 'Tech Corp')
            ->set('jenis_perusahaan', 'Swasta')
            ->set('jumlah_karyawan', '100+')
            ->set('selectedIsicSector', 'J')
            ->set('isic_code', 'J62')
            ->set('punya_pekerjaan_tambahan', 'Tidak')
            ->set('pernah_bekerja_sebelumnya_lain', 'Tidak')
            ->call('nextStep')

            // Step 4
            ->set('kesesuaian_bidang_ijazah', 'Sangat Sesuai')
            ->set('kesesuaian_jenjang_pendidikan', 'Sesuai')
            ->set('jenjang_paling_sesuai', 'Sarjana (S1)')
            ->set('bnsp_mudahkan_dapat_kerja', 'Sangat Membantu')
            ->set('perusahaan_hargai_bnsp', 'Ya')
            ->set('bnsp_tingkatkan_karir', 'Ya')
            ->set('bnsp_tingkatkan_gaji', 'Ya')
            ->set('kesesuaian_bidang_bnsp', 'Sesuai')
            ->set('jabatan_sebelum_bnsp', 'Junior Dev')
            ->set('jabatan_setelah_bnsp', 'Senior Dev')
            
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('isSubmitted', true);

        $this->assertDatabaseHas('respondents', [
            'email' => 'john@example.com',
            'nama' => 'John Doe',
            'campus_id' => 1,
            'perguruan_tinggi' => 'Universitas Indonesia',
            'competency_scheme_id' => 1,
            'skema_sertifikasi' => 'Skema Programmer',
            'isco_code' => '2512',
            'isco_title_id' => 'Pengembang Perangkat Lunak',
            'isic_code' => 'J62',
            'isic_title_id' => 'Aktivitas pemrograman komputer, konsultasi dan kegiatan ybdi'
        ]);
    }
}
