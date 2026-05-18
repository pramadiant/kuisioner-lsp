<?php

namespace App\Filament\Resources\Respondents\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RespondentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('nama')
                    ->searchable(),
                TextColumn::make('jenis_kelamin')
                    ->badge(),
                TextColumn::make('usia')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status_pernikahan')
                    ->badge(),
                TextColumn::make('punya_anak')
                    ->badge(),
                TextColumn::make('jumlah_anak')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('province_code')
                    ->searchable(),
                TextColumn::make('city_code')
                    ->searchable(),
                TextColumn::make('district_code')
                    ->searchable(),
                TextColumn::make('village_code')
                    ->searchable(),
                TextColumn::make('tipe_tempat_tinggal')
                    ->badge(),
                TextColumn::make('pendidikan_tertinggi')
                    ->searchable(),
                TextColumn::make('nama_sekolah')
                    ->searchable(),
                TextColumn::make('perguruan_tinggi')
                    ->searchable(),
                TextColumn::make('program_studi')
                    ->searchable(),
                TextColumn::make('tahun_lulus')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('pernah_sertifikasi_lsp')
                    ->badge(),
                TextColumn::make('dapat_sertifikat_bnsp')
                    ->badge(),
                TextColumn::make('skema_sertifikasi')
                    ->searchable(),
                TextColumn::make('bekerja_seminggu_terakhir')
                    ->badge(),
                TextColumn::make('punya_pekerjaan_tapi_tidak_bekerja')
                    ->badge(),
                TextColumn::make('pernah_bekerja_sebelumnya')
                    ->badge(),
                TextColumn::make('alasan_tidak_bekerja')
                    ->searchable(),
                TextColumn::make('status_pekerjaan')
                    ->searchable(),
                TextColumn::make('gaji_bulanan')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tahun_mulai_bekerja')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('jumlah_jam_kerja')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('ada_lembur')
                    ->badge(),
                TextColumn::make('jenis_pekerjaan')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
