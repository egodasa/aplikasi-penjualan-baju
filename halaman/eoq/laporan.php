<?php
  session_start();
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  require_once("../../pengaturan/helper.php");
  
  $judul = "Data ROP";  
  $daftar_eoq = $db->query("SELECT a.*, b.nm_kategori FROM barang a JOIN kategori b ON a.kd_kategori = b.kd_kategori")->fetchAll(PDO::FETCH_ASSOC);
  $data_barang = $db->query("SELECT * FROM barang")->fetchAll(PDO::FETCH_ASSOC);
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
            
            <!-- AWAL DARI BAGIAN KONTEN --> 
                
                <!-- Bagian tabel -->
                <div class="card" id="daftarData" style="display: block;">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-6 col-xs-12" style="padding-top: 15px;">
                        <span style="font-weight: bold; font-size: 15pt;">Laporan Perhitungan ROP</span>
                      </div>
                      <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                            <a href="cetak-laporan.php" class="btn btn-sm btn-success pull-right" target="_blank">Cetak</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
											<table id="tabel" class="table table-bordered table-head-bg-primary mt-4">
												<thead>
                          <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Penjualan</th>
                            <th>Biaya Pemesanan (Rp)</th>
                            <th>Biaya Penyimpanan (Rp)</th>
                            <th>Lead Time (Hari)</th>
                            <th>ROP</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $no = 1;
                            foreach($daftar_eoq as $i=>$d):
                          ?>
                            <tr>
                              <td><?=$no?></td>
                              <td><?=$d['nm_barang']?></td>
                              <td><?=$d['jumlah_penjualan']?></td>
                              <td><?=rupiah($d['biaya_pesan'], "")?></td>
                              <td><?=rupiah($d['biaya_simpan'], "")?></td>
                              <td><?=$d['lead_time']?></td>
                              <td><?=$d['rop']?></td>
                            </tr>
                          <?php
                            $no++;
                            endforeach;
                          ?>
                        </tbody>
											</table>
                      <!-- Akhir dari Bagian tabel -->
                      
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
    <script>
      noRowsTable('tabel', 'laporan.php');
    </script>
  </body>
</html>
