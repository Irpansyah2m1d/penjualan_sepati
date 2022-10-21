<?php 
include '../templates/admin/head.php' ?>
<?php include '../templates/admin/sidebar.php' ?>
<?php
$npm = $_SESSION["npm"];
$data_mahasiswa = getData("SELECT * FROM data_mahasiswa WHERE npm = '$npm'");
$data_ukm = getData("SELECT * FROM data_ukm");
$data_mahasiswa_ukm = getData("SELECT nama_ukm FROM data_mahasiswa_ukm WHERE npm = '$npm'");
$jml_ukm = count($data_mahasiswa_ukm);
// var_dump($jml_ukm);
// die();

if(isset($_POST["btn-simpan"])){
  // var_dump($_POST);
  // die();
  if(simpanProfile($_POST) > 0){
    setFlash("Disimpan", "True", "Profil");
    echo "<script>
      document.location.href = 'profil.php';
    </script>";
  }else {
    setFlash("Disimpan", "False", "Profil");
    echo "<script>
      document.location.href = 'profil.php';
    </script>";
  }
}

?>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <form action="" method="post" enctype="multipart/form-data">
         
        <?php foreach($data_mahasiswa as $mahasiswa) : ?>
          <div class="row">
              <div class="col-lg-3">
                  <img src="../img/profil/<?= $mahasiswa["foto"]; ?>" for="gambar" alt="Foto Profil" width="200px">
                  <input type="hidden" value="<?= $mahasiswa["foto"]; ?>" name="gambar_lama">
                  <div class="col-lg-10">
                    <input type="file" width="200px" class="form-control" id="gambar" name="gambar">
                  </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-1">
                  <label for="npm" class="form-label">NPM</label>
                  <input type="text" value="<?= $mahasiswa["npm"]; ?>" readonly class="form-control" id="npm" name="npm">
                </div>       
                <div class="mb-1">
                  <label for="nao" class="form-label">NAO</label>
                  <input type="text" value="<?= $mahasiswa["nao"]; ?>" readonly class="form-control" id="nao" name="nao">
                </div>       
                <div class="mb-1">
                  <label for="nama" class="form-label">Nama Lengkap</label>
                  <input type="text" value="<?= $mahasiswa["nama"]; ?>" class="form-control" placeholder="Masukan Nama..." id="nama" name="nama">
                </div>       
              </div>
              <div class="col-lg-4">
                <div class="mb-1">
                  <label for="prodi" class="form-label">Program Studi</label>
                 <select class="form-select" id="prodi"  name="prodi" aria-label="Default select example">
                  <option value="">--Pilih Prodi--</option>
                  <option value="D3 Teknik Komputer" <?= $mahasiswa["prodi"] == "D3 Teknik Komputer" ? "selected" : "";  ?>>D3 Teknik Komputer</option>
                  <option value="D4 Teknologi Informatika Multimedia Digital" <?= $mahasiswa["prodi"] == "D4 Teknologi Informatika Multimedia Digital" ? "selected" : "";  ?>>D4 Teknologi Informatika Multimedia Digital</option>
                </select>
                </div>       
                <div class="mb-1">
                  <label for="kelas" class="form-label">Kelas</label>
                  <input type="text" class="form-control" value="<?= $mahasiswa["kelas"]; ?>" id="kelas" placeholder="Masukan Kelas ex: 2 TIA" name="kelas">
                </div>       
                <div class="mb-1">
                  <label for="semester" class="form-label">Semester</label>
                  <input type="number" class="form-control" value="<?= $mahasiswa["semester"]; ?>" placeholder="Masukan Semster..." id="semester" name="semester">
                </div>       
              </div>
          </div>
          <div class="row">
            <div class="col-lg-3">
                <div class="mb-1">
                  <label for="akt" class="form-label">Angkatan</label>
                  <input type="number" class="form-control" value="<?= $mahasiswa["akt"]; ?>" placeholder="Masukan Tahun Angkatan..." id="akt" name="akt">
                </div>  
                <div class="mb-3">
                  <label for="hp" class="form-label">No HP</label>
                  <input type="text" class="form-control" value="<?= $mahasiswa["hp"]; ?>" id="hp" placeholder="Masukan hp.." name="hp">
                </div>     
                    
            </div>
            <div class="col-lg-4">
               <div class="mb-1">
                  <label for="nama" class="form-label">Asal Daerah</label>
                  <input type="text" class="form-control" value="<?= $mahasiswa["asal_daerah"]; ?>" id="nama" placeholder="Masukan Daerah ex: Muara Enim" name="asal_daerah">
                </div>          
                <div class="mb-1">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" value="<?= $mahasiswa["email"]; ?>" id="email" placeholder="Masukan Email.." name="email">
                </div>      
            </div>
            <div class="col-lg-4">
                 <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat Lengkap</label>
                  <textarea name="alamat" placeholder="Masukan Alamat..." class="form-control" id="alamat" rows="3"><?= $mahasiswa["alamat"]; ?></textarea>
                </div> 
              </div>
              <div class="col-lg-4">
                <div class="mb-3">
                  <label for="alamat" class="form-label">Pilih UKM</label>
                  <select class="form-select" size="3" name="ukm_mahasiswa[]" aria-label="size 3 select example" multiple>
                    
                    <?php foreach($data_ukm as $ukm) : ?>
                      <option value="<?= $ukm["nama_ukm"]; ?>" ><?= $ukm["nama_ukm"]; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <div id="website_ukm" class="form-text text-danger fw-bold h-6">*Untuk memilih lebih dari 1 tekan CTRL</div>
                  
                </div>
              </div>
              <div class="col-lg-8">
                <div class="mb-3">
                  <label for="alamat" class="form-label">UKM KAMU</label>
                      <?php if(empty($data_mahasiswa_ukm)) : ?>
                        <li class="text-danger">Belum Ada UKM yang dipilih</li>
                      <?php endif ?>
                    <ul>
                      <?php foreach($data_mahasiswa_ukm as $mahasiswa_ukm) : ?>
                      <li><?= $mahasiswa_ukm["nama_ukm"]; ?></li>
                      <?php endforeach; ?>
                    </ul>
                  </select>
                  
                </div>
            </div>
          <div class="row">
            <div class="col-lg-3">
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
<?php include '../template/admin/footer.php' ?>