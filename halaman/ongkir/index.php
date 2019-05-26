<?php
  session_start();
  if(isset($_GET['id_jasa']))
  {
    $_SESSION['current_jasa'] = $_GET['id_jasa'];
  }
  
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/helper.php");
  require_once("../../pengaturan/database.php");
  
  $jasa = $db->get("jasa_pengiriman", "*", ['id_jasa' => $_SESSION['current_jasa']]);
  
  $kota = $db->select("kota", "*");
  
  $judul = "Data Ongkos Kirim ".$jasa['nm_jasa'];  
  $daftar_jasa = $db->query("SELECT a.*, b.nm_kota FROM ongkir a JOIN kota b ON a.id_kota = b.id_kota AND a.id_jasa = :id_jasa", ['id_jasa' => $_SESSION['current_jasa']])->fetchAll(PDO::FETCH_ASSOC);
  
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
                
                <!-- Bagian form tambah data -->
                <form method="POST" id="tambahData" action="proses-tambah.php" style="display: none;">
                  <input type="hidden" value="" name="id_ongkir" />
                  <div class="card">
                    <div class="card-header">
                      <div class="card-title" id="judulForm">Data Ongkos Kirim <?=$jasa['nm_jasa']?></div>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="id_kota">Kota Tujuan</label>
                        <select class="form-control" name="id_kota">
                          <option value="">-- Pilih Kota --</option>
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
                        <label for="ongkir">Ongkos Kirim</label>
                        <input type="number" class="form-control" name="ongkir">
                      </div>
                    </div>
                    <div class="card-action">
                      <button type="submit" class="btn btn-success">Simpan</button>
                      <button type="reset" class="btn btn-danger">Reset</button>
                      <button type="button" class="btn btn-primary" onclick="showPage()">Kembali</button>
                    </div>
                  </div>
                </form>
                <!-- Akhir dari Bagian form tambah data -->
                
                <!-- Bagian tabel -->
                <div class="card" id="daftarData" style="display: block;">
                  <div class="card-header">
                    <div class="card-title">Data Ongkos Kirim <?=$jasa['nm_jasa']?></div>
                  </div>
                  <div class="card-body">
                    <a href="<?=$alamat_web?>/halaman/jasa" class="btn btn-success">< Kembali </a>
                    <button type="button" class="btn btn-primary" onclick="showPage()">+ Data Baru</button>
                    <div class="table-responsive">
											<table id="tabel" class="table table-bordered table-head-bg-primary mt-4">
												<thead>
                          <tr>
                            <th>No</th>
                            <th>Kota Tujuan</th>
                            <th>Ongkos Kirim</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $no = 1;
                            foreach($daftar_jasa as $i=>$d):
                          ?>
                            <tr>
                              <td><?=$no?></td>
                              <td><?=$d['nm_kota']?></td>
                              <td><?=rupiah($d['ongkir'])?></td>
                              <td>
                                <div class="form-group">
                                  <button type="button" class="btn btn-primary" onclick="editPage(<?=$i?>)">Edit</button>
                                  <a href="proses-hapus.php?id_ongkir=<?=$d['id_ongkir']?>" class="btn btn-danger">Hapus</a>
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
    <?php include("../../template/script.php") ?>
    
    <!-- notifikasi halaman crud ada disini -->
    <?php include("../../template/notifikasi-crud.php") ?>
    <script>
      var data_detail = <?=json_encode($daftar_jasa)?>;
      
      // memmunculkan form tambah data dan daftar data dengan javascript.
      function showPage()
      {
        var tambahData = document.getElementById('tambahData');
        var daftarData = document.getElementById('daftarData');
        if(tambahData.style.display == 'block')
        {
          tambahData.style.display = 'none';
          daftarData.style.display = 'block';
          
          // Mereset form menjadi form tambah data
          document.getElementById("judulForm").innerHTML = "Data Ongkos Kirim <?=$jasa['nm_jasa']?>";
          document.getElementById('tambahData').action = "proses-tambah.php"; 
          document.getElementsByName('id_kota')[0].value = "";
          document.getElementsByName('ongkir')[0].value = "";
        }
        else
        {
          tambahData.style.display = 'block';
          daftarData.style.display = 'none';
        }
      }
      function editPage(id)
      {
        showPage();
        if(document.getElementById('tambahData').action = "proses-tambah.php")
        {
          
          // Mengubah form tambah jadi edit
          document.getElementById("judulForm").innerHTML = "Edit Ongkos Kirim <?=$jasa['nm_jasa']?>";
          document.getElementById('tambahData').action = "proses-edit.php";
          
          // Memasukkan nilai yang ingin diedit kedalam form
          document.getElementsByName('id_kota')[0].value = data_detail[id].id_kota; 
          document.getElementsByName('id_ongkir')[0].value = data_detail[id].id_ongkir; 
          document.getElementsByName('ongkir')[0].value = data_detail[id].ongkir; 
        }
      }
      noRowsTable('tabel');
    </script>
  </body>
</html>
