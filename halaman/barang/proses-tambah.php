<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/helper.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  $foto_1 = "";
  $foto_2 = "";
  $foto_3 = "";
  
  if(file_exists($_FILES['foto_1']['tmp_name']) || is_uploaded_file($_FILES['foto_1']['tmp_name']))
  {
  	$foto_1 = fileUpload($_FILES['foto_1'], "../../assets/img/produk/");
  }
  
  if(file_exists($_FILES['foto_2']['tmp_name']) || is_uploaded_file($_FILES['foto_2']['tmp_name']))
  {
  	$foto_2 = fileUpload($_FILES['foto_2'], "../../assets/img/produk/");
  }
  
  if(file_exists($_FILES['foto_3']['tmp_name']) || is_uploaded_file($_FILES['foto_3']['tmp_name']))
  {
  	$foto_3 = fileUpload($_FILES['foto_3'], "../../assets/img/produk/");
  }
  
  // Proses menambah data ke database
  $db->insert("barang", [
    'nm_barang' => $_POST['nm_barang'],
    'hrg_beli' => $_POST['hrg_beli'],
    'hrg_jual' => $_POST['hrg_jual'],
    'stok' => $_POST['stok'],
    'kd_kategori' => $_POST['kd_kategori'],
    'foto_1' => $foto_1,
    'foto_2' => $foto_2,
    'foto_3' => $foto_3,
    'safety_stock' => $_POST['safety_stock'],
    'biaya_pesan' => $_POST['biaya_pesan'],
    'biaya_simpan' => $_POST['biaya_simpan'],
    'lead_time' => $_POST['lead_time'],
    'deskripsi' => $_POST['deskripsi']
  ]);
  $error = $db->error();
  if($error[0] != '00000')
  {
    header("Location: index.php?proses=tambah&hasil=0&error=".$error[2]);
  }
  else
  {
    header("Location: index.php?proses=tambah&hasil=1");
  }
?>
