<?php
  session_start();
  ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  require_once("../vendor/autoload.php");
  require_once("../pengaturan/database.php");
  header('Content-Type:application/json');
  
  $hasil = $db->query("SELECT YEAR(a.tgl_transaksi) as tahun, b.kd_barang, SUM(b.jumlah) AS jml FROM transaksi a JOIN detail_transaksi b ON a.kd_transaksi = b.kd_transaksi 
                          WHERE YEAR(a.tgl_transaksi) = :tahun AND b.kd_barang = :kd_barang", ['tahun' => $_GET['tahun'], 'kd_barang' => $_GET['kd_barang']])->fetch(PDO::FETCH_ASSOC);
  echo json_encode($hasil);
  
?>
