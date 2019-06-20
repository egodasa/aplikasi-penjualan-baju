<?
  session_start();
  require('../pengaturan/pengaturan.php');
  require('../pengaturan/helper.php');
  $level = $_SESSION['jenis_pengguna'];
  $url = "";
  if(isset($_SESSION['username'])){
    unset($_SESSION['username']);
    unset($_SESSION['nm_pengguna']);
    unset($_SESSION['jenis_pengguna']);
  }
  if($level == "Pelanggan")
  {
  	$url = "Location: $alamat_web/login";
  }
  else
  {
  	$url = "Location: $alamat_web/login/admin.php";
  }
  header($url);
?>
