<?php
  session_start();
  require_once("vendor/autoload.php");
  require_once("pengaturan/pengaturan.php");
  require_once("pengaturan/helper.php");
  require_once("pengaturan/database.php");
  
  var_dump([
    'kd_transaksi' => generateNumber(),
    'kd_pelanggan' => $_SESSION['kd_pengguna'],
    'tgl_transaksi' => date('Y-m-d'),
    'id_ongkir' => $_POST['id_ongkir'],
    'alamat' => $_POST['alamat']
  ]);
  
  
?>
