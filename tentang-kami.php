<?php
  session_start();
  require('vendor/autoload.php');
  require('pengaturan/medoo.php');
  require('pengaturan/helper.php');
  
  $judul = "Tentang Kami";
  
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
            
            <!-- AWAL DARI BAGIAN KONTEN --> 
                
                <!-- Bagian tabel -->
                <div class="card" id="daftarData" style="display: block;">
                  <div class="card-header">
                    <div class="card-title">Tentang Maryam Store</div>
                  </div>
                  <div class="card-body">
                    <p>
                  	<b>Toko Maryam Store</b> merupakan toko penjualan pakaian muslim dan muslimah 
Maryam Store ini berdiri di tahun 2015 dan sebagai pemiliknya yaitu ibuk Rahma Hidayati sekaligus sebagai pimpinan.
Pada Toko Maryam Store menawarkan berbagai jenis pakaian muslim dan muslimah berupa khimar  gamis kaus kaki  handsock dan perlengkapan muslim dan muslimah lainnya yang terjamin berkualitas dan harga terjangkau.
Toko maryam store ini beralamat di Padang, Sumatera Barat, kecamatan lubuk kilangan bandar buat. Dan untuk pelanggan yang berminat untuk produk di toko maryam store bisa juga datang ke toko langsung atau dengan melalui online juga bisa
                  	</p>
                  	<p><b>Sedikit Info Tambahan</b></p>
                  	<p>
											Awal dari nama toko ini adalah  pemilik toko maryam store yaitu ibuk rahma hidayati melahirkan anak ketiganya yaitu perempuan  dan diberi nama maryam attafunnisa pada waktu itu toko ibuk tersebut bernama toko rahma dan untuk kebahagiaan dari ibuk tersendiri atas anaknya tersebut maka toko rahma di tukar dengan nama Toko Maryam Store
                  	</p>
                  </div>
                </div>
          <!-- AKHIR DARI BAGIAN KONTEN -->  
          
          </div>
        </div>
      </div>
    </div>
    
    <!-- semua asset js dibawah ini -->
    <?php include("template/script.php") ?>
  </body>
</html>
