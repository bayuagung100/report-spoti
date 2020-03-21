<?php
if (!defined("INDEX")) header('location: ../index.php');
$show = isset($_GET['show']) ? $_GET['show'] : "";
$link = "?content=product";
switch ($show) {
    default:
        echo '
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Product List</h3>
                    <a href="' . $link . '&show=form" class="btn btn-primary btn-icon-split" style="float: right!important;">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah</span>
                    </a>
                </div>
    ';  
        
        buka_datatables(array("Nama Product","Harga","Income"));
        $no = 1;
        $query = $mysqli->query("SELECT * FROM product ORDER BY id DESC");
        while ($data = $query->fetch_array()) {
            $id = $data['id'];
            $nama = $data['nama'];
            $harga = $data['harga'];
            $income = $data['income'];
            
            isi_datatables($no, array($nama,$harga,$income), $link, $id);
            $no++;
        }

        tutup_datatables(array("Nama Product","Harga","Income"));
        echo '
            </div>
        </div>
    </section>
    ';
        break;

    case "form":
        if (isset($_GET['id'])) {
            $ip = $_GET['id'];
            $query     = $mysqli->query("SELECT * FROM product WHERE id='$ip'");
            $data = $query->fetch_array();
            $aksi     = "Edit";
        } else {
            $ip = "";
            $data = array("id" => "", "nama" => "", "harga" => "", "income" => "");
            $aksi     = "Tambah";
        }
        echo '
        <section class="content">
            <div class="container-fluid">
            <br>
                <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">'.$aksi.' Product (<span style="color:red">*</span> wajib diisi.)</h3>
                </div>
                <div class="card-body">';
                buka_form($link, $data['id'], strtolower($aksi));
                buat_textbox("Nama Product", "nama", $data['nama'],"Enter nama product", "required");
                buat_inlinebuka();
                    buat_inlinebuka_col(6);
                        buat_inline("Harga (*jangan pakai Rp/,/.)", "harga", $data['harga'],"ex: 10000", "required","number");
                    buat_inlinetutup_col();
                    buat_inlinebuka_col(6);
                        buat_inline("Income (*jangan pakai Rp/,/.)", "income", $data['income'],"ex: 10000", "required","number");
                    buat_inlinetutup_col();
                buat_inlinetutup();
                tutup_form($link);
        echo'                
                </div>
                </div>
            </div>
        </section>
        ';
        break;
        
    case "action":
        $nama	= addslashes(ucwords($_POST['nama']));
        $harga	= addslashes($_POST['harga']);
        $income	= addslashes($_POST['income']);
               
        if ($_POST['aksi']=="tambah") {
            $query = $mysqli->query("INSERT INTO product
            (
                nama,
                harga,
                income
            )
            VALUES
            (
                '$nama',
                '$harga',
                '$income'
            )
            ");
        }
        if ($_POST['aksi']=="edit") {
            $query = $mysqli->query("UPDATE product SET
            nama = '$nama',
            harga = '$harga',
            income = '$income'
            WHERE id='$_POST[id]'
            ");
        }
        header('location:'.$link);
        break;
    
    case "delete":
        $query = $mysqli->query("DELETE FROM product WHERE id='$_GET[id]'");
        header('location:'.$link);
        break;
}
