@extends('template')
@section('title')
Taniline >> Data Produk
@endsection
@section('breadcrumb')
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Data Produk</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0 align-items-center">
                <li class="breadcrumb-item"><a href="javascript:;">
                        <ion-icon name="home-outline"></ion-icon>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Data Produk</li>
            </ol>
        </nav>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row" style="margin-bottom: 25px">
                    <div class="col-sm-3">
                        <label>Nama Merchant</label>
                        <select id='id_user_merchant' class='form-control' name="id_user_merchant">
                            <option value=''>-- Pilih Merchant --</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label>Nama Kategori</label>
                        <select id='id_kategori' class='form-control' name="id_kategori">
                            <option value=''>-- Pilih Kategori --</option>
                        </select>
                    </div>
                </div>
                <table class="table table-striped table-bordered" id="dt_tbl" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Nama Kategori</th>
                            <th>Nama Merchant</th>
                            <th>Harga</th>
                            <th>Gambar</th>
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
<script src="{{  asset('assets/js/function/produk.js') }}"></script>

<script src="{{  asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{  asset('assets/js/form-select2.js') }}"></script>
@endpush
