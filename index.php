<?php
  session_start();
  require_once("vendor/autoload.php");
  require_once("pengaturan/medoo.php");
  require_once("pengaturan/helper.php");
  require_once("pengaturan/pengaturan.php");
  
  $judul = "Home";
  $barang = $db->select("barang", "*");
?>

<html>
  
  <!-- Bagian head -->
  <?php include("template/head.php") ?>
  
  <body>
    <div class="wrapper">
      
      <!-- Bagian sidebar -->
      <?php include("template/header.php") ?>
      
      <!-- Bagian sidebar -->
      <?php include("template/sidebar.php") ?>
      
      <div class="main-panel">
        <div class="content">
          <div class="container-fluid">
              <div class="row">
                <!-- Bagian Produk -->
                <?php
                  foreach($barang as $d)
                  {
                ?>
                <div class="col-xs-12 col-sm-4">
                  <div class="card">
                    <div class="card-header">
                      <div style="float: right;">
                        <?=rupiah($d['hrg_jual'])?>
                      </div>
                      <div style="float: left;">
                        <b><?=$d['nm_barang']?></b>
                      </div>
                      <div style="clear: both;"></div>
                    </div>
                    <div class="card-body">
                      <p>
                        <img class="img-responsive" src="<?=$alamat_web?>/assets/img/produk/<?=$d['foto_1']?>" height="300" width="100%" />
                      </p>
                    </div>
                    <div class="card-footer">
                      <a href="<?=$alamat_web?>/detail-produk.php?kd_barang=<?=$d['kd_barang']?>" class="btn btn-block btn-primary">Detail Produk</a>
                    </div>
                  </div>
                </div>
                <?php
                  }
                ?>
                <!-- Bagian Produk -->
              </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- semua asset js dibawah ini -->
    <?php include("template/script.php") ?>
  </body>
</html>
