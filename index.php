<?php
session_start();
ob_start();
define("INDEX", true);
//Panggil semua file yang diperlukan pada folder library
include "config.php";
include "./func/func_table.php";
include "./func/func_date.php";
include "./func/func_form.php";

//Mengecek status login
if (empty($_SESSION['email']) or empty($_SESSION['password']) or $_SESSION['login'] == 0) {
    header('location: login.php');
} else {
    include "admin.php";
}
?>
