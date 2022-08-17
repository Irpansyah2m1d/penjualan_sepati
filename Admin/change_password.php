<?php
session_start();
include '../template/admin/head.php'; ?>
<?php 
include '../template/admin/sidebar.php'; 

if(isset($_POST["btn-change"])){
    if(changePassword($_POST) > 0){
        setFlash("Diubah", "True", "Password");
         echo '<script type="text/javascript">
                    document.location.href = "change_password.php";
                    </script>'; 
      }else {
        setFlash("Diubah", "False", "Password");
           echo '<script type="text/javascript">
                    document.location.href = "change_password.php";
                    </script>';
    }
}

?>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <!-- /.card-header -->
              <div class="card-body">
                  <div class="container">
                      <div class="row">
                          <h1>Change Password</h1>
                      </div>
                      <div class="row">
                          <div class="col-lg-6">
                              <form action="" method="POST">
                                  <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" readonly class="form-control" id="username" name="username" value="<?= $_SESSION["username"]; ?>">
                                  </div>
                                  <div class="mb-3">
                                    <label for="recent-password" class="form-label">Recent Pasword</label>
                                    <input type="password" required class="form-control" name="recent_password" id="recent-password" autocomplete="off" placeholder="Masukan Password Lama...">
                                  </div>
                                  <div class="mb-3">
                                    <label for="new-password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" name="password1" id="new-password" placeholder="Masukan Password Baru..."   required>
                                  </div>
                                  <div class="mb-3">
                                    <label for="konfirmasi-password" class="form-label">Konfirmasi Pasword</label>
                                    <input type="password" name="password2" class="form-control" id="konfirmasi-password" placeholder="Konfirmasi Password..."  required>
                                  </div>
                                  <div class="mb-3">
                                      <input type="checkbox" class="form-checkbox" id="show-password"> 
                                      <label class="col-form-label" for="show-password">Show Password</label>
                                 </div>
                                <div class="mb-3">
                                    <button type="button" class="btn btn-secondary">Batal</button>
                                    <button type="submit" class="btn btn-success" name="btn-change">Simpan</button>
                                </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
            <!-- /.card -->
        </div>
        <!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php include '../template/admin/footer.php' ?>