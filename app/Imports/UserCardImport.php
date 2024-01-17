<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Lembaga;
use App\Models\Perusahaan;
use App\Models\Rekening;
use App\Models\User;
use App\Models\UserCard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Symfony\Contracts\Service\Attribute\Required;

class UserCardImport implements ToModel, WithHeadingRow, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // $perusahaan = Perusahaan::where('kd_perusahaan', $row['kode_perusahaan'])->first();


        $user = User::create([
            'name' => $row['nama_usercard'],
            'email' => $row['email'],
            'number_telephone' => $row['number_telephone'],
            'username' => $row['username'],
            'password' => Hash::make($row['password']),
            'level' => 7,
            'nis_nip' => $row['nis_nip'],
            'id_perusahaan' => Session::get('id_perusahaan'),
        ]);

        // $perusahaan = Perusahaan::where('kd_perusahaan', $row['kode_perusahaan'])->first();
        // $user = User::where('nis_nip', $row['nis_nip'])->first();
        // $lembaga = Lembaga::where('nama_lembaga', $row['nama_lembaga'])->first();
        // $kelas = Kelas::where('kelas', $row['kelas'])->first();
        $usercard = UserCard::create([
            'id_perusahaan' => Session::get('id_perusahaan'),
            'id_kategori_user' => Session::get('id_kategori_user'),
            'id_user' => $user->id,
            'id_lembaga' => Session::get('id_lembaga'),
            'id_kelas' => Session::get('id_kelas'),
            'nama_usercard' => $row['nama_usercard'],
            'jk' => $row['jk'],
            'alamat' => $row['alamat'],
            'barcode' => $row['nis_nip'],
        ]);

        $rekening = Rekening::create([
            'id_user_card' => $usercard->id,
            'id_perusahaan' => Session::get('id_perusahaan'),
            'id_rek_poling' => Session::get('id_rek_poling'),
            'saldo_awal' => 0,
            'saldo_akhir' => 0,
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            'id_perusahaan' => 'required',
            'id_lembaga' => 'required',
            'id_kelas' => 'required',
            'id_user' => 'required',
            'nama_usercard' => 'required',
            'nis_nip' => 'required|unique:users',
            'jk' => 'required',
            'alamat' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'number_telephone' => 'required',
            'username' => 'required',
            'password' => 'required|string|min:6|',
        ];
    }
}
