<?php
  session_start();
  require_once("../vendor/autoload.php");
  require_once("../pengaturan/medoo.php");
  require_once("../pengaturan/helper.php");
  require_once("../pengaturan/pengaturan.php");
  
  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    // cek dulu apakah barang sudah ada dikeranjang
    // jika sudah ada, maka update barang tersebut dan tambahkan jumlahnya
    
    $cek = $db->get("keranjang", "*", ['kd_barang' => $_POST['kd_barang'], 'kd_pengguna' => $_SESSION['kd_pengguna']]);
    
    if(empty($cek))
    {
      $db->insert("keranjang", [
        'kd_pengguna' => $_SESSION['kd_pengguna'],
        'kd_barang' => $_POST['kd_barang'],
        'jumlah' => $_POST['jumlah'],
        'keterangan' => $_POST['keterangan']
      ]);
    }
    else
    {
      $db->update("keranjang", [
        'jumlah' => $_POST['jumlah'] + $cek['jumlah']
      ]);
    }
  }
  header("Location: ".$alamat_web."/detail-produk.php?kd_barang=".$_POST['kd_barang']."&berhasil=1");
?>
