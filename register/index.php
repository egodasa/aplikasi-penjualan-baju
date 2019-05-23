<?php
  require_once("../pengaturan/helper.php");
  require_once("../pengaturan/pengaturan.php");
  $judul = "Daftar Pengguna Baru";
?>
<html>
  
  <!-- Bagian head -->
  <?php include("../template/head.php") ?>
  <style type="text/css">
    body {
      background: url('../assets/img/background.jpg');
      background-repeat: no-repeat;
      background-size: auto;
    }
    #login-form {
      width: 400px;
      margin: 100px auto;
    }
  </style>
<body>
    <div class="card" id="login-form">
      <div class="card-header">
        <p style="font-size: 20pt; font-weight: bold; text-align: center;">Register</p>
        <?php
          if(isset($_GET['username']))
          {
            echo alertBootstrap("success", "Peringatan!", "Username tidak bisa digunakan. Silahkan gunakan username lain.");
          }
        ?>
      </div>
      <div class="card-body">
        <form method="POST" action="proses-register.php">
          <div class="form-group">
            <label for="username"></label>
            <input type="text" class="form-control" name="username" placeholder="Username" required />
          </div> 
          <div class="form-group">
            <label for="password"></label>
            <input type="password" class="form-control" name="password" placeholder="Password" required />
          </div>
          <div class="form-group">
            <label for="nm_lengkap"></label>
            <input type="nm_lengkap" class="form-control" name="nm_lengkap" placeholder="Nama Lengkap" required />
          </div>
          <div class="form-group">
            <label for="nohp"></label>
            <input type="nohp" class="form-control" name="nohp" placeholder="NOHP" required />
          </div>
          <div class="form-group">
            <label for="alamat"></label>
            <input type="alamat" class="form-control" name="alamat" placeholder="Alamat" required />
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
          </div>
        </form>
      </div>
    </div>                      		                            
    <!-- semua asset js dibawah ini -->
    <?php
      include("../template/script.php");
      if(isset($_GET['login']))
      {
        echo "<script>alert('Username atau Password salah');</script>";
      }
    ?>
  </body>
</html>
