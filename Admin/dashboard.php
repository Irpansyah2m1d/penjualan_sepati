<?php 
include '../template/admin/head.php' ?>
<?php include '../template/admin/sidebar.php' ?>
<?php
$data_mahasiswa = count(getData("SELECT * FROM data_mahasiswa"));
$data_dosen = count(getData("SELECT * FROM data_dosen"));
$dsn_terdatar = count(getData("SELECT * FROM tbl_login WHERE level = '3'"));
$mhs_terdaftar = count(getData("SELECT * FROM tbl_login WHERE level = '1'"));
?>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $data_mahasiswa; ?></h3>

                <p>Data Mahasiswa</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-database"></i>
              </div>
              <a href="data_mahasiswa.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $dsn_terdatar; ?> Dari <?= $data_dosen; ?></h3>

                <p>Dosen Terdaftar</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-chalkboard-user"></i>
              </div>
              <a href="data_user.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $mhs_terdaftar; ?></h3>

                <p> Mahasiswa Terfaftar</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="data_user.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <!-- <div class="col-lg-3 col-6"> -->
            <!-- small box -->
            <!-- <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          <!-- ./col -->
        </div>
        <!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php include '../template/admin/footer.php' ?>