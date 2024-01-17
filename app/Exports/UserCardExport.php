<?php

namespace App\Exports;

use App\Models\UserCard;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class UserCardExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserCard::join('users', 'user_cards.id_user', 'users.id')
                        ->join('kelas', 'user_cards.id_kelas', 'kelas.id')
                        ->join('v_a_users', 'user_cards.id', 'v_a_users.id_user_card')

->join('kategori_users', 'kategori_users.id', 'user_cards.id_kategori_user')

->join('lembagas', 'lembagas.id', 'user_cards.id_lembaga')
                        ->get(['user_cards.nama_usercard','v_a_users.va', 'users.nis_nip', 'user_cards.jk', 'kelas.kelas','nama_lembaga', 'nama_kategori_user', 'users.email', 'users.number_telephone', 'user_cards.alamat','status_user']);
    }

    public function headings(): array
    {
        return ["NAMA USER", "VA", "NIS/NIP", "JENIS KELAMIN", "TAHUN ANGKATAN","LEMBAGA","KATEGORI","EMAIL", "NOMOR HP", "ALAMAT","STATUS"];
    }

    public function registerEvents(): array
    {

        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:K1'; // All headers
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
