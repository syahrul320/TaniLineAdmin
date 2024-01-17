@extends('template')
@section('title')
Thohir Yasin Core >> Data User
@endsection
@section('breadcrumb')
<link href="{{ asset('assets/css/ajaxmask.cs') }}" rel="stylesheet">

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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-bordered" id="dt_tbl" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No</th>
                            <th>Kode Perusahaan</th>
                            <th>Nama Perusahaan</th>
                            <th>Provinsi</th>
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
<script src="{{  asset('assets/js/function/user.js') }}"></script>
@endpush
