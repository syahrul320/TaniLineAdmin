<?php

namespace App\Exports;

use App\Models\MutasiMerchant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class MutasiMerchantExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithColumnFormatting, WithEvents
{

    public function __construct()
    {
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $user = request()->input('id_merchant');
        return $data = MutasiMerchant::join('users', 'mutasi_merchants.id_user_merchant', '=', 'users.id')
            ->select('users.name as nama_merchant', 'mutasi_merchants.debet', 'mutasi_merchants.kredit', 'mutasi_merchants.keterangan', 'mutasi_merchants.created_at')
            ->where('mutasi_merchants.id_user_merchant', $user)
            ->get();
    }

    public function headings(): array
    {
        return [
            "NAMA MERCHANT",
            "DEBET",
            "KREDIT",
            "KETERANGAN",
            "TANGGAL",
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'C' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function map($client): array
    {
        return [
            $client->nama_merchant,
            $client->debet,
            $client->kredit,
            $client->keterangan,
            Date::dateTimeToExcel($client->created_at),
        ];
    }

    public function registerEvents(): array
    {

        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:E1';
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
