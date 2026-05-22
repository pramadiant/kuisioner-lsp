<?php

namespace App\Filament\Resources\Respondents\Schemas;

use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RespondentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // ────────────────────────────────────────────
                // BAGIAN 1: DEMOGRAFI
                // ────────────────────────────────────────────
                Fieldset::make('Bagian 1: Demografi')
                    ->columns(2)
                    ->schema([
                        TextInput::make('email')
                            ->label('Alamat Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->columnSpanFull(),

                        TextInput::make('nama')
                            ->label('Nama Lengkap')
                            ->required()
                            ->regex('/^[a-zA-Z\s]+$/')
                            ->validationMessages([
                                'regex' => 'Nama lengkap hanya boleh berisi huruf dan spasi.',
                            ])
                            ->columnSpanFull(),

                        Select::make('jenis_kelamin')
                            ->label('Jenis Kelamin')
                            ->options(['Laki-Laki' => 'Laki-Laki', 'Perempuan' => 'Perempuan'])
                            ->required(),

                        TextInput::make('usia')
                            ->label('Usia (Tahun)')
                            ->numeric()
                            ->minValue(15)
                            ->maxValue(70)
                            ->required(),

                        Select::make('status_pernikahan')
                            ->label('Status Pernikahan')
                            ->options(['Belum Menikah' => 'Belum Menikah', 'Menikah' => 'Menikah', 'Bercerai' => 'Bercerai'])
                            ->required(),

                        Select::make('punya_anak')
                            ->label('Apakah Memiliki Anak?')
                            ->options(['Ya' => 'Ya', 'Tidak' => 'Tidak']),

                        TextInput::make('jumlah_anak')
                            ->label('Jumlah Anak')
                            ->numeric()
                            ->minValue(1),

                        Select::make('tipe_tempat_tinggal')
                            ->label('Tipe Tempat Tinggal')
                            ->options(['Pedesaan' => 'Pedesaan', 'Perkotaan' => 'Perkotaan'])
                            ->required(),

                        TextInput::make('province_code')
                            ->label('Kode Provinsi')
                            ->required(),

                        TextInput::make('city_code')
                            ->label('Kode Kabupaten/Kota')
                            ->required(),

                        TextInput::make('district_code')
                            ->label('Kode Kecamatan'),

                        TextInput::make('village_code')
                            ->label('Kode Kelurahan/Desa'),
                    ]),

                // ────────────────────────────────────────────
                // BAGIAN 2: PENDIDIKAN & SERTIFIKASI
                // ────────────────────────────────────────────
                Fieldset::make('Bagian 2: Pendidikan & Sertifikasi')
                    ->columns(2)
                    ->schema([
                        Select::make('pendidikan_tertinggi')
                            ->label('Pendidikan Tertinggi')
                            ->options([
                                'SMA/Sederajat' => 'SMA/Sederajat',
                                'D1' => 'Diploma 1',
                                'D2' => 'Diploma 2',
                                'D3' => 'Diploma 3',
                                'D4/S1' => 'D4 / Strata 1 (S1)',
                                'S2' => 'Strata 2 (S2)',
                                'S3' => 'Strata 3 (S3)',
                            ])
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('nama_sekolah')
                            ->label('Nama Sekolah (jika SMA)')
                            ->columnSpanFull(),

                        TextInput::make('perguruan_tinggi')
                            ->label('Nama Perguruan Tinggi')
                            ->columnSpanFull(),

                        TextInput::make('program_studi')
                            ->label('Program Studi'),

                        TextInput::make('tahun_lulus')
                            ->label('Tahun Lulus')
                            ->numeric()
                            ->minValue(2015)
                            ->maxValue(2026),

                        TextInput::make('ipk')
                            ->label('IPK')
                            ->numeric()
                            ->minValue(2.50)
                            ->maxValue(4.00)
                            ->step(0.01),

                        Select::make('melanjutkan_pendidikan')
                            ->label('Melanjutkan Pendidikan?')
                            ->options(['Ya' => 'Ya', 'Tidak' => 'Tidak']),

                        Select::make('pernah_sertifikasi_lsp')
                            ->label('Pernah Ikut Sertifikasi LSP?')
                            ->options(['Ya' => 'Ya', 'Tidak' => 'Tidak'])
                            ->required(),

                        Select::make('dapat_sertifikat_bnsp')
                            ->label('Mendapatkan Sertifikat BNSP?')
                            ->options(['Ya' => 'Ya', 'Tidak' => 'Tidak']),

                        TextInput::make('skema_sertifikasi')
                            ->label('Nama Skema Sertifikasi')
                            ->columnSpanFull(),
                    ]),

                // ────────────────────────────────────────────
                // BAGIAN 3: PEKERJAAN
                // ────────────────────────────────────────────
                Fieldset::make('Bagian 3: Pekerjaan')
                    ->columns(2)
                    ->schema([
                        Select::make('bekerja_seminggu_terakhir')
                            ->label('Bekerja Seminggu Terakhir?')
                            ->options(['Ya' => 'Ya', 'Tidak' => 'Tidak']),

                        Select::make('punya_pekerjaan_tapi_tidak_bekerja')
                            ->label('Punya Pekerjaan Tapi Tidak Bekerja?')
                            ->options(['Ya' => 'Ya', 'Tidak' => 'Tidak']),

                        Select::make('pernah_bekerja_sebelumnya')
                            ->label('Pernah Bekerja Sebelumnya?')
                            ->options(['Ya' => 'Ya', 'Tidak' => 'Tidak']),

                        TextInput::make('alasan_tidak_bekerja')
                            ->label('Alasan Tidak Bekerja'),

                        Select::make('pekerjaan_dimulai_setelah_lulus')
                            ->label('Pekerjaan Dimulai Setelah Lulus?')
                            ->options(['Ya' => 'Ya', 'Tidak' => 'Tidak']),

                        TextInput::make('waktu_tunggu_kerja')
                            ->label('Waktu Tunggu Kerja (bulan)')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(60),

                        Select::make('status_pekerjaan')
                            ->label('Status Pekerjaan Utama')
                            ->options([
                                'Berusaha sendiri/wiraswasta' => 'Berusaha sendiri/wiraswasta',
                                'Berwirausaha dengan dibantu oleh tenaga kerja tetap' => 'Berwirausaha (tenaga kerja tetap)',
                                'Berwirausaha dengan dibantu oleh tenaga kerja tidak tetap' => 'Berwirausaha (tenaga kerja tidak tetap)',
                                'Karyawan/pegawai/buruh' => 'Karyawan/pegawai/buruh',
                                'Pekerja lepas pertanian' => 'Pekerja lepas pertanian',
                                'Pekerja lepas non-pertanian' => 'Pekerja lepas non-pertanian',
                                'Pekerja keluarga tidak dibayar' => 'Pekerja keluarga tidak dibayar',
                            ]),

                        TextInput::make('gaji_bulanan')
                            ->label('Gaji Bulanan (Rp)')
                            ->numeric()
                            ->minValue(0),

                        Select::make('gaji_perbandingan_umr')
                            ->label('Perbandingan Gaji dengan UMR')
                            ->options([
                                'Di Bawah UMR' => 'Di Bawah UMR',
                                'Sesuai UMR' => 'Sesuai UMR',
                                'Di Atas UMR' => 'Di Atas UMR',
                            ]),

                        TextInput::make('tahun_mulai_bekerja')
                            ->label('Tahun Mulai Bekerja')
                            ->numeric()
                            ->minValue(1970)
                            ->maxValue(2026),

                        TextInput::make('jumlah_jam_kerja')
                            ->label('Jumlah Jam Kerja/Minggu')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(84),

                        Select::make('ada_lembur')
                            ->label('Ada Lembur?')
                            ->options(['Ya' => 'Ya', 'Tidak' => 'Tidak']),

                        TextInput::make('nama_perusahaan')
                            ->label('Nama Perusahaan')
                            ->columnSpanFull(),

                        Select::make('jenis_perusahaan')
                            ->label('Jenis Perusahaan')
                            ->options([
                                'Instansi Pemerintah/BUMN/TNI-Polri' => 'Instansi Pemerintah/BUMN/TNI-Polri',
                                'Perusahaan Swasta Nasional' => 'Perusahaan Swasta Nasional',
                                'Perusahaan Swasta Multinasional/Asing' => 'Perusahaan Swasta Multinasional/Asing',
                                'Wirausaha/Usaha Mandiri' => 'Wirausaha/Usaha Mandiri',
                                'Organisasi Non-Profit/LSM' => 'Organisasi Non-Profit/LSM',
                                'Lainnya' => 'Lainnya',
                            ]),

                        Select::make('jumlah_karyawan')
                            ->label('Jumlah Karyawan Perusahaan')
                            ->options([
                                '1-4 orang (Usaha Mikro)' => '1-4 orang (Usaha Mikro)',
                                '5-19 orang (Usaha Kecil)' => '5-19 orang (Usaha Kecil)',
                                '20-99 orang (Usaha Menengah)' => '20-99 orang (Usaha Menengah)',
                                '100 orang atau lebih (Usaha Besar)' => '100 orang atau lebih (Usaha Besar)',
                            ]),

                        TextInput::make('bidang_perusahaan')
                            ->label('Bidang Perusahaan (ISIC)')
                            ->columnSpanFull(),

                        TextInput::make('jenis_pekerjaan')
                            ->label('Jenis Pekerjaan (ISCO)')
                            ->columnSpanFull(),

                        Select::make('punya_pekerjaan_tambahan')
                            ->label('Punya Pekerjaan Tambahan?')
                            ->options(['Ya' => 'Ya', 'Tidak' => 'Tidak']),

                        Select::make('pernah_bekerja_sebelumnya_lain')
                            ->label('Pernah Bekerja di Tempat Lain Sebelumnya?')
                            ->options(['Ya' => 'Ya', 'Tidak' => 'Tidak']),
                    ]),

                // ────────────────────────────────────────────
                // BAGIAN 4: EVALUASI & DAMPAK BNSP
                // ────────────────────────────────────────────
                Fieldset::make('Bagian 4: Evaluasi & Dampak BNSP')
                    ->columns(2)
                    ->schema([
                        Select::make('kesesuaian_bidang_ijazah')
                            ->label('Kesesuaian Pekerjaan dengan Bidang Ijazah')
                            ->options([
                                'Sangat Sesuai' => 'Sangat Sesuai',
                                'Sesuai' => 'Sesuai',
                                'Cukup Sesuai' => 'Cukup Sesuai',
                                'Tidak Sesuai' => 'Tidak Sesuai',
                                'Tidak Sesuai Sama Sekali' => 'Tidak Sesuai Sama Sekali',
                            ])
                            ->columnSpanFull(),

                        Select::make('kesesuaian_jenjang_pendidikan')
                            ->label('Kesesuaian Pekerjaan dengan Jenjang Pendidikan')
                            ->options([
                                'Jenjang pendidikan saya terlalu rendah untuk pekerjaan ini (perlu pendidikan tambahan)' => 'Terlalu rendah (butuh pendidikan tambahan)',
                                'Jenjang pendidikan saya sudah sesuai dengan pekerjaan ini' => 'Sudah sesuai',
                                'Jenjang pendidikan saya terlalu tinggi untuk pekerjaan ini' => 'Terlalu tinggi',
                            ]),

                        Select::make('jenjang_paling_sesuai')
                            ->label('Jenjang Pendidikan Paling Sesuai untuk Pekerjaan Ini')
                            ->options([
                                'Tidak memerlukan jenjang pendidikan' => 'Tidak memerlukan jenjang pendidikan',
                                'Sekolah Dasar' => 'Sekolah Dasar',
                                'Sekolah Menengah Pertama/Sederajat' => 'SMP/Sederajat',
                                'Sekolah Menengah Atas/Sekolah Menengah Kejuruan/Sederajat' => 'SMA/SMK/Sederajat',
                                'Diploma 1, 2, atau 3' => 'Diploma 1, 2, atau 3',
                                'Strata 1' => 'Strata 1 (S1)',
                                'Strata 2 atau Strata 3' => 'Strata 2 atau 3 (Pascasarjana)',
                            ]),

                        Select::make('bnsp_mudahkan_dapat_kerja')
                            ->label('BNSP Membantu Mendapat Kerja?')
                            ->options([
                                'Tidak mendukung sama sekali' => '1. Tidak mendukung sama sekali',
                                'Sedikit mendukung' => '2. Sedikit mendukung',
                                'Cukup Mendukung' => '3. Cukup mendukung',
                                'Mendukung' => '4. Mendukung',
                                'Sangat Mendukung' => '5. Sangat mendukung',
                            ]),

                        Select::make('perusahaan_hargai_bnsp')
                            ->label('Perusahaan Menghargai Sertifikat BNSP?')
                            ->options([
                                'Tidak menyambut sama sekali' => '1. Tidak menghargai sama sekali',
                                'Sedikit menyambut baik' => '2. Sedikit menyambut baik',
                                'Cukup menyambut baik' => '3. Cukup menyambut baik',
                                'Menyambut baik' => '4. Menyambut baik',
                                'Sangat menyambut baik' => '5. Sangat menyambut baik',
                            ]),

                        Select::make('bnsp_tingkatkan_karir')
                            ->label('BNSP Berdampak pada Peningkatan Karir?')
                            ->options([
                                'Tidak Berdampak Terhadap Peningkatan Karir Sama Sekali' => '1. Tidak berdampak sama sekali',
                                'Sedikit Berdampak Terhadap Peningkatan Karir' => '2. Sedikit berdampak',
                                'Cukup Berdampak Terhadap Peningkatan Karir' => '3. Cukup berdampak',
                                'Berdampak Terhadap Peningkatan Karir' => '4. Berdampak',
                                'Sangat Berdampak Terhadap Peningkatan Karir' => '5. Sangat berdampak',
                            ]),

                        Select::make('bnsp_tingkatkan_gaji')
                            ->label('BNSP Berdampak pada Peningkatan Gaji?')
                            ->options([
                                'Tidak Berdampak Terhadap Peningkatan Pendapatan/Gaji Sama Sekali' => '1. Tidak berdampak sama sekali',
                                'Sedikit Berdampak Terhadap Peningkatan Pendapatan/Gaji' => '2. Sedikit berdampak',
                                'Cukup Berdampak Terhadap Peningkatan Pendapatan/Gaji' => '3. Cukup berdampak',
                                'Berdampak Terhadap Peningkatan Pendapatan/Gaji' => '4. Berdampak',
                                'Sangat Berdampak Terhadap Peningkatan Pendapatan/Gaji' => '5. Sangat berdampak',
                            ]),

                        Select::make('kesesuaian_bidang_bnsp')
                            ->label('Pekerjaan Sesuai Bidang Sertifikat BNSP?')
                            ->options(['Ya' => 'Ya (Sesuai)', 'Tidak' => 'Tidak (Tidak Sesuai)']),

                        TextInput::make('jabatan_sebelum_bnsp')
                            ->label('Jabatan SEBELUM Memiliki Sertifikat BNSP'),

                        TextInput::make('jabatan_setelah_bnsp')
                            ->label('Jabatan SETELAH Memiliki Sertifikat BNSP'),
                    ]),
            ]);
    }
}
