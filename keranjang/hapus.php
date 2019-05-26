<?php
  session_start();
  require_once("../vendor/autoload.php");
  require_once("../pengaturan/medoo.php");
  require_once("../pengaturan/helper.php");
  require_once("../pengaturan/pengaturan.php");
  
  $db->delete("keranjang", ['kd_barang' =>  $_GET['kd_barang'], 'kd_pengguna' => $_SESSION['kd_pengguna']]);
  
  header("Location: ".$alamat_web."/detail-produk.php?kd_barang=".$_GET['kd_barang']."&hapus=1");
?>
