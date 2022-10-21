<?php 
include 'koneksi.php';
if(isset($_GET["aksi"])){
    if($_GET["aksi"] === "tambahKeranjang"){
        if(!isset($_SESSION["login"])){
            $_SESSION["belum_login"] = true;
            header("Location: login.php");
            return false;
        }
        $id_user = $_SESSION["id_user"];
        $id_barang = $_GET["id_barang"];
        $jml = $_GET["jml"];
        $ukuran = $_GET["ukuran"];
        $warna = $_GET["warna"];
        $data_barang = getData("SELECT * FROM tbl_barang WHERE id_barang = '$id_barang'");
        $nama = $data_barang[0]["nama"];
        $total = intval($data_barang[0]["harga"])  * intval($jml);
        $cek = mysqli_query($conn, "INSERT INTO tbl_keranjang VALUES('', '$id_barang', '$id_user', '$nama', '$warna', '$ukuran', '$jml', '$total')");
        if($cek){
             setFlash("Ditambahkan", "True", "Barang");
            echo '<script>window.location="index.php";</script>';
        }else{
            setFlash("Ditambahkan", "False", "Barang");
           echo '<script>window.location="index.php";</script>';

        }

    }
}

?>