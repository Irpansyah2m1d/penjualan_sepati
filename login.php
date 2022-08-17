
<?php
session_start();
include 'koneksi.php';
 include "templates/login/head.php" ?>
<?php
if(isset($_POST["btn-login"])){

  $username = $_POST["username"];
  $password = $_POST["password"];
  @$data_user = getData("SELECT * FROM tbl_user WHERE username = '$username'")[0];
  if(@$data_user){
      if(password_verify($password, $data_user["password"])){
        $_SESSION["username"] = $data_user["username"];
        $_SESSION["level"] = $data_user["level"];
        $_SESSION["login"]= $username;
        if($data_user["level"] == '2'){
         echo '<script>window.location="Admin/profil.php";</script>';
        }else{
         echo '<script>window.location="Admin/dashboard.php";</script>';
        }
      }else {
        setFlashSistem("Salah", "danger", "Password Anda"); 
        //  echo '<script>window.location="login.php";</script>';
      }
    }else{
      setFlashSistem("Tidak Valid / Belum Terdaftar", "danger", "Username Anda"); 
    }
  }


if(isset($_SESSION["berhasil"])){
     setFlashSistem("Silahkan Login!", "success", "Berhasil Mendaftar");
     unset($_SESSION["berhasil"]);
}
?>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index2.html" class="h1"><b>E-Shoes</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Silahkan Login</p>
      <?= flashSistem(); ?>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username..." name="username" />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="password" placeholder="Password..." name="password" />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary" >
              <input type="checkbox" id="show-password" />
              <label for="show-password"> Show Password </label>
            </div>
          </div>
        </div>
        <div class="row mt-4 mb-4 justify-content-center">
          <div class="col">

            <button type="submit" name="btn-login" class="btn btn-block btn-primary">
              <i class="fab fa-login mr-2"></i> Login
            </button>
          </div>
        </div>
      </form>

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
      <p class="mb-3">Belum Punya Akun?<a href="register.php" class="text-center"> <b>Daftar</b></a></p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<?php include 'templates/login/footer.php' ?>
