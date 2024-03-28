@extends('template')
@section('title')
    Taniline >> Laporan Merchant
@endsection
@section('breadcrumb')
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Laporan Merchant</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                    <li class="breadcrumb-item"><a href="javascript:;">
                            <ion-icon name="home-outline"></ion-icon>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Laporan Merchant</li>
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
                        <div class="col-sm-12">
                            <b><label>Download Data Merchant</label></b>
                        </div>
                        <form action="{{ route('laporan-merchant.export') }}">
                            <div class="col-sm-4">
                                <select id='id_merchant' class='form-control' name="id_merchant">
                                    <option value=''>-- Pilih Merchant --</option>
                                    @foreach ($users as $user)
                                        <option value='{{ $user->id }}'>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-8">
                                <button type="submit" class="btn btn-primary">Download</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/form-select2.js') }}"></script>
    <script src="{{ asset('assets/js/function/laporan_merchant.js') }}"></script>
@endpush
