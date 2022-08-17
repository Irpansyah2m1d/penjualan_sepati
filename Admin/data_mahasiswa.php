<?php 
session_start();
include '../template/admin/head.php' ?>
<?php include '../template/admin/sidebar.php' ?>
<?php 
// include '../koneksi.php';
$data_mahasiswa = getData("SELECT * FROM data_mahasiswa");


?>

   <!-- Main content -->
    <section class="content">
      <div class="container">
      
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> <b>Data Mahasiswa Yang Mengikuti UKM/ORMAWA/KOMUNITAS</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>NAO</th>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach($data_mahasiswa as $mahasiswa) : ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $mahasiswa["nao"]; ?></td>
                        <td><?= $mahasiswa["npm"]; ?></td>
                        <td><?= $mahasiswa["nama"]; ?></td>
                        <td>
                          <?php
                          $npm = $mahasiswa["npm"];
                            $data_user = getData("SELECT * FROM tbl_login WHERE npm = '$npm'");
                            // var_dump($data_user);
                            // die();
                            if(!empty($data_user)){
                              echo '<span class="badge badge-success">Terdaftar</span>';
                            }else {
                              echo '<span class="badge badge-warning">Belum Terdaftar</span>';
                            }
                          ?>
                        </td>
                        <td>
                          <?php if(!empty($data_user)) : ?> 
                              <a style="text-decoration:none;" href="#" data-bs-toggle="modal" data-bs-target="#npm<?= $mahasiswa["npm"]; ?>" class="badge badge-info">Lihat</a>
                              <div class="modal fade" id="npm<?= $mahasiswa["npm"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detail Mahasiswa</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-6 mb-3">
                                                    <img src="../img/profil/<?= $mahasiswa["foto"]; ?>" width="150" alt="Foto Mahasiswa">
                                                </div>
                                            </div>
                                            <div class="row">
                                                
                                                <div class="col-lg-6">
                                                    <p><b>Nama :</b> <?= $mahasiswa["nama"]; ?></p>
                                                    <p><b>NAO :</b> <?= $mahasiswa["nao"]; ?></p>
                                                    <p><b>NPM :</b> <?= $mahasiswa["npm"]; ?></p>
                                                    <p><b>Prodi :</b> <?= $mahasiswa["prodi"]; ?></p>
                                                    <p><b>Angkatan :</b> <?= $mahasiswa["akt"]; ?></p>
                                                    <p><b>Semester :</b> <?= $mahasiswa["semester"]; ?></p>
                                                </div>
                                                <div class="col-lg-6">
                                                    <p><b>Email :</b> <?= $mahasiswa["email"]; ?></p>
                                                    <p><b>No HP :</b> <?= $mahasiswa["hp"]; ?></p>
                                                    <p><b>Asal Daerah :</b> <?= $mahasiswa["asal_daerah"]; ?></p>
                                                    <p><b>Alamat :</b> <?= $mahasiswa["alamat"]; ?></p>
                                                    <p><b>UKM/ORMAWA :</b> 
                                                    <ol>
                                                      <?php 
                                                      $npm_detail = $mahasiswa["npm"];
                                                      $data_mahasiswa_ukm = getData("SELECT nama_ukm FROM data_mahasiswa_ukm WHERE npm = '$npm_detail'");
                                                      foreach($data_mahasiswa_ukm as $data_mhs) : ?>
                                                        <li><?= $data_mhs["nama_ukm"]; ?></li>
                                                        <?php endforeach; ?>
                                                    </ol>
                                                  </p>
                                                </div>
                                            </div>
                                            <!-- <div class="row justify-content-between ">
                                                <div class="col-lg-2">
                                                    <img src="img/user.jpg" width="150" alt="Foto Mahasiswa">
                                                </div>
                                                <div class="col-lg-7">
                                                  
                                                  
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                              <?php endif; ?>
                          <a style="text-decoration:none;" href="../proses_hapus.php?aksi=hapusMahasiswa&npm=<?= $mahasiswa["npm"]; ?>" class="badge badge-danger hapusMahasiswa" data-konfirmasi="<?= $mahasiswa["nama"]; ?>">Hapus</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>NAO</th>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </tfoot>
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
  
<?php include '../template/admin/footer.php' ?>