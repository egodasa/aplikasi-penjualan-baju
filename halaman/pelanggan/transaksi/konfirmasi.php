<?php
  session_start();
  
  require_once("../../../vendor/autoload.php");
  require_once("../../../pengaturan/pengaturan.php");
  require_once("../../../pengaturan/helper.php");
  require_once("../../../pengaturan/database.php");
  
  $judul = "Konfirmasi Pembayaran";
?>

<html>
  
  <!-- Bagian head -->
  <?php include("../../../template/head.php") ?>
  
  <body>
    <div class="wrapper">
      
      <!-- Bagian sidebar -->
      <?php include("../../../template/header.php") ?>
      
      <!-- Bagian sidebar -->
      <?php include("../../../template/sidebar.php") ?>
      
      <div class="main-panel">
        <div class="content">
          <div class="container-fluid">
            
            <!-- AWAL DARI BAGIAN KONTEN --> 
                
                <!-- Bagian form tambah data -->
                <form method="POST" action="proses-konfirmasi.php" enctype='multipart/form-data'>
                  <div class="card">
                    <div class="card-header">
                      <div class="card-title">Konfirmasi Pembayaran</div>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="kd_transaksi">Kode Transaksi</label>
                        <input class="form-control" name="kd_transaksi" value="<?=$_GET['kd_transaksi']?>" readonly />
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="tgl_bayar">Tanggal Bayar</label>
                        <input class="form-control" name="tgl_bayar" type="date" />
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="norek">Nomor Rekening</label>
                        <input type="text" class="form-control" name="norek">
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="nm_bank">Bank Pengirim</label>
                        <input type="text" class="form-control" name="nm_bank">
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="total_bayar">Total Bayar</label>
                        <input type="text" class="form-control" name="total_bayar">
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="foto">Foto Bukti Pembayaran</label>
                        <input type="file" class="form-control" name="foto">
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" name="keterangan"></textarea>
                      </div>
                    </div>
                    <div class="card-action">
                      <button type="submit" class="btn btn-success">Konfirmasi Pembayaran</button>
                      <a href="index.php" class="btn btn-primary">Kembali</a>
                    </div>
                  </div>
                </form>
                <!-- Akhir dari Bagian form tambah data -->                      
										</div>
                  </div>
                </div>
          <!-- AKHIR DARI BAGIAN KONTEN -->  
          
          </div>
        </div>
      </div>
    </div>
    
    <!-- semua asset js dibawah ini -->
    <?php include("../../../template/script.php") ?>
  </body>
</html>
