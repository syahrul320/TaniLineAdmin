@extends('template')
@section('title')
Taniline >> Data Merchant
@endsection
@section('breadcrumb')
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Data Merchant</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0 align-items-center">
                <li class="breadcrumb-item"><a href="javascript:;">
                        <ion-icon name="home-outline"></ion-icon>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Data Merchant</li>
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
                <input type="hidden" id="id" class="form-control" name="id" value="">
                <div class="card-body col-sm-12">
                    <div class="form-group has-feedback">
                        <b><label>Nama Merchant</label></b>
                        <input type="text" id="name" class="form-control" placeholder="Nama Merchant" name="name">
                        <span class="text-danger" id="nameError"></span>
                    </div>
                </div>
                <div class="card-body col-sm-12">
                    <div class="form-group has-feedback">
                        <b><label>Email</label></b>
                        <input type="email" id="email" class="form-control" placeholder="Email" name="email">
                        <span class="text-danger" id="emailError"></span>
                    </div>
                </div>
                <div class="card-body col-sm-12">
                    <div class="form-group has-feedback">
                        <b><label>Nomor HP</label></b>
                        <input type="text" id="number_telephone" class="form-control" placeholder="Nomor HP" name="number_telephone">
                        <span class="text-danger" id="number_telephoneError"></span>
                    </div>
                </div>
                <div class="card-body col-sm-12">
                    <div class="form-group has-feedback">
                        <b><label>Alamat</label></b>
                        <input type="text" id="alamat" class="form-control" placeholder="Alamat" name="alamat">
                        <span class="text-danger" id="alamatError"></span>
                    </div>
                </div>
                <div class="card-body col-sm-12">
                    <div class="form-group has-feedback">
                        <b><label>Password</label></b>
                        <input type="password" id="password" class="form-control" name="password">
                        <span class="text-danger" id="passwordError"></span>
                    </div>
                </div>
                <div class="card-footer text-center col-sm-12">
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
            <div class="card-header">
                <button type="button" class="fadeIn animated bx bx-message-square-add btn btn-primary px-5" id="add">
                    Tambah Data
                </button>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="dt_tbl" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Merchant</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Alamat</th>
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
<script src="{{  asset('assets/js/function/merchant.js') }}"></script>
@endpush
