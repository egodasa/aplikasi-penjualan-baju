<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("DELETE FROM kota WHERE id_kota = :id_kota", [
    'id_kota' => $_GET['id_kota']
  ]);
  header("Location: index.php?proses=hapus&hasil=1");
?>
