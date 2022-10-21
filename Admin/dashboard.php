<?php 
include '../templates/admin/head.php' ?>
<?php include '../templates/admin/sidebar.php' ?>
<?php
$tbl_barang = count(getData("SELECT * FROM tbl_barang"));
$tbl_pesanan = count(getData("SELECT * FROM tbl_pemesanan"));
$tbl_user = count(getData("SELECT * FROM tbl_user WHERE level = '2'"));
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
                <h3><?= $tbl_barang; ?></h3>

                <p>Data Barang</p>
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
                <h3><?= $tbl_pesanan; ?></h3>

                <p>Data Pesanan</p>
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
                <h3><?= $tbl_user; ?></h3>

                <p> Data User</p>
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
<?php include '../templates/admin/footer.php' ?>