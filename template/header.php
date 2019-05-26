<div class="main-header">
  <div class="logo-header">
    <a href="index.html" class="logo">
    <?=$nama_perusahaan?>
    </a>
    <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
  </div>
  <nav class="navbar navbar-header navbar-expand-lg">
    <?php
      if(isset($_SESSION['username']))
      {
    ?>
      <div class="container-fluid">
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
          <?php
            if($_SESSION['jenis_pengguna'] == 'Pelanggan')
            {
          ?>
            <li class="nav-item dropdown">
              <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <span>Keranjang</span> </a>
              <ul class="dropdown-menu dropdown-user" style="width: auto;">
                <li>
                  <div class="container">
                  <table class="table table-bordered" style="width: 100%;">
                    <tr>
                      <th>No</th>
                      <th>Nama Produk</th>
                      <th>Jumlah</th>
                      <th>Sub Total</th>
                      <th colspan="2">Aksi</th>
                    </tr>
                    <?php
                      $sql = "SELECT a.*, b.nm_barang, b.hrg_jual, (a.jumlah*b.hrg_jual) AS sub_total FROM keranjang a JOIN barang b ON a.kd_barang = b.kd_barang WHERE a.kd_pengguna = ".$_SESSION['kd_pengguna'];

                      $total = 0;
                      $keranjang = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
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
                        <td>
                          <form action="<?=$alamat_web?>/keranjang/edit.php" method="POST">
                            <input type="hidden" name="kd_barang" value="<?=$d['kd_barang']?>" />
                            <input type="number" min=1 name="jumlah" value="<?=$d['jumlah']?>" class="form-control" required>
                            <button type="submit" class="btn btn-sm btn-success">Ganti Jumlah</button>
                          </form>
                        </td>
                        <td>
                          <a href="<?=$alamat_web?>/keranjang/hapus.php?kd_barang=<?=$d['kd_barang']?>" class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                      </tr>
                    <?php
                      }
                    ?>
                    <tr>
                      <td colspan="5">Total</td>
                      <td><?=rupiah($total)?></td>
                    </tr>
                  </table>
                  </div>
                </li>
              </ul>
            </li>
          <?php
            }
          ?>
          <li class="nav-item dropdown">
            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="<?=$alamat_web?>/assets/img/profile.jpg" alt="user-img" width="36" class="img-circle"><span><?=$_SESSION['username']?></span> </a>
            <ul class="dropdown-menu dropdown-user">
              <li>
                <div class="user-box">
                  <div class="u-img"><img src="<?=$alamat_web?>/assets/img/profile.jpg" alt="user"></div>
                  <div class="u-text">
                    <h4><?=$_SESSION['username']?></h4>
                  </div>
                </div>
              </li>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?=$alamat_web?>/login/proses-logout.php"><i class="fa fa-power-off"></i> Logout</a>
            </ul>
          </li>
        </ul>
      </div>
    <?
      }
    ?>
  </nav>
</div>
