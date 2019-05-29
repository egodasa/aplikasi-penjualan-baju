<?php
  session_start();
  
  require_once("../../../vendor/autoload.php");
  require_once("../../../pengaturan/pengaturan.php");
  require_once("../../../pengaturan/helper.php");
  require_once("../../../pengaturan/database.php");
  
  // Hapus semua konfirmasi pembayaran terlebih dahulu
  $db->delete('konfirmasi_pembayaran', ['kd_transaksi' => $_POST['kd_transaksi']]);
  
  $foto = fileUpload($_FILES['foto'], '../../../assets/img/bukti/');

  $db->insert("konfirmasi_pembayaran", [
    "kd_transaksi" => $_POST['kd_transaksi'],
    "norek" => $_POST['norek'],
    "nm_bank" => $_POST['nm_bank'],
    "total_bayar" => $_POST['total_bayar'],
    "keterangan" => $_POST['keterangan'],
    "tgl_bayar" => $_POST['tgl_bayar'],
    "foto" => $foto
  ]);
  
  $db->update("transaksi", ['status_transaksi' => "Pembayaran Diproses"], ['kd_transaksi' => $_POST['kd_transaksi']]);
  
  header("Location: detail-transaksi.php?kd_transaksi=".$_POST['kd_transaksi']);
?>
