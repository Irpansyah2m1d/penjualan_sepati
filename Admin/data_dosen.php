<?php 
session_start();
include '../template/admin/head.php' ?>
<?php include '../template/admin/sidebar.php' ?>
<?php 
// include '../koneksi.php';
$data_dosen = getData("SELECT * FROM data_dosen");


?>

   <!-- Main content -->
    <section class="content">
      <div class="container">
      
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> <b>Data Dosen POLSRI</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                
                <table id="example1" class="table table-bordered table-hover ">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>NIDN</th>
                    <th>Nama</th>
                    <th>HP</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach($data_dosen as $dosen) : ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $dosen["nidn"]; ?></td>
                        <td><?= $dosen["nama_dosen"]; ?></td>
                        <td><?= $dosen["hp"]; ?></td>
                        <td>
                          <?php
                          $id_dosen = $dosen["id_dosen"];
                            $data_user = getData("SELECT * FROM tbl_login WHERE id_user = '$id_dosen'");
                            if(!empty($data_user)){
                              echo '<span class="badge badge-success">Terdaftar</span>';
                            }else {
                              echo '<span class="badge badge-warning">Belum Terdaftar</span>';
                            }
                          ?>
                        </td>
                        <td>
                          <!-- <a href="#" class="badge badge-info">Lihat</a> -->
                          <a style="text-decoration:none;" href="../proses_hapus.php?aksi=hapusDosen&id_dosen=<?= $dosen["id_dosen"]; ?>" class="badge badge-danger hapusMahasiswa" data-konfirmasi="<?= $dosen["nama_dosen"]; ?>">Hapus</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                     <th>No</th>
                    <th>NIDN</th>
                    <th>Nama</th>
                    <th>HP</th>
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