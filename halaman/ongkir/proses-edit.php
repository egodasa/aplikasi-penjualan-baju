<?php
  session_start();
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("
    UPDATE ongkir SET
        id_kota = :id_kota,
        ongkir = :ongkir
    WHERE id_ongkir = :id_ongkir
  ", [
    'id_ongkir' => $_POST['id_ongkir'],
    'id_kota' => $_POST['id_kota'],
    'ongkir' => $_POST['ongkir']
  ]);
  header("Location: index.php?proses=edit&hasil=1");
?>
