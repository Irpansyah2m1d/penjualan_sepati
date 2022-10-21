<?php 
// mengaktifkan session php
session_start();
 
// menghapus semua session
session_destroy();
// session_unset($_SESSION["level"]);
 
// mengalihkan halaman ke halaman login
header("location: index.php");
?>