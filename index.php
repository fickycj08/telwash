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


// Include file koneksi dan header (pastikan file path benar)
include './partials/header.php';
include 'koneksi.php';

// Proses Registrasi
if (isset($_POST['register'])) {
    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['register-password'], PASSWORD_DEFAULT); // Enkripsi password
    $role = 'kasir'; // Role default untuk registrasi baru

    // Cek apakah email atau nomor telepon sudah ada di database
    $check_query = "SELECT * FROM Users WHERE email='$email'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Email atau nomor telepon sudah digunakan. Silakan gunakan data lain.');</script>";
    } else {
        // Masukkan data baru ke database
        $query = "INSERT INTO Users (name, phone_number, email, password, role) VALUES ('$name', '$phone_number', '$email', '$password', '$role')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Registrasi berhasil. Silakan login.');</script>";
        } else {
            echo "<script>alert('Registrasi gagal. Coba lagi.');</script>";
        }
    }
}

// Proses Login
if (isset($_POST['login'])) {
    $email = $_POST['username'];
    $password = $_POST['password'];

    // Ambil data user dari database berdasarkan email
    $query = "SELECT * FROM Users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Set session untuk user yang berhasil login
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];  // Simpan nama user ke session
            $_SESSION['role'] = $user['role'];
            echo "<script>alert('Login berhasil!'); window.location.href='page/dashboard.php';</script>";
        } else {
            echo "<script>alert('Password salah. Silakan coba lagi.');</script>";
        }
    } else {
        echo "<script>alert('Email tidak ditemukan. Silakan registrasi terlebih dahulu.');</script>";
    }
}

?>



<body>
    <!-- Overlay yang akan muncul saat tombol login diklik -->
    <div class="overlay" id="overlay">
        <!-- Modal yang berisi form login -->
        <div class="modal">
            <button class="close-btn" id="close-btn">&times;</button>

            <!-- Form Login -->
            <div id="login-form" class="form-content">
                <h2 class="account-login">Account Log In</h2>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">Email</label><br>
                        <input type="text" id="username" name="username" class="input-field"
                            placeholder="Masukkan Email Anda" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label><br>
                        <input type="password" id="password" name="password" class="input-field"
                            placeholder="Masukkan Password Anda" required>
                    </div>
                    <!-- Tombol Login -->
                    <button type="submit" name="login" class="login2-button">Login</button>
                </form>

                <!-- Link ke Form Registrasi -->
                <p class="toggle-form">Belum punya akun? <a href="#" id="show-register">Registrasi</a></p>
                </form>
            </div>

            <!-- Form Registrasi (disembunyikan secara default) -->
            <div id="register-form" class="form-content" style="display: none;">
                <h2 class="account-login">Account Registration</h2>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="fullname">Nama Lengkap</label><br>
                        <input type="text" id="fullname" name="fullname" class="input-field"
                            placeholder="Masukkan Nama Lengkap Anda" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label><br>
                        <input type="email" id="email" name="email" class="input-field"
                            placeholder="Masukkan Email Anda" required>
                    </div>
                    <div class="form-group">
                        <label for="register-password">Password</label><br>
                        <input type="password" id="register-password" name="register-password" class="input-field"
                            placeholder="Masukkan Password Anda" required>
                    </div>
                    <!-- Tombol Registrasi -->
                    <button type="submit" name="register" class="login2-button">Registrasi</button>
                </form>
                <!-- Link kembali ke Form Login -->
                <p class="toggle-form">Sudah punya akun? <a href="#" id="show-login">Login</a></p>
                </form>
            </div>

            <!-- Logo -->
            <img class="logo3" src="./asset/logo.png" alt="">
        </div>
    </div>



    <!-- Konten Utama -->
    <div class="landing-bg">
        <h1 class="slogan">I'm Ready To Go To Your <span class="highlight">Wardrobe!</span></h1>
        <a href="#" class="login-button" id="login-btn">
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
        <img class="logo2" src="./asset/logo.png" alt="">
    </div>

</body>
<!-- Tambahkan Script untuk Mengontrol Overlay dan Perpindahan Antar Form -->
<script src="https://unpkg.com/phosphor-icons"></script>
<script>
    // Ambil elemen yang diperlukan
    const loginBtn = document.getElementById('login-btn'); // Tombol untuk membuka modal
    const overlay = document.getElementById('overlay'); // Elemen overlay
    const closeBtn = document.getElementById('close-btn'); // Tombol untuk menutup modal
    const loginForm = document.getElementById('login-form'); // Form Login
    const registerForm = document.getElementById('register-form'); // Form Registrasi
    const showRegisterBtn = document.getElementById('show-register'); // Link untuk membuka form Registrasi
    const showLoginBtn = document.getElementById('show-login'); // Link untuk membuka form Login

    // Fungsi untuk membuka modal
    loginBtn.addEventListener('click', (e) => {
        e.preventDefault(); // Mencegah link default
        overlay.style.display = 'flex'; // Tampilkan overlay
        loginForm.style.display = 'block'; // Tampilkan form login
        registerForm.style.display = 'none'; // Sembunyikan form registrasi
    });

    // Fungsi untuk menutup modal saat tombol close diklik
    closeBtn.addEventListener('click', () => {
        overlay.style.display = 'none'; // Sembunyikan overlay
    });

    // Fungsi untuk menutup modal saat mengklik di luar area modal
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) {
            overlay.style.display = 'none'; // Sembunyikan overlay
        }
    });

    // Fungsi untuk menampilkan form registrasi dan menyembunyikan form login
    showRegisterBtn.addEventListener('click', (e) => {
        e.preventDefault(); // Mencegah link default
        loginForm.style.display = 'none'; // Sembunyikan form login
        registerForm.style.display = 'block'; // Tampilkan form registrasi
    });

    // Fungsi untuk menampilkan form login dan menyembunyikan form registrasi
    showLoginBtn.addEventListener('click', (e) => {
        e.preventDefault(); // Mencegah link default
        registerForm.style.display = 'none'; // Sembunyikan form registrasi
        loginForm.style.display = 'block'; // Tampilkan form login
    });
</script>


</html>