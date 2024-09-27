<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing</title>
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<?php
// Include file koneksi dan header
include './partials/header.php';
include 'koneksi.php';
?>

<body>
    <div class="landing-bg">
    <h1 class="slogan">I'm Ready To Go To Your <span class="highlight">Wardrobe!</span></h1>
        <a href="halaman-tujuan.html" class="login-button">
        <div class="login-center">
            <p>Log In</p>
        </div>
        </a>
        <div class="container-landing">
        <i class="ph-handbag"></i>       
        <span class="container-text">Pakaian Diterima</span>
        </div>
        <i class="ph-arrow-fat-line-right"></i>
        <div class="container2-landing">
        <i class="ph-hourglass-high"></i>       
        <span class="container-text">Pakaian Diproses</span>
        </div>
        <i class="ph-arrow-fat-line-right"></i>
        <div class="container3-landing">
        <i class="ph-t-shirt"></i>       
        <span class="container-text">Pakaian Selesai</span>
        </div>
        <img class ="logo2" src="./asset/logo.png" alt="">
    </div>
</body>
<script src="https://unpkg.com/phosphor-icons"></script>
</html>