<?php

namespace App\Filament\Resources\Respondents\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RespondentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('nama')
                    ->required(),
                Select::make('jenis_kelamin')
                    ->options(['Laki-Laki' => 'Laki  laki', 'Perempuan' => 'Perempuan'])
                    ->required(),
                TextInput::make('usia')
                    ->required()
                    ->numeric(),
                Select::make('status_pernikahan')
                    ->options(['Belum Menikah' => 'Belum menikah', 'Menikah' => 'Menikah', 'Bercerai' => 'Bercerai'])
                    ->required(),
                Select::make('punya_anak')
                    ->options(['Ya' => 'Ya', 'Tidak' => 'Tidak']),
                TextInput::make('jumlah_anak')
                    ->numeric(),
                TextInput::make('province_code')
                    ->required(),
                TextInput::make('city_code')
                    ->required(),
                TextInput::make('district_code'),
                TextInput::make('village_code'),
                Select::make('tipe_tempat_tinggal')
                    ->options(['Pedesaan' => 'Pedesaan', 'Perkotaan' => 'Perkotaan'])
                    ->required(),
                TextInput::make('pendidikan_tertinggi')
                    ->required(),
                TextInput::make('nama_sekolah'),
                TextInput::make('perguruan_tinggi'),
                TextInput::make('program_studi'),
                TextInput::make('tahun_lulus')
                    ->numeric(),
                Select::make('pernah_sertifikasi_lsp')
                    ->options(['Ya' => 'Ya', 'Tidak' => 'Tidak'])
                    ->required(),
                Select::make('dapat_sertifikat_bnsp')
                    ->options(['Ya' => 'Ya', 'Tidak' => 'Tidak']),
                TextInput::make('skema_sertifikasi'),
                Select::make('bekerja_seminggu_terakhir')
                    ->options(['Ya' => 'Ya', 'Tidak' => 'Tidak']),
                Select::make('punya_pekerjaan_tapi_tidak_bekerja')
                    ->options(['Ya' => 'Ya', 'Tidak' => 'Tidak']),
                Select::make('pernah_bekerja_sebelumnya')
                    ->options(['Ya' => 'Ya', 'Tidak' => 'Tidak']),
                TextInput::make('alasan_tidak_bekerja'),
                TextInput::make('status_pekerjaan'),
                TextInput::make('gaji_bulanan')
                    ->numeric(),
                TextInput::make('tahun_mulai_bekerja')
                    ->numeric(),
                TextInput::make('jumlah_jam_kerja')
                    ->numeric(),
                Select::make('ada_lembur')
                    ->options(['Ya' => 'Ya', 'Tidak' => 'Tidak']),
                TextInput::make('jenis_pekerjaan'),
            ]);
    }
}
