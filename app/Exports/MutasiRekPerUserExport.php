<?php

namespace App\Exports;

use App\Models\MutasiRek;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class MutasiRekPerUserExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithColumnFormatting, WithEvents
{

    public function __construct()
    {
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $user = request()->input('id_user_card');
        // return MutasiRek::join('user_cards', 'mutasi_reks.id_user_card', 'user_cards.id')
        //     ->join('users', 'user_cards.id_user', 'users.id')
        //     ->select('mutasi_reks.created_at', 'mutasi_reks.debet', 'mutasi_reks.kredit','mutasi_reks.keterangan')
        //     ->where('mutasi_reks.id_user_card', $user)
        //     ->get();
        $data = DB::select("SELECT nis_nip, nama_usercard, mr.created_at, mr.debet AS debet, mr.kredit AS kredit, @saldo:=@saldo-mr.debet+mr.kredit AS saldo, mr.keterangan as keterangan
                            FROM mutasi_reks mr 
                            JOIN (SELECT @saldo:=0) a
                            JOIN user_cards ON mr.id_user_card =  user_cards.id
                            JOIN  users ON user_cards.id_user =  users.id
                            WHERE mr.id_user_card = ".$user."
                            ORDER BY mr.id asc");
        return collect($data);

    }

    public function headings(): array
    {
        return ["TANGGAL TRANSAKSI", "NIS/NIP", "USER CARD","DEBET", "KREDIT",  "SALDO",  "KETERANGAN"];
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
            $client->created_at,
            $client->nis_nip,
            $client->nama_usercard,
            $client->debet,
            $client->kredit,
            $client->saldo,
            $client->keterangan
        ];
    }

    public function registerEvents(): array
    {

        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:G1'; // All headers
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
