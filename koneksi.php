<?php 
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
		$username = $data['username'];
        $password1 = $data['password1'];
        $password2 = $data['password2'];
        $npm = $data["npm"];
        $level = $data["jenis"];
        if($level == "1"){
            $data_cek = getData("SELECT * FROM data_mahasiswa WHERE npm = '$npm'");
            // var_dump($data_cek);
            // die();
            if(empty($data_cek)){
                setFlashSistem("Di UKM / Ormawa!", "danger", "Anda Belum Terdaftar");
                return;
            }else{
                @$data = getData("SELECT max(id_user) FROM tbl_login WHERE `level` = '1'")[0];
                
                if($data){
                    $kode = substr($data["max(id_user)"], 3);
                    $kode = $kode + 1;
                    
                    $id_user = "US".str_pad($kode, 4, "0", STR_PAD_LEFT);
                }else {
                    $id_user = "US0001";
                }
            }
        }else{
            $data_dosen = getData("SELECT * FROM data_dosen WHERE nidn = '$npm'");
            // var_dump($data_dosen);
            // die();
            if(empty($data_dosen)){
                setFlashSistem("Bapak / Ibu Belum Terdaftar Di Aplikasi", "danger", "Mohon Maaf");
                return;
            }else{
                $id_user = $data_dosen[0]["id_dosen"];
                }
            }
        @$cekUsername = getData("SELECT npm FROM `tbl_login` WHERE npm = '$npm'");
        if(@$cekUsername){
                setFlashSistem("Sudah Terdaftar", "danger", "Akun Anda");
                return; 
        }else{
            if($password1 !== $password2){
                setFlashSistem("Tidak Sesuai! Silahkan Coba Lagi", "danger", "Konfirmasi Password");
                return;
            }else{
                // var_dump($id_user);
                // die();
                $password = password_hash($password1, PASSWORD_DEFAULT);
                mysqli_query($conn, "INSERT INTO `tbl_login` VALUES('$id_user', '$npm', '$username', '$password', '$level', 1)");
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

    // Tambah UKM
    function tambahUKM($data){
        // var_dump($data);
        // die();
        global $conn;
        $nama_ukm = $data["nama_ukm"];
        $deskripsi_ukm = $data["deskripsi_ukm"];
        $website_ukm = $data["website_ukm"];
        $foto_ukm = uploadGambar("../img/foto_ukm/");
        if(!$foto_ukm){
            return false;
        }

        mysqli_query($conn, "INSERT INTO data_ukm VALUES('', '$nama_ukm', '$deskripsi_ukm', '$website_ukm', '$foto_ukm')");
        return mysqli_affected_rows($conn);
    }
    // Edit UKM
    function editUKM($data){
        // var_dump($data);
        // die();
        global $conn;
        $id_ukm = $data["id_ukm"];
        $nama_ukm = $data["nama_ukm"];
        $deskripsi_ukm = $data["deskripsi_ukm"];
        $website_ukm = $data["website_ukm"];
        $gambarLama = $data["gambarLama"];
        if($_FILES["gambar"]["error"] === 4){
            $foto_ukm = $gambarLama;
        }else {
            $foto_ukm = uploadGambar("../img/foto_ukm/");
            if(!$foto_ukm){
                return false;
            }
            if(file_exists("../img/foto_ukm/$gambarLama")){
                unlink("../img/foto_ukm/$gambarLama");
            }  
        }

        mysqli_query($conn, "UPDATE data_ukm SET nama_ukm = '$nama_ukm', deskripsi_ukm = '$deskripsi_ukm', website_ukm = '$website_ukm', foto_ukm = '$foto_ukm' WHERE id_ukm = '$id_ukm'");
        return mysqli_affected_rows($conn);
    }
    // Tambah Prestasi
    function tambahPrestasi($data){
        global $conn;
        $nama_prestasi = $data["nama_prestasi"];
        $tingkat_prestasi = $data["tingkat_prestasi"];
        $jenis_prestasi = $data["jenis_prestasi"];
        $bukti_prestasi = uploadGambar("../img/bukti_prestasi/");
        if(!$bukti_prestasi){
            return false;
        }
        $npm = $_SESSION["npm"];

        mysqli_query($conn, "INSERT INTO data_mahasiswa_prestasi VALUES('', '$npm', '$nama_prestasi', '$tingkat_prestasi', '$jenis_prestasi', '$bukti_prestasi')");
        return mysqli_affected_rows($conn);
    }
    // Edit Prestasi
    function editPrestasi($data){
        global $conn;
        $nama_prestasi = $data["nama_prestasi"];
        $tingkat_prestasi = $data["tingkat_prestasi"];
        $jenis_prestasi = $data["jenis_prestasi"];
        $bukti_lama = $data["gambar_lama"];
        $id = $data["id_prestasi"];
        if($_FILES["gambar"]["error"] === 4){
            $bukti_prestasi = $bukti_lama;
        }else {
            $bukti_prestasi = uploadGambar("../img/bukti_prestasi/");
            if(!$bukti_prestasi){
                return false;
            }
            if(file_exists("../img/bukti_prestasi/$bukti_lama")){
                unlink("../img/bukti_prestasi/$bukti_lama");
            }  
        }
        $npm = $_SESSION["npm"];

        mysqli_query($conn, "UPDATE data_mahasiswa_prestasi SET npm = '$npm', nama_prestasi = '$nama_prestasi', tingkat = '$tingkat_prestasi', jenis = '$jenis_prestasi', dokumentasi = '$bukti_prestasi' WHERE id = '$id'");
        return mysqli_affected_rows($conn);
    }

    function simpanProfile($data){
        global $conn;
        $npm = $data["npm"];
        $nama = $data["nama"];
        $asal_daerah = $data["asal_daerah"];
        $prodi = $data["prodi"];
        $kelas = $data["kelas"];
        $semester = $data["semester"];
        $akt = $data["akt"];
        $alamat = $data["alamat"];
        $hp = $data["hp"];
        $email = $data["email"];
        $gambarLama = $data["gambar_lama"];
        // $id_ukm = $data["id"];

        $ukm_mahasiswa = $data["ukm_mahasiswa"];
        $cek_ukm = getData("SELECT * FROM data_mahasiswa_ukm WHERE npm = '$npm'");
        // var_dump($cek_ukm);
        // die();
        if(empty($cek_ukm)){
            foreach($ukm_mahasiswa as $ukm){
                mysqli_query($conn, "INSERT INTO data_mahasiswa_ukm VALUES('', '$npm', '$ukm')");
            }
        }else{
            mysqli_query($conn, "DELETE FROM data_mahasiswa_ukm WHERE npm = '$npm'");
            foreach($ukm_mahasiswa as $ukm){
                mysqli_query($conn, "INSERT INTO data_mahasiswa_ukm VALUES('', '$npm', '$ukm')");
            }
            // $no = 0;
            // foreach($ukm_mahasiswa as $ukm){
            //     $id = $id_ukm[$no];
            //         mysqli_query($conn, "UPDATE data_mahasiswa_ukm SET npm = '$npm', nama_ukm = '$ukm' WHERE id = '$id'");
            //     $no++;
            // }
        }
        
        if($_FILES["gambar"]["error"] == 4){
            $gambar = $gambarLama;
        }else {
            if($gambarLama != "user.jpg"){
                if(file_exists("../img/profil/$gambarLama")){
                    unlink("../img/profil/$gambarLama");
                }
            }
            $gambar = uploadGambar("../img/profil/");
        }

        $cek = mysqli_query($conn, "UPDATE data_mahasiswa SET nama = '$nama', email = '$email', 
        hp = '$hp', prodi = '$prodi', kelas = '$kelas', semester = '$semester', akt = '$akt', asal_daerah = '$asal_daerah', alamat = '$alamat', foto = '$gambar' WHERE npm = '$npm'");
        if($cek){
            return 1;
        }else{
            return 0;
        }
    }
    function simpanProfileDosen($data){
        // var_dump($data);
        // die();
        global $conn;
        $nidn = $data["nidn"];
        $nama_dosen = $data["nama_dosen"];
        $hp_dosen = $data["hp_dosen"];
        $gambarLama = $data["gambar_lama"];
        
        if($_FILES["gambar"]["error"] == 4){
            $gambar = $gambarLama;
        }else {
            if($gambarLama != "user.jpg"){
                if(file_exists("img/profil/$gambarLama")){
                    unlink("img/profil/$gambarLama");
                }
            }
            $gambar = uploadGambar("img/profil/");
        }

        mysqli_query($conn, "UPDATE data_dosen SET nama_dosen = '$nama_dosen', hp = '$hp_dosen', foto = '$gambar' WHERE nidn = '$nidn'");
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



?>