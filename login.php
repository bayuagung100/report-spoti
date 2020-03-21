<?php
session_start();
include "config.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->

  <?php include "css.php";?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <?php
                if (isset($_POST['login'])) {
                    $email = $_POST['email'];
                    $password = md5($_POST['password']);

                    $cekuser = $mysqli->query("SELECT * FROM users WHERE email='$email' AND password='$password'");
                    $jmluser = $cekuser->num_rows;
                    $data = $cekuser->fetch_array();

                    if ($jmluser > 0) {
                        $_SESSION['id']       = $data['id'];
                        $_SESSION['email']     = $data['email'];
                        $_SESSION['nama']  = $data['nama'];
                        $_SESSION['password']     = $data['password'];


                        $_SESSION['timeout'] = time() + 1000;
                        $_SESSION['login'] = 1;

                        header('location: index.php');
                    } else {
                        echo '<div class="alert alert-danger" role="alert"><b>Sorry!</b> Username atau password salah.</div>';
                    }
                }
            ?>
            <form action="" method="post">
                <div class="input-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                    </div>
                </div>
                </div>
                <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-8">
                </div>
                <div class="col-4">
                    <button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
                </div>
                </div>
            </form>

            
        </div>
    </div>
</div>
<?php include "js.php";?>
</body>
</html>
