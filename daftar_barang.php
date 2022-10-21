<?php
require "templates/head_website.php";
?>
   <div class="container mt-3">

            <div class="row">
        <?php foreach($data_barang_all as $data) : ?>
          <div class="col-md-4 mb-3">
              <div class="card" style="width: 18rem;">
                <img src="img/produk/<?= $data["gambar"]; ?>" class="card-img-top" alt="Sepatu Kulit">
                <div class="card-body">
                  <h5 class="card-title"><?= $data["nama"]; ?></h5>
                  <p class="card-text"><?= $data["deskripsi"]; ?></p>
                  <p class="card-text">
                  <small class="text-muted font-weight-bold">Rp. <?= $data["harga"]; ?></small> 
                  <a class="badge bg-danger ms-3 warna_produk" data-warna="Merah">Merah</a>
                  <a class="badge bg-dark warna_produk active-produk" data-warna="Hitam">Hitam</a>
                  <a class="badge bg-primary warna_produk" data-warna="Biru">Biru</a>
                </p> 
                  <a href="proses.php?aksi=tambahKeranjang&id_barang=<?= $data["id_barang"]; ?>" data-nama="<?= $data["nama"]; ?>" class="btn btn-success tambahKeranjang"><i class="bi bi-arrow-right-circle-fill"></i> Pesan Sekarang</a>
                  </div>
              </div>
            </div>
          <?php endforeach; ?>
      </div>
  <?php 
  require "templates/footer_website.php";
  ?>
   