<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("
    UPDATE jasa_pengiriman SET
        nm_jasa = :nm_jasa
    WHERE id_jasa = :id_jasa
  ", [
    'id_jasa' => $_POST['id_jasa'],
    'nm_jasa' => $_POST['nm_jasa']
  ]);
  header("Location: index.php?proses=edit&hasil=1");
?>
