<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Respondent;
use App\Models\Campus;
use App\Models\CompetencyScheme;
use App\Models\Isco;
use App\Models\Isic;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

class FormKuisioner extends Component
{
    // Wizard
    public $currentStep = 0;
    public $isSubmitted = false;

    // Dropdowns data lists
    public $provinces = [];
    public $cities = [];
    public $districts = [];
    public $villages = [];
    public $campuses = [];
    public $competencySchemes = [];
    public $isicSectors = [];
    public $isicDivisions = [];

    // ISCO Dropdown lists (Current Job)
    public $iscoL1Options = [];
    public $iscoL2Options = [];
    public $iscoL3Options = [];
    public $iscoL4Options = [];

    // ISCO Dropdown lists (Previous Job - Unemployed)
    public $prevIscoL2Options = [];
    public $prevIscoL3Options = [];
    public $prevIscoL4Options = [];

    // ISCO Dropdown lists (Additional Job)
    public $addIscoL2Options = [];
    public $addIscoL3Options = [];
    public $addIscoL4Options = [];

    // Step 1: Demografi
    public $email;
    public $nama;
    public $jenis_kelamin;
    public $usia;
    public $status_pernikahan;
    public $punya_anak;
    public $jumlah_anak;
    public $selectedProvince = null;
    public $selectedCity = null;
    public $selectedDistrict = null;
    public $selectedVillage = null;
    public $tipe_tempat_tinggal;

    // Step 2: Pendidikan & Sertifikasi
    public $pendidikan_tertinggi;
    public $nama_sekolah;
    public $campus_id;
    public $program_studi;
    public $tahun_lulus;
    public $ipk;
    public $melanjutkan_pendidikan;
    public $pernah_sertifikasi_lsp;
    public $dapat_sertifikat_bnsp;
    public $competency_scheme_id;
    public $skema_sertifikasi_lainnya;

    // Step 3: Pekerjaan
    public $bekerja_seminggu_terakhir;
    
    // Jika Tidak Bekerja:
    public $punya_pekerjaan_tapi_tidak_bekerja;
    public $pernah_bekerja_sebelumnya;
    public $pekerjaan_sebelumnya_isco_code;
    public $pekerjaan_sebelumnya_isco_title_en;
    public $pekerjaan_sebelumnya_isco_title_id;
    public $alasan_tidak_bekerja;

    // Jika Bekerja (Seminggu Terakhir = Ya ATAU Punya Pekerjaan tapi Tidak Bekerja = Ya):
    public $pekerjaan_dimulai_setelah_lulus;
    public $waktu_tunggu_kerja;
    public $status_pekerjaan;
    public $gaji_bulanan;
    public $gaji_perbandingan_umr;
    public $tahun_mulai_bekerja;
    public $jumlah_jam_kerja;
    public $ada_lembur;
    public $nama_perusahaan;
    public $jenis_perusahaan;
    public $jumlah_karyawan;
    
    // ISIC (Bidang Perusahaan)
    public $selectedIsicSector = null;
    public $isic_code;
    public $isic_title_en;
    public $isic_title_id;

    // ISCO (Pekerjaan Utama)
    public $isco_code;
    public $isco_title_en;
    public $isco_title_id;
    public $isco_l1;
    public $isco_l2;
    public $isco_l3;
    public $isco_l4;

    // Pekerjaan Tambahan
    public $punya_pekerjaan_tambahan;
    public $status_pekerjaan_tambahan;
    public $pekerjaan_tambahan_isco_code;
    public $pekerjaan_tambahan_isco_title_en;
    public $pekerjaan_tambahan_isco_title_id;
    public $pekerjaan_tambahan_isco_l1;
    public $pekerjaan_tambahan_isco_l2;
    public $pekerjaan_tambahan_isco_l3;
    public $pekerjaan_tambahan_isco_l4;
    public $jumlah_jam_kerja_tambahan;

    // Pernah bekerja di tempat lain sebelum saat ini (untuk yang bekerja)
    public $pernah_bekerja_sebelumnya_lain;

    // ISCO (Pekerjaan Sebelumnya - jika tidak bekerja)
    public $prev_isco_l1;
    public $prev_isco_l2;
    public $prev_isco_l3;
    public $prev_isco_l4;

    // Step 4: Evaluasi & Dampak
    public $kesesuaian_bidang_ijazah;
    public $kesesuaian_jenjang_pendidikan;
    public $jenjang_paling_sesuai;
    public $bnsp_mudahkan_dapat_kerja;
    public $perusahaan_hargai_bnsp;
    public $bnsp_tingkatkan_karir;
    public $bnsp_tingkatkan_gaji;
    public $kesesuaian_bidang_bnsp;
    public $jabatan_sebelum_bnsp;
    public $jabatan_setelah_bnsp;
    
    // Gaji terbilang helper
    public $gaji_terbilang = '';

    public function mount()
    {
        $this->provinces = Province::pluck('name', 'code');
        $this->campuses = Campus::orderBy('name')->get();
        $this->isicSectors = Isic::whereRaw('length(code) = 1')->orderBy('code')->get();
        $this->iscoL1Options = Isco::where('level', 1)->orderBy('code')->get();
    }

    public function updated($propertyName)
    {
        $this->resetErrorBag($propertyName);
    }

    // Geografi Cascading
    public function updatedSelectedProvince($provinceCode)
    {
        $this->cities = City::where('province_code', $provinceCode)->pluck('name', 'code');
        $this->selectedCity = null;
        $this->selectedDistrict = null;
        $this->selectedVillage = null;
        $this->districts = [];
        $this->villages = [];
    }

    public function updatedSelectedCity($cityCode)
    {
        $this->districts = District::where('city_code', $cityCode)->pluck('name', 'code');
        $this->selectedDistrict = null;
        $this->selectedVillage = null;
        $this->villages = [];
    }

    public function updatedSelectedDistrict($districtCode)
    {
        $this->villages = Village::where('district_code', $districtCode)->pluck('name', 'code');
        $this->selectedVillage = null;
    }

    // Pendidikan Cascading
    public function updatedCampusId($value)
    {
        if ($value) {
            $this->competencySchemes = CompetencyScheme::where('campus_id', $value)->orderBy('name')->get();
        } else {
            $this->competencySchemes = [];
        }
        $this->competency_scheme_id = null;
        $this->skema_sertifikasi_lainnya = null;
    }

    // Gaji Terbilang reactivity
    public function updatedGajiBulanan($value)
    {
        if (empty($value) || !is_numeric($value)) {
            $this->gaji_terbilang = '';
        } else {
            $terbilang = trim($this->terbilang($value));
            $this->gaji_terbilang = $terbilang ? preg_replace('/\s+/', ' ', $terbilang) . ' Rupiah' : '';
        }
    }

    // ISIC Cascading
    public function updatedSelectedIsicSector($value)
    {
        $this->isicDivisions = $value ? Isic::where('code', 'like', $value . '%')->whereRaw('length(code) > 1')->orderBy('code')->get() : [];
        $this->isic_code = null;
        $this->isic_title_en = null;
        $this->isic_title_id = null;
    }

    public function updatedIsicCode($value)
    {
        if ($value) {
            $isic = Isic::where('code', $value)->first();
            if ($isic) {
                $this->isic_title_en = $isic->title_en;
                $this->isic_title_id = $isic->title_id;
            }
        } else {
            $this->isic_title_en = null;
            $this->isic_title_id = null;
        }
    }

    // ISCO Cascading (Current Job)
    public function updatedIscoL1($value)
    {
        $this->isco_l2 = null;
        $this->isco_l3 = null;
        $this->isco_l4 = null;
        $this->iscoL2Options = $value ? Isco::where('level', 2)->where('code', 'like', $value . '%')->orderBy('code')->get() : [];
        $this->iscoL3Options = [];
        $this->iscoL4Options = [];
        
        $this->isco_code = null;
        $this->isco_title_en = null;
        $this->isco_title_id = null;
    }

    public function updatedIscoL2($value)
    {
        $this->isco_l3 = null;
        $this->isco_l4 = null;
        $this->iscoL3Options = $value ? Isco::where('level', 3)->where('code', 'like', $value . '%')->orderBy('code')->get() : [];
        $this->iscoL4Options = [];
        
        $this->isco_code = null;
        $this->isco_title_en = null;
        $this->isco_title_id = null;
    }

    public function updatedIscoL3($value)
    {
        $this->isco_l4 = null;
        $this->iscoL4Options = $value ? Isco::where('level', 4)->where('code', 'like', $value . '%')->orderBy('code')->get() : [];
        
        $this->isco_code = null;
        $this->isco_title_en = null;
        $this->isco_title_id = null;
    }

    public function updatedIscoL4($value)
    {
        if ($value) {
            $isco = Isco::where('level', 4)->where('code', $value)->first();
            if ($isco) {
                $this->isco_code = $isco->code;
                $this->isco_title_en = $isco->title_en;
                $this->isco_title_id = $isco->title_id;
            }
        } else {
            $this->isco_code = null;
            $this->isco_title_en = null;
            $this->isco_title_id = null;
        }
    }

    // ISCO Cascading (Additional Job)
    public function updatedPekerjaanTambahanIscoL1($value)
    {
        $this->pekerjaan_tambahan_isco_l2 = null;
        $this->pekerjaan_tambahan_isco_l3 = null;
        $this->pekerjaan_tambahan_isco_l4 = null;
        $this->addIscoL2Options = $value ? Isco::where('level', 2)->where('code', 'like', $value . '%')->orderBy('code')->get() : [];
        $this->addIscoL3Options = [];
        $this->addIscoL4Options = [];
        
        $this->pekerjaan_tambahan_isco_code = null;
        $this->pekerjaan_tambahan_isco_title_en = null;
        $this->pekerjaan_tambahan_isco_title_id = null;
    }

    public function updatedPekerjaanTambahanIscoL2($value)
    {
        $this->pekerjaan_tambahan_isco_l3 = null;
        $this->pekerjaan_tambahan_isco_l4 = null;
        $this->addIscoL3Options = $value ? Isco::where('level', 3)->where('code', 'like', $value . '%')->orderBy('code')->get() : [];
        $this->addIscoL4Options = [];
        
        $this->pekerjaan_tambahan_isco_code = null;
        $this->pekerjaan_tambahan_isco_title_en = null;
        $this->pekerjaan_tambahan_isco_title_id = null;
    }

    public function updatedPekerjaanTambahanIscoL3($value)
    {
        $this->pekerjaan_tambahan_isco_l4 = null;
        $this->addIscoL4Options = $value ? Isco::where('level', 4)->where('code', 'like', $value . '%')->orderBy('code')->get() : [];
        
        $this->pekerjaan_tambahan_isco_code = null;
        $this->pekerjaan_tambahan_isco_title_en = null;
        $this->pekerjaan_tambahan_isco_title_id = null;
    }

    public function updatedPekerjaanTambahanIscoL4($value)
    {
        if ($value) {
            $isco = Isco::where('level', 4)->where('code', $value)->first();
            if ($isco) {
                $this->pekerjaan_tambahan_isco_code = $isco->code;
                $this->pekerjaan_tambahan_isco_title_en = $isco->title_en;
                $this->pekerjaan_tambahan_isco_title_id = $isco->title_id;
            }
        } else {
            $this->pekerjaan_tambahan_isco_code = null;
            $this->pekerjaan_tambahan_isco_title_en = null;
            $this->pekerjaan_tambahan_isco_title_id = null;
        }
    }

    // ISCO Cascading (Previous Job - Unemployed)
    public function updatedPrevIscoL1($value)
    {
        $this->prev_isco_l2 = null;
        $this->prev_isco_l3 = null;
        $this->prev_isco_l4 = null;
        $this->prevIscoL2Options = $value ? Isco::where('level', 2)->where('code', 'like', $value . '%')->orderBy('code')->get() : [];
        $this->prevIscoL3Options = [];
        $this->prevIscoL4Options = [];
        
        $this->pekerjaan_sebelumnya_isco_code = null;
        $this->pekerjaan_sebelumnya_isco_title_en = null;
        $this->pekerjaan_sebelumnya_isco_title_id = null;
    }

    public function updatedPrevIscoL2($value)
    {
        $this->prev_isco_l3 = null;
        $this->prev_isco_l4 = null;
        $this->prevIscoL3Options = $value ? Isco::where('level', 3)->where('code', 'like', $value . '%')->orderBy('code')->get() : [];
        $this->prevIscoL4Options = [];
        
        $this->pekerjaan_sebelumnya_isco_code = null;
        $this->pekerjaan_sebelumnya_isco_title_en = null;
        $this->pekerjaan_sebelumnya_isco_title_id = null;
    }

    public function updatedPrevIscoL3($value)
    {
        $this->prev_isco_l4 = null;
        $this->prevIscoL4Options = $value ? Isco::where('level', 4)->where('code', 'like', $value . '%')->orderBy('code')->get() : [];
        
        $this->pekerjaan_sebelumnya_isco_code = null;
        $this->pekerjaan_sebelumnya_isco_title_en = null;
        $this->pekerjaan_sebelumnya_isco_title_id = null;
    }

    public function updatedPrevIscoL4($value)
    {
        if ($value) {
            $isco = Isco::where('level', 4)->where('code', $value)->first();
            if ($isco) {
                $this->pekerjaan_sebelumnya_isco_code = $isco->code;
                $this->pekerjaan_sebelumnya_isco_title_en = $isco->title_en;
                $this->pekerjaan_sebelumnya_isco_title_id = $isco->title_id;
            }
        } else {
            $this->pekerjaan_sebelumnya_isco_code = null;
            $this->pekerjaan_sebelumnya_isco_title_en = null;
            $this->pekerjaan_sebelumnya_isco_title_id = null;
        }
    }

    // Spelled out salary generator
    public function terbilang($angka)
    {
        $angka = (float)$angka;
        $bilangan = [
            '', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima',
            'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'
        ];

        if ($angka < 0) {
            return "Minus " . trim($this->terbilang(abs($angka)));
        }

        if ($angka < 12) {
            return $bilangan[$angka];
        } elseif ($angka < 20) {
            return $this->terbilang($angka - 10) . " Belas";
        } elseif ($angka < 100) {
            return $this->terbilang(floor($angka / 10)) . " Puluh " . $this->terbilang($angka % 10);
        } elseif ($angka < 200) {
            return "Seratus " . $this->terbilang($angka - 100);
        } elseif ($angka < 1000) {
            return $this->terbilang(floor($angka / 100)) . " Ratus " . $this->terbilang($angka % 100);
        } elseif ($angka < 200) {
            // redundant but handles typical seribu bounds
            return "Seribu " . $this->terbilang($angka - 1000);
        } elseif ($angka < 2000) {
            return "Seribu " . $this->terbilang($angka - 1000);
        } elseif ($angka < 1000000) {
            return $this->terbilang(floor($angka / 1000)) . " Ribu " . $this->terbilang($angka % 1000);
        } elseif ($angka < 1000000000) {
            return $this->terbilang(floor($angka / 1000000)) . " Juta " . $this->terbilang($angka % 1000000);
        } elseif ($angka < 1000000000000) {
            return $this->terbilang(floor($angka / 1000000000)) . " Miliar " . $this->terbilang($angka % 1000000000);
        } elseif ($angka < 1000000000000000) {
            return $this->terbilang(floor($angka / 1000000000000)) . " Triliun " . $this->terbilang($angka % 1000000000000);
        }

        return "";
    }

    // Step validations
    protected function validateStep1()
    {
        $rules = [
            'email' => 'required|email|unique:respondents,email',
            'nama' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'usia' => 'required|integer|min:15|max:70',
            'status_pernikahan' => 'required|in:Belum Menikah,Menikah,Bercerai',
            'punya_anak' => 'required|in:Ya,Tidak',
            'selectedProvince' => 'required',
            'selectedCity' => 'required',
            'tipe_tempat_tinggal' => 'required|in:Pedesaan,Perkotaan',
        ];

        if ($this->punya_anak === 'Ya') {
            $rules['jumlah_anak'] = 'required|integer|min:1';
        }

        $this->validate($rules, [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Maaf, email ini sudah digunakan untuk mengisi kuisioner.',
            'nama.required' => 'Nama wajib diisi.',
            'nama.regex' => 'Nama lengkap hanya boleh berisi huruf dan spasi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'usia.required' => 'Usia wajib diisi.',
            'usia.integer' => 'Usia harus berupa angka.',
            'usia.min' => 'Usia minimal 15 tahun.',
            'usia.max' => 'Usia maksimal 70 tahun.',
            'status_pernikahan.required' => 'Status pernikahan wajib dipilih.',
            'punya_anak.required' => 'Pilihan punya anak wajib diisi.',
            'jumlah_anak.required' => 'Jumlah anak wajib diisi.',
            'jumlah_anak.integer' => 'Jumlah anak harus berupa angka.',
            'jumlah_anak.min' => 'Jumlah anak minimal 1.',
            'selectedProvince.required' => 'Provinsi wajib dipilih.',
            'selectedCity.required' => 'Kabupaten/Kota wajib dipilih.',
            'tipe_tempat_tinggal.required' => 'Tipe wilayah wajib dipilih.',
        ]);
    }

    protected function validateStep2()
    {
        $rules = [
            'pendidikan_tertinggi' => 'required',
            'pernah_sertifikasi_lsp' => 'required|in:Ya,Tidak',
        ];

        if ($this->pendidikan_tertinggi === 'SMA/Sederajat') {
            $rules['nama_sekolah'] = 'required|string|max:255';
        } else {
            $rules['campus_id'] = 'required';
            $rules['program_studi'] = 'required|string|max:255';
            $rules['tahun_lulus'] = 'required|integer|min:2015|max:2026';
            $rules['ipk'] = 'required|numeric|min:2.50|max:4.00';
            $rules['melanjutkan_pendidikan'] = 'required|in:Ya,Tidak';
        }

        if ($this->pernah_sertifikasi_lsp === 'Ya') {
            $rules['dapat_sertifikat_bnsp'] = 'required|in:Ya,Tidak';
            
            if ($this->dapat_sertifikat_bnsp === 'Ya') {
                $rules['competency_scheme_id'] = 'required';
                if ($this->competency_scheme_id === 'other') {
                    $rules['skema_sertifikasi_lainnya'] = 'required|string|max:255';
                }
            }
        }

        $this->validate($rules, [
            'pendidikan_tertinggi.required' => 'Pendidikan tertinggi wajib dipilih.',
            'nama_sekolah.required' => 'Nama sekolah wajib diisi.',
            'campus_id.required' => 'Perguruan Tinggi wajib dipilih.',
            'program_studi.required' => 'Program studi wajib diisi.',
            'tahun_lulus.required' => 'Tahun lulus wajib diisi.',
            'tahun_lulus.integer' => 'Tahun lulus harus berupa angka.',
            'tahun_lulus.min' => 'Tahun lulus minimal tahun 2015.',
            'tahun_lulus.max' => 'Tahun lulus maksimal tahun 2026.',
            'ipk.required' => 'IPK wajib diisi.',
            'ipk.numeric' => 'IPK harus berupa angka.',
            'ipk.min' => 'IPK minimal 2.50.',
            'ipk.max' => 'IPK maksimal 4.00.',
            'melanjutkan_pendidikan.required' => 'Pilihan melanjutkan pendidikan wajib dipilih.',
            'pernah_sertifikasi_lsp.required' => 'Pilihan mengikuti sertifikasi LSP wajib dipilih.',
            'dapat_sertifikat_bnsp.required' => 'Pilihan mendapatkan sertifikat BNSP wajib dipilih.',
            'competency_scheme_id.required' => 'Skema sertifikasi wajib dipilih.',
            'skema_sertifikasi_lainnya.required' => 'Nama skema sertifikasi lainnya wajib diisi.',
        ]);
    }

    protected function validateStep3()
    {
        $rules = [
            'bekerja_seminggu_terakhir' => 'required|in:Ya,Tidak',
        ];

        if ($this->bekerja_seminggu_terakhir === 'Tidak') {
            $rules['punya_pekerjaan_tapi_tidak_bekerja'] = 'required|in:Ya,Tidak';
            
            if ($this->punya_pekerjaan_tapi_tidak_bekerja === 'Tidak') {
                $rules['pernah_bekerja_sebelumnya'] = 'required|in:Ya,Tidak';
                if ($this->pernah_bekerja_sebelumnya === 'Ya') {
                    $rules['pekerjaan_sebelumnya_isco_code'] = 'required';
                }
                $rules['alasan_tidak_bekerja'] = 'required';
            }
        }

        if ($this->bekerja_seminggu_terakhir === 'Ya' || $this->punya_pekerjaan_tapi_tidak_bekerja === 'Ya') {
            $rules['pekerjaan_dimulai_setelah_lulus'] = 'required';
            $rules['waktu_tunggu_kerja'] = 'required|integer|min:0|max:60';
            $rules['status_pekerjaan'] = 'required';
            $rules['gaji_bulanan'] = 'required|numeric|min:0';
            $rules['gaji_perbandingan_umr'] = 'required';
            $rules['tahun_mulai_bekerja'] = 'required|integer|min:1970|max:2026';
            $rules['isco_code'] = 'required';
            $rules['jumlah_jam_kerja'] = 'required|integer|min:1|max:84';
            
            if ((int)$this->jumlah_jam_kerja > 40) {
                $rules['ada_lembur'] = 'required|in:Ya,Tidak';
            }
            
            $rules['nama_perusahaan'] = 'required|string|max:255';
            $rules['jenis_perusahaan'] = 'required';
            $rules['jumlah_karyawan'] = 'required';
            $rules['isic_code'] = 'required';
            
            $rules['punya_pekerjaan_tambahan'] = 'required|in:Ya,Tidak';
            if ($this->punya_pekerjaan_tambahan === 'Ya') {
                $rules['status_pekerjaan_tambahan'] = 'required';
                $rules['pekerjaan_tambahan_isco_code'] = 'required';
                $rules['jumlah_jam_kerja_tambahan'] = 'required|integer|min:1|max:84';
            }
            
            $rules['pernah_bekerja_sebelumnya_lain'] = 'required|in:Ya,Tidak';
        }

        $this->validate($rules, [
            'bekerja_seminggu_terakhir.required' => 'Pilihan bekerja seminggu terakhir wajib diisi.',
            'punya_pekerjaan_tapi_tidak_bekerja.required' => 'Pilihan memiliki pekerjaan tetapi tidak bekerja wajib diisi.',
            'pernah_bekerja_sebelumnya.required' => 'Pilihan pernah bekerja sebelumnya wajib diisi.',
            'pekerjaan_sebelumnya_isco_code.required' => 'Pekerjaan sebelumnya wajib dipilih.',
            'alasan_tidak_bekerja.required' => 'Alasan tidak bekerja wajib dipilih.',
            
            'pekerjaan_dimulai_setelah_lulus.required' => 'Pilihan waktu mulai bekerja wajib diisi.',
            'waktu_tunggu_kerja.required' => 'Waktu tunggu mencari kerja wajib diisi.',
            'waktu_tunggu_kerja.integer' => 'Waktu tunggu harus berupa angka.',
            'waktu_tunggu_kerja.min' => 'Waktu tunggu minimal 0 bulan.',
            'waktu_tunggu_kerja.max' => 'Waktu tunggu maksimal 60 bulan.',
            'status_pekerjaan.required' => 'Status pekerjaan utama wajib dipilih.',
            'gaji_bulanan.required' => 'Gaji bulanan wajib diisi.',
            'gaji_bulanan.numeric' => 'Gaji bulanan harus berupa angka.',
            'gaji_bulanan.min' => 'Gaji bulanan tidak boleh kurang dari 0.',
            'gaji_perbandingan_umr.required' => 'Perbandingan gaji dengan UMR wajib dipilih.',
            'tahun_mulai_bekerja.required' => 'Tahun mulai bekerja wajib diisi.',
            'tahun_mulai_bekerja.integer' => 'Tahun mulai bekerja harus berupa angka.',
            'tahun_mulai_bekerja.min' => 'Tahun mulai bekerja minimal tahun 1970.',
            'tahun_mulai_bekerja.max' => 'Tahun mulai bekerja maksimal tahun 2026.',
            'isco_code.required' => 'Pilihan pekerjaan / jabatan ISCO wajib dipilih hingga level 4.',
            'jumlah_jam_kerja.required' => 'Jumlah jam kerja seminggu wajib diisi.',
            'jumlah_jam_kerja.integer' => 'Jumlah jam kerja harus berupa angka.',
            'jumlah_jam_kerja.min' => 'Jumlah jam kerja minimal 1 jam.',
            'jumlah_jam_kerja.max' => 'Jumlah jam kerja maksimal 84 jam.',
            'ada_lembur.required' => 'Pilihan lembur wajib diisi karena jam kerja melebihi 40 jam.',
            'nama_perusahaan.required' => 'Nama perusahaan wajib diisi.',
            'jenis_perusahaan.required' => 'Jenis perusahaan wajib dipilih.',
            'jumlah_karyawan.required' => 'Jumlah karyawan wajib dipilih.',
            'isic_code.required' => 'Bidang perusahaan (ISIC) wajib dipilih.',
            
            'punya_pekerjaan_tambahan.required' => 'Pilihan memiliki pekerjaan tambahan wajib diisi.',
            'status_pekerjaan_tambahan.required' => 'Status pekerjaan tambahan wajib dipilih.',
            'pekerjaan_tambahan_isco_code.required' => 'Pekerjaan tambahan ISCO wajib dipilih hingga level 4.',
            'jumlah_jam_kerja_tambahan.required' => 'Jumlah jam kerja tambahan wajib diisi.',
            'jumlah_jam_kerja_tambahan.integer' => 'Jumlah jam kerja tambahan harus berupa angka.',
            'jumlah_jam_kerja_tambahan.min' => 'Jumlah jam kerja tambahan minimal 1 jam.',
            'jumlah_jam_kerja_tambahan.max' => 'Jumlah jam kerja tambahan maksimal 84 jam.',
            
            'pernah_bekerja_sebelumnya_lain.required' => 'Pilihan pernah bekerja di tempat lain sebelum pekerjaan saat ini wajib diisi.',
        ]);
    }

    protected function validateStep4()
    {
        $rules = [];

        if ($this->bekerja_seminggu_terakhir === 'Ya' || $this->punya_pekerjaan_tapi_tidak_bekerja === 'Ya') {
            $rules['kesesuaian_bidang_ijazah'] = 'required';
            $rules['kesesuaian_jenjang_pendidikan'] = 'required';
            $rules['jenjang_paling_sesuai'] = 'required';
            
            if ($this->pernah_sertifikasi_lsp === 'Ya' && $this->dapat_sertifikat_bnsp === 'Ya') {
                $rules['bnsp_mudahkan_dapat_kerja'] = 'required';
                $rules['perusahaan_hargai_bnsp'] = 'required';
                $rules['bnsp_tingkatkan_karir'] = 'required';
                $rules['bnsp_tingkatkan_gaji'] = 'required';
                $rules['kesesuaian_bidang_bnsp'] = 'required';
                $rules['jabatan_sebelum_bnsp'] = 'required|string|max:255';
                $rules['jabatan_setelah_bnsp'] = 'required|string|max:255';
            }
        }

        if (empty($rules)) {
            return;
        }

        $this->validate($rules, [
            'kesesuaian_bidang_ijazah.required' => 'Tingkat kesesuaian bidang pekerjaan dengan ijazah wajib dipilih.',
            'kesesuaian_jenjang_pendidikan.required' => 'Tingkat kesesuaian jenjang pendidikan wajib dipilih.',
            'jenjang_paling_sesuai.required' => 'Jenjang pendidikan yang paling sesuai wajib dipilih.',
            
            'bnsp_mudahkan_dapat_kerja.required' => 'Pernyataan tentang kemudahan mendapat kerja wajib dipilih.',
            'perusahaan_hargai_bnsp.required' => 'Pernyataan tentang penghargaan perusahaan terhadap sertifikat BNSP wajib dipilih.',
            'bnsp_tingkatkan_karir.required' => 'Pernyataan tentang dampak terhadap karir wajib dipilih.',
            'bnsp_tingkatkan_gaji.required' => 'Pernyataan tentang dampak terhadap peningkatan gaji wajib dipilih.',
            'kesesuaian_bidang_bnsp.required' => 'Tingkat kesesuaian bidang sertifikat dengan pekerjaan wajib dipilih.',
            'jabatan_sebelum_bnsp.required' => 'Jabatan sebelum sertifikasi wajib diisi.',
            'jabatan_setelah_bnsp.required' => 'Jabatan setelah sertifikasi wajib diisi.',
        ]);
    }

    // Step Navigation
    public function nextStep()
    {
        if ($this->currentStep === 0) {
            $this->currentStep = 1;
        } elseif ($this->currentStep === 1) {
            $this->validateStep1();
            $this->currentStep = 2;
        } elseif ($this->currentStep === 2) {
            $this->validateStep2();
            $this->currentStep = 3;
        } elseif ($this->currentStep === 3) {
            $this->validateStep3();
            $this->currentStep = 4;
        }
    }

    public function backStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function submit()
    {
        // Validate based on the current step/state
        if ($this->currentStep === 4) {
            $this->validateStep4();
        } else {
            if ($this->currentStep >= 1) $this->validateStep1();
            if ($this->currentStep >= 2) $this->validateStep2();
            if ($this->currentStep >= 3) $this->validateStep3();
        }

        // Prepare Database Save Data
        $data = [
            'email' => $this->email,
            'nama' => $this->nama,
            'jenis_kelamin' => $this->jenis_kelamin,
            'usia' => $this->usia,
            'status_pernikahan' => $this->status_pernikahan,
            'punya_anak' => $this->punya_anak,
            'jumlah_anak' => ($this->punya_anak === 'Ya') ? $this->jumlah_anak : null,
            
            'province_code' => $this->selectedProvince,
            'city_code' => $this->selectedCity,
            'district_code' => $this->selectedDistrict,
            'village_code' => $this->selectedVillage,
            'tipe_tempat_tinggal' => $this->tipe_tempat_tinggal,
            
            'pendidikan_tertinggi' => $this->pendidikan_tertinggi,
            'pernah_sertifikasi_lsp' => $this->pernah_sertifikasi_lsp,
        ];

        // Pendidikan Tertinggi Options
        if ($this->pendidikan_tertinggi === 'SMA/Sederajat') {
            $data['nama_sekolah'] = $this->nama_sekolah;
            $data['campus_id'] = null;
            $data['perguruan_tinggi'] = null;
            $data['program_studi'] = null;
            $data['tahun_lulus'] = null;
            $data['ipk'] = null;
            $data['melanjutkan_pendidikan'] = null;
        } else {
            $data['nama_sekolah'] = null;
            $data['campus_id'] = $this->campus_id;
            $data['perguruan_tinggi'] = Campus::find($this->campus_id)->name ?? null;
            $data['program_studi'] = $this->program_studi;
            $data['tahun_lulus'] = $this->tahun_lulus;
            $data['ipk'] = $this->ipk;
            $data['melanjutkan_pendidikan'] = $this->melanjutkan_pendidikan;
        }

        // Sertifikasi
        if ($this->pernah_sertifikasi_lsp === 'Ya') {
            $data['dapat_sertifikat_bnsp'] = $this->dapat_sertifikat_bnsp;
            if ($this->dapat_sertifikat_bnsp === 'Ya') {
                if ($this->competency_scheme_id === 'other') {
                    $data['competency_scheme_id'] = null;
                    $data['skema_sertifikasi'] = $this->skema_sertifikasi_lainnya;
                    $data['skema_sertifikasi_lainnya'] = $this->skema_sertifikasi_lainnya;
                } else {
                    $data['competency_scheme_id'] = $this->competency_scheme_id;
                    $data['skema_sertifikasi'] = CompetencyScheme::find($this->competency_scheme_id)->name ?? null;
                    $data['skema_sertifikasi_lainnya'] = null;
                }
            } else {
                $data['competency_scheme_id'] = null;
                $data['skema_sertifikasi'] = null;
                $data['skema_sertifikasi_lainnya'] = null;
            }
        } else {
            $data['dapat_sertifikat_bnsp'] = null;
            $data['competency_scheme_id'] = null;
            $data['skema_sertifikasi'] = null;
            $data['skema_sertifikasi_lainnya'] = null;
        }

        // Pekerjaan
        $data['bekerja_seminggu_terakhir'] = $this->bekerja_seminggu_terakhir;
        
        if ($this->bekerja_seminggu_terakhir === 'Tidak') {
            $data['punya_pekerjaan_tapi_tidak_bekerja'] = $this->punya_pekerjaan_tapi_tidak_bekerja;
            
            if ($this->punya_pekerjaan_tapi_tidak_bekerja === 'Tidak') {
                $data['pernah_bekerja_sebelumnya'] = $this->pernah_bekerja_sebelumnya;
                if ($this->pernah_bekerja_sebelumnya === 'Ya') {
                    $data['pekerjaan_sebelumnya_isco_code'] = $this->pekerjaan_sebelumnya_isco_code;
                    $data['pekerjaan_sebelumnya_isco_title_en'] = $this->pekerjaan_sebelumnya_isco_title_en;
                    $data['pekerjaan_sebelumnya_isco_title_id'] = $this->pekerjaan_sebelumnya_isco_title_id;
                } else {
                    $data['pekerjaan_sebelumnya_isco_code'] = null;
                    $data['pekerjaan_sebelumnya_isco_title_en'] = null;
                    $data['pekerjaan_sebelumnya_isco_title_id'] = null;
                }
                $data['alasan_tidak_bekerja'] = $this->alasan_tidak_bekerja;
                
                // Clear working data
                $data['pekerjaan_dimulai_setelah_lulus'] = null;
                $data['waktu_tunggu_kerja'] = null;
                $data['status_pekerjaan'] = null;
                $data['gaji_bulanan'] = null;
                $data['gaji_perbandingan_umr'] = null;
                $data['tahun_mulai_bekerja'] = null;
                $data['isco_code'] = null;
                $data['isco_title_en'] = null;
                $data['isco_title_id'] = null;
                $data['jenis_pekerjaan'] = null;
                $data['jumlah_jam_kerja'] = null;
                $data['ada_lembur'] = null;
                $data['nama_perusahaan'] = null;
                $data['jenis_perusahaan'] = null;
                $data['jumlah_karyawan'] = null;
                $data['isic_code'] = null;
                $data['isic_title_en'] = null;
                $data['isic_title_id'] = null;
                $data['bidang_perusahaan'] = null;
                $data['punya_pekerjaan_tambahan'] = null;
                $data['status_pekerjaan_tambahan'] = null;
                $data['pekerjaan_tambahan_isco_code'] = null;
                $data['pekerjaan_tambahan_isco_title_en'] = null;
                $data['pekerjaan_tambahan_isco_title_id'] = null;
                $data['jumlah_jam_kerja_tambahan'] = null;
                $data['pernah_bekerja_sebelumnya_lain'] = null;
            }
        }

        if ($this->bekerja_seminggu_terakhir === 'Ya' || $this->punya_pekerjaan_tapi_tidak_bekerja === 'Ya') {
            $data['punya_pekerjaan_tapi_tidak_bekerja'] = ($this->bekerja_seminggu_terakhir === 'Tidak') ? 'Ya' : null;
            $data['pernah_bekerja_sebelumnya'] = null;
            $data['pekerjaan_sebelumnya_isco_code'] = null;
            $data['pekerjaan_sebelumnya_isco_title_en'] = null;
            $data['pekerjaan_sebelumnya_isco_title_id'] = null;
            $data['alasan_tidak_bekerja'] = null;

            $data['pekerjaan_dimulai_setelah_lulus'] = $this->pekerjaan_dimulai_setelah_lulus;
            $data['waktu_tunggu_kerja'] = $this->waktu_tunggu_kerja;
            $data['status_pekerjaan'] = $this->status_pekerjaan;
            $data['gaji_bulanan'] = $this->gaji_bulanan;
            $data['gaji_perbandingan_umr'] = $this->gaji_perbandingan_umr;
            $data['tahun_mulai_bekerja'] = $this->tahun_mulai_bekerja;
            $data['isco_code'] = $this->isco_code;
            $data['isco_title_en'] = $this->isco_title_en;
            $data['isco_title_id'] = $this->isco_title_id;
            $data['jenis_pekerjaan'] = $this->isco_title_id; // Set text field too
            $data['jumlah_jam_kerja'] = $this->jumlah_jam_kerja;
            $data['ada_lembur'] = ((int)$this->jumlah_jam_kerja > 40) ? $this->ada_lembur : 'Tidak';
            $data['nama_perusahaan'] = $this->nama_perusahaan;
            $data['jenis_perusahaan'] = $this->jenis_perusahaan;
            $data['jumlah_karyawan'] = $this->jumlah_karyawan;
            $data['isic_code'] = $this->isic_code;
            $data['isic_title_en'] = $this->isic_title_en;
            $data['isic_title_id'] = $this->isic_title_id;
            $data['bidang_perusahaan'] = $this->isic_title_id; // Set text field too
            
            $data['punya_pekerjaan_tambahan'] = $this->punya_pekerjaan_tambahan;
            if ($this->punya_pekerjaan_tambahan === 'Ya') {
                $data['status_pekerjaan_tambahan'] = $this->status_pekerjaan_tambahan;
                $data['pekerjaan_tambahan_isco_code'] = $this->pekerjaan_tambahan_isco_code;
                $data['pekerjaan_tambahan_isco_title_en'] = $this->pekerjaan_tambahan_isco_title_en;
                $data['pekerjaan_tambahan_isco_title_id'] = $this->pekerjaan_tambahan_isco_title_id;
                $data['jumlah_jam_kerja_tambahan'] = $this->jumlah_jam_kerja_tambahan;
            } else {
                $data['status_pekerjaan_tambahan'] = null;
                $data['pekerjaan_tambahan_isco_code'] = null;
                $data['pekerjaan_tambahan_isco_title_en'] = null;
                $data['pekerjaan_tambahan_isco_title_id'] = null;
                $data['jumlah_jam_kerja_tambahan'] = null;
            }
            $data['pernah_bekerja_sebelumnya_lain'] = $this->pernah_bekerja_sebelumnya_lain;
        }

        // Step 4: Evaluasi & Dampak (Only saved for working respondents)
        if ($this->bekerja_seminggu_terakhir === 'Ya' || $this->punya_pekerjaan_tapi_tidak_bekerja === 'Ya') {
            $data['kesesuaian_bidang_ijazah'] = $this->kesesuaian_bidang_ijazah;
            $data['kesesuaian_jenjang_pendidikan'] = $this->kesesuaian_jenjang_pendidikan;
            $data['jenjang_paling_sesuai'] = $this->jenjang_paling_sesuai;
            
            if ($this->pernah_sertifikasi_lsp === 'Ya' && $this->dapat_sertifikat_bnsp === 'Ya') {
                $data['bnsp_mudahkan_dapat_kerja'] = $this->bnsp_mudahkan_dapat_kerja;
                $data['perusahaan_hargai_bnsp'] = $this->perusahaan_hargai_bnsp;
                $data['bnsp_tingkatkan_karir'] = $this->bnsp_tingkatkan_karir;
                $data['bnsp_tingkatkan_gaji'] = $this->bnsp_tingkatkan_gaji;
                $data['kesesuaian_bidang_bnsp'] = $this->kesesuaian_bidang_bnsp;
                $data['jabatan_sebelum_bnsp'] = $this->jabatan_sebelum_bnsp;
                $data['jabatan_setelah_bnsp'] = $this->jabatan_setelah_bnsp;
            } else {
                $data['bnsp_mudahkan_dapat_kerja'] = null;
                $data['perusahaan_hargai_bnsp'] = null;
                $data['bnsp_tingkatkan_karir'] = null;
                $data['bnsp_tingkatkan_gaji'] = null;
                $data['kesesuaian_bidang_bnsp'] = null;
                $data['jabatan_sebelum_bnsp'] = null;
                $data['jabatan_setelah_bnsp'] = null;
            }
        } else {
            $data['kesesuaian_bidang_ijazah'] = null;
            $data['kesesuaian_jenjang_pendidikan'] = null;
            $data['jenjang_paling_sesuai'] = null;
            $data['bnsp_mudahkan_dapat_kerja'] = null;
            $data['perusahaan_hargai_bnsp'] = null;
            $data['bnsp_tingkatkan_karir'] = null;
            $data['bnsp_tingkatkan_gaji'] = null;
            $data['kesesuaian_bidang_bnsp'] = null;
            $data['jabatan_sebelum_bnsp'] = null;
            $data['jabatan_setelah_bnsp'] = null;
        }

        Respondent::create($data);

        $this->isSubmitted = true;
    }

    public function render()
    {
        return view('livewire.form-kuisioner');
    }
}
