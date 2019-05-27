<?php
  session_start();
  require_once("vendor/autoload.php");
  require_once("pengaturan/database.php");
  header('Content-Type:application/json');
  
  $hasil = $db->query("SELECT a.id_ongkir, a.ongkir, b.nm_kota, c.nm_jasa FROM ongkir a JOIN kota b ON a.id_kota = b.id_kota JOIN jasa_pengiriman c ON a.id_jasa = c.id_jasa WHERE a.id_kota = :id_kota", ['id_kota' => $_GET['id_kota']])->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode($hasil);
  
?>
