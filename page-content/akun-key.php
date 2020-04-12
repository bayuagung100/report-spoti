<?php
if (!defined("INDEX")) header('location: ../index.php');
$show = isset($_GET['show']) ? $_GET['show'] : "";
$link = "?content=akun-key";
switch ($show) {
    default:
        echo '
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Akun Key</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List Akun Key</h3>
                    <a href="' . $link . '&show=form" class="btn btn-primary btn-icon-split" style="float: right!important;">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah</span>
                    </a>
                </div>
    ';  
        
        buka_datatables(array("Key","Email"));
        $no = 1;
        $query = $mysqli->query("SELECT * FROM akun_key ORDER BY id DESC");
        while ($data = $query->fetch_array()) {
            $id = $data['id'];
            $key = $data['api_key'];
            $email = $data['email'];
            
            isi_datatables($no, array($key,$email), $link, $id);
            $no++;
        }

        tutup_datatables(array("Key","Email"));
        echo '
            </div>
        </div>
    </section>
    ';
        break;

    case "form":
        if (isset($_GET['id'])) {
            $ip = $_GET['id'];
            $query     = $mysqli->query("SELECT * FROM akun_key WHERE id='$ip'");
            $data = $query->fetch_array();
            $aksi     = "Edit";
        } else {
            $ip = "";
            $data = array("id" => "", "api_key" => "", "email" => "");
            $aksi     = "Tambah";
        }
        echo '
        <section class="content">
            <div class="container-fluid">
            <br>
                <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">'.$aksi.' Akun Key (<span style="color:red">*</span> wajib diisi.)</h3>
                </div>
                <div class="card-body">';
                buka_form($link, $data['id'], strtolower($aksi));
                buat_textbox("Key", "api_key", $data['api_key'],"Enter key", "required");
                buat_textbox("Email", "email", $data['email'],"Enter Email");
                
                tutup_form($link);
        echo'                
                </div>
                </div>
            </div>
        </section>
        ';
        break;
        
    case "action":
        $keys	= addslashes($_POST['api_key']);
        $email	= addslashes($_POST['email']);
               
        if ($_POST['aksi']=="tambah") {
            $query = $mysqli->query("INSERT INTO akun_key
            (
                api_key,
                email
            )
            VALUES
            (
                '$keys',
                '$email'
            )
            ");
        }
        if ($_POST['aksi']=="edit") {
            $query = $mysqli->query("UPDATE akun_key SET
            api_key = '$keys',
            email = '$email'
            WHERE id='$_POST[id]'
            ");
        }
        header('location:'.$link);
        break;
    
    case "delete":
        $query = $mysqli->query("DELETE FROM akun_key WHERE id='$_GET[id]'");
        header('location:'.$link);
        break;
}
