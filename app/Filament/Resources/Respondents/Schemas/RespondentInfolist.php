<?php

namespace App\Filament\Resources\Respondents\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RespondentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('nama'),
                TextEntry::make('jenis_kelamin')
                    ->badge(),
                TextEntry::make('usia')
                    ->numeric(),
                TextEntry::make('status_pernikahan')
                    ->badge(),
                TextEntry::make('punya_anak')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('jumlah_anak')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('province_code'),
                TextEntry::make('city_code'),
                TextEntry::make('district_code')
                    ->placeholder('-'),
                TextEntry::make('village_code')
                    ->placeholder('-'),
                TextEntry::make('tipe_tempat_tinggal')
                    ->badge(),
                TextEntry::make('pendidikan_tertinggi'),
                TextEntry::make('nama_sekolah')
                    ->placeholder('-'),
                TextEntry::make('perguruan_tinggi')
                    ->placeholder('-'),
                TextEntry::make('program_studi')
                    ->placeholder('-'),
                TextEntry::make('tahun_lulus')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('pernah_sertifikasi_lsp')
                    ->badge(),
                TextEntry::make('dapat_sertifikat_bnsp')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('skema_sertifikasi')
                    ->placeholder('-'),
                TextEntry::make('bekerja_seminggu_terakhir')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('punya_pekerjaan_tapi_tidak_bekerja')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('pernah_bekerja_sebelumnya')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('alasan_tidak_bekerja')
                    ->placeholder('-'),
                TextEntry::make('status_pekerjaan')
                    ->placeholder('-'),
                TextEntry::make('gaji_bulanan')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('tahun_mulai_bekerja')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('jumlah_jam_kerja')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('ada_lembur')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('jenis_pekerjaan')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
