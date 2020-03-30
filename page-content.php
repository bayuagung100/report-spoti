<?php
if(!defined("INDEX")) header('location: index.php');
	
$content = isset($_GET['content']) ? $_GET['content'] : 'dashboard';
$kosong = true;

//Menampilkan file sesuai nilai $content
$page = array('dashboard','sales','pengeluaran','product','traffic','akun-owner','member');
foreach($page as $pg){
	if($content == $pg and $kosong){
		include 'page-content/'.$pg.'.php';
		$kosong = false;
	}
}

//Pesan jika kosong
if($kosong){
	echo '<br><br><div class="alert alert-warning"><b>Sorry</b>, Halaman tidak ditemukan!</div>';
}	
?>