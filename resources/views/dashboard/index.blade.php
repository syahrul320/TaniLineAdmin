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
      <div class="card radius-10 shadow-none mb-0 bg-primary">
                      <div class="card-body text-light p-4">
                        <div class="d-flex align-items-center gap-3">
                          <div class="fs-6">
                            <ion-icon name="people-outline"></ion-icon>
                            <h6 class="mb-0">Jumlah Users</h6>
                          </div>
                          {{-- <div class="ms-auto">Nama User</div> --}}
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
                            <h6 class="mb-0">Jumlah Merchant</h6>
                          </div>
                          
                          {{-- <div class="ms-auto">Nama User</div> --}}
                        </div>
                      </div>
      </div>
    </div>
  </div>    
  

  <div class="container d-flex justify-container-center">
    <div class="row">
        <div class="col-md-12">
            <div id="donutchart" style="width: 900px; height: 500px;"></div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/plugins/chartjs/chart.min.js') }}"></script>

<script>
  $(document).ready(function(){

google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
var data = google.visualization.arrayToDataTable([
['Task', 'Hours per Day'],
['Work', 11],
['Eat', 2],
['Commute', 2],
['Watch TV', 2],
['Sleep', 7]
]);

var options = {
title: 'My Daily Activities',
pieHole: 0.4,
};

var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
chart.draw(data, options);
}

});
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


@endpush
