<?php
  session_start();
  require_once("vendor/autoload.php");
  require_once("pengaturan/pengaturan.php");
  require_once("pengaturan/helper.php");
  require_once("pengaturan/database.php");
  
  $kd_transaksi = generateNumber();
  
  $db->insert('transaksi',[
    'kd_transaksi' => $kd_transaksi,
    'kd_pelanggan' => $_SESSION['kd_pengguna'],
    'tgl_transaksi' => date('Y-m-d'),
    'id_ongkir' => $_POST['id_ongkir'],
    'alamat' => $_POST['alamat']
  ]);
  
  $db->query("INSERT INTO detail_transaksi (kd_transaksi, kd_barang, jumlah, keterangan) SELECT :kd_transaksi AS kd_transaksi, kd_barang, jumlah, keterangan FROM keranjang WHERE kd_pengguna = :kd_pengguna", ['kd_transaksi' => $kd_transaksi, 'kd_pengguna' => $_SESSION['kd_pengguna']]);
  
  $db->query("DELETE FROM keranjang WHERE kd_pengguna = :kd_pengguna", ['kd_pengguna' => $_SESSION['kd_pengguna']]);
  
  header("Location: ".$alamat_web."/halaman/pelanggan/transaksi/detail-transaksi.php?kd_transaksi=".$kd_transaksi);  
  
?>
