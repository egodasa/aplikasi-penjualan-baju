<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("
    UPDATE kota SET
        nm_kota = :nm_kota
    WHERE id_kota = :id_kota
  ", [
    'id_kota' => $_POST['id_kota'],
    'nm_kota' => $_POST['nm_kota']
  ]);
  header("Location: index.php?proses=edit&hasil=1");
?>
