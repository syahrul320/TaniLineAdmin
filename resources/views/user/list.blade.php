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
                <li class="breadcrumb-item active" aria-current="page">Data User</li>
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
            <form id="form" enctype="multipart/form-data">
                <div class="card-body col-sm-5">
                    <div class="form-group has-feedback">
                        <b><label>Nama</label></b>
                        <input type="hidden" id="id_perusahaan" class="form-control" name="id_perusahaan" value="{{ $perusahaan->id }}">
                        <input type="hidden" id="id" class="form-control" name="id" value="">
                        <input type="text" placeholder="Name" id="name" class="form-control" name="name">
                        <span class="text-danger" id="nameError"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <b><label>Email</label></b>
                        <input type="email" placeholder="Email@example.com" id="email" class="form-control" name="email">
                        <span class="text-danger" id="emailError"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <b><label>Nomor Hp</label></b>
                        <input type="text" placeholder="0812-3332-2322" id="number_telephone" class="form-control" name="number_telephone">
                        <span class="text-danger" id="number_telephoneError"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <b><label>Username</label></b>
                        <input type="text" placeholder="Username" id="username" class="form-control" name="username">
                        <span class="text-danger" id="usernameError"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <b><label>Password</label></b>
                        <input type="password" id="password" class="form-control" name="password">
                        <span class="text-danger" id="passwordError"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <b><label>Level</label></b>
                        <select class="form-control" id="level" name="level">
                            <option>-Silahkan Pilih-</option>
                            <option value="1">Admin Super</option>
                            <option value="2">Admin Perusahaan</option>
                            <option value="3">Merchant</option>
                            <option value="4">Customer Service</option>
                            <option value="5">Teller</option>
                            <option value="8">Informasi</option>
                            <span class="text-danger" id="levelError"></span>
                        </select>
                    </div>
                    <div class="form-group has-feedback">
                        <b><label>NIS / NIP</label></b>
                        <input type="text" placeholder="123" id="nis_nip" class="form-control" name="nis_nip">
                        <span class="text-danger" id="nis_nipError"></span>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-primary" id="submit">
                            Simpan
                        </button>
                        <a href="javascript:void(0)" class="btn btn-secondary" id="close-form">
                            <ion-icon name="log-in-outline"></ion-icon>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-outline-primary" id="add">
                    <ion-icon name="add-circle-outline"></ion-icon> Tambah Data
                </button>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="dt_tbl" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>NIS/NIP</th>
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
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')

<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script src="{{  asset('assets/js/function/user_list.js') }}"></script>
@endpush
