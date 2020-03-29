<?php
if (!defined("INDEX")) header('location: ../index.php');
$show = isset($_GET['show']) ? $_GET['show'] : "";
$link = "?content=pengeluaran";
switch ($show) {
    default:
        echo '
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengeluaran</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pengeluaran List</h3>
                    <a href="' . $link . '&show=form" class="btn btn-primary btn-icon-split" style="float: right!important;">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah</span>
                    </a>
                </div>
    ';  
        
        buka_datatables(array("Tanggal","Jenis","Nominal","Keterangan"));
        $no = 1;
        $query = $mysqli->query("SELECT * FROM pengeluaran ORDER BY id DESC");
        while ($data = $query->fetch_array()) {
            $id = $data['id'];
            $jenis = $data['jenis'];
            $nominal = $data['nominal'];
            $tanggal = date("d/m/Y", strtotime($data['tanggal']));
            $keterangan = $data['keterangan'];
            
            isi_datatables($no, array($tanggal,$jenis,$nominal,$keterangan), $link, $id);
            $no++;
        }

        tutup_datatables(array("Tanggal","Jenis","Nominal","Keterangan"));
        echo '
            </div>
        </div>
    </section>
    ';
        break;

    case "form":
        if (isset($_GET['id'])) {
            $ip = $_GET['id'];
            $query     = $mysqli->query("SELECT * FROM pengeluaran WHERE id='$ip'");
            $data = $query->fetch_array();
            $aksi     = "Edit";
        } else {
            $ip = "";
            $data = array("id" => "", "jenis" => "", "nominal" => "", "tanggal" => "", "keterangan" => "");
            $aksi     = "Tambah";
        }
        echo '
        <section class="content">
            <div class="container-fluid">
            <br>
                <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">'.$aksi.' Keterangan (<span style="color:red">*</span> wajib diisi.)</h3>
                </div>
                <div class="card-body">';
                buka_form($link, $data['id'], strtolower($aksi));
                buat_inlinebuka();
                    buat_inlinebuka_col(6);
                        $list = array();
                        $list[] = array('val'=>'', 'cap'=>'Tidak Ada');
                        $list[] = array('val'=>'Admin', 'cap'=>'Admin');
                        $list[] = array('val'=>'Modal', 'cap'=>'Modal');
                        $list[] = array('val'=>'Lainnya', 'cap'=>'Lainnya');
                        buat_inline_select("Pilih jenis pengeluaran", "jenis", $list, $data['jenis'], "required");
                    buat_inlinetutup_col();
                    buat_inlinebuka_col(6);
                        buat_inline("Nominal (*jangan pakai Rp/,/.)", "nominal", $data['nominal'],"ex: 10000", "required","number");
                    buat_inlinetutup_col();
                buat_inlinetutup();
                buat_inlinebuka();
                    buat_inlinebuka_col(6);
                    if($data['tanggal']!=""){
                        $newtanggal = date("d/m/Y", strtotime($data['tanggal']));
                    }else{
                        $newtanggal = $data['tanggal'];
                    }
                    buat_datemask("Tanggal pengeluaran", "tanggal", $newtanggal, "required");
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
        $jenis	= addslashes($_POST['jenis']);
        $nominal	= addslashes($_POST['nominal']);
        $tanggal	= date("Y-m-d", strtotime(str_replace("/","-",$_POST['tanggal'])));
        $keterangan	= addslashes($_POST['keterangan']);
               
        if ($_POST['aksi']=="tambah") {
            $query = $mysqli->query("INSERT INTO pengeluaran
            (
                jenis,
                nominal,
                tanggal,
                keterangan
            )
            VALUES
            (
                '$jenis',
                '$nominal',
                '$tanggal',
                '$keterangan'
            )
            ");
        }
        if ($_POST['aksi']=="edit") {
            $query = $mysqli->query("UPDATE pengeluaran SET
            jenis = '$jenis',
            nominal = '$nominal',
            tanggal = '$tanggal',
            keterangan = '$keterangan'
            WHERE id='$_POST[id]'
            ");
        }
        header('location:'.$link);
        break;
    
    case "delete":
        $query = $mysqli->query("DELETE FROM pengeluaran WHERE id='$_GET[id]'");
        header('location:'.$link);
        break;
}
