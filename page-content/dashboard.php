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
          <a href="?content=sales">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Sales <?php echo date('F');?></span>
                <span class="info-box-number">
                <?php
                $query = $mysqli->query("SELECT * FROM sales WHERE MONTH(tanggal_order) = MONTH(CURRENT_DATE())" );
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
                <span class="info-box-text">Total Sales</span>
                <span class="info-box-number">
                <?php
                $query = $mysqli->query("SELECT * FROM sales" );
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
                  <span class="info-box-text">Income <?php echo date('F');?> </span>
                  <span class="info-box-number">
                  <?php
                  $query = $mysqli->query("SELECT SUM(income) AS total FROM sales WHERE MONTH(tanggal_order) = MONTH(CURRENT_DATE()) AND status='paid' AND status_income='Y' ");
                  $row = $query->fetch_array();
                  echo "Masuk : ".rupiah($row['total']);
                  $query2 = $mysqli->query("SELECT SUM(income) AS total FROM sales WHERE MONTH(tanggal_order) = MONTH(CURRENT_DATE()) AND status='unpaid' OR status='paid' AND status_income='N'  ");
                  $row2 = $query2->fetch_array();
                  echo "<br>Belum : ".rupiah($row2['total']);
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
                  <span class="info-box-text">Total Income</span>
                  <span class="info-box-number">
                  <?php
                  $query = $mysqli->query("SELECT SUM(income) AS total FROM sales WHERE status='paid' AND status_income='Y' ");
                  $row = $query->fetch_array();
                  echo "Masuk : ".rupiah($row['total']);
                  $query2 = $mysqli->query("SELECT SUM(income) AS total FROM sales WHERE status='unpaid' OR status='paid' AND status_income='N'  ");
                  $row2 = $query2->fetch_array();
                  echo "<br>Belum : ".rupiah($row2['total']);
                  ?>
                  </span>
              </div>
              
              </div>
              </a>
          </div>

          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
          <a href="?content=pengeluaran">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pengeluaran <?php echo date('F');?></span>
                <span class="info-box-number">
                <?php
                  $query = $mysqli->query("SELECT SUM(nominal) AS total FROM pengeluaran WHERE MONTH(tanggal) = MONTH(CURRENT_DATE()) ");
                  $row = $query->fetch_array();
                  echo rupiah($row['total']);
                ?>
                </span>
              </div>
            </div>
          </a>
          </div>

          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
          <a href="?content=pengeluaran">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Pengeluaran </span>
                <span class="info-box-number">
                <?php
                  $query = $mysqli->query("SELECT SUM(nominal) AS total FROM pengeluaran");
                  $row = $query->fetch_array();
                  echo rupiah($row['total']);
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
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Profit <?php echo date('F');?></span>
                <span class="info-box-number">
                <?php
                $query = $mysqli->query("SELECT SUM(income) AS total FROM sales WHERE MONTH(tanggal_order) = MONTH(CURRENT_DATE()) ");
                $row = $query->fetch_array();
                $query2 = $mysqli->query("SELECT SUM(nominal) AS outcome FROM pengeluaran WHERE MONTH(tanggal) = MONTH(CURRENT_DATE()) ");
                $row2 = $query2->fetch_array();
                echo rupiah($row['total']-$row2['outcome']);
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
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Profit</span>
                <span class="info-box-number">
                <?php
                $query = $mysqli->query("SELECT SUM(income) AS total FROM sales");
                $row = $query->fetch_array();
                $query2 = $mysqli->query("SELECT SUM(nominal) AS outcome FROM pengeluaran");
                $row2 = $query2->fetch_array();
                echo rupiah($row['total']-$row2['outcome']);
                ?>
                </span>
              </div>
            </div>
          </a>
          </div>

          <div class="clearfix hidden-md-up"></div>

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
          <h3 class="card-title">Detail Income <?php echo date('Y');?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 300px;overflow: scroll;">
          <table class="table table-bordered">
            <thead>                  
              <tr>
                <th>Bulan</th>
                <th>Tokopedia</th>
                <th>Sosmed</th>
                <th>Income</th>
                <th>Pengeluaran</th>
                <th>Profit</th>
              </tr>
            </thead>
            <tbody>
            <?php 
            $kalender=array();
            $kalender[0]['month']= date('Y').'-01-01';
            $kalender[1]['month']= date('Y').'-02-01';
            $kalender[2]['month']= date('Y').'-03-01';
            $kalender[3]['month']= date('Y').'-04-01';
            $kalender[4]['month']= date('Y').'-05-01';
            $kalender[5]['month']= date('Y').'-06-01';
            $kalender[6]['month']= date('Y').'-07-01';
            $kalender[7]['month']= date('Y').'-08-01';
            $kalender[8]['month']= date('Y').'-09-01';
            $kalender[9]['month']= date('Y').'-10-01';
            $kalender[10]['month']= date('Y').'-11-01';
            $kalender[11]['month']= date('Y').'-12-01';

            $cm = count($kalender);
            // echo $kalender[0];
            ?>
              <!-- <tr>
                <td>
                  <?php 
                  $date = new DateTime($kalender[0]['month']);
                  echo $date->format('F');
                  ?>
                </td>
                <td>
                  <?php
                  $query3 = $mysqli->query("SELECT SUM(harga) AS total FROM sales WHERE traffic_source='Tokopedia' ");
                  $row3 = $query3->fetch_array();
                  echo "Kotor: ".rupiah($row3['total'])."<br>";
                  $query4 = $mysqli->query("SELECT SUM(income) AS total FROM sales WHERE traffic_source='Tokopedia' ");
                  $row4 = $query4->fetch_array();
                  echo "Bersih: ".rupiah($row4['total']);
                  ?>
                </td>
                <td>
                  <?php
                  $query5 = $mysqli->query("SELECT SUM(harga) AS total FROM sales WHERE traffic_source!='Tokopedia' ");
                  $row5 = $query5->fetch_array();
                  echo "Kotor: ".rupiah($row5['total'])."<br>";
                  $query6 = $mysqli->query("SELECT SUM(income) AS total FROM sales WHERE traffic_source!='Tokopedia' ");
                  $row6 = $query6->fetch_array();
                  echo "Bersih: ".rupiah($row6['total']);
                  ?>
                </td>
                <td>
                  <?php
                  $query7 = $mysqli->query("SELECT SUM(harga) AS total FROM sales");
                  $row7 = $query7->fetch_array();
                  echo "Kotor: ".rupiah($row7['total'])."<br>";
                  $query8 = $mysqli->query("SELECT SUM(income) AS total FROM sales");
                  $row8 = $query8->fetch_array();
                  $query9 = $mysqli->query("SELECT SUM(nominal) AS outcome FROM pengeluaran");
                  $row9 = $query9->fetch_array();
                  echo "Bersih: ".rupiah($row8['total']);
                  ?>
                </td>
                <td>
                  <?php
                  $query9 = $mysqli->query("SELECT SUM(nominal) AS outcome FROM pengeluaran");
                  $row9 = $query9->fetch_array();
                  echo rupiah($row9['outcome']);
                  ?>
                </td>
                <td>
                  <?php
                  $query10 = $mysqli->query("SELECT SUM(income) AS total FROM sales");
                  $row10 = $query10->fetch_array();
                  $query11 = $mysqli->query("SELECT SUM(nominal) AS outcome FROM pengeluaran");
                  $row11 = $query11->fetch_array();
                  echo rupiah($row10['total']-$row11['outcome']);
                  ?>
                </td>
              </tr> -->
              <?php 
              foreach ($kalender as $key => $value) {
                $date = new DateTime($value['month']);

                $tgl = $date->format('F');
              ?>

              <tr>
                <td>
                  <?php echo $date->format('F');?>
                </td>
                <td>
                  <?php
                  $query3 = $mysqli->query("SELECT SUM(harga) AS total FROM sales WHERE traffic_source='Tokopedia' AND monthname(tanggal_order)='$tgl'");
                  $row3 = $query3->fetch_array();
                  echo "Kotor: ".rupiah($row3['total'])."<br>";
                  $query4 = $mysqli->query("SELECT SUM(income) AS total FROM sales WHERE traffic_source='Tokopedia' AND monthname(tanggal_order)='$tgl'");
                  $row4 = $query4->fetch_array();
                  echo "Bersih: ".rupiah($row4['total']);
                  ?>
                </td>
                <td>
                  <?php
                  $query5 = $mysqli->query("SELECT SUM(harga) AS total FROM sales WHERE traffic_source!='Tokopedia' AND monthname(tanggal_order)='$tgl'");
                  $row5 = $query5->fetch_array();
                  echo "Kotor: ".rupiah($row5['total'])."<br>";
                  $query6 = $mysqli->query("SELECT SUM(income) AS total FROM sales WHERE traffic_source!='Tokopedia' AND monthname(tanggal_order)='$tgl'");
                  $row6 = $query6->fetch_array();
                  echo "Bersih: ".rupiah($row6['total']);
                  ?>
                </td>
                <td>
                  <?php
                  $query7 = $mysqli->query("SELECT SUM(harga) AS total FROM sales WHERE monthname(tanggal_order)='$tgl'");
                  $row7 = $query7->fetch_array();
                  echo "Kotor: ".rupiah($row7['total'])."<br>";
                  $query8 = $mysqli->query("SELECT SUM(income) AS total FROM sales WHERE monthname(tanggal_order)='$tgl'");
                  $row8 = $query8->fetch_array();
                  $query9 = $mysqli->query("SELECT SUM(nominal) AS outcome FROM pengeluaran WHERE monthname(tanggal)='$tgl'");
                  $row9 = $query9->fetch_array();
                  echo "Bersih: ".rupiah($row8['total']);
                  ?>
                </td>
                <td>
                  <?php
                  $query9 = $mysqli->query("SELECT SUM(nominal) AS outcome FROM pengeluaran WHERE monthname(tanggal)='$tgl'");
                  $row9 = $query9->fetch_array();
                  echo rupiah($row9['outcome']);
                  ?>
                </td>
                <td>
                  <?php
                  $query10 = $mysqli->query("SELECT SUM(income) AS total FROM sales WHERE monthname(tanggal_order)='$tgl'");
                  $row10 = $query10->fetch_array();
                  $query11 = $mysqli->query("SELECT SUM(nominal) AS outcome FROM pengeluaran WHERE monthname(tanggal)='$tgl'");
                  $row11 = $query11->fetch_array();
                  echo rupiah($row10['total']-$row11['outcome']);
                  ?>
                </td>
              </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
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
            $tanggal = date("d/m/Y", strtotime($data['tanggal_order']));
            $garansi = date("d/m/Y", strtotime($data['tanggal_garansi']));
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
