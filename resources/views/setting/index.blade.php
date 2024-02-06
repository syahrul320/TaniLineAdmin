@extends('template')
@section('title')
Taniline >> Setting
@endsection
@section('breadcrumb')
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Setting</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0 align-items-center">
                <li class="breadcrumb-item"><a href="javascript:;">
                        <ion-icon name="home-outline"></ion-icon>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Setting</li>
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
            <form action="{{ route('setting.update.data') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $setting->id }}" class="form-control" name="id">
                <div class="card-body col-sm-12">
                    <div class="form-group has-feedback">
                        <b><label>Nama Aplikasi</label></b>
                        <input type="text" class="form-control" value="{{ $setting->nama_aplikasi }}" name="nama_aplikasi">
                    </div>
                    <div class="form-group has-feedback">
                        <b><label>Tanggal Expired</label></b>
                        <input type="date" class="form-control" value="{{ $setting->tgl_expired }}" name="tgl_expired">
                    </div>
                    <div class="form-group has-feedback">
                        <b><label>Biaya Admin</label></b>
                        <input type="number" class="form-control" value="{{ $setting->biaya_admin }}" name="biaya_admin">
                    </div>
                </div>
                <div class="card-footer text-center col-sm-12">
                    <button class="btn btn-primary" id="submit">
                        Update
                    </button>
                </div>
        </form>
    </div>
</div>
</div>
@endsection
@push('scripts')

<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
{{-- <script src="{{  asset('assets/js/function/setting.js') }}"></script> --}}
@endpush
