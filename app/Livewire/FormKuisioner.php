<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Respondent;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

class FormKuisioner extends Component
{
    // Variabel untuk menampung daftar pilihan
    public $provinces = [];
    public $cities = [];
    public $districts = [];
    public $villages = [];

    public $isSubmitted = false;

    // Field Form
    public $email;
    public $nama;
    public $jenis_kelamin;
    public $usia;
    public $status_pernikahan;
    public $punya_anak;
    public $jumlah_anak;
    
    // Wilayah
    public $selectedProvince = null;
    public $selectedCity = null;
    public $selectedDistrict = null;
    public $selectedVillage = null;
    public $tipe_tempat_tinggal;
    
    // Pendidikan
    public $pendidikan_tertinggi;
    public $nama_sekolah;
    public $perguruan_tinggi;
    public $program_studi;
    public $tahun_lulus;
    
    // Sertifikasi
    public $pernah_sertifikasi_lsp;
    public $dapat_sertifikat_bnsp;
    public $skema_sertifikasi;
    
    // Pekerjaan
    public $bekerja_seminggu_terakhir;
    public $punya_pekerjaan_tapi_tidak_bekerja;
    public $pernah_bekerja_sebelumnya;
    public $alasan_tidak_bekerja;
    public $status_pekerjaan;
    public $gaji_bulanan;
    public $tahun_mulai_bekerja;
    public $jumlah_jam_kerja;
    public $ada_lembur;
    public $jenis_pekerjaan;

    public function rules()
    {
        return [
            'email' => 'required|email|unique:respondents,email',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'usia' => 'required|integer|min:15|max:70',
            'status_pernikahan' => 'required|in:Belum Menikah,Menikah,Bercerai',
            
            'selectedProvince' => 'required',
            'selectedCity' => 'required',
            'tipe_tempat_tinggal' => 'required|in:Pedesaan,Perkotaan',
            
            'pendidikan_tertinggi' => 'required|string',
            'pernah_sertifikasi_lsp' => 'required|in:Ya,Tidak',
            'bekerja_seminggu_terakhir' => 'required|in:Ya,Tidak',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Maaf, email ini sudah digunakan untuk mengisi kuisioner.',
            'email.required' => 'Email wajib diisi.',
            'nama.required' => 'Nama wajib diisi.',
            'selectedProvince.required' => 'Provinsi wajib dipilih.',
            'selectedCity.required' => 'Kabupaten wajib dipilih.',
        ];
    }

    public function mount()
    {
        $this->provinces = Province::pluck('name', 'code');
    }

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

    public function submit()
    {
        $this->validate();

        Respondent::create([
            'email' => $this->email,
            'nama' => $this->nama,
            'jenis_kelamin' => $this->jenis_kelamin,
            'usia' => $this->usia,
            'status_pernikahan' => $this->status_pernikahan,
            'punya_anak' => $this->punya_anak,
            'jumlah_anak' => $this->jumlah_anak,
            
            'province_code' => $this->selectedProvince,
            'city_code' => $this->selectedCity,
            'district_code' => $this->selectedDistrict,
            'village_code' => $this->selectedVillage,
            'tipe_tempat_tinggal' => $this->tipe_tempat_tinggal,
            
            'pendidikan_tertinggi' => $this->pendidikan_tertinggi,
            'nama_sekolah' => $this->nama_sekolah,
            'perguruan_tinggi' => $this->perguruan_tinggi,
            'program_studi' => $this->program_studi,
            'tahun_lulus' => $this->tahun_lulus,
            
            'pernah_sertifikasi_lsp' => $this->pernah_sertifikasi_lsp,
            'dapat_sertifikat_bnsp' => $this->dapat_sertifikat_bnsp,
            'skema_sertifikasi' => $this->skema_sertifikasi,
            
            'bekerja_seminggu_terakhir' => $this->bekerja_seminggu_terakhir,
            'punya_pekerjaan_tapi_tidak_bekerja' => $this->punya_pekerjaan_tapi_tidak_bekerja,
            'pernah_bekerja_sebelumnya' => $this->pernah_bekerja_sebelumnya,
            'alasan_tidak_bekerja' => $this->alasan_tidak_bekerja,
            'status_pekerjaan' => $this->status_pekerjaan,
            'gaji_bulanan' => $this->gaji_bulanan,
            'tahun_mulai_bekerja' => $this->tahun_mulai_bekerja,
            'jumlah_jam_kerja' => $this->jumlah_jam_kerja,
            'ada_lembur' => $this->ada_lembur,
            'jenis_pekerjaan' => $this->jenis_pekerjaan,
        ]);

        $this->isSubmitted = true;
    }

    public function render()
    {
        return view('livewire.form-kuisioner');
    }
}
