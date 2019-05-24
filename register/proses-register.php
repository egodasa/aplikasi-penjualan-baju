<?
  session_start();
  require('../pengaturan/helper.php');
  require('../vendor/autoload.php');
  require('../pengaturan/medoo.php');
  
  $cek_username = $db->get("pengguna", ['username'], ['username' => $_POST['username']]);
  
  if(empty($cek_username))
  {
    $db->insert("pengguna", [
      'username' => $_POST['username'],
      'nm_pengguna' => $_POST['nm_pengguna'],
      'password' => md5($_POST['password']),
      'jenis_pengguna' => "Pelanggan",
      'nohp' => $_POST['nohp'],
      'alamat' => $_POST['alamat']
    ]);
    header("Location: ".$alamat_web."/login?daftar=true");
  }
  else
  {
    header("Location: ".$alamat_web."/register?username=salah");
  }
?>
