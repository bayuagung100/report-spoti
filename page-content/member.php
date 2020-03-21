<?php
if (!defined("INDEX")) header('location: ../index.php');
$show = isset($_GET['show']) ? $_GET['show'] : "";
$link = "?content=member";
switch ($show) {
    default:
        echo '
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Member</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List Member</h3>
                </div>
    ';  
        
        buka_datatables(array("Nama","Email","Password"));
        $no = 1;
        $query = $mysqli->query("SELECT * FROM member ORDER BY id DESC");
        while ($data = $query->fetch_array()) {
            $id = $data['id'];
            $nama = $data['nama'];
            $email = $data['email'];
            $password = $data['password'];
            
            detail_datatables($no, array($nama,$email,$password), $link, $id);
            $no++;
        }

        tutup_datatables(array("Nama","Email","Password"));
        echo '
            </div>
        </div>
    </section>
    ';
        break;

    case "form":
        if (isset($_GET['id'])) {
            $ip = $_GET['id'];
            $query     = $mysqli->query("SELECT * FROM member WHERE id='$ip'");
            $data = $query->fetch_array();
            $aksi     = "Detail";
        } 
        // else {
        //     $ip = "";
        //     $data = array("id" => "", "nama" => "", "email" => "", "password" => "");
        //     $aksi     = "Tambah";
        // }
        echo '
        <section class="content">
            <div class="container-fluid">
            <br>
                <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">'.$aksi.' Member (<span style="color:red">*</span> wajib diisi.)</h3>
                </div>
                <div class="card-body">';
                buat_notag("Nama :", $data['nama'], 4);
                buat_rowtabsbuka();
                    buat_label("Email:",2);
                    buat_col($data['email'],4);
                    buat_label("Password:",2);
                    buat_col($data['password'],4);
                buat_rowtabstutup();
        echo'                
                </div>
                </div>
            </div>
        </section>
        ';
        break;
        
    // case "action":
    //     $nama	= addslashes(ucwords($_POST['nama']));
    //     $email	= addslashes($_POST['email']);
    //     $password	= addslashes($_POST['password']);
               
    //     if ($_POST['aksi']=="tambah") {
    //         $query = $mysqli->query("INSERT INTO member
    //         (
    //             nama,
    //             email,
    //             password
    //         )
    //         VALUES
    //         (
    //             '$nama',
    //             '$email',
    //             '$password'
    //         )
    //         ");
    //     }
    //     if ($_POST['aksi']=="edit") {
    //         $query = $mysqli->query("UPDATE member SET
    //         nama = '$nama',
    //         email = '$email',
    //         password = '$password'
    //         WHERE id='$_POST[id]'
    //         ");
    //     }
    //     header('location:'.$link);
    //     break;
    
    // case "delete":
    //     $query = $mysqli->query("DELETE FROM traffic WHERE id='$_GET[id]'");
    //     header('location:'.$link);
    //     break;
}
