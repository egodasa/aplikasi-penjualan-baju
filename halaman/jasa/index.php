<?php
  session_start();
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/database.php");
  
  $judul = "Data Jasa Pengiriman";  
  $daftar_jasa = $db->query("SELECT * FROM jasa_pengiriman")->fetchAll(PDO::FETCH_ASSOC);
  
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
                  <input type="hidden" value="" name="id_jasa" />
                  <div class="card">
                    <div class="card-header">
                      <div class="card-title" id="judulForm">Data Jasa Pengiriman Baru</div>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="nm_jasa">Nama Jasa Pengiriman</label>
                        <input type="text" class="form-control" name="nm_jasa">
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
                    <div class="card-title">Daftar Jasa Pengiriman</div>
                  </div>
                  <div class="card-body">
                    <button type="button" class="btn btn-primary" onclick="showPage()">+ Data Baru</button>
                    <div class="table-responsive">
											<table id="tabel" class="table table-bordered table-head-bg-primary mt-4">
												<thead>
                          <tr>
                            <th>No</th>
                            <th>Nama Jasa Pengiriman</th>
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
                              <td><?=$d['nm_jasa']?></td>
                              <td>
                                <div class="form-group">
                                  <a href="<?=$alamat_web?>/halaman/ongkir?id_jasa=<?=$d['id_jasa']?>" class="btn btn-success">Data Ongkos Kirim</a>
                                  <button type="button" class="btn btn-primary" onclick="editPage(<?=$i?>)">Edit</button>
                                  <a href="proses-hapus.php?id_jasa=<?=$d['id_jasa']?>" class="btn btn-danger">Hapus</a>
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
          document.getElementById("judulForm").innerHTML = "Data Jasa Pengiriman Baru";
          document.getElementById('tambahData').action = "proses-tambah.php"; 
          document.getElementsByName('nm_jasa')[0].value = "";
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
          document.getElementById("judulForm").innerHTML = "Edit Data Jasa Pengiriman";
          document.getElementById('tambahData').action = "proses-edit.php";
          
          // Memasukkan nilai yang ingin diedit kedalam form
          document.getElementsByName('nm_jasa')[0].value = data_detail[id].nm_jasa; 
        }
      }
      noRowsTable('tabel');
    </script>
  </body>
</html>
