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
                    <div class="card-body col-sm-12" style="display: flex;">
                        <div class="form-group has-feedback col-6 style="padding: 20px;"">
                            <input type="hidden" class="form-control" name="id_perusahaan" value="{{ $perusahaan->id }}">
                            <input type="file" class="form-control" name="file">
                            <br>
                            <button type="submit" class="btn btn-primary">IMPORT</button>
                        </div>
                    </div>
                    <a href="{{ url('/download/format_import.csv')  }}" target="_blank">
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
<script src="{{  asset('assets/js/function/data_user.js') }}"></script>
@endpush
