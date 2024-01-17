<?php

namespace App\Exports;

use App\Models\MutasiRekMerchant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class MerchantExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithColumnFormatting, WithEvents
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
        return MutasiRekMerchant::join('merchants', 'mutasi_rek_merchants.id_merchant', '=', 'merchants.id')
            ->select('mutasi_rek_merchants.created_at', 'merchants.nama_merchant', 'mutasi_rek_merchants.debet', 'mutasi_rek_merchants.kredit', 'mutasi_rek_merchants.keterangan')
            ->whereMonth('mutasi_rek_merchants.created_at', $bulan)
            ->whereYear('mutasi_rek_merchants.created_at', $tahun)
            ->orderBy('mutasi_rek_merchants.created_at', 'DESC')
            ->get();
        // return MutasiRekMerchant::all();
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
            $client->nama_merchant,
            $client->debet,
            $client->kredit,
            $client->keterangan
        ];
    }

    public function headings(): array
    {
        return ["TANGGAL TRANSAKSI", "NAMA MERCHANT", "DEBET", "KREDIT", "KETERANGAN"];
    }

    public function registerEvents(): array
    {

        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:E1'; // All headers
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
