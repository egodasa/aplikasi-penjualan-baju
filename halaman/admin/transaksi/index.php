<?php
  session_start();
  require_once("../../../vendor/autoload.php");
  require_once("../../../pengaturan/pengaturan.php");
  require_once("../../../pengaturan/database.php");
  require_once("../../../pengaturan/helper.php");
  
  $judul = "Daftar Transaksi";  
  $sql = "SELECT a.*, b.ongkir, c.nm_jasa, d.nm_kota, e.nm_pengguna, (SELECT SUM(bb.hrg_jual) FROM detail_transaksi aa JOIN barang bb ON aa.kd_barang = bb.kd_barang WHERE aa.kd_transaksi = a.kd_transaksi) + b.ongkir AS total_bayar FROM transaksi a JOIN ongkir b ON a.id_ongkir = b.id_ongkir JOIN jasa_pengiriman c ON b.id_jasa = c.id_jasa JOIN kota d ON b.id_kota = d.id_kota JOIN pengguna e ON a.kd_pelanggan = e.kd_pengguna";
  $transaksi = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
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
                
                <!-- Bagian tabel -->
                <div class="card" id="daftarData" style="display: block;">
                  <div class="card-header">
                    <div class="card-title">Daftar Transaksi</div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
											<table id="tabel" class="table table-bordered table-head-bg-primary mt-4">
												<thead>
                          <tr>
                            <th>No</th>
                            <th>Kode transaksi</th>
                            <th>Nama</th>
                            <th>Tanggal Penjualan</th>
                            <th>Kota Tujuan</th>
                            <th>Jasa Pengiriman</th>
                            <th>Total Bayar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $no = 1;
                            foreach($transaksi as $i=>$d):
                          ?>
                            <tr>
                              <td><?=$no?></td>
                              <td><?=$d['kd_transaksi']?></td>
                              <td><?=$d['nm_pengguna']?></td>
                              <td><?=tanggal_indo($d['tgl_transaksi'])?></td>
                              <td><?=$d['nm_kota']?></td>
                              <td><?=$d['nm_jasa']?></td>
                              <td><?=rupiah($d['total_bayar'])?></td>
                              <td><?=$d['status_transaksi']?></td>
                              <td>
                                <div class="form-group">
                                  <?php
                                    if($d['status_transaksi'] == 'Belum Bayar')
                                    {
                                  ?>
                                    <p>
                                      <a href="proses-batal.php?kd_transaksi=<?=$d['kd_transaksi']?>" class="btn btn-danger btn-sm">Batalkan Transaksi</a>
                                    </p>
                                  <?php
                                    }
                                    else if($d['status_transaksi'] == 'Pembayaran Diproses')
                                    {
                                  ?>
                                    <p>
                                      <a href="verifikasi.php?kd_transaksi=<?=$d['kd_transaksi']?>" class="btn btn-success btn-sm">Verifikasi Pembayaran</a>
                                    </p>
                                  <?php
                                    }
                                  ?>
                                  <p>
                                  <a href="detail-transaksi.php?kd_transaksi=<?=$d['kd_transaksi']?>" class="btn btn-success btn-sm">Nota Pemesanan</a>
                                  </p>
                                </div>
                              </td>
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
    <?php include("../../../template/script.php") ?>
    
    <!-- notifikasi halaman crud ada disini -->
    <?php include("../../../template/notifikasi-crud.php") ?>
    <script>
      noRowsTable('tabel');
    </script>
  </body>
</html>
