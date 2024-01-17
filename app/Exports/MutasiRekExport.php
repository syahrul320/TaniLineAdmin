<?php

namespace App\Exports;

use App\Models\MutasiRek;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class MutasiRekExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithColumnFormatting, WithEvents
{

    public function __construct()
    {
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $bulan = request()->input('bulan');
        $tahun = request()->input('tahun');
        return MutasiRek::join('user_cards', 'mutasi_reks.id_user_card', '=', 'user_cards.id')->join('users', 'user_cards.id_user', '=', 'users.id')
            ->select('mutasi_reks.created_at', 'user_cards.nama_usercard', 'users.nis_nip', 'mutasi_reks.debet', 'mutasi_reks.kredit', 'mutasi_reks.keterangan')
            ->whereMonth('mutasi_reks.created_at', $bulan)
            ->whereYear('mutasi_reks.created_at', $tahun)
            ->orderBy('mutasi_reks.created_at', 'DESC')
            ->get();
    }

    public function headings(): array
    {
        return ["TANGGAL TRANSAKSI", "NAMA USER", "NIS/NIP", "DEBET", "KREDIT", "KETERANGAN"];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }

    public function map($client): array
    {
        return [
            Date::dateTimeToExcel($client->created_at),
            $client->nama_usercard,
            $client->nis_nip,
            $client->debet,
            $client->kredit,
            $client->keterangan
        ];
    }

    public function registerEvents(): array
    {

        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:F1'; // All headers
                $event->sheet->getDelegate()
                    ->getStyle($cellRange)
                    ->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFA500');
            },
        ];
    }
}
