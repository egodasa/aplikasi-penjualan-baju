<?php
  session_start();
  require('vendor/autoload.php');
  require('pengaturan/medoo.php');
  require('pengaturan/helper.php');
  error_reporting(E_ALL);
ini_set('display_errors', 1);
  require_once("pengaturan/pengaturan.php");
  
  $judul = "Cara Belanja";
  
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
                    <div class="card-title">Cara Belanja</div>
                  </div>
                  <div class="card-body">
                    <ol>
                    	<li>
                    		<b>Login/Registrasi</b>
                    		<p>
                    			Silahkan login terlebih dahulu ke website Kami dengan cara mengklik menu <b>Login</b> dan masukkan username serta password. Jika belum memiliki 
                    			username, maka silahkan klik menu <b>Register</b> dan masukkan data diri serta username yang diinginkan.
                    		</p>
                    	</li>
                    	<li>
                    		<b>Memilih Produk</b>
                    		<p>
                    			Untuk memilih produk, silahkan klik menu <b>Beranda</b> dan klik <b>Detail Produk</b> pada bagian bawah foto produk.
                    			Kemudian pada bagian bawah foto produk, isikan jumlah produk yang diinginkan dan klik tombol <b>Tambah</b>.
                    		</p>
                    	</li>
                    	<li>
                    		<b>Melihat Keranjang Produk</b>
                    		<p>
                    			Setelah produk ditambahkan, maka produk tersebut akan muncul di menu <b>Keranjang</b>. Jika ingin menambahkan produk lain, silahkan lakukan langkah sebelumnya.
                    			Setelah selesai, klik tombol <b>Selesaikan Belanja</b> pada menu <b>Keranjang</b>.
                    		</p>
                    	</li>
                    	<li>
                    		<b>Menyelesaikan Belanja</b>
                    		<p>
                    			Selanjutnya, silahkan pilih <b>Kota Tujuan</b> dan pilih <b>Jasa Pengiriman</b>. Total ongkir akan tampil langsung. Kemudian ketik alamat lengkap dan klik tombol <b>Selesaikan Belanja dan Bayar</b>.
                    		</p>
                    	</li>
                    	<li>
                    		<b>Pembayaran</b>
                    		<p>
                    			Silahkan lakukan pembayaran kerekening yang ada dibawah ini : <br>
                    			<b>Bank BNI</b><br>
                    			<b>No. Rekening: 0361580705</b>
                    			<b>A/n Rahma hidayati</b>
                    		</p>
                    	</li>
                    	<li>
                    		<b>Konfirmasi Pembayaran</b>
                    		<p>
                    			Setelah melakukan pembayaran, silahkan klik tombol <b>Konfirmasi Pembayaran</b> pada menu <b>Riwayat Pemesanan</b> dan isikan data yang diperlukan, terutama bukti/foto pembayaran transfer.
                    		</p>
                    	</li>
                    	<li>
                    		<b>Pembayaran diterima/ditolak</b>
                    		<p>
                    			Kami akan memberitahu Anda melalui SMS jika pembayaran ditolak dan Anda akan diminta untuk melakukan konfirmasi pembayaran ulang. <br>
                    			Jika pembayaran diterima, maka produk yang Anda pesan akan dikirim dan nomor resi akan dikirimkan melalui SMS ke nohp Anda.
                    		</p>
                    	</li>
                    </ol>
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
