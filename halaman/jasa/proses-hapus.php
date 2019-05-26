<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("DELETE FROM jasa_pengiriman WHERE id_jasa = :id_jasa", [
    'id_jasa' => $_GET['id_jasa']
  ]);
  header("Location: index.php?proses=hapus&hasil=1");
?>
