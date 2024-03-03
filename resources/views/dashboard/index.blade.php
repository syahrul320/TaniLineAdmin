@extends('template')
@section('breadcrumb')
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Dashboard</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0 align-items-center">
                    <li class="breadcrumb-item"><a href="javascript:;">
                            <ion-icon name="home-outline"></ion-icon>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page"> Hai, {{ Auth::user()->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
@endsection
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4 mx-auto" style="margin: 20px">
                    <div class="col">
                        <div class="card radius-10 bg-primary">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="mb-1 text-white">Jumlah User</p>
                                        <h4 class="mb-0 text-white">{{ $user }}</h4>
                                    </div>
                                    <div class="ms-auto text-white fs-2">
                                        <ion-icon name="accessibility-sharp"></ion-icon>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mx-auto" style="margin: 20px">
                    <div class="col">
                        <div class="card radius-10 bg-danger">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="mb-1 text-white">Jumlah Merchant</p>
                                        <h4 class="mb-0 text-white">{{ $merchant }}</h4>
                                    </div>
                                    <div class="ms-auto text-white fs-2">
                                        <ion-icon name="storefront-sharp"></ion-icon>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mx-auto" style="margin: 20px">
                    <div class="col">
                        <div class="card radius-10 bg-success">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="mb-1 text-white">Jumlah Produk</p>
                                        <h4 class="mb-0 text-white">{{ $produk }}</h4>
                                    </div>
                                    <div class="ms-auto text-white fs-2">
                                        <ion-icon name="bag-handle-sharp"></ion-icon>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card radius-10 overflow-hidden w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <h6 class="mb-0"><b>Pembayaran Pendaftaran</b></h6>
                            <div class="dropdown options ms-auto">
                                <div id="nominal_date"
                                    style="background: #fff; cursor: pointer; font-size:8px; font-style:bold; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                    <i class="fa fa-calendar"></i>&nbsp;
                                    <span></span> <i class="fa fa-caret-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="chart-container3">
                            <div class="container">
                                <canvas id="pembayaran"></canvas>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center border-top">
                            Pendaftaran Lunas
                            <span class="badge bg-tiffany rounded-pill" id="pendaftaran_nominal">0</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Daftar Ulang Lunas
                            <span class="badge bg-tiffany rounded-pill" id="daftar_ulang_nominal">0</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card radius-10 overflow-hidden w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <h6 class="mb-0"><b>Topup</b></h6>
                            <div class="dropdown options ms-auto">
                                <div id="nominal_date"
                                    style="background: #fff; cursor: pointer; font-size:8px; font-style:bold; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                    <i class="fa fa-calendar"></i>&nbsp;
                                    <span></span> <i class="fa fa-caret-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="chart-container3">
                            <div class="container">
                                <canvas id="topup"></canvas>
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center border-top">
                            Produk Terjual
                            <span class="badge bg-tiffany rounded-pill" id="produk_terjual">0</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Produk Terjual
                            <span class="badge bg-tiffany rounded-pill" id="produk_terjual">0</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartjs/chart.min.js') }}"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script>
        $(function() {

            var start = moment().subtract(29, 'days');
            var end = moment();



            function cb(start, end) {
                $('#nominal_date span').html(start.format('YYYY-MM-DD') + ' &#8594; ' + end.format('YYYY-MM-DD'));
                nominal_chart(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
            }

            $('#nominal_date').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

            $('#nominal_date').on('apply.daterangepicker', function(ev, picker) {
                console.log(picker.startDate.format('YYYY-MM-DD'));
                console.log(picker.endDate.format('YYYY-MM-DD'));
                start_date = picker.startDate.format('YYYY-MM-DD');
                end_date = picker.endDate.format('YYYY-MM-DD');
                nominal_chart(start_date, end_date);
            });

        });



        const data = {
            labels: [
                'Pembayaran Pendaftaran Lunas',
                'Pembayaran Daftar Ulang Lunas',
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [0, 0, 0],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    // 'rgb(255, 205, 86)',
                    // 'rgb(255, 172, 86)',
                ],
                hoverOffset: 4
            }]
        };
        const config = {
            type: 'doughnut',
            data: data,
        };

        var nominal = new Chart(
            document.getElementById('pembayaran'),
            config,
        );

        nominal.canvas.parentNode.style.height = '310px';
        nominal.canvas.parentNode.style.width = '310px';

        function nominal_chart(start, end) {
            $.ajax({
                url: url + "/dashboard/pembayaran?start_date=" + start + "&end_date=" + end,
                method: "GET",
                dataType: "JSON",
                success: function(param) {
                    nominal.data.datasets[0].data = [param.pendaftaran, param.daftar_ulang];
                    nominal.update();
                    $('#pendaftaran_nominal').html(param.pendaftaran.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
                    $('#daftar_ulang_nominal').html(param.daftar_ulang.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
                }
            });
        }
    </script>
@endpush
