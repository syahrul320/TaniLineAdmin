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
@if (Auth::user()->level != 3)
<div class="page-content">
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-4 mx-auto" style="margin: 20px">
      <div class="card radius-10 shadow-none mb-0 bg-primary">
                      <div class="card-body text-light p-4">
                        <div class="d-flex align-items-center gap-3">
                          <div class="fs-6">
                            <ion-icon name="people-outline"></ion-icon>
                            <h6 class="mb-0">Jumlah Users</h6>
                          </div>
                          <div class="ms-auto">{{ $user }}</div>
                        </div>
                      </div>
      </div>
    </div>
    <div class="col-md-4 mx-auto" style="margin: 20px">
      <div class="card radius-10 shadow-none mb-0 bg-secondary">
                      <div class="card-body text-light p-4">
                        <div class="d-flex align-items-center gap-3">
                          <div class="fs-6">
                            <ion-icon name="finger-print-outline"></ion-icon>
                            <h6 class="mb-0">Jumlah Usercard Sidik Jari</h6>
                          </div>
                          
                          <div class="ms-auto">{{ $user_card }}</div>
                        </div>
                      </div>
      </div>
    </div>
  </div>    
  <div class="row">
        <div class="col-md-12">
        <div class="col-md-6">
            <div class="card radius-10 overflow-hidden w-100">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <h6 class="mb-0"><b>Nominal Transaksi</b></h6>
                  <div class="dropdown options ms-auto">
                    <div id="nominal_date" style="background: #fff; cursor: pointer; font-size:8px; font-style:bold; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                      <i class="fa fa-calendar"></i>&nbsp;
                      <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                  </div>
                </div>
                <div class="chart-container3">
                  <div class="container">
                    <canvas id="nominal_transaksi"></canvas>
                  </div>
                </div>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center border-top">
                  Topup
                  <span class="badge bg-tiffany rounded-pill" id="topup_nominal">0</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Transaksi
                  <span class="badge bg-tiffany rounded-pill" id="transaksi_nominal">0</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Tagihan Lunas
                  <span class="badge bg-tiffany rounded-pill" id="tagihan_lunas_nominal">0</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Biaya Admin
                  <span class="badge bg-tiffany rounded-pill" id="biaya_admin_nominal">0</span>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card radius-10 overflow-hidden w-100">
              <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                  <h6 class="mb-0"><b>Jumlah Transaksi</b></h6>
                  <div class="dropdown options ms-auto">
                    <div id="jumlah_date" style="background: #fff; cursor: pointer; font-size:8px; font-style:bold; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                      <i class="fa fa-calendar"></i>&nbsp;
                      <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                  </div>
                </div>
                <div class="chart-container3">
                  <div class="container">
                  <canvas id="jumlah_transaksi"></canvas>
                  </div>
                </div>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center border-top">
                  Topup
                  <span class="badge bg-tiffany rounded-pill" id="topup_jumlah">0</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Transaksi
                  <span class="badge bg-tiffany rounded-pill" id="transaksi_jumlah">0</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Tagihan Lunas
                  <span class="badge bg-tiffany rounded-pill" id="tagihan_lunas_jumlah">0</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      
</div>
@endif
@if (Auth::user()->level == 3)
<div class="page-content">
  <center><h1>Selamat datang di aplikasi SiDiK Thohir Yasin</h1></center>
</div>
@endif

@endsection
@push('scripts')
<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/plugins/chartjs/chart.min.js') }}"></script>
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
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
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
    'Topup',
    'Transaksi',
    'Tagihan Lunas',
    'Biaya Admin',
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [0, 0, 0],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)',
      'rgb(255, 172, 86)',
    ],
    hoverOffset: 4
  }]
};
const config = {
  type: 'doughnut',
  data: data,
};

var nominal = new Chart(
    document.getElementById('nominal_transaksi'),
    config, 
);

nominal.canvas.parentNode.style.height = '310px';
nominal.canvas.parentNode.style.width = '310px';

function nominal_chart(start,end){
  $.ajax({
          url: url + "/dashboard/nominal_transaksi?start_date="+start+"&end_date="+end,
        method: "GET",
        dataType: "JSON",
        success: function (param) {
            nominal.data.datasets[0].data= [param.data_topup  , param.data_transaksi ,  param.data_tagihan_lunas ,  param.data_biaya_admin];
            nominal.update();
            $('#topup_nominal').html(param.data_topup.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
            $('#transaksi_nominal').html(param.data_transaksi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
            $('#tagihan_lunas_nominal').html(param.data_tagihan_lunas.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
            $('#biaya_admin_nominal').html(param.data_biaya_admin.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));


          }
        });
  
}

const data2 = {
  labels: [
    'Topup',
    'Transaksi',
    'Tagihan Lunas'
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [0, 0, 0],
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)'
    ],
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    },
    hoverOffset: 4
  }]
};
const config2 = {
  type: 'pie',
  data: data2,
};

var jumlah = new Chart(
    document.getElementById('jumlah_transaksi'),
    config2,
);

jumlah.canvas.parentNode.style.height = '300px';
jumlah.canvas.parentNode.style.width = '300px';
function jumlah_chart(start2,end2){

  $.ajax({
          url: url + "/dashboard/jumlah_transaksi?start_date="+start2+"&end_date="+end2,
        method: "GET",
        dataType: "JSON",
        success: function (param) {
            jumlah.data.datasets[0].data= [param.data_topup  , param.data_transaksi ,  param.data_tagihan_lunas];
            jumlah.update();
            $('#topup_jumlah').html(param.data_topup.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
            $('#transaksi_jumlah').html(param.data_transaksi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
            $('#tagihan_lunas_jumlah').html(param.data_tagihan_lunas.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));

          }
        });
  
}

$(function() {
    
    var start2 = moment().subtract(29, 'days');
    var end2 = moment();



    function cb2(start2, end2) {
        $('#jumlah_date span').html(start2.format('YYYY-MM-DD') + ' &#8594; ' + end2.format('YYYY-MM-DD'));
        jumlah_chart(start2.format('YYYY-MM-DD'), end2.format('YYYY-MM-DD'));
    }

    $('#jumlah_date').daterangepicker({
        startDate: start2,
        endDate: end2,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb2);

    cb2(start2, end2);
    
    $('#jumlah_date').on('apply.daterangepicker', function(ev, picker) {
        console.log(picker.Date.format('YYYY-MM-DD'));
        console.log(picker.endDate.format('YYYY-MM-DD'));
        start_date2 = picker.startDate.format('YYYY-MM-DD');
        end_date2 = picker.endDate.format('YYYY-MM-DD');
        jumlah_chart(start_date, end_date);
    });

});


</script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


@endpush
