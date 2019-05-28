<?php
  session_start();
  require_once("../../../vendor/autoload.php");
  require_once("../../../pengaturan/pengaturan.php");
  require_once("../../../pengaturan/database.php");
  require_once("../../../pengaturan/helper.php");
  $db->query("UPDATE transaksi SET status_transaksi = 'Transaksi Dibatalkan' WHERE kd_transaksi = :kd_transaksi", ['kd_transaksi' => $_GET['kd_transaksi']]);
  header("Location: ".$alamat_web."/halaman/pelanggan/transaksi");
  
?>
