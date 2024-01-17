@extends('template')
@section('title')
Thohir Yasin Core >> Import User
@endsection
@section('breadcrumb')
<link href="{{ asset('assets/css/ajaxmask.cs') }}" rel="stylesheet">

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Import User</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0 align-items-center">
                <li class="breadcrumb-item"><a href="javascript:;">
                        <ion-icon name="home-outline"></ion-icon>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Import User</li>
            </ol>
        </nav>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <?php if (session('success')) {
            # code...
        ?>
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        <?php }

        if (session('error')) {

        ?>

        <div class="alert alert-success">
            {{ session('error') }}
        </div>
        <?php } ?>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('import.datauser'); }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {{ method_field('POST') }}
                    {{ csrf_field() }}
                    <div class="card-body col-sm-6">
                        <div class="form-group has-feedback">
                            <b><label>Lembaga</label></b>
                            <select class="form-control" id="id_lembaga" name="id_lembaga">
                                <option>-Silahkan Pilih-</option>
                                @foreach($lembaga as $lembaga)   
                                 <option value="{{ $lembaga->id }}">{{ $lembaga->nama_lembaga }}</option>
                                @endforeach
                                <span class="text-danger" id="id_lembagaError"></span>
                            </select>
                        </div>
                        <div class="form-group has-feedback">
                            <b><label>Tahun Angkatan</label></b>
                            <select name="id_kelas" required id="id_kelas" class="form-control">
                            <option value="">---Pilih Tahun Angkatan---</option>
                        </select>
                        </div>
                        <div class="form-group has-feedback">
                            <b><label>Kategori User</label></b>
                            <select class="form-control" id="id_kategori_user" name="id_kategori_user">
                                <option>-Silahkan Pilih-</option>
                                @foreach($kategori as $kategori_user)   
                                 <option value="{{ $kategori_user->id }}">{{ $kategori_user->nama_kategori_user }}</option>
                                @endforeach
                                <span class="text-danger" id="id_kategori_userError"></span>
                            </select>
                        </div>
                        <div class="form-group has-feedback col-6 style="padding: 20px;"">
                            <input type="hidden" class="form-control" name="id_perusahaan" value="{{ $perusahaan->id }}">
                            <input type="hidden" class="form-control" name="id_rek_poling" value="{{ $rekening_poling->id }}">
                            <b><label>File </label></b>
                            <input type="file" class="form-control" name="file">
                            <br>
                            <button type="submit" class="btn btn-primary">IMPORT</button>
                        </div>
                    </div>
                    <a href="{{  asset('assets/import/Sample Import Data User.xlsx') }}">
                        Download Format Import
                    </a>
                    <br>
                    <b>NB :</b> File Harus Format Excel
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@push('scripts')
<script src="{{  asset('assets/js/function/import.js') }}"></script>
@endpush
