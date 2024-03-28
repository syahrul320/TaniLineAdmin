<?php

namespace App\Exports;

use App\Models\DetailTransaksi;
use Faker\Core\Number;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class LaporanMerchantExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithColumnFormatting, WithEvents
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
        return $data = DetailTransaksi::join('transaksis', 'detail_transaksis.id_transaksi', '=', 'transaksis.id')
            ->join('users', 'transaksis.id_user_pembeli', '=', 'users.id')
            ->join('produks', 'detail_transaksis.id_produk', '=', 'produks.id')
            ->select('transaksis.kode_transaksi', 'users.name', 'produks.nama_produk', 'transaksis.biaya_admin', 'transaksis.status_transaksi', 'transaksis.tgl_transaksi', 'detail_transaksis.harga_jual', 'detail_transaksis.qty')
            ->where('detail_transaksis.id_user_merchant', $user)
            ->get();
    }

    public function headings(): array
    {
        return [
            "KODE TRANSAKSI",
            "NAMA PEMBELI",
            "NAMA PRODUK",
            "BIAYA ADMIN",
            "STATUS TRANSAKSI",
            "HARGA JUAL",
            "QTY",
            "TANGGAL TRANSAKSI"
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'G' => NumberFormat::FORMAT_NUMBER,
            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function map($client): array
    {
        return [
            $client->kode_transaksi,
            $client->name,
            $client->nama_produk,
            $client->biaya_admin,
            $client->status_transaksi,
            $client->harga_jual,
            $client->qty,
            $client->tgl_transaksi,
        ];
    }

    public function registerEvents(): array
    {

        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:H1';
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
