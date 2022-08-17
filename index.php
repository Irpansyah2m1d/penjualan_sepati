<?php
require "templates/head_website.php";
?>
      <div class="row">
        <?php foreach($data_barang as $data) : ?>
          <div class="col-md-4 mb-3">
              <div class="card" style="width: 18rem;">
                <img src="img/kulit1.jpg" class="card-img-top" alt="Sepatu Kulit">
                <div class="card-body">
                  <h5 class="card-title"><?= $data["nama"]; ?></h5>
                  <p class="card-text"><?= $data["deskripsi"]; ?></p>
                  <p class="card-text">
                  <small class="text-muted font-weight-bold">Rp. <?= $data["harga"]; ?></small> 
                  <a href="" class="badge badge-danger">Merah</a>
                  <a href="" class="badge badge-dark">Hitam</a>
                  <a href="" class="badge badge-primary">Biru</a>
                </p> 
                  <a href="#" class="btn btn-success"><i class="bi bi-arrow-right-circle-fill"></i> Pesan Sekarang</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
      </div>
  <?php 
  require "templates/footer_website.php";
  ?>
   