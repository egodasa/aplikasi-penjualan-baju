<?php
  session_start();
  require_once("vendor/autoload.php");
  require_once("pengaturan/pengaturan.php");
  require_once("pengaturan/helper.php");
  require_once("pengaturan/database.php");
  
  $judul = "Selesaikan Belanja";  
  $sql = "SELECT a.*, b.nm_barang, b.hrg_jual, (a.jumlah*b.hrg_jual) AS sub_total FROM keranjang a JOIN barang b ON a.kd_barang = b.kd_barang WHERE a.kd_pengguna = ".$_SESSION['kd_pengguna'];
  $keranjang = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  
  $kota = $db->select("kota", "*");
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
                    <div class="card-title">Selesaikan Belanja</div>
                  </div>
                  <div class="card-body">
                    <p>
                      Berikut adalah daftar barang yang akan Anda beli. Silahkan klik menu "<b>Keranjang</b>" untuk mengubah barang yang ingin dibeli :
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
                    ?>
                    
                    <?php
                      foreach($keranjang as $nomor => $d)
                      {
                        $total += $d['sub_total'];
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
                      <td colspan="3" class="text-right"><b>Sub Total</b></td>
                      <td>
                        <input type="hidden" name="sub_total" value="<?=$total?>">
                        <?=rupiah($total)?>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2">
                        <div class="form-group">
                          <label>Pilih Kota Tujuan</label>
                          <select name="id_kota" class="form-control">
                            <option value="">-- Kota Tujuan --</option>  
                            <?php
                              foreach($kota as $d)
                              {
                            ?>
                              <option value="<?=$d['id_kota']?>"><?=$d['nm_kota']?></option>
                            <?php
                              }
                            ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Pilih Jasa Pengiriman</label>
                          <select name="id_jasa" class="form-control">
                          </select>
                        </div>
                      </td>
                      <td class="text-right">
                        <b>Ongkos Kirim</b>
                      </td>
                      <td>
                        <span name="ongkir"></span>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3" class="text-right"><b>Total yang Harus Dibayar</b></td>
                      <td>
                        <span name="total"></span>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="4">
                        <form action="selesaikan-belanja.php" method="POST">
                          <input type="hidden" name="id_ongkir" >
                          <div class="form-grooup">
                            <label>Alamat Lengkap</label>
                            <textarea class="form-control" name="alamat"></textarea>
                          </div>
                          <button type="submit" class="btn btn-primary">Selesaikan Belanja dan Bayar</button>  
                        </form>
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
    <?php include("template/script.php") ?>
    
    <script src="<?=$alamat_web?>/assets/js/axios.min.js"></script>
    
    <script>
      var daftar_jasa = [];
      
      function getJasa(id_kota)
      {
        axios.get("<?=$alamat_web?>/get-ongkir.php?id_kota=" + id_kota)
          .then(function(res){
            if(res.data)
            {
              var hasil = res.data;
              var banyak_data = hasil.length;
              daftar_jasa = res.data;
              document.getElementsByName("id_jasa")[0].innerHTML = "";
              for(var x = 0; x < banyak_data; x++)
              {
                document.getElementsByName("id_jasa")[0].innerHTML += "<option value='" + hasil[x].id_jasa + "'>" + hasil[x].nm_jasa + "</option>";
              }
              hitungOngkir(document.getElementsByName('id_jasa')[0].selectedIndex);
            }
          })        
      }
      
      function hitungOngkir(index)
      {
        document.getElementsByName("ongkir")[0].innerHTML = daftar_jasa[index].ongkir;
        document.getElementsByName("id_ongkir")[0].value = daftar_jasa[index].id_ongkir;
        document.getElementsByName("total")[0].innerHTML = parseInt(daftar_jasa[index].ongkir) + parseInt(document.getElementsByName("sub_total")[0].value);
      }
      
      // Event
      document.getElementsByName("id_kota")[0].addEventListener('change', function(){
        getJasa(this.value)
      });
      
      document.getElementsByName("id_jasa")[0].addEventListener('change', function(){
        hitungOngkir(this.selectedIndex)
      });
    </script>
  </body>
</html>
