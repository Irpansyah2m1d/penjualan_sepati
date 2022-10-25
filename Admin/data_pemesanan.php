<?php 
session_start();
include '../templates/admin/head.php' ?>
<?php include '../templates/admin/sidebar.php' ?>
<?php 
// include '../koneksi.php';
$data_pemesanan = getData("SELECT * FROM tbl_pemesanan JOIN tbl_user ON tbl_pemesanan.id_user = tbl_user.id_user ORDER BY id_pemesanan DESC");
@$id_pemesanan = $data_pemesanan[0]["id_pemesanan"];
$data_produk = getData("SELECT * FROM tbl_barang_user WHERE id_pemesanan = '$id_pemesanan'");


?>

   <!-- Main content -->
    <section class="content">
      <div class="container">
      
        <div class="row">
          <div class="col-lg-12">
           <div class="card mb-3" >
              <div class="card-header">
                <h3 class="card-title"> <b>Data Pemesanan E-Shoes</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                
                <table  class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama User</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Produk</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Tanggal Pengiriman</th>
                    <th>Total Harga</th>
                    <th>Metode Pembayaran</th>
                    <th>Keterangan</th>
                    <th>Bukti Bayar</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if(count($data_pemesanan) < 1) : ?>
                      <td colspan="11" class="text-center">
                        <span class="text-danger fw-bold">Tidak Ada Data Pemesanan</span>
                      </td>
                    <?php endif ?>
                    <?php 
                    $no = 1;
                    foreach($data_pemesanan as $pemesanan) : ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $pemesanan["nama"]; ?></td>
                        <td><?= $pemesanan["email"]; ?></td>
                        <td><?= $pemesanan["alamat"]; ?></td>
                        <td>
                          <ol>
                            <?php foreach($data_produk as $produk) : ?>
                              <li><?= $produk["nama"]; ?>  <span class="ms-5"></li>
                              <?php endforeach; ?>
                            </ol>
                          </td>
                        <td><?= $pemesanan["tgl_pemesanan"]; ?></td>
                        <td><?= $pemesanan["tgl_pengiriman"]; ?></td>
                        <td>Rp. <?= $pemesanan["total_harga"]; ?></td>
                        <td>
                          <?php if($pemesanan["metode_bayar"] === "COD") : ?>
                             <img src="../img/cod-logo-design.png" alt="" width="50px" >
                             <?php elseif($pemesanan["metode_bayar"] === "Alfamart") : ?>
                              <img src="../img/Logo-Alfamart.png" alt="" width="50px" >
                              <?php elseif($pemesanan["metode_bayar"] === "Indomaret") : ?>
                                <img src="../img/Logo_Indomaret.png" alt="" width="50px" >
                                <?php else: ?>
                                  <img src="../img/loho-dana.png" alt="" width="50px" >
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php if($pemesanan["ket"] === "1") : ?>
                            <?php if($pemesanan["metode_bayar"] === "COD") : ?>
                                                      <span class="badge bg-danger">Belum Bayar</span>
                                                      <?php else: ?>
                                                        <span class="badge bg-danger">Menunggu Pembayaran</span>
                                                      <?php endif; ?>
                            <?php elseif($pemesanan["ket"] === "2") : ?>
                              <span class="badge bg-warning">Menunggu Konfirmasi</span>
                              <?php else: ?>
                                <span class="badge bg-success">Lunas</span>
                          <?php endif; ?>
                        </td>
                        <td>
                        <?php if($pemesanan["ket"] !== "1") : ?>
                          <a style="text-decoration:none;" href="../img/bukti_pembayaran/<?= $pemesanan["bukti_pembayaran"]; ?>" class="badge bg-orange">Bukti</a>
                        <?php else: ?>
                          -
                        <?php endif; ?>
                        </td>
                        <td>
                          <a style="text-decoration:none;" href="#" data-bs-toggle="modal" data-bs-target="#id_pesanan<?= $pemesanan["id_pemesanan"]; ?>" class="badge bg-info">Detail</a>
                              <div class="modal fade" id="id_pesanan<?= $pemesanan["id_pemesanan"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan <?= $pemesanan["id_pemesanan"]; ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-6 mb-3">
                                                    <img src="../img/qrcode/qrcode.png" width="150" alt="QRCODE">
                                                </div>
                                            </div>
                                            <div class="row">
                                                
                                                <div class="col-lg-12">
                                                    <p><b class="fw-bold">Nama :</b> <?= $pemesanan["nama"]; ?></p>
                                                    <p><b class="fw-bold">Email :</b> <?= $pemesanan["email"]; ?></p>
                                                    <p><b class="fw-bold">Alamat :</b> <?= $pemesanan["alamat"]; ?></p>
                                                    <p><b class="fw-bold">Total Harga :</b> Rp. <?= $pemesanan["total_harga"]; ?></p>
                                                    <p><b class="fw-bold">Produk :</b> <br>
                                                     <ol>
                                                      <?php foreach($data_produk as $produk) : ?>
                                                        <li><?= $produk["nama"]; ?>  <span class="ms-5">(Warna: <?= $produk["warna"] ?>, Ukuran: <?= $produk["ukuran"] ?>)</li>
                                                        <?php endforeach; ?>
                                                      </ol>
                                                  </p>
                                                    <p><b class="fw-bold">Akan Tiba Pada :</b> <?= tanggal_indo($pemesanan["tgl_pengiriman"], true); ?></p>
                                                    <p><b class="fw-bold">Metode Pembayaran :</b> <?php if($pemesanan["metode_bayar"] === "COD") : ?>
                                                            <img src="../img/cod-logo-design.png" alt="" width="50px" >
                                                            <?php elseif($pemesanan["metode_bayar"] === "Alfamart") : ?>
                                                              <img src="../img/Logo-Alfamart.png" alt="" width="50px" >
                                                              <?php elseif($pemesanan["metode_bayar"] === "Indomaret") : ?>
                                                                <img src="../img/Logo_Indomaret.png" alt="" width="50px" >
                                                                <?php else: ?>
                                                                  <img src="../img/loho-dana.png" alt="" width="50px" >
                                                          <?php endif; ?></p>
                                                    <p><b class="fw-bold">Keterangan :</b>  <?php if($pemesanan["ket"] === "1") : ?>
                                                      <?php if($pemesanan["metode_bayar"] === "COD") : ?>
                                                      <span class="badge bg-danger">Belum Bayar</span>
                                                      <?php else: ?>
                                                        <span class="badge bg-danger">Menunggu Pembayaran</span>
                                                      <?php endif; ?>
                                                      <?php elseif($pemesanan["ket"] === "2") : ?>
                                                        <span class="badge bg-warning">Menunggu Konfirmasi</span>
                                                        <?php else: ?>
                                                          <span class="badge bg-success">Lunas</span>
                                                    <?php endif; ?></p>
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
                                        <?php if($_SESSION["level"] === "2") : ?>
                                          <?php if($pemesanan["metode_bayar"] !== "COD") : ?>
                                          <a href="pembayaran.php?id_pemesanan=<?= $pemesanan["id_pemesanan"]; ?>" class="btn btn-primary">Bayar?</a>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    </div>
                                </div>
                                </div>
                          <a style="text-decoration:none;" href="../proses_hapus.php?aksi=batalPesananAdmin&id_pemesanan=<?= $pemesanan["id_pemesanan"]; ?>" class="badge bg-danger hapusMahasiswa" data-konfirmasi="<?= $pemesanan["id_pemesanan"]; ?>">Batal</a>
                          <?php if($pemesanan["ket"] === "2") : ?>
                            <a style="text-decoration:none;" href="../proses.php?aksi=konfirmasiPesanan&id_pemesanan=<?= $pemesanan["id_pemesanan"]; ?>" class="badge bg-success" onclick="return confirm('Apakah anda yakin ingin mengkonfirmasi pemesanan?')">Konfirmasi</a>
                          <?php endif; ?>
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