<?php 
include 'koneksi.php';
if(isset($_GET["aksi"])){
    if($_GET["aksi"] === "hapusBarang"){
        $id_barang = $_GET["id_barang"];
        @$data_barang = getData("SELECT * FROM tbl_barang WHERE id_barang = '$id_barang'")[0];
        @$foto = $data_barang["foto"];
            if(file_exists("img/produk/$foto")){
                unlink("img/produk/$foto");
            }
        //  $cek = mysqli_query($conn, "DELETE FROM data_mahasiswa WHERE npm = '$npm'");
         $cek = mysqli_query($conn, "DELETE FROM tbl_barang WHERE id_barang = '$id_barang'");
        if($cek){
            setFlash("Dihapus", "True", "Barang");
            echo '<script>window.location="Admin/data_barang.php";</script>';
        }else{
            setFlash("Dihapus", "False", "Barang");
        }
    }
    else if($_GET["aksi"] === "batalPesanan"){
        $id_pemesanan = $_GET["id_pemesanan"];
      
        //  $cek = mysqli_query($conn, "DELETE FROM data_mahasiswa WHERE npm = '$npm'");
        $cek = mysqli_query($conn, "DELETE FROM tbl_pemesanan WHERE id_pemesanan = '$id_pemesanan'");
        if($cek){
            mysqli_query($conn, "DELETE FROM tbl_barang_user WHERE id_pemesanan = '$id_pemesanan'");
            setFlash("Dibatalkan", "True", "Pemesanan");
            echo '<script>window.location="data_pemesanan_user.php";</script>';
        }else{
            setFlash("Dibatalkan", "False", "Pemesanan");
        }
    }
    else if($_GET["aksi"] === "batalPesananAdmin"){
        $id_pemesanan = $_GET["id_pemesanan"];
      
        //  $cek = mysqli_query($conn, "DELETE FROM data_mahasiswa WHERE npm = '$npm'");
        $cek = mysqli_query($conn, "DELETE FROM tbl_pemesanan WHERE id_pemesanan = '$id_pemesanan'");
        if($cek){
            mysqli_query($conn, "DELETE FROM tbl_barang_user WHERE id_pemesanan = '$id_pemesanan'");
            setFlash("Dibatalkan", "True", "Pemesanan");
            echo '<script>window.location="Admin/data_pemesanan.php";</script>';
        }else{
            setFlash("Dibatalkan", "False", "Pemesanan");
        }
    }
}

?>