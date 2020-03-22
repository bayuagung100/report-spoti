<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
                <p>Welcome, <?php echo $_SESSION['nama'];?></p>
            </div>
        </div>
    </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
            <!-- <div class="col-md-12">
              <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title">Sales Graph</h3>
                    <a href="javascript:void(0);">View Report</a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex">
                    <p class="d-flex flex-column">
                      <span class="text-bold text-lg">
                      <?php
                      $query = $mysqli->query("SELECT * FROM sales");
                      $jml = $query->num_rows;
                      echo $jml;
                      ?>
                      </span>
                      <span>Sales Over Time</span>
                    </p>
                  </div>

                  <div class="position-relative mb-4">
                    <canvas id="visitors-chart" height="200"></canvas>
                  </div>

                  <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                      <i class="fas fa-square text-primary"></i> This Week
                    </span>

                    <span>
                      <i class="fas fa-square text-gray"></i> Last Week
                    </span>
                  </div>
                </div>
              </div>
              <script>
              $(function() {
                  'use strict'

                  var ticksStyle = {
                  fontColor: '#495057',
                  fontStyle: 'bold'
                  }

                  var mode      = 'index'
                  var intersect = true
                  var $visitorsChart = $('#visitors-chart')
                  var visitorsChart  = new Chart($visitorsChart, {
                      data   : {
                          labels  : ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                          
                          datasets: [{
                              type                : 'line',
                              data                : [
                                <?php 
                                $query = $mysqli->query('SELECT * FROM sales ');
                                $data = $query->fetch_array();
                                while ($data = $query->fetch_array()) {
                                  $dt = strtotime($data['tanggal_order']);
                                  $day = date("l", $dt);
                                  if ($day == "Sunday") {
                                    $minggu = "Minggu";
                                  } elseif ($day == "Monday") {
                                    $senin = "Senin";
                                  } elseif ($day == "Tuesday") {
                                    $selasa = "Selasa";
                                  } elseif ($day == "Wednesday") {
                                    $rabu = "Rabu";
                                  } elseif ($day == "Thursday") {
                                    $kamis = "Kamis";
                                  } elseif ($day == "Friday") {
                                    $jumat = "Jumat";
                                  } elseif ($day == "Saturday") {
                                    $sabtu = "Sabtu";
                                  } 

                                  echo count($minggu).",".count($senin).",".count($selasa).",".count($rabu).",".count($kamis).",".count($juamt).",".count($sabtu).",".count($minggu);
                                }
                                
                                ?>
                                100, 120, 170, 167, 180, 177, 160,
                                ],
                              backgroundColor     : 'transparent',
                              borderColor         : '#007bff',
                              pointBorderColor    : '#007bff',
                              pointBackgroundColor: '#007bff',
                              fill                : false
                          },
                              {
                              type                : 'line',
                              data                : [60, 80, 70, 67, 80, 77, 100],
                              backgroundColor     : 'tansparent',
                              borderColor         : '#ced4da',
                              pointBorderColor    : '#ced4da',
                              pointBackgroundColor: '#ced4da',
                              fill                : false
                              }]
                      },
                      options: {
                          maintainAspectRatio: false,
                          tooltips           : {
                              mode     : mode,
                              intersect: intersect
                          },
                          hover              : {
                              mode     : mode,
                              intersect: intersect
                          },
                          legend             : {
                              display: false
                          },
                          scales             : {
                              xAxes: [{
                                  gridLines: {
                                      display: false
                                  },
                                  ticks    : ticksStyle
                              }],

                              yAxes: [{
                                  gridLines : {
                                      display : true,
                                      color: '#efefef',
                                      drawBorder: false,
                                  },
                                  ticks    : $.extend({
                                      beginAtZero : true,
                                  }, ticksStyle)
                              }],
                              
                          }
                      }
                  })
              })
              </script>
            </div> -->

            <div class="col-12 col-sm-6 col-md-3">
                <a href="?content=product">
                <div class="info-box">
                
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-camera-retro"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Product</span>
                    <span class="info-box-number">
                    <?php
                    $query = $mysqli->query("SELECT * FROM product");
                    $jml = $query->num_rows;
                    echo $jml;
                    ?>
                    </span>
                </div>
                
                </div>
                </a>
            </div>

            <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
          <a href="?content=sales">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Sales</span>
                <span class="info-box-number">
                <?php
                $query = $mysqli->query("SELECT * FROM sales");
                $jml = $query->num_rows;
                echo $jml;
                ?>
                </span>
              </div>
            </div>
          </a>
          </div>

          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
                <a href="#">
                <div class="info-box">
                
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-check-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Income</span>
                    <span class="info-box-number">
                    <?php
                    $query = $mysqli->query("SELECT SUM(income) AS total FROM sales WHERE status='paid' AND status_income='Y' ");
                    $row = $query->fetch_array();
                    echo "Masuk : ".rupiah($row['total']);
                    $query2 = $mysqli->query("SELECT SUM(income) AS total FROM sales WHERE status='unpaid' OR status='paid' AND status_income='N'  ");
                    $row2 = $query2->fetch_array();
                    echo "<br>Belum Masuk : ".rupiah($row2['total']);
                    ?>
                    </span>
                </div>
                
                </div>
                </a>
            </div>

            <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
          <a href="#">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pengeluaran</span>
                <span class="info-box-number">
                0
                </span>
              </div>
            </div>
          </a>
          </div>

          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
          <a href="?content=traffic">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-comment"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Traffic Source</span>
                <span class="info-box-number">
                <?php
                $query = $mysqli->query("SELECT * FROM traffic");
                $jml = $query->num_rows;
                echo $jml;
                ?>
                </span>
              </div>
            </div>
          </a>
          </div>

          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
          <a href="?content=member">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Members</span>
                <span class="info-box-number">
                <?php
                $query = $mysqli->query("SELECT * FROM member");
                $jml = $query->num_rows;
                echo $jml;
                ?>
                </span>
              </div>
            </div>
          </a>
          </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Sales List</h3>    
        <a href="?content=sales&show=form" class="btn btn-primary btn-icon-split" style="float: right!important;">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah</span>
        </a>
      </div>
      <?php
        $link = "?content=sales";
        buka_datatables(array("Tanggal","Garansi","Product","Nama","Traffic Source","Status Pembayaran","Harga","Income", "PIC"));
        $no = 1;
        $query = $mysqli->query("SELECT * FROM sales ORDER BY id DESC");
        while ($data = $query->fetch_array()) {
            $id = $data['id'];
            $product = $data['product'];
            $harga = $data['harga'];
            $income = $data['income'];
            $nama = $data['nama'];
            $email = $data['email'];
            $tanggal = $data['tanggal_order'];
            $garansi = $data['tanggal_garansi'];
            $traffic_source = $data['traffic_source'];
            $status = $data['status'];
            $status_income = $data['status_income'];
            if ($status_income == 'Y') {
                $si = "Dana sudah masuk";
            } else {
                $si = "Dana belum masuk";
            }
            $pic = $data['pic'];
            isi_datatables($no, array($tanggal,$garansi,$product,$nama."<br>".$email,$traffic_source,ucwords($status).",<p>".$si."<p>",$harga,$income,$pic),$link, $id);
            $no++;
        }

        tutup_datatables(array("Tanggal","Garansi","Product","Nama","Traffic Source","Status Pembayaran","Harga","Income","PIC"));
        ?>
    </div>
  </div>
</section>
