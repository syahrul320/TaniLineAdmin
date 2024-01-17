@extends('template')
@section('title')
Thohir Yasin Core >> Data User
@endsection
@section('breadcrumb')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Data User</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0 align-items-center">
                <li class="breadcrumb-item"><a href="javascript:;">
                        <ion-icon name="home-outline"></ion-icon>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $perusahaan->nama}}</li>
            </ol>
        </nav>
    </div>
</div>
@endsection
@section('content')
<div class="row" id="card-form">
    <div class="col-12">
        <div class="card">
            <div class="card-header  d-flex flex-row align-items-center">
                <b class="float-left">Form</b>
            </div>
            <form id="form" enctype="multipart/form-data" autocomplete="off">
                <div class="card-body col-sm-6">
                    <div class="form-group has-feedback">
                        <b><label>Nama</label></b>
                        <input type="hidden" id="id" class="form-control" name="id" value="">
                        <input type="hidden" value="{{ encrypt($perusahaan->id) }}" id="id_perusahaan"
                            class="form-control" name="id_perusahaan">
                        <input type="text" id="nama_usercard" placeholder="Nama User" class="form-control" required name="nama_usercard">
                        <span class="text-danger" id="nama_usercardError"></span>
                    </div>
                    <div class="form-group has-feedback" id="rek_poling">
                        <b><label>Bank</label></b>
                        <select name="id_rek_poling" id="id_rek_poling" class="form-control">
                            <option value="">---Pilih Bank---</option>
                            @foreach ($rekening_poling as $rekening_poling)
                            <option value="{{ $rekening_poling->id }}">{{ $rekening_poling->banks->nama_bank }}
                                <!-- - {{
                                $rekening_poling->atas_nama }} -->
                            </option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="id_rek_polingError"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <b><label>Kategori</label></b>
                        <select name="id_kategori_user" required id="id_kategori_user" class="form-control">
                            <option value="">---Pilih Kategori---</option>
                            @foreach ($katergori_user as $katergori_user)
                            <option value="{{ $katergori_user->id }}">{{ $katergori_user->nama_kategori_user }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="id_kategori_userError"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <b><label>NIS/NIP</label></b>
                        <input type="text" id="nis_nip" required placeholder="Contoh - 1809599001" class="form-control" name="nis_nip">
                        <span class="text-danger" id="nis_nipError"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <b><label>Jenis Kelamin</label></b>
                        <select name="jk" id="jk" required class="form-control">
                            <option value="">---Pilih Jenis Kelamin---</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <span class="text-danger" id="jenis_kelaminError"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <b><label>Lembaga</label></b>
                        <select name="id_lembaga" required id="id_lembaga" class="form-control">
                            <option value="">---Pilih Lembaga---</option>
                            @foreach ($lembaga as $key)
                            <option value="{{ $key->id }}">{{ $key->nama_lembaga }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="id_lembagaError"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <b><label>Kelas</label></b>
                        <select name="id_kelas" required id="id_kelas" class="form-control">
                            <option value="">---Pilih Tahun Angkatan---</option>
                        </select>
                        <span class="text-danger" id="id_kelasError"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <b><label>Email</label></b>
                        <input type="text" required id="email" placeholder="contoh@gmail.com" class="form-control" name="email">
                        <span class="text-danger" id="emailError"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <b><label>Nomor HP</label></b>
                        <input type="text" required id="nohp" placeholder="08XX-XXXX-XXXX" class="form-control" name="nohp">
                        <span class="text-danger" id="nohpError"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <b><label>Alamat</label></b>
                        <textarea id="alamat" required name="alamat" placeholder="Masukkan Alamat Lengkap"
                            class="form-control"></textarea>
                        <span class="text-danger" id="usernameError"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <b><label>Username</label></b>
                        <input type="text" required id="username" placeholder="Username" class="form-control" name="username">
                        <span class="text-danger" id="usernameError"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <b><label>Password</label></b>
                        <input type="password" id="password" placeholder="Password" class="form-control" name="password">
                        <span class="text-danger" id="passwordError"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <b><label>Limit Harian</label></b>
                        <input type="number" id="limit_harian" placeholder="Limit Harian" class="form-control" name="limit_harian">
                        <span class="text-danger" id="limit_harianError"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <b><label>Status User</label></b>
                        <select name="status_user" id="status_user" class="form-control">
                            <option value="">---Pilih Status User---</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Non Aktif">Non Aktif</option>
                        </select>
                        <span class="text-danger" id="status_userError"></span>
                    </div>
                    
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-primary" id="submit">
                        Simpan
                    </button>
                    <a href="javascript:void(0)" class="btn btn-secondary" id="close-form">
                        <ion-icon name="log-in-outline"></ion-icon>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="display: flex;">
                <div style="text-align: left;" class="col-6">
                    <button type="button" class="btn btn-outline-primary" id="add">
                        <ion-icon name="add-circle-outline"></ion-icon> Tambah Data
                    </button>
                </div>
                <div style="text-align: right;" class="col-6">
                <a href="{{ route('usercard.export') }}">
                    <button type="button" class="btn btn-outline-primary" id="add">
                        <ion-icon name="add-circle-outline"></ion-icon> Excel
                    </button>
                </a>
                <a href="/usercardku/{{ encrypt($perusahaan->id) }}">
                    <button type="button" class="btn btn-outline-primary" id="add">
                        <ion-icon name="add-circle-outline"></ion-icon> Import
                    </button>
                </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="dt_tbl" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>VA</th>
                            <th>Nama</th>
                            <th>NIS/NIP</th>
                            <th>Jenis Kelamin</th>
                            <th>Lembaga</th>
                            <th>Kategori User</th>
                            <th>Angkatan</th>
                            <th>Nomor HP</th>
                            <th>Email</th>
                            <th>Limit Harian</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@push('scripts')

<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script src="{{  asset('assets/js/jquery.timer.js') }}"></script>
<script src="{{  asset('assets/js/ajaxmask.js') }}"></script>
<script src="{{  asset('assets/js/function/user_card.js') }}"></script>
@endpush
