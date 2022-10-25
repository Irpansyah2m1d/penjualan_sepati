<?php
require "templates/head_website.php";
$data_keranjang = getData("SELECT * FROM tbl_keranjang WHERE id_user = '$id_user'");

if(isset($_POST["checkout"])){
  $_SESSION["waktu"] = random_int(3, 7);
  $_SESSION["id_keranjang"] = $_POST["pilihBarang"];
  $_SESSION["total"] = $_POST["totalHarga"];
  echo "<script>
    document.location.href = 'pemesanan.php';
  </script>";
}
?>
   <div class="container mt-3" style="height: 380px ;">
    <div class="row">
      <div class="col-lg-10">
        <div class="card mb-3" >
              <div class="card-header">
                <h3 class="card-title"> <b>Keranjang Anda</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                
                <table  class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Warna</th>
                    <th>Ukuran</th>
                    <th>Jumlah Pesanan</th>
                    <th>Total</th>
                    <th>Aksi</th>
                    <th>Pilih</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(count($data_keranjang) < 1) : ?>
                      <td colspan="8" class="text-center">
                        <span class="text-danger fw-bold">Keranjang Anda Masih Kosong</span>
                      </td>
                    <?php endif ?>
                    <form action="" method="POST">

                      <?php 
                      $no = 1;
                      foreach($data_keranjang as $keranjang) : ?>
                      <!-- <input type="hidden" name=""> -->
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $keranjang["nama"]; ?></td>
                          <td><?= $keranjang["warna"]; ?></td>
                          <td><?= $keranjang["ukuran"]; ?></td>
                          <td><?= $keranjang["jumlah"]; ?></td>
                          <td><?= $keranjang["total"]; ?></td>
                          <td>
                            <a style="text-decoration:none;" href="../proses_hapus.php?aksi=hapusKeranjang&id_keranjang=<?= $keranjang["id_keranjang"]; ?>" class="badge bg-danger hapusMahasiswa" data-konfirmasi="<?= $keranjang["nama"]; ?>">Hapus</a>
                          </td>
                          <td>
                            <input type="checkbox" name="pilihBarang[]" class="pesanan" value="<?= $keranjang["id_keranjang"]; ?>" data-harga="<?= $keranjang["total"]; ?>">
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="div">
                 <p class="fw-bold ms-3 d-inline-block">Total : Rp. </p> 
                 <input type="text" size="10" value="0" class="hasil" name="totalHarga" readonly>
                </div>
                <div class="col-lg-12">

                  <button class="btn btn-success float-end me-3 mb-3" type="submit" name="checkout" <?= count($data_keranjang) < 1 ? "disabled" : ""; ?> >Checkout</button>
                  <a href="" class="btn btn-warning voucher float-end me-3 mb-3" >Voucher</a>

                </div>
              </div>
              </form>
            <!-- /.card -->
      </div>
    </div>
  <?php 
  require "templates/footer_website.php";
  ?>
   