<?php
  session_start();
  
  require_once("../../../vendor/autoload.php");
  require_once("../../../pengaturan/pengaturan.php");
  require_once("../../../pengaturan/helper.php");
  require_once("../../../pengaturan/database.php");
  
  $judul = "Konfirmasi Pembayaran";
  
  $transaksi = $db->get("konfirmasi_pembayaran", "*", ['kd_transaksi' => $_GET['kd_transaksi']]);
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
                        <input class="form-control" name="tgl_bayar" type="date" value="<?=$transaksi['tgl_bayar']?>" readonly />
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="norek">Nomor Rekening</label>
                        <input type="text" class="form-control" name="norek" value="<?=$transaksi['norek']?>" readonly>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="nm_bank">Bank Pengirim</label>
                        <input type="text" class="form-control" name="nm_bank" value="<?=$transaksi['nm_bank']?>" readonly>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="total_bayar">Total Bayar</label>
                        <input type="text" class="form-control" name="total_bayar" value="<?=$transaksi['total_bayar']?>" readonly>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="foto">Foto Bukti Pembayaran</label>
                        <p>
                          <a href="<?=$alamat_web?>/assets/img/bukti/<?=$transaksi['foto']?>">
                            <img src="<?=$alamat_web?>/assets/img/bukti/<?=$transaksi['foto']?>" width="300" />
                          </a>
                        </p>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" name="keterangan" readonly><?=$transaksi['keterangan']?></textarea>
                      </div>
                    </div>
                    <div class="card-action">
                      <a href="proses-verifikasi.php?status_transaksi=Diterima&kd_transaksi=<?=$transaksi['kd_transaksi']?>" class="btn btn-success">Terima Pembayaran</a>
                      <a href="proses-verifikasi.php?status_transaksi=Ditolak&kd_transaksi=<?=$transaksi['kd_transaksi']?>" class="btn btn-danger">Tolak Pembayaran</a>
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
