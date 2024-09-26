<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/phosphor-icons/css/phosphor.css">
    <!-- Tambahkan link untuk font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    // Sambungkan header
    include 'partials/header.php';
    ?>

    <div class="content-wrapper">
        <div class="sidebar">
            <?php
            // Sambungkan sidebar
            include 'partials/sidebar.php';
            ?>
        </div>

        <div class="landing-bg">
            <div class="warning-pesanan">
                <button class="bulanini-bt" type="button">Bulan Ini</button>
                <button class="bulanlalu-bt" type="button">Bulan Lalu</button>
                <div class="pesananditerima-dashboard">
                    Pesanan Diterima
                    <i class="ph-warning-circle"></i>
                </div>
                <div class="pesanandiproses-dashboard">
                    Pesanan Diproses
                    <i class="ph-warning-circle"></i>
                </div>
                <div class="pesananselesai-dashboard">
                    Pesanan Selesai
                    <i class="ph-warning-circle"></i>
                </div>
            </div>

        </div>
    </div>
</body>

<script>
    document.querySelector('.bulanini-bt').addEventListener('click', function () {
        alert('Tombol diklik!');
    });
    document.querySelector('.bulanlalu-bt').addEventListener('click', function () {
        alert('Tombol diklik!');
    });
</script>

</html>