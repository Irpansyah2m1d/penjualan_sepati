<?php 
session_start();
include '../template/admin/head.php' ?>
<?php include '../template/admin/sidebar.php' ?>
<?php 
// include '../koneksi.php';
$data_ukm = getData("SELECT * FROM data_ukm");

// Tambah UKM
if(isset($_POST["btn_tambah"])){
  if(tambahUKM($_POST) > 0){
      setFlash("Ditambahkan", "True", "UKM");
      echo '<script>window.location="data_ukm.php";</script>';
    }else{
    setFlash("Ditambahkan", "False", "UKM");
    echo '<script>window.location="data_ukm.php";</script>';
  }
}

// Edit Data
if(isset($_POST["btn_edit"])){
  if(editUKM($_POST) > 0){
      setFlash("Diupdate", "True", "UKM");
      echo '<script>window.location="data_ukm.php";</script>';
    }else{
    setFlash("Diupdate", "False", "UKM");
    echo '<script>window.location="data_ukm.php";</script>';
  }
}
?>

   <!-- Main content -->
    <section class="content">
      <div class="container">
      
        <div class="row">
          <div class="col-lg-9">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> <b>Data UKM/ORMAWA/KOMUNITAS Politeknik Negeri Sriwijaya</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 <div class="col-lg-4">
                  <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahUKM">
                        <i class="fa-solid fa-circle-plus"></i> Tambah Data
                  </button>
                </div>
                <table class="table table-bordered table-hover table-responsive">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama UKM</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Website</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach($data_ukm as $ukm) : ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $ukm["nama_ukm"]; ?></td>
                        <td><?= $ukm["deskripsi_ukm"]; ?></td>
                        <td><a href="../img/foto_ukm/<?= $ukm["foto_ukm"]; ?>"><i class="fa-solid fa-eye"></i></a></td>
                        <td><a style="text-decoration:none;" class="badge badge-info" target="_blank" href="<?= $ukm["website_ukm"]; ?>">Kunjungi</a></td>
                        <td>
                          
                          <a style="text-decoration:none;" href="" class="badge badge-danger" data-bs-toggle="modal" data-bs-target="#editUKM-<?= $ukm["id_ukm"]; ?>" ><i class="fa-solid fa-pen-to-square"></i></a>
                          <!-- Modal Edit Data UKM-->
                            <div class="modal fade" id="editUKM-<?= $ukm["id_ukm"]; ?>" tabindex="-1" aria-labelledby="editUKMLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="editUKMLabel">Edit Data UKM</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <form action="" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                      <div class="mb-3">
                                        <label for="nama_ukm" class="form-label">Nama UKM</label>
                                        <input type="text" class="form-control" value="<?= $ukm["nama_ukm"]; ?>" placeholder="Masukan Nama UKM..." name="nama_ukm" id="nama_ukm" aria-describedby="emailHelp" required>
                                        <input type="hidden" name="id_ukm" value="<?= $ukm["id_ukm"]; ?>">
                                      </div>
                                      <div class="mb-3">
                                        <label for="deskripsi_ukm" class="form-label">Deskripsi UKM</label>
                                        <textarea class="form-control" name="deskripsi_ukm" id="deskripsi_ukm" cols="30" rows="5" maxlength="120" placeholder="Masukan Deskripsi UKM... max: 120 Charakter" required><?= $ukm["deskripsi_ukm"]; ?></textarea>
                                      </div>
                                      <div class="mb-3">
                                        <label for="website_ukm" class="form-label">Website UKM</label>
                                        <input type="text" class="form-control" placeholder="Masukan Website UKM..." name="website_ukm" id="website_ukm" value="<?= $ukm["website_ukm"]; ?>" required>
                                        <div id="website_ukm" class="form-text text-danger fw-bold">*Example : https://www.hmjtekkom.polsri.ac.id</div>
                                      </div>
                                      <div class="mb-3">
                                        <label for="foto_ukm" class="form-label">Foto UKM</label>
                                        <input type="file" class="form-control" name="gambar" id="foto_ukm">
                                        <input type="hidden" value="<?= $ukm["foto_ukm"]; ?>" class="form-control" name="gambarLama">
                                      </div>

                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                      <button type="submit" name="btn_edit" class="btn btn-primary">Update</button>
                                    </div>
                                  </div>
                              </form>
                              </div>
                            </div>
                              </div>
                          <a style="text-decoration:none;" href="../proses_hapus.php?aksi=hapusUKM&id_ukm=<?= $ukm["id_ukm"]; ?>" class="badge badge-danger hapusMahasiswa" data-konfirmasi="<?= $ukm["nama_ukm"]; ?>"><i class="fa-solid fa-trash"></i></a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- Modal Tambah Data UKM-->
<div class="modal fade" id="tambahUKM" tabindex="-1" aria-labelledby="tambahUKMLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahUKMLabel">Tambah Data UKM</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="mb-3">
            <label for="nama_ukm" class="form-label">Nama UKM</label>
            <input type="text" class="form-control" placeholder="Masukan Nama UKM..." name="nama_ukm" id="nama_ukm" aria-describedby="emailHelp" required>
          </div>
          <div class="mb-3">
            <label for="deskripsi_ukm" class="form-label">Deskripsi UKM</label>
            <textarea class="form-control" name="deskripsi_ukm" id="deskripsi_ukm" cols="30" rows="5" maxlength="120" placeholder="Masukan Deskripsi UKM... max: 120 Charakter" required></textarea>
          </div>
          <div class="mb-3">
            <label for="website_ukm" class="form-label">Website UKM</label>
            <input type="text" class="form-control" placeholder="Masukan Website UKM..." name="website_ukm" id="website_ukm" required>
            <div id="website_ukm" class="form-text text-danger fw-bold">*Example : https://www.hmjtekkom.polsri.ac.id</div>
          </div>
          <div class="mb-3">
            <label for="foto_ukm" class="form-label">Foto UKM</label>
            <input type="file" class="form-control" name="gambar" id="foto_ukm" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
          <button type="submit" name="btn_tambah" class="btn btn-primary">Tambah</button>
        </div>
      </div>
  </form>
  </div>
</div>
  </div>
  
<?php include '../template/admin/footer.php' ?>