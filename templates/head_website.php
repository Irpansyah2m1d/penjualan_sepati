<?php 
include 'koneksi.php';

$data_barang = getData("SELECT * FROM tbl_barang");
// var_dump($data_barang);
// die()

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="css/bootstrap.min.css"
      integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
      crossorigin="anonymous"
    />

    <title>Home | E-Shoes</title>
  </head>
  <body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
          <a class="navbar-brand" href="#"><img src="img/logo.png" width="50px" alt="Penjualan Apps">E-Shoes</a>
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
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="daftar_barang.php">Daftar Barang</a>
              </li>
              <li class="nav-item">
                <a class="nav-link">About Us</a>
              </li>
              <a href="login.php" class="ml-5 font-weight-bold btn btn-outline-light">Login</a>
            </ul>
          </div>
        </div>
      </nav>
    <div class="container mt-3">