

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <p  class="brand-link fw-bold">
      <img src="../img/logo.jpg" alt="E-Shoes Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light fw-bold">E-Shoes</span>
    </p>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="../img/user.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" style="text-decoration:none;" class="d-block fw-bold"><?= $_SESSION["username"]; ?></a>
        </div>
      </div>

     
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <?php if($_SESSION["level"] == '2') : ?>
            <li class="nav-item menu-open">
              <a href="profil.php" class="nav-link mt-2 <?= ($link=='profil.php') ? 'active' : ''?>">
                <i class="nav-icon fa-solid fa-user"></i>
                <p>
                  Profil
                </p>
              </a>
            </li>
            <li class="nav-item menu-open">
              <a href="data_prestasi.php" class="nav-link mt-2 <?= ($link=='data_prestasi.php') ? 'active' : ''?>">
              <i class="nav-icon fa-solid fa-certificate"></i>
                <p>
                  Data Barang
                </p>
              </a>
            </li>
          <?php endif; ?>
          <?php if($_SESSION["level"] == '1') : ?>
          <li class="nav-item menu-open">
            <a href="dashboard.php" class="nav-link <?= ($link=='dashboard.php') ? 'active' : ''?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="data_barang.php" class="nav-link mt-2 <?= ($link=='data_barang.php') ? 'active' : ''?>">
                <i class="nav-icon fa-solid fa-database"></i>
              <p>
                Data Barang
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="data_pemesanan.php" class="nav-link mt-2 <?= ($link=='data_pemesanan.php') ? 'active' : ''?>">
                <i class="nav-icon fa-solid fa-database"></i>
              <p>
                Data Pemesanan
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="data_user.php" class="nav-link mt-2 <?= ($link=='data_user.php') ? 'active' : ''?>">
              <i class="nav-icon fa-solid fa-users"></i>
              <p>
                Data User
              </p>
            </a>
          </li>
        <?php endif; ?>
          <!-- <li class="nav-item menu-open">
            <a href="change_password.php" class="nav-link mt-2 <?= ($link=='change_password.php') ? 'active' : ''?>">
              <i class="nav-icon fa-solid fa-user-lock"></i>
              <p>
                Change Password
              </p>
            </a>
          </li> -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
          <li class="nav-item menu-open">
            <a href=""  class="nav-link mt-2" data-bs-toggle="modal" data-bs-target="#logout">
              <i class="nav-icon fa-solid fa-right-from-bracket"></i>
              <p>
               Logout
              </p>
            </a>
          </li>
       
          
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $bread; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?= $bread; ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->