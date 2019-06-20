<?php
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  require_once("../../pengaturan/helper.php");
  
  error_reporting(E_ALL);
	ini_set('display_errors', 1);
  
  // Ambil nama foto barang yang lama terlebih dahulu agar foto bisa diedit
  $barang = $db->query("SELECT foto_1, foto_2, foto_3 FROM barang WHERE kd_barang = :kd_barang", ["kd_barang" => $_POST['kd_barang']])->fetch(PDO::FETCH_ASSOC);
  
  $foto_1 = $barang['foto_1'];
  $foto_2 = $barang['foto_2'];
  $foto_3 = $barang['foto_3'];
  
  if(file_exists($_FILES['foto_1']['tmp_name']) || is_uploaded_file($_FILES['foto_1']['tmp_name']))
  {
  	if(!empty($foto_1))
  	{
  		unlink("../../assets/img/produk/".$foto_1);	
  	}
  	$foto_1 = fileUpload($_FILES['foto_1'], "../../assets/img/produk/");
  }
  
  if(file_exists($_FILES['foto_2']['tmp_name']) || is_uploaded_file($_FILES['foto_2']['tmp_name']))
  {
  	if(!empty($foto_2))
  	{
  		unlink("../../assets/img/produk/".$foto_2);	
  	}
  	$foto_2 = fileUpload($_FILES['foto_2'], "../../assets/img/produk/");
  }
  
  if(file_exists($_FILES['foto_3']['tmp_name']) || is_uploaded_file($_FILES['foto_3']['tmp_name']))
  {
  	if(!empty($foto_3))
  	{
  		unlink("../../assets/img/produk/".$foto_3);	
  	}
  	$foto_3 = fileUpload($_FILES['foto_3'], "../../assets/img/produk/");
  }
  
  // Proses menambah data ke database
  $db->update("barang", [
    'nm_barang' => $_POST['nm_barang'],
    'hrg_beli' => $_POST['hrg_beli'],
    'hrg_jual' => $_POST['hrg_jual'],
    'stok' => $_POST['stok'],
    'kd_kategori' => $_POST['kd_kategori'],
    'safety_stock' => $_POST['safety_stock'],
    'biaya_pesan' => $_POST['biaya_pesan'],
    'biaya_simpan' => $_POST['biaya_simpan'],
    'lead_time' => $_POST['lead_time'],
    'deskripsi' => $_POST['deskripsi'],
    'foto_1' => $foto_1,
    'foto_2' => $foto_2,
    'foto_3' => $foto_3
  ], ['kd_barang' => $_POST['kd_barang']]);
  $error = $db->error();
  if($error[0] != '00000')
  {
    header("Location: index.php?proses=edit&hasil=0&error=".$error[2]);
  }
  else
  {
    header("Location: index.php?proses=edit&hasil=1");
  }
?>
