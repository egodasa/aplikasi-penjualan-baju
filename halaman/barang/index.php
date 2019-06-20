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
                        <label for="foto_1">Foto 1</label>
                        <input type="file" class="form-control" name="foto_1">
                      </div>
                      <div class="form-group">
                        <label for="foto_2">Foto 2</label>
                        <input type="file" class="form-control" name="foto_2">
                      </div>
                      <div class="form-group">
                        <label for="foto_3">Foto 3</label>
                        <input type="file" class="form-control" name="foto_3">
                      </div>
                      <div class="row">
                        <div class="col-md-6 col-xs-12">
                          <div class="form-group">
                            <label for="nohp">Tahun Penjualan (Tahun)</label>
                            <input type="text" class="form-control" name="tahun_penjualan">
                          </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                          <div class="form-group">
                            <label for="nohp">Jumlah Penjualan (Pcs)</label>
                            <input type="text" class="form-control" name="jumlah_penjualan">
                          </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                          <div class="form-group">
                            <label for="nohp">Biaya Pesan (RP)</label>
                            <input type="text" class="form-control" name="biaya_pesan">
                          </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                          <div class="form-group">
                            <label for="nohp">Biaya Penyimpanan (Rp)</label>
                            <input type="text" class="form-control" name="biaya_simpan">
                          </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                          <div class="form-group">
                            <label for="nohp">Lead Time (Hari)</label>
                            <input type="text" class="form-control" name="lead_time">
                          </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                          <div class="form-group">
                            <label for="nohp">Hasil Perhitungan EOQ</label>
                            <input type="text" class="form-control" name="eoq">
                          </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                          <div class="form-group">
                            <label for="nohp">Hasil Perhitungan ROP</label>
                            <input type="text" class="form-control" name="rop">
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
          document.getElementsByName('jumlah_penjualan')[0].value = "";
          document.getElementsByName('rop')[0].value = "";
          document.getElementsByName('eoq')[0].value = "";
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
          document.getElementsByName('jumlah_penjualan')[0].value = data_detail[id].jumlah_penjualan;
          document.getElementsByName('rop')[0].value = data_detail[id].rop;
          document.getElementsByName('eoq')[0].value = data_detail[id].eoq;
        }
      }
      function hitungEoqDanRop()
      {
        var R = document.getElementsByName('jumlah_penjualan')[0].value;
        var S = document.getElementsByName('biaya_pesan')[0].value;
        var C = document.getElementsByName('biaya_simpan')[0].value;
        var LT = document.getElementsByName('lead_time')[0].value;
        var EOQ = 0; 
        var ROP = 0; 
        if(R != "" && S != "" && C != "" && LT != "")
        {
          EOQ = Math.sqrt((2 * R * S) / C);
          ROP = (R / 365) * LT;
          document.getElementsByName("eoq")[0].value = Math.round(EOQ);
          document.getElementsByName("rop")[0].value = Math.round(ROP);
        }
      }
      
      // Mengambil jumlah penjualan per tahun berdasarkan tahun dan barang
      
      function getBanyakPenjualan(){
        var kd_barang = document.getElementsByName("kd_barang")[0].value;
        var tahun_penjualan = document.getElementsByName("tahun_penjualan")[0].value;
        if(kd_barang != "" && tahun_penjualan != ""){
          axios.get("<?=$alamat_web?>/api/get-penjualan-tahun.php?kd_barang=" + kd_barang + "&tahun=" + tahun_penjualan)
            .then(function(res){
            	if(res.data.jml == undefined)
            	{
            		document.getElementsByName("jumlah_penjualan")[0].value = 0;
            	}
            	else
            	{
            		document.getElementsByName("jumlah_penjualan")[0].value = res.data.jml;
            	}
            })          
            .catch(function(err){
              document.getElementsByName("jumlah_penjualan")[0].value = "0";
            })          
        }
        else
        {
        	document.getElementsByName("jumlah_penjualan")[0].value = 0;
        }
      }
      
      // Menghitung eoq dan rop saat terjadi perubahan nilai di jumlah penjualan, biaya pesan, biaya simpan dan lead time
      document.getElementsByName('jumlah_penjualan')[0].addEventListener("keyup", hitungEoqDanRop);
      document.getElementsByName('biaya_pesan')[0].addEventListener("keyup", hitungEoqDanRop);
      document.getElementsByName('biaya_simpan')[0].addEventListener("keyup", hitungEoqDanRop);
      document.getElementsByName('lead_time')[0].addEventListener("keyup", hitungEoqDanRop);
      
      // Event untuk perubahan barang dan tahun penjualan
      document.getElementsByName("tahun_penjualan")[0].addEventListener("blur", getBanyakPenjualan)  
      document.getElementsByName("kd_barang")[0].addEventListener("change", getBanyakPenjualan) 
      noRowsTable('tabel');
    </script>
  </body>
</html>
