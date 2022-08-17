<?php include '../template/admin/head.php';
$data_user = getData("SELECT * FROM tbl_login WHERE `level` = '1'");
$data_dosen = getData("SELECT * FROM tbl_login WHERE `level` = '3'");
 ?>
<?php include '../template/admin/sidebar.php'
 ?>

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> <b>Data Akun Mahasiswa</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <table id="data_user" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>NPM</th>
                    <th>Usernmae</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach($data_user as $user) : ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $user["npm"]; ?></td>
                        <td><?= $user["username"]; ?></td>
                        <td>
                          <a style="text-decoration:none;" href="../prosesAll.php?aksi=nonaktifkan&id_user=<?= $user["id_user"]; ?>" class="badge badge-<?= $user["is_active"] == "1" ? "success" : "info" ?>"><?= $user["is_active"] == "1" ? "Nonaktifkan" : "Aktifkan" ?></a>
                          <a style="text-decoration:none;" href="../prosesAll.php?aksi=hapusUser&id_user=<?= $user["id_user"]; ?>" class="badge badge-danger tombolKonfirmasi" data-konfirmasi="<?= $user["username"]; ?>">Hapus</a>
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
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> <b>Data Akun Dosen</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <table id="data_user" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>NIDN</th>
                    <th>Username</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach($data_dosen as $dosen) : ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $dosen["npm"]; ?></td>
                        <td><?= $dosen["username"]; ?></td>
                        <td>
                          <a style="text-decoration:none;" href="../prosesAll.php?aksi=nonaktifkan&id_user=<?= $dosen["id_user"]; ?>" class="badge badge-<?= $dosen["is_active"] == "1" ? "success" : "info" ?>"><?= $dosen["is_active"] == "1" ? "Nonaktifkan" : "Aktifkan" ?></a>
                          <a style="text-decoration:none;" href="../prosesAll.php?aksi=hapusUser&id_user=<?= $dosen["id_user"]; ?>" class="badge badge-danger tombolKonfirmasi" data-konfirmasi="<?= $dosen["username"]; ?>">Hapus</a>
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
<?php include '../template/admin/footer.php' ?>