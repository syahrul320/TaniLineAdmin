@extends('template')
@section('title')
Taniline >> Data Informasi
@endsection
@section('breadcrumb')
<link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Data Informasi</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0 align-items-center">
                <li class="breadcrumb-item"><a href="javascript:;">
                        <ion-icon name="home-outline"></ion-icon>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Data Informasi</li>
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
            <div class="card-body">
                <form id="form" enctype="multipart/form-data" method="post">
                    <div class="form-group has-feedback">
                        <b><label>Informasi</label></b>
                        <input type="hidden" id="id" class="form-control" name="id" value="">
                        <input type="text" id="informasi" class="form-control" placeholder="Nama Merchant" name="informasi">
                        <span class="text-danger" id="informasiError"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <b><label>Image</label></b>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*">
                        <span class="text-danger" id="imageError"></span>
                    </div>
                    <img class="img-thumbnail" id="preview" width="100">
                    <br> <br>
                        <b>NB :</b> Gunakan Ukuran 800px X 400px Pada Gambar
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
                            <th>Gambar</th>
                            <th>Informasi</th>
                            <th>Tanggal</th>
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
<script src="{{  asset('assets/js/function/informasi.js') }}"></script>
</script>
@endpush
