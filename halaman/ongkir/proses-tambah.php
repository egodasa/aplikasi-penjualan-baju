<?php
  session_start();
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  // Proses menambah data ke database
  $db->query("
    INSERT INTO ongkir
      (
        id_kota,
        ongkir,
        id_jasa
      ) 
    VALUES
      (
        :id_kota,
        :ongkir,
        :id_jasa
      )
  ", [
    'id_kota' => $_POST['id_kota'],
    'ongkir' => $_POST['ongkir'],
    'id_jasa' => $_SESSION['current_jasa']
  ]);
  header("Location: index.php?proses=tambah&hasil=1");
?>
