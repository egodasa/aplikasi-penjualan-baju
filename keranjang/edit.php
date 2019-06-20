<?php
  session_start();
  require_once("../vendor/autoload.php");
  require_once("../pengaturan/medoo.php");
  require_once("../pengaturan/helper.php");
  require_once("../pengaturan/pengaturan.php");
  
  $db->update("keranjang", ['jumlah' => $_POST['jumlah'], 'keterangan' => $_POST['keterangan']], ['kd_barang' =>  $_POST['kd_barang'], 'kd_pengguna' => $_SESSION['kd_pengguna']]);
  
  header("Location: ".$alamat_web."/detail-produk.php?kd_barang=".$_POST['kd_barang']."&edit=1");
?>
