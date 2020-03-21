<?php
if (!defined("INDEX")) header('location: ../index.php');
$show = isset($_GET['show']) ? $_GET['show'] : "";
$link = "?content=traffic";
switch ($show) {
    default:
        echo '
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Traffic Source</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List Traffic Source</h3>
                    <a href="' . $link . '&show=form" class="btn btn-primary btn-icon-split" style="float: right!important;">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah</span>
                    </a>
                </div>
    ';  
        
        buka_datatables(array("Nama Traffic"));
        $no = 1;
        $query = $mysqli->query("SELECT * FROM traffic ORDER BY id DESC");
        while ($data = $query->fetch_array()) {
            $id = $data['id'];
            $nama = $data['nama'];
            
            isi_datatables($no, array($nama), $link, $id);
            $no++;
        }

        tutup_datatables(array("Nama Traffic"));
        echo '
            </div>
        </div>
    </section>
    ';
        break;

    case "form":
        if (isset($_GET['id'])) {
            $ip = $_GET['id'];
            $query     = $mysqli->query("SELECT * FROM traffic WHERE id='$ip'");
            $data = $query->fetch_array();
            $aksi     = "Edit";
        } else {
            $ip = "";
            $data = array("id" => "", "nama" => "");
            $aksi     = "Tambah";
        }
        echo '
        <section class="content">
            <div class="container-fluid">
            <br>
                <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">'.$aksi.' Traffic Source (<span style="color:red">*</span> wajib diisi.)</h3>
                </div>
                <div class="card-body">';
                buka_form($link, $data['id'], strtolower($aksi));
                buat_textbox("Nama Traffic", "nama", $data['nama'],"Enter nama traffic", "required");
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
               
        if ($_POST['aksi']=="tambah") {
            $query = $mysqli->query("INSERT INTO traffic
            (
                nama
            )
            VALUES
            (
                '$nama'
            )
            ");
        }
        if ($_POST['aksi']=="edit") {
            $query = $mysqli->query("UPDATE traffic SET
            nama = '$nama'
            WHERE id='$_POST[id]'
            ");
        }
        header('location:'.$link);
        break;
    
    case "delete":
        $query = $mysqli->query("DELETE FROM traffic WHERE id='$_GET[id]'");
        header('location:'.$link);
        break;
}
