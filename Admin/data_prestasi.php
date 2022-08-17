<?php include '../template/admin/head.php';
$npm = $_SESSION["npm"];
@$data_akademik = getData("SELECT * FROM data_mahasiswa_prestasi WHERE `jenis` = 'Akademik' AND npm = '$npm'");
@$data_non_akademik = getData("SELECT * FROM data_mahasiswa_prestasi WHERE `jenis` = 'Non Akademik' AND npm = '$npm'");
 ?>
<?php include '../template/admin/sidebar.php';

// Tambah Data
if(isset($_POST["btn_simpan"])){
  if(tambahPrestasi($_POST) > 0){
      setFlash("Disimpan", "True", "Prestasi");
      echo '<script>window.location="data_prestasi.php";</script>';
    }else{
    setFlash("Disimpan", "False", "Prestasi");
    echo '<script>window.location="data_prestasi.php";</script>';
  }
}
// Edit Data
if(isset($_POST["btn_edit"])){
  if(editPrestasi($_POST) > 0){
      setFlash("Diupdate", "True", "Prestasi");
      echo '<script>window.location="data_prestasi.php";</script>';
    }else{
    setFlash("Diupdate", "False", "Prestasi");
    echo '<script>window.location="data_prestasi.php";</script>';
  }
}
 ?>



    <!-- Main content -->
    <section class="content">
      <div class="container">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahPrestasi">
          Tambah Data
        </button>
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> <b>Data Prestasi Akademik</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="data_user" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Prestasi</th>
                      <th>Tingkat</th>
                      <th>Bukti</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no = 1;
                      foreach($data_akademik as $akademik) : ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $akademik["nama_prestasi"]; ?></td>
                          <td><?= $akademik["tingkat"]; ?></td>
                          <td><a href="../img/bukti_prestasi/<?= $akademik["dokumentasi"]; ?>" ><i class="fa-solid fa-eye"></i></a></td>
                          <td>
                            <a href="#" class="badge badge-info" data-bs-toggle="modal" data-bs-target="#PrestasiAkademik<?= $akademik["id"]; ?>"><i class="fa-solid fa-pen-to-square"></i></a>

                            <div class="modal fade" id="PrestasiAkademik<?= $akademik["id"]; ?>" tabindex="-1" aria-labelledby="editPrestasiLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="editPrestasiLabel">Edit Prestasi Akademik</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <label for="nama_prestasi" class="form-label">Nama Prestasi</label>
                                            <input type="hidden" value="<?= $akademik["id"]; ?>" name="id_prestasi">
                                            <input type="text" class="form-control" value="<?= $akademik["nama_prestasi"] ?>" name="nama_prestasi" id="nama_prestasi" aria-describedby="emailHelp" required>
                                            <div id="nama_prestasi" class="form-text">Contoh: Juara 1 Lomba Catur</div>
                                          </div>
                                          <div class="mb-3">
                                            <label for="tingkat_prestasi" class="form-label">Tingkat</label>
                                            <select class="form-select" id="tingkat_prestasi"  name="tingkat_prestasi" aria-label="Default select example" required>
                                              <option value="">--Pilih Tingkat--</option>
                                              <option <?= $akademik["tingkat"] == "Kabupaten/Kota" ? "selected" : "" ?> value="Kabupaten/Kota">Kabupaten/Kota</option>
                                              <option <?= $akademik["tingkat"] == "Provinsi" ? "selected" : "" ?> value="Provinsi">Provinsi</option>
                                              <option <?= $akademik["tingkat"] == "Nasional" ? "selected" : "" ?> value="Nasional">Nasional</option>
                                              <option <?= $akademik["tingkat"] == "Internasional" ? "selected" : "" ?> value="Internasional">Internasioanl</option>
                                            </select>
                                          </div>
                                          <div class="mb-3">
                                            <label for="jenis_prestasi" class="form-label">Jenis Prestasi</label>
                                            <select class="form-select" aria-label="Default select example" name="jenis_prestasi" id="jenis_prestasi" required>
                                              <option value="">--Pilih Jenis--</option>
                                              <option <?= $akademik["jenis"] == "Akademik" ? "selected" : "" ?> value="Akademik">Akademik</option>
                                              <option <?= $akademik["jenis"] == "Non Akademik" ? "selected" : "" ?> value="Non Akademik">Non Akademik</option>
                                            </select>
                                          </div>
                                          <div class="mb-3">
                                            <label for="bukti_prestasi" class="form-label">Bukti Prestasi</label>
                                            <input type="file" class="form-control" name="gambar" id="bukti_prestasi" aria-describedby="emailHelp">
                                            <input type="hidden" value="<?= $akademik["dokumentasi"]; ?>" name="gambar_lama" >
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




                            <a href="../proses_hapus.php?aksi=hapusPrestasi&id=<?= $akademik["id"]; ?>"  class="badge badge-danger tombolKonfirmasi" data-konfirmasi="Prestasi <?= $akademik["nama_prestasi"]; ?> "><i class="fa-solid fa-trash"></i></a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                  </div>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> <b>Data Prestasi Non Akademik</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <table id="data_user" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Prestasi</th>
                      <th>Tingkat</th>
                      <th>Bukti</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no = 1;
                      foreach($data_non_akademik as $non_akademik) : ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $non_akademik["nama_prestasi"]; ?></td>
                          <td><?= $non_akademik["tingkat"]; ?></td>
                          <td><a href="../img/bukti_prestasi/<?= $non_akademik["dokumentasi"]; ?>" ><i class="fa-solid fa-eye"></i></a></td>
                          <td>
                            <a href="#" class="badge badge-info" data-bs-toggle="modal" data-bs-target="#PrestasiNonAkademik<?= $non_akademik["id"]; ?>"><i class="fa-solid fa-pen-to-square"></i></a>

                            <!-- Modal -->
                                <div class="modal fade" id="PrestasiNonAkademik<?= $non_akademik["id"]; ?>" tabindex="-1" aria-labelledby="tambahPrestasiLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="tambahPrestasiLabel">Edit Prestasi Non Akademik</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <form action="" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <label for="nama_prestasi" class="form-label">Nama Prestasi</label>
                                             <input type="hidden" value="<?= $non_akademik["id"]; ?>" name="id_prestasi">
                                            <input type="text" class="form-control" value="<?= $non_akademik["nama_prestasi"] ?>" name="nama_prestasi" id="nama_prestasi" aria-describedby="emailHelp" required>
                                            <div id="nama_prestasi" class="form-text">Contoh: Juara 1 Lomba Catur</div>
                                          </div>
                                          <div class="mb-3">
                                            <label for="tingkat_prestasi" class="form-label">Tingkat</label>
                                            <select class="form-select" id="tingkat_prestasi"  name="tingkat_prestasi" aria-label="Default select example" required>
                                              <option value="">--Pilih Tingkat--</option>
                                              <option <?= $non_akademik["tingkat"] == "Kabupaten/Kota" ? "selected" : "" ?> value="Kabupaten/Kota">Kabupaten/Kota</option>
                                              <option <?= $non_akademik["tingkat"] == "Provinsi" ? "selected" : "" ?> value="Provinsi">Provinsi</option>
                                              <option <?= $non_akademik["tingkat"] == "Nasional" ? "selected" : "" ?> value="Nasional">Nasional</option>
                                              <option <?= $non_akademik["tingkat"] == "Internasional" ? "selected" : "" ?> value="Internasional">Internasioanl</option>
                                            </select>
                                          </div>
                                          <div class="mb-3">
                                            <label for="jenis_prestasi" class="form-label">Jenis Prestasi</label>
                                            <select class="form-select" aria-label="Default select example" name="jenis_prestasi" id="jenis_prestasi" required>
                                              <option value="">--Pilih Jenis--</option>
                                              <option <?= $non_akademik["jenis"] == "Akademik" ? "selected" : "" ?> value="Akademik">Akademik</option>
                                              <option <?= $non_akademik["jenis"] == "Non Akademik" ? "selected" : "" ?> value="Non Akademik">Non Akademik</option>
                                            </select>
                                          </div>
                                          <div class="mb-3">
                                            <label for="bukti_prestasi" class="form-label">Bukti Prestasi</label>
                                            <input type="file" class="form-control" name="gambar" id="bukti_prestasi" aria-describedby="emailHelp">
                                            <input type="hidden" value="<?= $non_akademik["dokumentasi"]; ?>"  name="gambar_lama" >
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



                            <a href="../proses_hapus.php?aksi=hapusPrestasi&id=<?= $non_akademik["id"]; ?>"  class="badge badge-danger tombolKonfirmasi" data-konfirmasi="Prestasi <?= $non_akademik["nama_prestasi"]; ?> "><i class="fa-solid fa-trash"></i></a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
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
    <!-- Modal -->
<div class="modal fade" id="tambahPrestasi" tabindex="-1" aria-labelledby="tambahPrestasiLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahPrestasiLabel">Tambah Prestasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="mb-3">
            <label for="nama_prestasi" class="form-label">Nama Prestasi</label>
            <input type="text" class="form-control" name="nama_prestasi" id="nama_prestasi" aria-describedby="emailHelp" required>
            <div id="nama_prestasi" class="form-text">Contoh: Juara 1 Lomba Catur</div>
          </div>
          <div class="mb-3">
            <label for="tingkat_prestasi" class="form-label">Tingkat</label>
            <select class="form-select" id="tingkat_prestasi" name="tingkat_prestasi" aria-label="Default select example" required>
              <option value="">--Pilih Tingkat--</option>
              <option value="Kabupaten/Kota">Kabupaten/Kota</option>
              <option value="Provinsi">Provinsi</option>
              <option value="Nasional">Nasional</option>
              <option value="Internasional">Internasioanl</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="jenis_prestasi" class="form-label">Jenis Prestasi</label>
            <select class="form-select" aria-label="Default select example" name="jenis_prestasi" id="jenis_prestasi" required>
              <option value="">--Pilih Jenis--</option>
              <option value="Akademik">Akademik</option>
              <option value="Non Akademik">Non Akademik</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="bukti_prestasi" class="form-label">Bukti Prestasi</label>
            <input type="file" class="form-control" name="gambar" id="bukti_prestasi" aria-describedby="emailHelp" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
          <button type="submit" name="btn_simpan" class="btn btn-primary">Simpan</button>
        </div>
      </div>
  </form>
  </div>
</div>
  </div>
<?php include '../template/admin/footer.php' ?>