<?php
  session_start();
  
  require_once("../../../vendor/autoload.php");
  require_once("../../../pengaturan/pengaturan.php");
  require_once("../../../pengaturan/helper.php");
  require_once("../../../pengaturan/database.php");
  
  $db->update("konfirmasi_pembayaran", ['status_transaksi' => $_GET['status_transaksi'], "kd_transaksi" => $_GET['kd_transaksi']]);
  
  $status_transaksi = "";
  
  if($_GET['status_transaksi'] == 'Diterima')
  {
    $status_transaksi = "Barang Akan Dikirimkan";
    
    // Lakukan proses perhitungan eoq dan rop kembali
    $daftar_barang = $db->query("SELECT a.kd_barang, a.jumlah, b.* FROM detail_transaksi a JOIN barang b ON a.kd_barang = b.kd_barang WHERE a.kd_transaksi = :kd_transaksi", ["kd_transaksi" => $_GET['kd_transaksi']])->fetchAll(PDO::FETCH_ASSOC);
    foreach($daftar_barang as $d)
    {
    	// Lakukan perhitungan eoq dan rop
    	// Ambil jumlah pesanan tahun ini per barang
    	$jumlah = $db->query("SELECT SUM(b.jumlah) AS jml FROM transaksi a JOIN detail_transaksi b ON a.kd_transaksi = b.kd_transaksi WHERE YEAR(a.tgl_transaksi) = :tahun AND b.kd_barang = :kd_barang", ['tahun' => date("Y"), 'kd_barang' => $d['kd_barang']])->fetch(PDO::FETCH_ASSOC);
      
      $R = $jumlah['jml'];
      $S = $d['biaya_pesan'];
      $C = $d['biaya_simpan'];
      $LT = $d['lead_time'];
      $EOQ = 0;
      $ROP = 0;
      
      // Hitung rop
      $EOQ = sqrt((2 * $R * $S) / $C);
      $ROP = ($R / 365) * $LT;
      
    	// Update hasil kedatabase
    	$db->query("UPDATE barang SET jumlah_penjualan = :jumlah_penjualan, rop = :rop, eoq = :eoq WHERE kd_barang = :kd_barang",
    	[
    		"jumlah_penjualan" => $R,
    		"rop" => $ROP,
    		"eoq" => $EOQ,
    		"kd_barang" => $d['kd_barang']
    	]);
    }
  }
  else
  {
    $status_transaksi = "Pembayaran Ditolak";
  }
  
  $db->update("transaksi", ['status_transaksi' => $status_transaksi], ['kd_transaksi' => $_GET['kd_transaksi']]);
  
  header("Location: detail-transaksi.php?kd_transaksi=".$_GET['kd_transaksi']);
?>
