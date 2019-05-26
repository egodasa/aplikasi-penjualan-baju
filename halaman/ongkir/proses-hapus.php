<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("DELETE FROM ongkir WHERE id_ongkir = :id_ongkir", [
    'id_ongkir' => $_GET['id_ongkir']
  ]);
  header("Location: index.php?proses=hapus&hasil=1");
?>
