<?php
  session_start();
  require_once("vendor/autoload.php");
  require_once("pengaturan/medoo.php");
  require_once("pengaturan/helper.php");
  require_once("pengaturan/pengaturan.php");
  
  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    $db->insert("keranjang", [
      'kd_pengguna' => $_SESSION['kd_pengguna'],
      'kd_barang' => $_GET['kd_barang'],
      'jumlah' => $_POST['jumlah'],
    ]);
  }
  
  $barang = $db->get("barang", "*", ['kd_barang' => $_GET['kd_barang']]);
  
  $judul = "Detail Produk ".$barang['nm_barang'];
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
            <div class="card">
              <div class="card-header">
                <?=$barang['nm_barang']?> <br>
                <?=rupiah($barang['hrg_jual'])?>
                <input type="hidden" name="hrg_jual" />
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-4 col-xs-12">
                    <img src="<?=$alamat_web?>/assets/img/produk/<?=$barang['foto_1']?>" style="width: 100%;">
                  </div>
                  <div class="col-sm-4 col-xs-12">
                    <img src="<?=$alamat_web?>/assets/img/produk/<?=$barang['foto_2']?>" style="width: 100%;">
                  </div>
                  <div class="col-sm-4 col-xs-12">
                    <img src="<?=$alamat_web?>/assets/img/produk/<?=$barang['foto_3']?>" style="width: 100%;">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-6 col-xs-12">
                    <h4>Tambahkan ke Keranjang</h4>
                  </div>
                  <div class="col-sm-6 col-xs-12">
                    <form method="POST">
                      <input type="hidden" name="kd_produk" value="<?=$_GET['kd_produk']?>" />
                      <input type="number" name="jumlah" />
                      <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- semua asset js dibawah ini -->
    <?php include("template/script.php") ?>
  </body>
</html>
