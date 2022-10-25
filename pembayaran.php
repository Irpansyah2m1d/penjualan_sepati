<?php

require "templates/head_website.php";

// var_dump($_SESSION);
// die();
$id_keranjang = $_SESSION["id_keranjang"];
$data_pesanan = [];
foreach($id_keranjang as $id_kj){
  $data_pesanan[] = getData("SELECT * FROM tbl_keranjang WHERE id_keranjang = '$id_kj'");
}

$newKode = $_SESSION["kode_pembayaran"];

if(isset($_GET["id_pemesanan"])){
  $id_pemesanan = $_GET["id_pemesanan"];
  $pemesanan = getData("SELECT * FROM tbl_pemesanan WHERE id_pemesanan = '$id_pemesanan'")[0];
  $newKode = $pemesanan["kode_pembayaran"];
}

if(isset($_POST["btn_bukti"])){
  // var_dump($_FILES["gambar"]);
  // die();
  $gambar = uploadGambar("img/bukti_pembayaran/");
  $id_pemesanan = $_POST["id_pemesanan"];
  $cek = mysqli_query($conn, "UPDATE tbl_pemesanan SET bukti_pembayaran = '$gambar', ket = '2' WHERE id_pemesanan = '$id_pemesanan'");
  if($cek){
     setFlash("Diupload", "True", "Bukti_Pembayaran");
     echo '<script>window.location="data_pemesanan_user.php";</script>';
    }else {
      setFlash("Diupload", "False", "Bukti_Pembayaran");
      echo '<script>window.location="data_pemesanan_user.php";</script>';
  }
}



// var_dump($data_pesanan);
// die();

?>
   <div class="container mt-3 mb-5" >
    <div class="row mb-5">
      <div class="col-lg-10 mb-5">
        <?php if(isset($_SESSION["data"])) : ?>
            <?php if($_SESSION["data"]["metode_bayar"] === "Dana") : ?>
              <h1>Cara Melakukan Pembayaran Via <span class="fw-bold"> Dana <img src="img/loho-dana.png" alt="Dana" width="50px"> </span></h1>
              
              <ol>
                <li>Silahkan Buka Aplikasi Dana yang ada di smartphone Anda</li>
                <li>Pilih Menu Kirim Uang</li>
                <li>Masukan No HP tujuan: <span class="fw-bold"><b>0823-7622-7823</b></span> </li>
                <li>Masukan Jumlah Uang Sesuai Dengan Pesanan</li>
                <li>Konfirmasi Pembayaran Dengan Memasukan PIN Dana Anda</li>
                <li>Jangan lupa Screnshoot Bukti Pembayaran</li>
                <li>Silahkan Upload Bukti Pembayaran Di Bawah Ini</li>
              </ol>
              <?php elseif($_SESSION["data"]["metode_bayar"] === "Alfamart") : ?>
                <h1>Cara Melakukan Pembayaran Via <span class="fw-bold">Alfamart <img src="img/Logo-Alfamart.png" alt="Alfamart" width="50px"></span></h1>
                <ol>
                  <li>Silahkan Datang ke Alfamart Terdekat Dengan Membawa Kode Pembayaran</li>
                  <li>Silahkan Tunjukan Kepada Kasir Alfamart</li>
                  <li>Lakuan Pembayaran</li>
                  <li>Minta Bukti Transaksi</li>
                  <li>Foto Bukti Transaksi</li>
                  <li>Silahkan Upload Bukti Pembayaran Di Bawah Ini</li>
                </ol>
                <div class="mb-3 col-lg-6 text-center">
                    <label class="form-label fw-bold">Kode Pembayaran</label>
                    <!-- <input type="text" class="form-control" id="kode_bayar" value=""  name="kode_bayar" readonly> -->
                    <p style="background-color: silver; color:red; font-weight:bold; padding: 10px; font-size:25px;" class="fw-bold"><?= $newKode; ?></p>
                </div>
              <?php elseif($_SESSION["data"]["metode_bayar"] === "Indomaret") : ?>
                  <h1>Cara Melakukan Pembayaran Via <span class="fw-bold">Indomaret <img src="img/Logo_Indomaret.png" alt="Indomaret" width="50px"></span></h1>
                  <ol>
                    <li>Silahkan Datang ke Indomaret Terdekat Dengan Membawa Kode Pembayaran</li>
                  <li>Silahkan Tunjukan Kepada Kasir Indomaret</li>
                  <li>Lakuan Pembayaran</li>
                  <li>Minta Bukti Transaksi</li>
                  <li>Foto Bukti Transaksi</li>
                  <li>Silahkan Upload Bukti Pembayaran Di Bawah Ini</li>
                  </ol>
                   <div class="mb-3 col-lg-6 text-center">
                    <label class="form-label fw-bold">Kode Pembayaran</label>
                    <!-- <input type="text" class="form-control" id="kode_bayar" value=""  name="kode_bayar" readonly> -->
                    <p style="background-color: silver; color:red; font-weight:bold; padding: 10px; font-size:25px;" class="fw-bold"><?= $newKode; ?></p>
                </div>
            <?php endif; ?>
          <?php endif; ?>
          
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="mb-3 col-lg-6">
            <label for="gambar" class="form-label fw-bold">Upload Bukti Pembayaran</label>
            <input type="hidden" class="form-control" id="id_pemesanan"  name="id_pemesanan" value="<?= $id_pemesanan; ?>">
            <input type="file" class="form-control" id="gambar" name="gambar" required>
         </div>
           <div class="mb-3">
            <button class="btn btn-success" name="btn_bukti" type="submit">Upload</button>
            </div>
         </div>
        </form>
      </div>
    </div>
   </div>
  <?php 
  require "templates/footer_website.php";
  ?>
   