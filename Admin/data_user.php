<?php 
session_start();
include '../templates/admin/head.php' ?>
<?php include '../templates/admin/sidebar.php' ?>
<?php 
// include '../koneksi.php';
$data_user = getData("SELECT * FROM tbl_user WHERE level != '1'");


?>

   <!-- Main content -->
    <section class="content">
      <div class="container">
      
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> <b>Data Akun User E-Shoes</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <table  class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach($data_user as $user) : ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $user["nama"]; ?></td>
                        <td><?= $user["email"]; ?></td>
                        <td><?= ucfirst($user["username"]); ?></td>
                        <td>
                              
                          <a style="text-decoration:none;" href="../proses_hapus.php?aksi=hapusMahasiswa&npm=<?= $mahasiswa["npm"]; ?>" class="badge badge-danger hapusMahasiswa" data-konfirmasi="<?= $mahasiswa["nama"]; ?>">Hapus</a>
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
  
<?php include '../templates/admin/footer.php' ?>