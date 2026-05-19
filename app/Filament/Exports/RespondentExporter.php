<?php

namespace App\Filament\Exports;

use App\Models\Respondent;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class RespondentExporter extends Exporter
{
    protected static ?string $model = Respondent::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('email'),
            ExportColumn::make('nama'),
            ExportColumn::make('jenis_kelamin'),
            ExportColumn::make('usia'),
            ExportColumn::make('status_pernikahan'),
            ExportColumn::make('punya_anak'),
            ExportColumn::make('jumlah_anak'),
            ExportColumn::make('province_code'),
            ExportColumn::make('city_code'),
            ExportColumn::make('district_code'),
            ExportColumn::make('village_code'),
            ExportColumn::make('tipe_tempat_tinggal'),
            ExportColumn::make('pendidikan_tertinggi'),
            ExportColumn::make('nama_sekolah'),
            ExportColumn::make('perguruan_tinggi'),
            ExportColumn::make('program_studi'),
            ExportColumn::make('tahun_lulus'),
            ExportColumn::make('ipk'),
            ExportColumn::make('melanjutkan_pendidikan'),
            ExportColumn::make('pernah_sertifikasi_lsp'),
            ExportColumn::make('dapat_sertifikat_bnsp'),
            ExportColumn::make('skema_sertifikasi'),
            ExportColumn::make('bekerja_seminggu_terakhir'),
            ExportColumn::make('punya_pekerjaan_tapi_tidak_bekerja'),
            ExportColumn::make('pernah_bekerja_sebelumnya'),
            ExportColumn::make('alasan_tidak_bekerja'),
            ExportColumn::make('status_pekerjaan'),
            ExportColumn::make('gaji_bulanan'),
            ExportColumn::make('tahun_mulai_bekerja'),
            ExportColumn::make('jumlah_jam_kerja'),
            ExportColumn::make('ada_lembur'),
            ExportColumn::make('jenis_pekerjaan'),
            ExportColumn::make('nama_perusahaan'),
            ExportColumn::make('jenis_perusahaan'),
            ExportColumn::make('jumlah_karyawan'),
            ExportColumn::make('bidang_perusahaan'),
            ExportColumn::make('kesesuaian_bidang_ijazah'),
            ExportColumn::make('kesesuaian_jenjang_pendidikan'),
            ExportColumn::make('jenjang_paling_sesuai'),
            ExportColumn::make('bnsp_mudahkan_dapat_kerja'),
            ExportColumn::make('perusahaan_hargai_bnsp'),
            ExportColumn::make('bnsp_tingkatkan_karir'),
            ExportColumn::make('jabatan_sebelum_bnsp'),
            ExportColumn::make('jabatan_setelah_bnsp'),
            ExportColumn::make('bnsp_tingkatkan_gaji'),
            ExportColumn::make('kesesuaian_bidang_bnsp'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your respondent export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
