@extends('admin.layout.master')

@section('title', 'Dashboard')

@section('content')
<!-- /top tiles -->

<!-- page content -->
<div class="right_col" role="main">
    <div class="col-lg-12">
        <div class="top_tiles">
            <h1>Selamat Datang Di Sistem Rental</h1>
            <div class="row">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                        <div class="count">{{ $pelanggan }}</div>
                        <h5>Data Pelanggan</h5>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-comments-o"></i></div>
                        <div class="count">{{ $alat }}</div>
                        <h5>Data Alat</h5>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                        <div class="count">{{ $rental }}</div>
                        <h5>Data Rental</h5>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                        <div class="count">{{ $pengembalian }}</div>
                        <h5>Data Pengembalian</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Diagram Data <small>Rental</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-6">
                        <canvas id="rentalPerMonthChart" width="400" height="200"></canvas>
                    </div>
                    <div class="col-sm-6">
                        <canvas id="pengembalianStatusChart" width="400" height="200"></canvas>
                    </div>
                    <div class="col-sm-12">
                        <canvas id="topAlatChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', (event) => {
      var rentalPerMonthCtx = document.getElementById('rentalPerMonthChart').getContext('2d');
      var pengembalianStatusCtx = document.getElementById('pengembalianStatusChart').getContext('2d');
      var topAlatCtx = document.getElementById('topAlatChart').getContext('2d');

      var rentalPerMonthChart = new Chart(rentalPerMonthCtx, {
          type: 'bar',
          data: {
              labels: {!! json_encode(array_keys($rentalPerMonth->toArray())) !!},
              datasets: [{
                  label: 'Jumlah Rental Bulanan',
                  data: {!! json_encode(array_values($rentalPerMonth->toArray())) !!},
                  backgroundColor: 'rgba(255, 99, 132, 0.2)',
                  borderColor: 'rgba(255, 99, 132, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });

      var pengembalianStatusChart = new Chart(pengembalianStatusCtx, {
          type: 'pie',
          data: {
              labels: {!! json_encode(array_keys($pengembalianStatus->toArray())) !!},
              datasets: [{
                  label: 'Status Pengembalian',
                  data: {!! json_encode(array_values($pengembalianStatus->toArray())) !!},
                  backgroundColor: [
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(255, 206, 86, 0.2)'
                  ],
                  borderColor: [
                      'rgba(75, 192, 192, 1)',
                      'rgba(255, 206, 86, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              responsive: true,
              plugins: {
                  legend: {
                      position: 'top',
                  },
                  title: {
                      display: true,
                      text: 'Status Pengembalian'
                  }
              }
          }
      });

      var topAlatChart = new Chart(topAlatCtx, {
          type: 'bar',
          data: {
              labels: {!! json_encode($topAlat->pluck('')->toArray()) !!},
              datasets: [{
                  label: 'Top 5 Alat yang Sering Dipinjam',
                  data: {!! json_encode($topAlat->pluck('count')->toArray()) !!},
                  backgroundColor: 'rgba(153, 102, 255, 0.2)',
                  borderColor: 'rgba(153, 102, 255, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              }
          }
      });
  });
</script>
@endsection
