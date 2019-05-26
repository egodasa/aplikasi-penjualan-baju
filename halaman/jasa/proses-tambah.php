<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("
    INSERT INTO jasa_pengiriman
      (
        nm_jasa
      ) 
    VALUES
      (
        :nm_jasa
      )
  ", [
    'nm_jasa' => $_POST['nm_jasa']
  ]);
  header("Location: index.php?proses=tambah&hasil=1");
?>
