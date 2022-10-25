<?php 
date_default_timezone_set("Asia/Jakarta");
if(!session_id()) session_start();
$server = "localhost";
$host = "root";
$pass = "";
$db_name = "db_sepatu";

$conn = mysqli_connect($server, $host, $pass, $db_name) or die(mysqli_error($conn));

function getData($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];

    while($data = mysqli_fetch_assoc($result)) {
        $rows[] = $data;
    }

    return $rows;

}


// Function uploadGambar
function uploadGambar($path){
    $namaFile = $_FILES["gambar"]["name"];
    $ukuranFIle = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpName = $_FILES["gambar"]["tmp_name"];

    if($error === 4){
        echo "<script>
            alert('File Belum Di Upload!!');
        </script>";
        return false;
    }

    $ekstensiValid = ["jpeg", "jpg", "png"];
    // foto1.jpg => ["foto1", "jpg"]
    $ekstensiFile = explode(".", $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile)); // jpg

    if(!in_array($ekstensiFile, $ekstensiValid)){
        echo "<script>
            alert('Ekstensi File tidak valid');
        </script>";
        return false;
    }

    if($ukuranFIle > 1000000){
        echo "<script>
            alert('Ukuran File Terlalu Besar');
        </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFile;

    move_uploaded_file($tmpName, $path . $namaFileBaru );

    return $namaFileBaru;

}

function registerasi($data){
		global $conn;
		$nama = $data['nama'];
		$email = $data['email'];
		$username = $data['username'];
        $password1 = $data['password1'];
        $password2 = $data['password2'];
            $data_cek = getData("SELECT * FROM tbl_user WHERE username = '$username'");
            // var_dump($data_cek);
            // die();
            if($data_cek){
                setFlashSistem("Silahkan Coba Lagi!!", "danger", "Username Sudah Ada");
                return;
            }else {
                 @$data = getData("SELECT max(id_user) FROM tbl_user WHERE `level` = '2'")[0];
                
                if($data){
                    $kode = substr($data["max(id_user)"], 3);
                    $kode = intval($kode) + 1;
                    
                    $id_user = "US".str_pad($kode, 4, "0", STR_PAD_LEFT);
                }else {
                    $id_user = "US0001";
                }
                if($password1 !== $password2){
                        setFlashSistem("Tidak Sesuai! Silahkan Coba Lagi", "danger", "Konfirmasi Password");
                        return;
                    }else{
                        // var_dump($id_user);
                        // die();
                        $level = "2";
                        $password = password_hash($password1, PASSWORD_DEFAULT);
                        mysqli_query($conn, "INSERT INTO `tbl_user` VALUES('$id_user', '$nama', '$email', '-', '$username', '$password', '$level')");
                        return mysqli_affected_rows($conn);
                    }
            }
	}

    function changePassword($data){
        global $conn;
        $username = htmlspecialchars($data["username"]);
        $recent_pass = mysqli_escape_string($conn, $data["recent_password"]);
        $pass1 = mysqli_escape_string($conn, $data["password1"]);
        $pass2 = mysqli_escape_string($conn, $data["password2"]);

        $data = getData("SELECT password FROM `tbl_login` WHERE username = '$username'")[0];
        if(password_verify($recent_pass, $data["password"])){
            if($pass1 === $pass2){
                $password = password_hash($pass1, PASSWORD_DEFAULT);
                mysqli_query($conn, "UPDATE `tbl_login` SET password =  '$password' WHERE username = '$username'");
                return mysqli_affected_rows($conn);
            }else{
                infoFlash("Konfirmasi password tidak sesuai!");
                //  echo '<script type="text/javascript">
                //     alert("Konfirmasi password tidak sesuai!");
                //     </script>'; 
                    return false;
            }
        }else {
            infoFlash("Password lama salah!");
            //  echo '<script type="text/javascript">
            //         alert("Password Lama Salah!");
            //         </script>'; 
                    return false;
                    
            }
    }
    // Tambah Barang
    function tambahBarang($data){
        global $conn;
        @$data_barang = getData("SELECT max(id_barang) FROM tbl_barang")[0];
                
                if($data_barang){
                    $kode = substr($data_barang["max(id_barang)"], 3);
                    $kode = intval($kode) + 1;
                    
                    $id_barang = "SPT".str_pad($kode, 4, "0", STR_PAD_LEFT);
                }else {
                    $id_barang = "SPT0001";
                }
        $nama_barang = $data["nama_barang"];
        $deskripsi_barang = $data["deskripsi_barang"];
        $warna_barang = $data["warna_barang"];
        $harga_barang = $data["harga_barang"];
        $jumlah_barang = $data["jumlah_barang"];
        $gambar_barang = uploadGambar("../img/produk/");
        if(!$gambar_barang){
            return false;
        }

        mysqli_query($conn, "INSERT INTO tbl_barang VALUES('$id_barang', '$nama_barang', '$deskripsi_barang', '$warna_barang','$harga_barang', '$gambar_barang', '$jumlah_barang')");
        return mysqli_affected_rows($conn);
    }
    // Edit Barang
    function editBarang($data){
        global $conn;
        $id_barang = $data["id_barang"];
        $nama_barang = $data["nama_barang"];
        $deskripsi_barang = $data["deskripsi_barang"];
        $warna_barang = $data["warna_barang"];
        $harga_barang = $data["harga_barang"];
        $jumlah_barang = $data["jumlah_barang"];
        $gambarLama = $data["gambarLama"];
        if($_FILES["gambar"]["error"] === 4){
            $gambar_barang = $gambarLama;
        }else {
            if(file_exists("img/produk/$gambarLama")){
                unlink("img/produk/$gambarLama");
            }
            $gambar_barang = uploadGambar("../img/produk/");
        }
        
        // if(!$gambar_barang){
        //     return false;
        // }

        mysqli_query($conn, "UPDATE tbl_barang SET nama = '$nama_barang', deskripsi = '$deskripsi_barang', warna = '$warna_barang', harga = '$harga_barang', gambar = '$gambar_barang', jumlah_produk = '$jumlah_barang' WHERE id_barang = '$id_barang'");
        return mysqli_affected_rows($conn);
    }
    // Tambah Pemesanan
    function tambahPemesanan($data){
        global $conn;
        @$data_pemesanan = getData("SELECT max(id_pemesanan) FROM tbl_pemesanan")[0];
                
                if($data_pemesanan){
                    $kode = substr($data_pemesanan["max(id_pemesanan)"], 3);
                    $kode = intval($kode) + 1;
                    
                    $id_pemesanan = "PSN".str_pad($kode, 4, "0", STR_PAD_LEFT);
                }else {
                    $id_pemesanan = "PSN0001";
                }
        $total = $data["total"];
        $id_user = $_SESSION["id_user"];
        $tgl_pemesanan = date("Y-m-d");
        $tgl_pengiriman = $data["tgl_pengiriman"];
        $metode_bayar = $data["metode_bayar"];
        $newKode = $data["kode_pembayaran"];
        if($metode_bayar === "COD"){
            $ket = "1";
            $bukti_pembayaran = "COD";
        }else {
            $ket = "1";
            $bukti_pembayaran = "-";
        }
        foreach($data["data_pesanan"] as $pesanan){
            $id_keranjang = $pesanan[0]["id_keranjang"];
            $nama = $pesanan[0]["nama"];
            $warna = $pesanan[0]["warna"];
            $ukuran = $pesanan[0]["ukuran"];
            $cek = mysqli_query($conn, "INSERT INTO tbl_barang_user VALUES('', '$id_user', '$id_pemesanan', '$nama', '$warna', '$ukuran')");
            if($cek){
                mysqli_query($conn, "DELETE FROM tbl_keranjang WHERE id_keranjang = '$id_keranjang'");
            }
        }
        $qrcode = "qrcode.png";
        mysqli_query($conn, "INSERT INTO tbl_pemesanan VALUES('$id_pemesanan', '$id_user', '$total', '$tgl_pemesanan', '$tgl_pengiriman','$metode_bayar', '$newKode', '$bukti_pembayaran', '$ket', '$qrcode')");
        // if($cek){
        // }

        return mysqli_affected_rows($conn);
    }

 
    function simpanProfile($data){
        // var_dump($data);
        // die();
        global $conn;
        $id_user = $_SESSION["id_user"];
        $nama = $data["nama"];
        $email = $data["email"];
        $alamat = $data["alamat"];
        
        // if($_FILES["gambar"]["error"] == 4){
        //     $galamat;
        // }else {
        //     if($gambarLama != "user.jpg"){
        //         if(file_exists("img/profil/$gambarLama")){
        //             unlink("img/profil/$gambarLama");
        //         }
        //     }
        //     $gambar = uploadGambar("img/profil/");
        // }

        mysqli_query($conn, "UPDATE tbl_user SET nama = '$nama', email = '$email', alamat = '$alamat' WHERE id_user = '$id_user'");
        return mysqli_affected_rows($conn);
    }

     // Fungsi untuk set session yang akan digunakan sweetalert jangan dihapus ya
    function setFlash($aksi, $response, $data){
    $_SESSION["flash"] = [
        "aksi" => $aksi,
        "response" => $response,
        "data" => $data
    ];
}
    function infoFlash($info){
        $_SESSION["info"] = $info;
    }
    
    function info(){
        if(isset($_SESSION["info"])){
            echo '<div id="data-info" data-info="'. $_SESSION["info"] .'"></div>';
           unset($_SESSION["info"]); 
        }
    }
    function flash(){
    if(isset($_SESSION["flash"])){
        // $data = 
        echo '<div id="data-flash" data-flash="'. $_SESSION["flash"]["aksi"].' '.$_SESSION["flash"]["response"] .' '.$_SESSION["flash"]["data"].'"></div>';
        unset($_SESSION["flash"]);
    }
}

 function setFlashSistem($pesan, $alert, $data){
        $_SESSION["message"] = [
            "pesan" => $pesan,
            "alert" => $alert,
            "data" => $data
        ];
    }
    function flashSistem(){
    if(isset($_SESSION["message"])){
        // $data = 
        echo '<div class="alert alert-'. $_SESSION["message"]["alert"] .' alert-dismissible fade show" role="alert">
            <strong>'. $_SESSION["message"]["data"] .'!</strong> '. $_SESSION["message"]["pesan"] .'.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>';
        unset($_SESSION["message"]);
    }
    }

    // Manipulasi Tanggal;
function manipulasiTanggal($tgl,$jumlah=1,$format='days'){
	$currentDate = $tgl;
	return date('Y-m-d', strtotime($jumlah.' '.$format, strtotime($currentDate)));
}

function tanggal_indo($tanggal, $cetak_hari = false)
{
	$hari = array ( 1 =>    'Senin',
				'Selasa',
				'Rabu',
				'Kamis',
				'Jumat',
				'Sabtu',
				'Minggu'
			);
			
	$bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split 	  = explode('-', $tanggal);
	$tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
	
	if ($cetak_hari) {
		$num = date('N', strtotime($tanggal));
		return $hari[$num] . ', ' . $tgl_indo;
	}
	return $tgl_indo;
}



?>