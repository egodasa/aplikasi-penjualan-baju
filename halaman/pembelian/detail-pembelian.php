<?php
  session_start();
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/helper.php");
  require_once("../../pengaturan/database.php");
 
  $detail_pembelian = $db->query("SELECT a.*, b.nm_supplier FROM pembelian a JOIN supplier b ON a.kd_supplier = b.kd_supplier WHERE a.kd_pembelian = :kd_pembelian", ["kd_pembelian" => $_GET['kd_pembelian']])->fetch(PDO::FETCH_ASSOC);
  
  $detail_barang = $db->query("SELECT b.nm_barang, a.jml, a.total_hrg FROM detail_pembelian a JOIN barang b ON a.kd_barang = b.kd_barang WHERE a.kd_pembelian = :kd_pembelian", ["kd_pembelian" => $_GET['kd_pembelian']])->fetchAll(PDO::FETCH_ASSOC);
  
  $judul = "Detail Pembelian ".$detail_pembelian['kd_pembelian'];  

?>

<html>
  
  <!-- Bagian head -->
  <?php include("../../template/head.php") ?>
  
  <body>
    <div class="wrapper">
      
      <!-- Bagian sidebar -->
      <?php include("../../template/header.php") ?>
      
      <!-- Bagian sidebar -->
      <?php include("../../template/sidebar.php") ?>
      
      <div class="main-panel">
        <div class="content">
          <div class="container-fluid">
                <a href="index.php" class="btn btn-primary">< Kembali</a>
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Detail Pembelian No. <?=$detail_pembelian['kd_pembelian']?></div>
                  </div>
                  <div class="card-body">
                    <p>
                      Supplier : <b><?=$detail_pembelian['nm_supplier']?></b>
                    </p>
                    <p>
                      Tanggal Pembelian: <b><?=tanggal_indo($detail_pembelian['tgl_pembelian'])?></b>
                    </p>
                    <div class="table-responsive">
                      <table class="table table-bordered" style="width: 100%;">
                    <tr>
                      <th>No</th>
                      <th>Nama Produk</th>
                      <th>Jumlah</th>
                      <th>Sub Total</th>
                    </tr>
                    <?php
                      $total = 0;
                      $jumlah_pesan = 0;

                      foreach($detail_barang as $nomor => $d)
                      {
                        $total += $d['total_hrg'];
                        $jumlah_pesan += $d['jml'];
                    ?>
                      <tr>
                        <td><?=($nomor+1)?></td>
                        <td><?=$d['nm_barang']?></td>
                        <td><?=$d['jml']?></td>
                        <td><?=rupiah($d['total_hrg'])?></td>
                      </tr>
                    <?php
                      }
                    ?>
                    <tr>
                    	<td colspan="2">Total</td>
                    	<td><?=$jumlah_pesan?></td>
                    	<td><?=rupiah($total)?></td>
                    </tr>
                  </table>
										</div>
                  </div>
                </div>
          <!-- AKHIR DARI BAGIAN KONTEN -->  
          
          </div>
        </div>
      </div>
    </div>
    
    <!-- semua asset js dibawah ini -->
    <?php include("../../template/script.php") ?>
  </body>
</html>
