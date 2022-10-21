<?php 
session_start();
include '../templates/admin/head.php' ?>
<?php include '../templates/admin/sidebar.php' ?>
<?php 
// include '../koneksi.php';
$data_barang = getData("SELECT * FROM tbl_barang");

// Tambah Data
if(isset($_POST["btn_simpan"])){
  if(tambahBarang($_POST) > 0){
      setFlash("Disimpan", "True", "Barang");
      echo '<script>window.location="data_barang.php";</script>';
    }else{
    setFlash("Disimpan", "False", "Barang");
    echo '<script>window.location="data_barang.php";</script>';
  }
}
// Edit Data
if(isset($_POST["btn_update"])){
  if(editBarang($_POST) > 0){
      setFlash("Diupdate", "True", "Barang");
      echo '<script>window.location="data_barang.php";</script>';
    }else{
    setFlash("Diupdate", "False", "Barang");
    echo '<script>window.location="data_barang.php";</script>';
  }
}

?>

   <!-- Main content -->
    <section class="content">
      <div class="container">
      
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> <b>Data Produk E-Shoes</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahBarang">
                 Tambah Data
               </button>
                
                <table  class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Gambar</th>
                      <th>Nama Barang</th>
                      <th>Deskripsi</th>
                    <th>Warna</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no = 1;
                    foreach($data_barang as $barang) : ?>
                      <tr>
                        <td><?= $no++; ?></td>
                        <td><img src="../img/produk/<?= $barang["gambar"]; ?>" alt="Gambar Produk" width="100"></td>
                        <td><?= $barang["nama"]; ?></td>
                        <td><?= $barang["deskripsi"]; ?></td>
                        <td><?= ucfirst($barang["warna"]); ?></td>
                        <td><?= $barang["harga"]; ?></td>
                        <td>
                          <a style="text-decoration:none;" href="../proses_hapus.php?aksi=hapusBarang&id_barang=<?= $barang["id_barang"]; ?>" class="badge badge-danger hapusMahasiswa" data-konfirmasi="<?= $barang["nama"]; ?>">Hapus</a>
                           <a href="#" class="badge badge-success" data-bs-toggle="modal" data-bs-target="#barang<?= $barang["id_barang"]; ?>">Edit</a>
                              <!-- Modal -->
                            <div class="modal fade" id="barang<?= $barang["id_barang"]; ?>" tabindex="-1" aria-labelledby="editBarangLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="editBarangLabel">Edit Barang</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <form action="" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                      <div class="mb-3">
                                        <label for="nama_barang" class="form-label">Nama Barang</label>
                                        <input type="text" class="form-control" value="<?= $barang["nama"]; ?>" name="nama_barang" id="nama_barang" required>
                                        <input type="hidden" class="form-control" value="<?= $barang["id_barang"]; ?>" name="id_barang" id="id_barang">
                                        <!-- <div id="nama_prestasi" class="form-text">Contoh: Juara 1 Lomba Catur</div> -->
                                      </div>
                                      <div class="mb-3">
                                        <label for="deksripsi_barang" class="form-label">Deskripsi Barang</label>
                                        <textarea name="deskripsi_barang" id="deskripsi_barang" class="form-control" cols="30" rows="3"><?= $barang["deskripsi"]; ?></textarea>
                                      </div>
                                      <div class="mb-3">
                                        <label for="warna_barang" class="form-label">Warna Barang</label>
                                        <select class="form-select" id="warna_barang" name="warna_barang" aria-label="Default select example" required>
                                          <option value="">--Pilih Warna--</option>
                                          <option <?= $barang["warna"] == "merah" ? "selected" : "";  ?> value="merah">Merah</option>
                                          <option <?= $barang["warna"] == "biru" ? "selected" : "";  ?> value="biru">Biru</option>
                                          <option <?= $barang["warna"] == "hitam" ? "selected" : "";  ?> value="hitam">Hitam</option>
                                        </select>
                                      </div>
                                      <div class="mb-3">
                                        <label for="harga_barang" class="form-label">Harga Barang</label>
                                        <input type="number" min="1" value="<?= $barang["harga"]; ?>" class="form-control" name="harga_barang" id="harga_barang" required>
                                      </div>
                                      <div class="mb-3">
                                        <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                                        <input type="number" min="1" value="<?= $barang["jumlah_produk"]; ?>" class="form-control" name="jumlah_barang" id="jumlah_barang" required>
                                      </div>
                                      <div class="mb-3">
                                        <label for="gambar_barang" class="form-label">Gambar Barang</label>
                                        <input type="file" class="form-control" name="gambar" id="gambar_barang">
                                        <input type="hidden" class="form-control" value="<?= $barang["gambar"]; ?>" name="gambarLama" id="gambarLama">
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                      <button type="submit" name="btn_update" class="btn btn-primary">Update</button>
                                    </div>
                                  </div>
                              </form>
                              </div>
                            </div>
                              <a style="text-decoration:none;" href="#" data-bs-toggle="modal" data-bs-target="#id_barang<?= $barang["id_barang"]; ?>" class="badge badge-info">Lihat</a>
                              <div class="modal fade" id="id_barang<?= $barang["id_barang"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detail barang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-6 mb-3">
                                                    <img src="../img/produk/<?= $barang["gambar"]; ?>" width="150" alt="Foto barang">
                                                </div>
                                            </div>
                                            <div class="row">
                                                
                                                <div class="col-lg-6">
                                                    <p><b>Nama :</b> <?= $barang["nama"]; ?></p>
                                                    <p><b>Deskripsi :</b> <?= $barang["deskripsi"]; ?></p>
                                                    <p><b>Warna :</b> <?= $barang["warna"]; ?></p>
                                                    <p><b>Harga :</b> <?= $barang["harga"]; ?></p>
                                                    <p><b>Jumlah Produk :</b> <?= $barang["jumlah_produk"]; ?></p>
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
   <!-- Modal -->
<div class="modal fade" id="tambahBarang" tabindex="-1" aria-labelledby="tambahBarangLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahBarangLabel">Tambah Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" name="nama_barang" id="nama_barang" required>
            <!-- <div id="nama_prestasi" class="form-text">Contoh: Juara 1 Lomba Catur</div> -->
          </div>
          <div class="mb-3">
            <label for="deksripsi_barang" class="form-label">Deskripsi Barang</label>
            <textarea name="deskripsi_barang" id="deskripsi_barang" class="form-control" cols="30" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="warna_barang" class="form-label">Warna Barang</label>
            <select class="form-select" id="warna_barang" name="warna_barang" aria-label="Default select example" required>
              <option value="">--Pilih Warna--</option>
              <option value="merah">Merah</option>
              <option value="biru">Biru</option>
              <option value="hitam">Hitam</option>
            </select>
          </div>
           <div class="mb-3">
            <label for="harga_barang" class="form-label">Harga Barang</label>
            <input type="number" min="1" class="form-control" name="harga_barang" id="harga_barang" required>
          </div>
           <div class="mb-3">
            <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
            <input type="number" min="1" class="form-control" name="jumlah_barang" id="jumlah_barang" required>
          </div>
           <div class="mb-3">
            <label for="gambar_barang" class="form-label">Gambar Barang</label>
            <input type="file" class="form-control" name="gambar" id="gambar_barang" required>
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
  
<?php include '../templates/admin/footer.php' ?>