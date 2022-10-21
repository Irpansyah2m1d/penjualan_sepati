<?php
require "templates/head_website.php";
$waktu = $_SESSION["waktu"];
$today = date("Y-m-d");
$tgl_bayar = manipulasiTanggal($today, "$waktu");
$tgl_pengiriman = tanggal_indo($tgl_bayar, true);
// var_dump($tgl_pengiriman);
// die();
if($data_user[0]["alamat"] == "-"){
  echo "<script>
      alert('Silahkan Lengkapi Alamat Anda');
       let cek = confirm('Mau Lengkapi Alamat?');
      if(cek){
        document.location.href = 'profil_web.php';
      }
     
  </script>";
}
$id_keranjang = $_SESSION["id_keranjang"];
// var_dump($_SESSION);
// die();
$total = $_SESSION["total"];
$data_pesanan = [];
foreach($id_keranjang as $id_kj){
  $data_pesanan[] = getData("SELECT * FROM tbl_keranjang WHERE id_keranjang = '$id_kj'");
}

 $kode_pembayaran = mt_rand(1000000000, 9999999999);
  $kode_pembayaran = str_split(strval($kode_pembayaran), 3);
        $kode_user = $_SESSION["id_user"];
        $kode_user = str_split($kode_user, 3 );
        $newKode = "$kode_user[1]";
        foreach($kode_pembayaran as $kode){
        $newKode .= "- $kode ";
        }

if(isset($_POST["btn_pesan"])){
  $_POST["data_pesanan"] = $data_pesanan;
  // var_dump($_POST);
  // die();
  if(tambahPemesanan($_POST) > 0){
    setFlash("Ditambahkan", "True", "Pesanan");
    echo "<script>
      localStorage.removeItem('voucher');
    </script>";
    if($_POST["metode_bayar"] === "COD"){
      $_SESSION["data"] = $_POST;
     echo '<script>window.location="data_pemesanan_user.php";</script>';
    }else {
      $_SESSION["kode_pembayaran"] = $_POST["kode_pembayaran"];
      $_SESSION["data"] = $_POST;
      echo '<script>window.location="pembayaran.php";</script>';
    }
     echo '<script>window.location="data_pemesanan_user.php";</script>';
    }else {
      setFlash("Ditambahkan", "False", "Pesanan");
      echo '<script>window.location="data_pemesanan_user.php";</script>';
  }
}



// var_dump($data_pesanan);
// die();

?>
   <div class="container mt-3 mb-5">
    <div class="row mb-5">
      <div class="col-lg-8 mb-5">
        <h1>Pemesanan Barang Anda</h1>
        <form action="" method="POST">
          <div class="mb-3">
            <label for="nama" class="form-label fw-bold">Nama User</label>
            <input type="text" class="form-control" id="nama" value="<?= @$data_user[0]["nama"]; ?>" name="nama" required readonly >
            <input type="hidden" class="form-control" id="tgl_pemesanan" value="<?= @$today; ?>" name="tgl_pemesanan">
            <input type="hidden" class="form-control" id="tgl_pengiriman" value="<?= @$tgl_bayar; ?>" name="tgl_pengiriman">
            <input type="hidden" class="form-control" id="kode_pembayaran" value="<?= @$newKode; ?>" name="kode_pembayaran">
         </div>
          <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= @$data_user[0]["email"]; ?>" required readonly>
         </div>
          <div class="mb-3">
            <label for="alamat" class="form-label fw-bold">Alamat User</label>
            <input type="text" class="form-control" value="<?= @$data_user[0]["alamat"]; ?>" id="alamat" name="alamat"  required readonly>
         </div>
          <ul class="list-group mb-3 col-lg-7">
            <li class="list-group-item active" aria-current="true">Daftar Pesanan</li>
             <?php 
              $no = 1;
              foreach($data_pesanan as $pesanan ) : ?>
              <li class="list-group-item"><?= $no++; ?>. <?= $pesanan[0]["nama"]; ?>  <span class="ms-5">(Warna: <?= $pesanan[0]["warna"] ?>, Ukuran: <?= $pesanan[0]["ukuran"] ?>)</span></li>
               <?php endforeach; ?>
          </ul>
          <div class="mb-3">
            <label class="form-label fw-bold">Metode Pembayaran</label><br>
             <input class="form-check-input" type="radio" value="Dana" name="metode_bayar" id="dana">
            <label class="form-check-label me-3" for="dana">
              <img src="img/loho-dana.png" alt="Dana" width="50px"> Dana
            </label>
             <input class="form-check-input" type="radio" name="metode_bayar" id="alfamart" value="Alfamart">
            <label class="form-check-label me-3" for="alfamart">
              <img src="img/Logo-Alfamart.png" alt="alfamart" width="50px"> Alfamart
            </label>
             <input class="form-check-input" type="radio" name="metode_bayar" id="indomaret" value="Indomaret">
            <label class="form-check-label me-3" for="indomaret">
              <img src="img/Logo_Indomaret.png" alt="indomaret" width="50px"> Indomaret
            </label>
             <input class="form-check-input" type="radio" name="metode_bayar" id="cod" value="COD">
            <label class="form-check-label me-3" for="cod">
              <img src="img/cod-logo-design.png" alt="cod" width="50px"> COD (Cash On Delivery)
            </label>
           <div class="mb-3 mt-3">
            <label for="tgl_pemesanan" class="form-label fw-bold">Akan Tiba Pada</label>
            <input type="text" class="form-control" value="<?= @$tgl_pengiriman; ?>" id="tgl_pemesanan" name="tgl_pemesanan" readonly>
            </div>
           <div class="mb-3 mt-3">
            <label for="tgl_pemesanan" class="form-label fw-bold">Total Harga</label>
            <input type="text" class="form-control" id="total" value="<?= @$total; ?>" name="total" readonly>
            </div>
           <div class="mb-3">
            <button class="btn btn-success" name="btn_pesan" type="submit">Pesan</button>
            </div>
         </div>
        </form>
      </div>
    </div>
   </div>
  <?php 
  require "templates/footer_website.php";
  ?>
   