<?php
if (!defined("INDEX")) header('location: ../index.php');
$show = isset($_GET['show']) ? $_GET['show'] : "";
$link = "?content=akun-owner";
switch ($show) {
    default:
        echo '
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Akun Owner</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List Akun Owner</h3>
                    <a href="' . $link . '&show=form" class="btn btn-primary btn-icon-split" style="float: right!important;">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah</span>
                    </a>
                </div>
    ';  
        
        buka_datatables(array("Label","Email","Password","Status","Anggota"));
        $no = 1;
        $query = $mysqli->query("SELECT * FROM akun_owner ORDER BY id DESC");
        while ($data = $query->fetch_array()) {
            $id = $data['id'];
            $label = $data['label'];
            $email = $data['email'];
            $password = $data['password'];
            $status = $data['status'];
            $anggota1 = $data['anggota1'];
            $anggota2 = $data['anggota2'];
            $anggota3 = $data['anggota3'];
            $anggota4 = $data['anggota4'];
            $anggota5 = $data['anggota5'];
            
            isi_datatables($no, array($label,$email,$password,$status,$anggota1."<br>".$anggota2."<br>".$anggota3."<br>".$anggota4."<br>".$anggota5), $link, $id);
            $no++;
        }

        tutup_datatables(array("Label","Email","Password","Status","Anggota"));
        echo '
            </div>
        </div>
    </section>
    ';
        break;

    case "form":
        if (isset($_GET['id'])) {
            $ip = $_GET['id'];
            $query     = $mysqli->query("SELECT * FROM akun_owner WHERE id='$ip'");
            $data = $query->fetch_array();
            $aksi     = "Edit";
        } else {
            $ip = "";
            $data = array("id" => "", "label" => "", "email" => "", "password" => "", "status" => "", "anggota1" => "", "anggota2" => "", "anggota3" => "", "anggota4" => "", "anggota5" => "");
            $aksi     = "Tambah";
        }
        echo '
        <section class="content">
            <div class="container-fluid">
            <br>
                <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">'.$aksi.' Akun Owner (<span style="color:red">*</span> wajib diisi.)</h3>
                </div>
                <div class="card-body">';
                buka_form($link, $data['id'], strtolower($aksi));
                buat_textbox("Label", "label", $data['label'],"Enter label", "required");
                buat_inlinebuka();
                    buat_inlinebuka_col(6);
                        buat_inline("Email", "email", $data['email'],"Enter email", "required");
                    buat_inlinetutup_col();
                    buat_inlinebuka_col(6);
                        buat_inline("Password", "password", $data['password'],"Enter password", "required");
                    buat_inlinetutup_col();
                buat_inlinetutup();
                buat_inlinebuka();
                    buat_inlinebuka_col(6);
                        $list[] = array('val'=>'', 'cap'=>'Tidak Ada');
                        $list[] = array('val'=>'Aktif', 'cap'=>'Aktif');
                        $list[] = array('val'=>'Nonaktif', 'cap'=>'Nonaktif');
                        buat_inline_select("Status akun ", "status", $list, $data['status'], "required");
                    buat_inlinetutup_col();
                    buat_inlinebuka_col(6);
                        buat_inline("Anggota 1", "anggota1", $data['anggota1'],"Enter anggota 1");
                    buat_inlinetutup_col();
                buat_inlinetutup();
                buat_inlinebuka();
                    buat_inlinebuka_col(6);
                        buat_inline("Anggota 2", "anggota2", $data['anggota2'],"Enter anggota 2");
                    buat_inlinetutup_col();
                    buat_inlinebuka_col(6);
                        buat_inline("Anggota 3", "anggota3", $data['anggota3'],"Enter anggota 3");
                    buat_inlinetutup_col();
                buat_inlinetutup();
                buat_inlinebuka();
                    buat_inlinebuka_col(6);
                        buat_inline("Anggota 4", "anggota4", $data['anggota4'],"Enter anggota 4");
                    buat_inlinetutup_col();
                    buat_inlinebuka_col(6);
                        buat_inline("Anggota 5", "anggota5", $data['anggota5'],"Enter anggota 5");
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
        $label	= addslashes(ucwords($_POST['label']));
        $email	= addslashes($_POST['email']);
        $password	= addslashes($_POST['password']);
        $status	= addslashes($_POST['status']);
        $anggota1	= addslashes($_POST['anggota1']);
        $anggota2	= addslashes($_POST['anggota2']);
        $anggota3	= addslashes($_POST['anggota3']);
        $anggota4	= addslashes($_POST['anggota4']);
        $anggota5	= addslashes($_POST['anggota5']);
               
        if ($_POST['aksi']=="tambah") {
            $query = $mysqli->query("INSERT INTO akun_owner
            (
                label,
                email,
                password,
                status,
                anggota1,
                anggota2,
                anggota3,
                anggota4,
                anggota5
            )
            VALUES
            (
                '$label',
                '$email',
                '$password',
                '$status',
                '$anggota1',
                '$anggota2',
                '$anggota3',
                '$anggota4',
                '$anggota5'
            )
            ");
        }
        if ($_POST['aksi']=="edit") {
            $query = $mysqli->query("UPDATE akun_owner SET
            label = '$label',
            email = '$email',
            password = '$password',
            status = '$status',
            anggota1 = '$anggota1',
            anggota2 = '$anggota2',
            anggota3 = '$anggota3',
            anggota4 = '$anggota4',
            anggota5 = '$anggota5'
            WHERE id='$_POST[id]'
            ");
        }
        header('location:'.$link);
        break;
    
    case "delete":
        $query = $mysqli->query("DELETE FROM akun_owner WHERE id='$_GET[id]'");
        header('location:'.$link);
        break;
}
