<?php
session_start(); // Memulai session di bagian paling atas file
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="head">
        <div class="logo-top">
            
        </div>
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Tampilkan tombol Log Out jika user sudah login -->
            <a href="logout.php" class="login-button">
                <div class="login-top">
                    <p>Log Out</p>
                </div>
            </a>
        <?php endif; ?>
    </div>
</body>

</html>
