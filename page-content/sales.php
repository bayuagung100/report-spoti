<?php
if (!defined("INDEX")) header('location: ../index.php');
$show = isset($_GET['show']) ? $_GET['show'] : "";
$link = "?content=sales";
switch ($show) {
    default:
        echo '
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sales</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Sales List</h3>
                    <a href="' . $link . '&show=form" class="btn btn-primary btn-icon-split" style="float: right!important;">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah</span>
                    </a>
                </div>
    ';  
        
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
        echo '
            </div>
        </div>
    </section>
    ';
        break;

    case "form":
        if (isset($_GET['id'])) {
            $ip = $_GET['id'];
            $query     = $mysqli->query("SELECT * FROM sales WHERE id='$ip'");
            $data = $query->fetch_array();
            $aksi     = "Edit";
        } else {
            $ip = "";
            $data = array("id" => "", "product" => "", "harga" => "", "income" => "", "nama" => "", "email" => "", "password" => "", "tanggal_order" => "", "tanggal_garansi" => "", "traffic_source" => "", "status" => "","status_income"=>"", "keterangan" => "");
            $aksi     = "Tambah";
        }
        echo '
        <section class="content">
            <div class="container-fluid">
            <br>
                <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">'.$aksi.' Sales (<span style="color:red">*</span> wajib diisi.)</h3>
                </div>
                <div class="card-body">';
                buka_form($link, $data['id'], strtolower($aksi));

                $product = $mysqli->query ("SELECT * FROM product");
                $list = array();
                $list[] = array('val'=>'', 'cap'=>'Tidak Ada');
                while($k = $product->fetch_array()){
                    $list[] = array('val'=>$k['nama'], 'cap'=>$k['nama'], 'harga'=>$k['harga'], 'income'=>$k['income']);
                }
                buat_inline_product("Pilih Product", "product", $list, $data['product'], "required");
                
                buat_inlinebuka();
                    buat_inlinebuka_col(6);
                        buat_inline("Harga (*jangan pakai Rp/,/.)", "harga", $data['harga'],"ex: 10000", "readonly","number");
                    buat_inlinetutup_col();
                    buat_inlinebuka_col(6);
                        buat_inline("Income (*jangan pakai Rp/,/.)", "income", $data['income'],"ex: 10000", "readonly","number");
                    buat_inlinetutup_col();
                buat_inlinetutup();

                buat_textbox("Nama", "nama", $data['nama'],"Enter nama", "required");
                buat_inlinebuka();
                    buat_inlinebuka_col(6);
                    buat_textbox("Email", "email", $data['email'],"Enter email", "required");
                    buat_inlinetutup_col();
                    buat_inlinebuka_col(6);
                    buat_textbox("Password", "password", $data['password'],"Enter password" );
                    buat_inlinetutup_col();
                buat_inlinetutup();
                buat_inlinebuka();
                    buat_inlinebuka_col(6);
                        if($data['tanggal_order']!=""){
                            $newtanggal = date("d/m/Y", strtotime($data['tanggal_order']));
                        }else{
                            $newtanggal = $data['tanggal_order'];
                        }
                        buat_datemask("Tanggal Order", "tanggal_order", $newtanggal, "required");
                    buat_inlinetutup_col();
                    buat_inlinebuka_col(6);
                    if($data['tanggal_order']!=""){
                        $newgaransi = date("d/m/Y", strtotime($data['tanggal_garansi']));
                    }else{
                        $newgaransi = $data['tanggal_garansi'];
                    }
                    buat_datemask("Tanggal Garansi", "tanggal_garansi", $newgaransi, "required");
                    buat_inlinetutup_col();
                buat_inlinetutup();
                buat_inlinebuka();
                    buat_inlinebuka_col(6);
                        $product = $mysqli->query ("SELECT * FROM traffic");
                        $list = array();
                        $list[] = array('val'=>'', 'cap'=>'Tidak Ada');
                        while($k = $product->fetch_array()){
                            $list[] = array('val'=>$k['nama'], 'cap'=>$k['nama']);
                        }
                        buat_inline_select("Pilih Traffic", "traffic_source", $list, $data['traffic_source'], "required");
                    buat_inlinetutup_col();
                    buat_inlinebuka_col(6);
                        $list = array();
                        $list[] = array('val'=>'', 'cap'=>'Tidak Ada');
                        // while($k = $product->fetch_array()){
                            $list[] = array('val'=>"paid", 'cap'=>"paid");
                            $list[] = array('val'=>"unpaid", 'cap'=>"unpaid");
                        // }
                        buat_inline_select("Status", "status", $list, $data['status'], "required");
                    buat_inlinetutup_col();
                buat_inlinetutup();
                buat_inlinebuka();
                    buat_inlinebuka_col(6);
                        $list = array();
                        $list[] = array('val'=>'', 'cap'=>'Tidak Ada');
                        // while($k = $product->fetch_array()){
                            $list[] = array('val'=>"Y", 'cap'=>"Sudah");
                            $list[] = array('val'=>"N", 'cap'=>"Belum");
                        // }
                        buat_inline_select("Dana sudah masuk ? ", "status_income", $list, $data['status_income'], "required");
                    buat_inlinetutup_col();
                buat_inlinetutup();
                buat_textarea("Keterangan", "keterangan", $data['keterangan'], "Enter keterangan");

                


                

                tutup_form($link);
        echo'                
                </div>
                </div>
            </div>
        </section>
        ';
        break;
        
    case "action":
        $product = addslashes($_POST['product']); 
        $harga	= addslashes($_POST['harga']);
        $income	= addslashes($_POST['income']);
        $nama	= addslashes(ucwords($_POST['nama']));
        $email	= addslashes($_POST['email']);
        $password	= addslashes($_POST['password']);
        $tanggal_order	= date("Y-m-d", strtotime(str_replace("/","-",$_POST['tanggal_order'])));
        $tanggal_garansi	= date("Y-m-d", strtotime(str_replace("/","-",$_POST['tanggal_garansi'])));
        $traffic_source	= addslashes($_POST['traffic_source']);
        $status	= addslashes($_POST['status']);
        $status_income	= addslashes($_POST['status_income']);
        $keterangan	= addslashes($_POST['keterangan']);
        $pic = $_SESSION['nama'];
               
        if ($_POST['aksi']=="tambah") {
            $query = $mysqli->query("INSERT INTO sales
            (
                product,
                harga,
                income,
                nama,
                email,
                password,
                tanggal_order,
                tanggal_garansi,
                traffic_source,
                status,
                status_income,
                keterangan,
                pic
            )
            VALUES
            (
                '$product',
                '$harga',
                '$income',
                '$nama',
                '$email',
                '$password',
                '$tanggal_order',
                '$tanggal_garansi',
                '$traffic_source',
                '$status',
                '$status_income',
                '$keterangan',
                '$pic'
            )
            ");
            if ($query) {
                $query2 = $mysqli->query("INSERT INTO member
                (
                    nama,
                    email,
                    password
                )
                VALUES
                (
                    '$nama',
                    '$email',
                    '$password'
                )
                ");
            }
        }
        if ($_POST['aksi']=="edit") {
            $query = $mysqli->query("UPDATE sales SET
            product = '$product',
            harga = '$harga',
            income = '$income',
            nama = '$nama',
            email = '$email',
            password = '$password',
            tanggal_order = '$tanggal_order',
            tanggal_garansi = '$tanggal_garansi',
            traffic_source = '$traffic_source',
            status = '$status',
            status_income = '$status_income',
            keterangan = '$keterangan'
            WHERE id='$_POST[id]'
            ");
        }
        header('location:'.$link);
        break;
    
    case "delete":
        $query = $mysqli->query("DELETE FROM sales WHERE id='$_GET[id]'");
        header('location:'.$link);
        break;
}
