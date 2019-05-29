<?php
  session_start();
  
  require_once("../../../vendor/autoload.php");
  require_once("../../../pengaturan/pengaturan.php");
  require_once("../../../pengaturan/helper.php");
  require_once("../../../pengaturan/database.php");
  
  $db->update("konfirmasi_pembayaran", ['status_transaksi' => $_GET['status_transaksi'], "kd_transaksi" => $_GET['kd_transaksi']]);
  
  $status_transaksi = "";
  
  if($_GET['status_transaksi'] == 'Diterima')
  {
    $status_transaksi = "Barang Akan Dikirimkan";
  }
  else
  {
    $status_transaksi = "Pembayaran Ditolak";
  }
  
  $db->update("transaksi", ['status_transaksi' => $status_transaksi], ['kd_transaksi' => $_GET['kd_transaksi']]);
  
  header("Location: detail-transaksi.php?kd_transaksi=".$_GET['kd_transaksi']);
?>
