<?php
require "templates/head_website.php";
?>
<section id="cessgo" class="overlay bg-fixed" >
    <div class="container">
        <div class="section-content" data-aos="fade-up" >
            <div class="row ">
                <div class="col-md-12">
                    <!-- Section Title -->
                    <div class="title-wrap mb-5">
                        <h2>Produk <b>E-Shoes <?= date('Y'); ?></b></h2>
                        <span>Dapatkan promo terbaik spesial Hari Kemerdekaan!!!</span>
                        
                    </div>
                    <!-- End of Section Title -->
                </div>
                <!-- Client Holder -->
                <div class="col-md-12 client-holder">
                    <div class="client-slider owl-carousel">
                        <?php foreach($data_barang_all as $bidang) : ?>
                            <div class="client-item">
                                <img class="img-responsive d-block" src="img/produk/<?= $bidang["gambar"]; ?>" width="100" walt=" ">
								                <p style="font-weight:bold;"><b><?= $bidang["nama"]; ?></b></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- End of Client Holder -->
                </div>
              </div>
              <div class="title-wrap mt-5">
                     <h2>Promo Berakhir Dalam <span class="fw-bold badge bg-danger" id="waktu"></span></h2>
                     <span>Gunakan Kode Voucher : <span class="fw-bold">irpanganteng</span></span>
                 </div>
            </div>
</section>
    
    <div class="container mt-3">
   

      <div class="row">
        <?php foreach($data_barang as $data) : ?>
          <div class="col-md-4 mb-3">
              <div class="card" style="width: 18rem;">
                <img src="img/produk/<?= $data["gambar"]; ?>" class="card-img-top" alt="Sepatu Kulit">
                <div class="card-body">
                  <h5 class="card-title"><?= $data["nama"]; ?></h5>
                  <p class="card-text"><?= $data["deskripsi"]; ?></p>
                  <p class="card-text">
                  <small class="text-muted font-weight-bold">Rp. <?= $data["harga"]; ?></small> 
                  <a class="badge bg-danger ms-3 warna_produk" data-warna="merah">Merah</a>
                  <a class="badge bg-dark warna_produk" data-warna="hitam">Hitam</a>
                  <a class="badge bg-primary warna_produk" data-warna="biru">Biru</a>
                </p> 
                <?php if(!isset($_SESSION[""])) ?>
                  <a href="proses.php?aksi=tambahKeranjang&id_barang=<?= $data["id_barang"]; ?>" data-nama="<?= $data["nama"]; ?>" class="btn btn-success tambahKeranjang"><i class="bi bi-arrow-right-circle-fill"></i> Pesan Sekarang</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
      </div>
        <div class="text-center mt-3">
          <a href="daftar_barang.php" class="btn btn-primary">Selengkapnya</a>
        </div>
  <?php 
  require "templates/footer_website.php";
  ?>
   