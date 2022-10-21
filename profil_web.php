<?php 
include 'templates/head_website.php'; ?>
<?php
$id_user = $_SESSION["id_user"];
$data_user = getData("SELECT * FROM tbl_user WHERE id_user = '$id_user'");

if(isset($_POST["btn-simpan"])){
  if(simpanProfile($_POST) > 0){
    setFlash("Disimpan", "True", "Profil");
    echo "<script>
      document.location.href = 'profil_web.php';
    </script>";
  }else {
    setFlash("Disimpan", "False", "Profil");
    echo "<script>
      document.location.href = 'profil_web.php';
    </script>";
  }
}

?>


    <!-- Main content -->
    <section class="content mt-5">
      <div class="container" style="height: 350px;">
        <!-- Small boxes (Stat box) -->
        <form action="" method="post" enctype="multipart/form-data">
        <?php foreach($data_user as $user) : ?>
          <div class="row">
              <div class="col-lg-3">
                  <img src="img/user.jpg" for="gambar" alt="Foto Profil" width="200px">
                  <!-- <input type="hidden" value="<?= $user["foto"]; ?>" name="gambar_lama">
                  <div class="col-lg-10 mt-2">
                    <input type="file" width="200px" class="form-control" id="gambar" name="gambar">
                  </div> -->
              </div>
              <div class="col-lg-4">
                <div class="mb-1">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" value="<?= $user["nama"]; ?>" placeholder="Masukan Nama..." class="form-control" id="nama" name="nama">
                </div>       
                <div class="mb-1">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" value="<?= $user["email"]; ?>" class="form-control" placeholder="Masukan Email..." id="email" name="email">
                </div>       
                <div class="mb-1">
                  <label for="alamat" class="form-label">Alamat</label>
                  <input type="text" value="<?= $user["alamat"]; ?>" class="form-control" placeholder="Masukan Alamat..." id="alamat" name="alamat">
                </div>       
              </div>
            </div>
          <div class="row">
            <div class="col-lg-3 mt-3">
              <div class="mb-1">
                  <button type="submit" class="btn btn-success" name="btn-simpan">Simpan</button>
                </div> 
            </div>
          </div>
        </form>
      <?php endforeach; ?>
        <!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php include 'templates/footer_website.php'; ?>