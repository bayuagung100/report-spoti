<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Administrator</title>
    <?php include "css.php";?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
            <i class="fas fa-chevron-up"></i>
        </a>

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <!-- <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url("../"); ?>" target="_blank">
                        <i class="fas fa-eye"></i> Lihat Website
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index.php" class="brand-link">
                <img src="./img/AdminLTELogo.png" alt="Adminisitrator Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Adminisitrator</span>
            </a>

            <div class="sidebar">
                <?php include "sidebar.php"; ?>
            </div>
        </aside>

        <div class="content-wrapper">
            <?php include "page-content.php"; ?>
        </div>
    </div>

    <?php include "js.php";?>
</body>

</html>