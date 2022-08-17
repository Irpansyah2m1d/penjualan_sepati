<?php
$url = $_SERVER['REQUEST_URI'];

$url = explode("/junior_web_developer/Penjualan_sepatu/",$url)[1];

$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
$request_uri = $uri_parts[0];
switch ($request_uri) {
  
  case '/junior_web_developer/Penjualan_sepatu/login.php':
    $title="Login | E-Shoes";
    break;
  case '/junior_web_developer/Penjualan_sepatu/register.php':
    $title="Register | E-Shoes";
    break;
 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css"> -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <!-- <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

</head>
<body class="hold-transition login-page">
