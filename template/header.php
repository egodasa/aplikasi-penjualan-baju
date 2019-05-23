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
