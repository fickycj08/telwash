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
   <?php
// Mulai session
session_start();

// Cek apakah pengguna sudah login
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Ambil nama pengguna dari database berdasarkan user_id
    $sql_user = "SELECT name, role FROM Users WHERE user_id = $user_id";
    $result_user = $conn->query($sql_user);

    if ($result_user->num_rows > 0) {
        $user_data = $result_user->fetch_assoc();
        $nama_user = $user_data['name'];  // Nama pengguna yang sedang login
        $role_user = $user_data['role'];  // Role pengguna yang sedang login
    } else {
        $nama_user = "Nama tidak ditemukan";
        $role_user = "Role tidak ditemukan";
    }
} else {
    // Redirect ke halaman login jika belum login
    header("Location: ../index.php");
    exit();
}
?>

<!-- Struktur HTML -->
<div class="sidebar">
    <!-- Ikon Phosphor -->
    <div>
        <script src="https://unpkg.com/phosphor-icons"></script>
        <i class="ph-user-circle"></i>
    </div>
    <!-- Menampilkan role pengguna yang sedang login -->
    <div class="role">
        <?php echo $role_user; ?>
    </div>
    <!-- Menampilkan nama pengguna yang sedang login -->
    <div class="nama-admin">
        <?php echo $nama_user; ?>
    </div>



        <a href="halaman-tujuan.html" class="warning-button">
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
        </a>

        <div class="garis2-sidebar"></div>
        <a href="halaman-transaksi-baru.html" class="transaksibaru-button">
            <div class="transaksibaru">
                <i class="ph-plus-circle"></i>
                <span class="transaksibaru-text">Transaksi Baru</span>
                <i class="ph-caret-right"></i>
            </div>
        </a>

        <div class="garis3-sidebar"></div>
        <a href="halaman-data-pelanggan.html" class="datapelanggan-button">
            <div class="datapelanggan">
                <i class="ph-address-book"></i>
                <span class="datapelanggan-text">Data Pelanggan</span>
                <i class="ph-caret-right"></i>
            </div>
        </a>

        <div class="garis4-sidebar"></div>
        <a href="halaman-data-pelanggan.html" class="historytransksi-button">
            <div class="historytransksi">
                <i class="ph-book-open"></i>
                <span class="historytransksi-text">History Transksi</span>
                <i class="ph-caret-right"></i>
            </div>
        </a>
        <div class="garis5-sidebar"></div>
        <a href="halaman-data-pelanggan.html" class="laporantransaksi-button">
            <div class="laporantransaksi">
                <i class="ph-bank"></i>
                <span class="laporantransaksi-text">Laporan Transaksi</span>
                <i class="ph-caret-right"></i>
            </div>
        </a>
        <div class="logo-bot">
            <img src="../asset/logo.png" alt="">
        </div>
    </div>

</body>

</html>