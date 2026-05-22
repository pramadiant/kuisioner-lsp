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
            // Default: tampilkan 25 baris per halaman, opsi 25/50/100
            ->paginationPageOptions([25, 50, 100])
            // Default sort: submit terbaru tampil paling atas
            ->defaultSort('created_at', 'desc')
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
                TextColumn::make('ipk')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('melanjutkan_pendidikan')
                    ->badge(),
                TextColumn::make('nama_perusahaan')
                    ->searchable(),
                TextColumn::make('jenis_perusahaan')
                    ->searchable(),
                TextColumn::make('jumlah_karyawan')
                    ->searchable(),
                TextColumn::make('bidang_perusahaan')
                    ->searchable(),
                TextColumn::make('kesesuaian_bidang_ijazah')
                    ->searchable(),
                TextColumn::make('kesesuaian_jenjang_pendidikan')
                    ->searchable(),
                TextColumn::make('jenjang_paling_sesuai')
                    ->searchable(),
                TextColumn::make('bnsp_mudahkan_dapat_kerja')
                    ->searchable(),
                TextColumn::make('perusahaan_hargai_bnsp')
                    ->searchable(),
                TextColumn::make('bnsp_tingkatkan_karir')
                    ->searchable(),
                TextColumn::make('jabatan_sebelum_bnsp')
                    ->searchable(),
                TextColumn::make('jabatan_setelah_bnsp')
                    ->searchable(),
                TextColumn::make('bnsp_tingkatkan_gaji')
                    ->searchable(),
                TextColumn::make('kesesuaian_bidang_bnsp')
                    ->searchable(),

                // Kolom metadata — disembunyikan default, bisa di-toggle karena
                // merupakan info teknis (kapan data masuk/diubah), bukan data survei.
                // Admin bisa mengaktifkannya via ikon kolom (⊞) jika diperlukan.
                TextColumn::make('created_at')
                    ->label('Tanggal Submit')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                \Filament\Tables\Filters\Filter::make('created_at')
                    ->label('Tanggal Submit')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('created_from')->label('Dari Tanggal'),
                        \Filament\Forms\Components\DatePicker::make('created_until')->label('Sampai Tanggal'),
                    ])
                    ->query(function (\Illuminate\Database\Eloquent\Builder $query, array $data): \Illuminate\Database\Eloquent\Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (\Illuminate\Database\Eloquent\Builder $query, $date): \Illuminate\Database\Eloquent\Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (\Illuminate\Database\Eloquent\Builder $query, $date): \Illuminate\Database\Eloquent\Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
                \Filament\Tables\Filters\SelectFilter::make('province_code')
                    ->label('Provinsi')
                    ->options(fn () => \Laravolt\Indonesia\Models\Province::pluck('name', 'code')->toArray())
                    ->searchable(),
                \Filament\Tables\Filters\SelectFilter::make('city_code')
                    ->label('Kabupaten/Kota')
                    ->options(fn () => \Laravolt\Indonesia\Models\City::pluck('name', 'code')->toArray())
                    ->searchable(),
            ])
            ->recordActions([
                \Filament\Actions\ViewAction::make(),
                \Filament\Actions\EditAction::make(),
            ])
            ->headerActions([
                \Filament\Actions\ExportAction::make()
                    ->exporter(\App\Filament\Exports\RespondentExporter::class)
                    ->label('Export Semua Data (CSV)')
                    ->columnMappingColumns(3),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                    \Filament\Actions\ExportBulkAction::make()
                        ->exporter(\App\Filament\Exports\RespondentExporter::class)
                        ->label('Export Terpilih (CSV)')
                        ->columnMappingColumns(3),
                ]),
            ]);
    }
}
