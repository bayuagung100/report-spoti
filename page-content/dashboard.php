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
