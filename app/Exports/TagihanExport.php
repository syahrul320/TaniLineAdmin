<?php

namespace App\Exports;

use App\Models\Tagihan_user;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class TagihanExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Tagihan_user::join('master_tagihans', 'tagihan_users.id_master_tagihan', '=', 'master_tagihans.id')
                ->join('user_cards', 'tagihan_users.id_user_card', '=', 'user_cards.id')->join('users', 'user_cards.id_user', '=', 'users.id');
                
                
                if(request()->id_user_card !=''){
                    $data = $data->where('tagihan_users.id_user_card',request()->id_user_card);
                } 
                if(request()->status !=''){
                    $data = $data->where('tagihan_users.status',request()->status);
                }
                
                if(request()->start_date !=''){
                    $from = Carbon::createFromFormat('Y-m-d', request()->start_date)->startOfDay();
                    $to = Carbon::createFromFormat('Y-m-d', request()->end_date)->endOfDay();
    
                    $data =  $data->whereDate('master_tagihans.tgl_harus_bayar', '>=', $from)
                        ->whereDate('master_tagihans.tgl_harus_bayar', '<=', $to);
                }

        $data = $data->get(['master_tagihans.nama', 'master_tagihans.total', 'master_tagihans.tgl_harus_bayar', 'user_cards.nama_usercard','users.nis_nip','tagihan_users.status']);
        return $data;
        // return Tagihan_user::all();
    }

    public function headings(): array
    {
        return ["NAMA TAGIHAN","TOTAL TAGIHAN", "TANGGAL JATUH TEMPO", "NAMA USER","NIS/NIP" ,"STATUS"];
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
