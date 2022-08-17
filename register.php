
<?php 
session_start();
include "templates/login/head.php"; ?>

<?php
include 'koneksi.php';
// $data = getData("SELECT * FROM data_mahasiswa");
// var_dump($data);
// die();
if(isset($_POST["btn-daftar"])){
  if(registerasi($_POST) > 0){
   $_SESSION["berhasil"] = true;
   header("Location: login.php");
  }else {
    if(!isset($_SESSION["message"])){
          setFlashSistem("Silahkan coba lagi!", "danger", "Gagal Mendaftar");
     }
  }
}
?>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index2.html" class="h1"><b>E-Shoes</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"> <b>Silahkan Mendaftar</b> </p>
      <?php flashSistem(); ?>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Masukan Nama Lengkap" name="nama" required />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Masukan Username" name="username" required/>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Masukan Password" name="password1" required/>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Konfirmasi Password" name="password2" required />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        
        <div class="row mt-4 mb-4 justify-content-center">
          <div class="col">

            <button type="submit" name="btn-daftar" class="btn btn-block btn-primary">
              <i class="fab fa-login mr-2"></i> Daftar
            </button>
          </div>
        </div>
      </form>

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
      <p class="mb-3">Sudah Punya Akun?<a href="login.php" class="text-center"> <b> Login</b></a></p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<?php include 'templates/login/footer.php'; ?>
