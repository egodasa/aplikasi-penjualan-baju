<?php
  session_start();
  require_once("../../vendor/autoload.php");
  require_once("../../pengaturan/pengaturan.php");
  require_once("../../pengaturan/helper.php");
  require_once("../../pengaturan/database.php");
  
  $judul = "Data Barang";  
  $daftar_barang = $db->query("SELECT a.*, b.nm_kategori FROM barang a JOIN kategori b ON a.kd_kategori = b.kd_kategori")->fetchAll(PDO::FETCH_ASSOC);
  
  $daftar_kategori = $db->query("SELECT * FROM kategori")->fetchAll(PDO::FETCH_ASSOC);
  
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
                <form method="POST" id="tambahData" action="proses-tambah.php" style="display: none;" enctype="multipart/form-data">
                  <input type="hidden" value="" name="kd_barang" />
                  <div class="card">
                    <div class="card-header">
                      <div class="card-title" id="judulForm">Data Barang Baru</div>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <label for="nm_barang">Nama Barang</label>
                        <input type="text" class="form-control" name="nm_barang">
                      </div>
                      <div class="form-group">
                        <label for="hrg_jual">Harga Beli (Rp)</label>
                        <input type="number" class="form-control" name="hrg_beli">
                      </div>
                      <div class="form-group">
                        <label for="hrg_beli">Harga Jual (Rp)</label>
                        <input type="number" class="form-control" name="hrg_jual">
                      </div>
                      <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" name="stok">
                      </div>
                      <div class="form-group">
                        <label for="safety_stock">Stok Minimal</label>
                        <input type="number" class="form-control" name="safety_stock">
                      </div>
                      <div class="form-group">
                        <label for="kd_kategori">Kategori</label>
                        <select name="kd_kategori" class="form-control">
                          <?php foreach($daftar_kategori as $d): ?>
                            <option value="<?=$d['kd_kategori']?>"><?=$d['nm_kategori']?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                      	<label for="deskripsi">Deskripsi</label>
                      	<div id="deskripsi"></div>
                      	<input type="hidden" name="deskripsi" id="deskripsi_isi" />
                      </div>
                    <div class="row">
                    	<div class="col-xs-12 col-sm-4">
                    		<div class="form-group">
	                        <label for="foto_1">Foto 1</label>
	                        <p id="foto_1"></p>
	                        <input type="file" class="form-control" name="foto_1">
	                      </div>
                    	</div>
                    	<div class="col-xs-12 col-sm-4">
                    		<div class="form-group">
	                        <label for="foto_2">Foto 2</label>
	                        <p id="foto_2"></p>
	                        <input type="file" class="form-control" name="foto_2">
	                      </div>
                    	</div>
                    	<div class="col-xs-12 col-sm-4">
                    		<div class="form-group">
	                        <label for="foto_3">Foto 3</label>
	                        <p id="foto_3"></p>
	                        <input type="file" class="form-control" name="foto_3">
	                      </div>
                    	</div>
                    </div>
                      <div class="row">
                        <div class="col-md-4 col-xs-12">
                          <div class="form-group">
                            <label for="nohp">Biaya Pesan (RP)</label>
                            <input type="text" class="form-control" name="biaya_pesan">
                          </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                          <div class="form-group">
                            <label for="nohp">Biaya Penyimpanan (Rp)</label>
                            <input type="text" class="form-control" name="biaya_simpan">
                          </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                          <div class="form-group">
                            <label for="nohp">Lead Time (Hari)</label>
                            <input type="text" class="form-control" name="lead_time">
                          </div>
                        </div>
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
                    <div class="card-title">Daftar Barang</div>
                  </div>
                  <div class="card-body">
                    <button type="button" class="btn btn-primary" onclick="showPage()">+ Data Baru</button>
                    <div class="table-responsive">
											<table id="tabel" class="table table-bordered table-head-bg-primary mt-4">
												<thead>
                          <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Deskripsi</th>
                            <th>Harga Beli (Rp)</th>
                            <th>Harga Jual (Rp)</th>
                            <th>Stok</th>
                            <th>Kategori</th>
                            <th>Safety Stock</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $no = 1;
                            foreach($daftar_barang as $i=>$d):
                          ?>
                            <tr>
                              <td><?=$no?></td>
                              <td><?=$d['nm_barang']?></td>
                              <td><?=$d['deskripsi']?></td>
                              <td><?=rupiah($d['hrg_beli'], "")?></td>
                              <td><?=rupiah($d['hrg_jual'], "")?></td>
                              <td><?=$d['stok']?></td>
                              <td><?=$d['nm_kategori']?></td>
                              <td><?=$d['safety_stock']?></td>
                              <td>
                                <div class="form-group">
                                  <button type="button" class="btn btn-primary" onclick="editPage(<?=$i?>)">Edit</button>
                                  <a href="proses-hapus.php?kd_barang=<?=$d['kd_barang']?>" class="btn btn-danger">Hapus</a>
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
    
    <script src="<?=$alamat_web?>/assets/js/axios.min.js"></script>
    <script>
    	
    	$(document).ready(function() {
			  $('#deskripsi').summernote({
				  callbacks: {
				    onChange: function(contents, $editable) {
				      $('#deskripsi_isi').val(contents);
				    }
				  }
				});
			});
      
      // detail setiap data ada disini
      var data_detail = <?=json_encode($daftar_barang)?>;
      
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
          document.getElementById("judulForm").innerHTML = "Data Barang Baru";
          document.getElementById('tambahData').action = "proses-tambah.php"; 
          document.getElementsByName('nm_barang')[0].value = ""; 
          document.getElementsByName('hrg_beli')[0].value = ""; 
          document.getElementsByName('hrg_jual')[0].value = ""; 
          document.getElementsByName('stok')[0].value = ""; 
          document.getElementsByName('safety_stock')[0].value = "";
          document.getElementsByName('kd_kategori')[0].value = "";
          
          document.getElementsByName('biaya_simpan')[0].value = "";
          document.getElementsByName('biaya_pesan')[0].value = "";
          document.getElementsByName('lead_time')[0].value = "";
          
          // Kosongkan bagian html foto
          document.getElementById('foto_1').innerHTML = "";
          document.getElementById('foto_2').innerHTML = "";
          document.getElementById('foto_3').innerHTML = "";
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
          document.getElementById("judulForm").innerHTML = "Edit Data Barang";
          document.getElementById('tambahData').action = "proses-edit.php";
          
          // Memasukkan nilai yang ingin diedit kedalam form
          document.getElementsByName('nm_barang')[0].value = data_detail[id].nm_barang; 
          document.getElementsByName('hrg_beli')[0].value = data_detail[id].hrg_beli; 
          document.getElementsByName('hrg_jual')[0].value = data_detail[id].hrg_jual; 
          document.getElementsByName('stok')[0].value = data_detail[id].stok; 
          document.getElementsByName('kd_kategori')[0].value = data_detail[id].kd_kategori; 
          document.getElementsByName('kd_barang')[0].value = data_detail[id].kd_barang;
          document.getElementsByName('safety_stock')[0].value = data_detail[id].safety_stock;
          
          document.getElementsByName('biaya_simpan')[0].value = data_detail[id].biaya_simpan;
          document.getElementsByName('biaya_pesan')[0].value = data_detail[id].biaya_pesan;
          document.getElementsByName('lead_time')[0].value = data_detail[id].lead_time;
          
          var foto_1 = data_detail[id].foto_1;
          var foto_2 = data_detail[id].foto_2;
          var foto_3 = data_detail[id].foto_3;
          
          if(foto_1.length == 0)
          {
          	foto_1 = "*Foto tidak ada. Silahkan upload foto baru.";
          }
          else
          {
          	foto_1 = "<img width='300' height='300' src='/assets/img/produk/" + foto_1 + "' /> <br> *Upload foto baru untuk ganti foto.";
          }
          if(foto_2.length == 0)
          {
          	foto_2 = "*Foto tidak ada. Silahkan upload foto baru.";
          }
          else
          {
          	foto_2 = "<img width='300' height='300' src='/assets/img/produk/" + foto_2 + "' /> <br> *Upload foto baru untuk ganti foto.";
          }
          if(foto_3.length == 0)
          {
          	foto_3 = "*Foto tidak ada. Silahkan upload foto baru.";
          }
          else
          {
          	foto_3 = "<img width='300' height='300' src='/assets/img/produk/" + foto_3 + "' /> <br> *Upload foto baru untuk ganti foto.";
          }
          document.getElementById('foto_1').innerHTML = foto_1;
          document.getElementById('foto_2').innerHTML = foto_2;
          document.getElementById('foto_3').innerHTML = foto_3;
          
          $("#deskripsi").summernote("code", data_detail[id].deskripsi);
        }
      }

      noRowsTable('tabel');
    </script>
  </body>
</html>
