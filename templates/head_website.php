<?php 
include 'koneksi.php';
// var_dump($_SESSION);
// die();
$url = $_SERVER['REQUEST_URI'];

$url = explode("Junior_Web_Developer/Penjualan_sepatu/",$url)[1];

$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
$request_uri = $uri_parts[0];
// var_dump($request_uri);
// die();
switch ($request_uri) {
  case '/junior_web_developer/Penjualan_sepatu/daftar_barang.php':
    $title="Daftar Barang | E-Shoes";
    break;
  case '/junior_web_developer/Penjualan_sepatu/about_us.php':
    $title="About Us | E-Shoes";
    break;
  case '/junior_web_developer/Penjualan_sepatu/data_pemesanan_user.php':
    $title="Data Pemesanan | E-Shoes";
    break;
  case '/junior_web_developer/Penjualan_sepatu/change_password_web.php':
    $title="Change Password | E-Shoes";
    break;
  case '/junior_web_developer/Penjualan_sepatu/profil_web.php':
    $title="Profil User | E-Shoes";
    break;
  case '/junior_web_developer/Penjualan_sepatu/pembayaran.php':
    $title="Pembayaran | E-Shoes";
    break;
  case '/junior_web_developer/Penjualan_sepatu/pemesanan.php':
    $title="Pemesanan | E-Shoes";
    break;
  case '/junior_web_developer/Penjualan_sepatu/keranjang.php':
    $title="Keranjang | E-Shoes";
    break;
 default:
    $title = "Home | E-Shoes";
}
$data_barang = getData("SELECT * FROM tbl_barang LIMIT 0, 3");
$data_barang_all = getData("SELECT * FROM tbl_barang");
// var_dump($data_barang);
// die()

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="css/assets/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<!-- <link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css"> -->
    <link rel="stylesheet" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" href="vendor/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendor/lightcase/lightcase.css">
    <link rel="stylesheet" href="css/style.min.css">
     <!-- Modernizr JS for IE8 support of HTML5 elements and media queries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
     <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      body{
        padding: 0;
      }
      .keranjang {
        width: 100px;
        padding: 15px;
        border-radius: 50%;
        height: 100px;
        background-color: white;
        background: -webkit-linear-gradient(to right, #333399, #ff00cc);
        /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #333399, #ff00cc);
        border-color: blue;
        position: fixed;
        right: 50px;
        bottom: 25px;
        z-index: 999;
      }
      .warna_produk {
        cursor: pointer;
      }

      .active-produk{
        transform: scale(1.25);
        border: 3px solid green;
        box-sizing: border-box;
        
      }
      /* .hasil {
        float: left;
      } */
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/carousel.css" rel="stylesheet">

    <title><?= $title; ?></title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
          <a class="navbar-brand judul-web" href="#"><img src="img/logo.jpg" class="rounded-circle me-2" width="50px" alt="Penjualan Apps">E-Shoes</a>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item active">
                <a class="nav-link <?= ($url =='index.php') || $url == '' ? 'active' : ''?>" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= ($url =='daftar_barang.php') ? 'active' : ''?>" href="daftar_barang.php">Daftar Barang</a>
              </li>
              <li class="nav-item">
                <a href="about_us.php"  class="nav-link <?= ($url =='about_us.php') ? 'active' : ''?>">About Us</a>
              </li>

              <?php 
              // $_SESSION["level"] = "2";
              // $_SESSION["id_user"] = "US0001";
              if(@$_SESSION["level"] === '2') : ?>
            <?php 
                $id_user = $_SESSION["id_user"];
                $data_user = getData("SELECT * FROM tbl_user WHERE id_user = '$id_user'");
                $data_keranjang = getData("SELECT * FROM tbl_keranjang WHERE id_user = '$id_user'");
              ?>
            <li class="nav-item ms-lg-5">
              
              <span style="margin-top: -7px;" class="position-absolute top-50  translate-middle p-1 bg-danger border border-light rounded-circle">
            </span>
              <img class=" mt-2" src="img/user.jpg" alt="" width="30" height="24" style="border-radius:50%;">
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $data_user[0]["username"]; ?>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                <!-- <li><a class="dropdown-item" href="profil.php">Profil</a></li> -->
                <li><a class="dropdown-item <?= ($url =='profil_web.php') ? 'active' : ''?>" href="profil_web.php">Profil</a></li>
                <li><a class="dropdown-item <?= ($url =='data_pemesanan_user.php') ? 'active' : ''?>" href="data_pemesanan_user.php">Data Pemesanan</a></li>
                <li><a class="dropdown-item <?= ($url =='keranjang.php') ? 'active' : ''?>" href="keranjang.php">Keranjang Saya</a></li>
                <li><a class="dropdown-item <?= ($url =='change_password_web.php') ? 'active' : ''?>" href="change_password_web.php">Change Password</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logout" >Logout</a></li>
              </ul>
            </li>
            <?php else: ?>
              <a href="login.php" class="ml-5 font-weight-bold btn btn-outline-light">Login</a>
          <?php endif; ?>
            </ul>
          </div>
        </div>
      </nav>
        <!-- Set Flash -->
            <?= flash(); ?>
          <?= info(); ?>
      <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="logoutLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutLabel">Konfirmas Pesan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda Yakin Ingin Keluar?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="logout.php" class="btn btn-primary" style="background-color: #0d6efd; border-color: #0d6efd;">Logout</a>
      </div>
    </div>
  </div>
</div>
       