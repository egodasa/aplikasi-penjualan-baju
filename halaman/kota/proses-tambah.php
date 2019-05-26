<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("
    INSERT INTO kota
      (
        nm_kota
      ) 
    VALUES
      (
        :nm_kota
      )
  ", [
    'nm_kota' => $_POST['nm_kota']
  ]);
  header("Location: index.php?proses=tambah&hasil=1");
?>
