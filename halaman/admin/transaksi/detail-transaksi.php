<?php
  session_start();
  require_once("../../../vendor/autoload.php");
  require_once("../../../pengaturan/pengaturan.php");
  require_once("../../../pengaturan/helper.php");
  require_once("../../../pengaturan/database.php");
  
  $sql = "SELECT a.*, b.ongkir, c.nm_jasa, d.nm_kota FROM transaksi a JOIN ongkir b ON a.id_ongkir = b.id_ongkir JOIN jasa_pengiriman c ON b.id_jasa = c.id_jasa JOIN kota d ON b.id_kota = d.id_kota WHERE a.kd_transaksi = ".$_GET['kd_transaksi'];
  $transaksi = $db->query($sql)->fetch(PDO::FETCH_ASSOC);
  
  $sql = "SELECT a.*, b.nm_barang, b.hrg_jual, (a.jumlah*b.hrg_jual) AS sub_total FROM detail_transaksi a JOIN barang b ON a.kd_barang = b.kd_barang WHERE a.kd_transaksi = :kd_transaksi";
  $detail_transaksi = $db->query($sql, ['kd_transaksi' => $_GET['kd_transaksi']])->fetchAll(PDO::FETCH_ASSOC);
  $judul = "Nota Pemesanan ".$transaksi['kd_transaksi'];  

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
                <a href="index.php" class="btn btn-primary">< Kembali</a>
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Nota Pemesanan No. <?=$transaksi['kd_transaksi']?></div>
                  </div>
                  <div class="card-body">
                    <p>
                      Status Transaksi : <b><?=$transaksi['status_transaksi']?></b>
                    </p>
                    <p>
                      Alamat Pengiriman: <b><?=$transaksi['alamat']?></b>
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

                      foreach($detail_transaksi as $nomor => $d)
                      {
                        $total += $d['sub_total'];
                        $jumlah_pesan += $d['jumlah'];
                    ?>
                      <tr>
                        <td><?=($nomor+1)?></td>
                        <td><?=$d['nm_barang']?></td>
                        <td><?=$d['jumlah']?></td>
                        <td><?=rupiah($d['sub_total'])?></td>
                      </tr>
                    <?php
                      }
                    ?>
                    <tr>
                      <td colspan="2" class="text-right"><b>Sub Total</b></td>
                      <td>
                        <?=$jumlah_pesan?>
                      </td>
                      <td>
                        <input type="hidden" name="sub_total" value="<?=$total?>">
                        <?=rupiah($total)?>
                      </td>
                    </tr>
                    <?php
                      $total += $transaksi['ongkir'];
                    ?>
                    <tr>
                      <td colspan="3" class="text-right"><b>Ongkir <br>Kota <?=$transaksi['nm_kota']?><br> Jasa Pengiriman <?=$transaksi['nm_jasa']?></b></td>
                      <td>
                        <?=rupiah($transaksi['ongkir'])?>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3" class="text-right"><b>Total yang Harus Dibayar</b></td>
                      <td>
                        <?=rupiah($total)?>
                      </td>
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
    <?php include("../../../template/script.php") ?>
    
    <script src="<?=$alamat_web?>/assets/js/axios.min.js"></script>
  </body>
</html>
