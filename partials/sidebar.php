<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/phosphor-icons/css/phosphor.css">
    <!-- Tambahkan link untuk font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>


<body>
    <?php include 'koneksi.php'; ?>

    <?php
    // Mengambil role berdasarkan user_id
    $sql_role = "SELECT role FROM Users WHERE user_id = 1";
    $result_role = $conn->query($sql_role);

    if ($result_role->num_rows > 0) {
        while ($row = $result_role->fetch_assoc()) {
            $role = $row['role'];
        }
    } else {
        $role = "Role tidak ditemukan";
    }

    // Mengambil nama admin dari tabel Users
    $sql_admin = "SELECT name FROM Users WHERE role = 'admin'";
    $result_admin = $conn->query($sql_admin);

    if ($result_admin->num_rows > 0) {
        while ($row = $result_admin->fetch_assoc()) {
            $nama_admin = $row['name'];
        }
    } else {
        $nama_admin = "Admin tidak ditemukan";
    }

    // Menutup koneksi
    $conn->close();
    ?>

    <!-- Struktur HTML -->
    <div class="sidebar">
        <!-- Ikon Phosphor -->
        <div>
            <script src="https://unpkg.com/phosphor-icons"></script>
            <i class="ph-user-circle"></i>
        </div>

        <!-- Menampilkan role -->
        <div class="role">
            <?php echo $role; ?>
        </div>

        <!-- Menampilkan nama admin -->
        <div class="nama-admin">
            <?php echo $nama_admin; ?>
        </div>
        <div class="garis1-sidebar"></div>
        <div class="warning-dikirim">
            Perlu Dikirim Hari Ini
            <i class="ph-warning-circle"></i>
        </div>
        <div class="jumlah-warning">
            <i class="ph-alarm"></i>
            <span class="warning-text">30</span>
            <i class="ph-caret-right"></i>
        </div>
        <div class="garis2-sidebar"></div>
        <div class="transaksibaru">
            <i class="ph-plus-circle"></i>
            <span class="transaksibaru-text">Transaksi Baru</span>
            <i class="ph-caret-right"></i>
        </div>
        <div class="garis3-sidebar"></div>
        <div class="datapelanggan">
            <i class="ph-address-book"></i>
            <span class="datapelanggan-text">Data Pelanggan</span>
            <i class="ph-caret-right"></i>
        </div>
        <div class="garis4-sidebar"></div>
        <div class="historytransksi">
            <i class="ph-book-open"></i>
            <span class="historytransksi-text">History Transksi</span>
            <i class="ph-caret-right"></i>
        </div>
        <div class="garis5-sidebar"></div>
        <div class="laporantransaksi">
            <i class="ph-bank"></i>
            <span class="laporantransaksi-text">Laporan Transaksi</span>
            <i class="ph-caret-right"></i>
        </div>
        <div class="logo-bot">
            <img src="../asset/logo.png" alt="">
        </div>
    </div>

</body>

</html>