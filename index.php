<?php
// Include file koneksi dan header
include 'partials/header.php';
include 'koneksi.php';

// Query untuk mengambil jumlah pesanan berdasarkan status
$query_diterima = "SELECT COUNT(*) as jumlah FROM Orders WHERE status = 'diterima'";
$query_diproses = "SELECT COUNT(*) as jumlah FROM Orders WHERE status = 'diproses'";
$query_selesai = "SELECT COUNT(*) as jumlah FROM Orders WHERE status = 'selesai'";

// Ambil nilai ID Transaksi dan status dari parameter GET jika ada
$transaction_id_search = isset($_GET['transaction_id']) ? $_GET['transaction_id'] : '';
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'all'; // Ambil nilai status dari filter

// Eksekusi query untuk mendapatkan jumlah pesanan berdasarkan status
$result_diterima = $conn->query($query_diterima);
$result_diproses = $conn->query($query_diproses);
$result_selesai = $conn->query($query_selesai);

$pesanan_diterima = $result_diterima->fetch_assoc()['jumlah'];
$pesanan_diproses = $result_diproses->fetch_assoc()['jumlah'];
$pesanan_selesai = $result_selesai->fetch_assoc()['jumlah'];

// Query untuk mengambil data transaksi dari database dengan filter jika ada
$sql = "SELECT Orders.status, Customers.name AS customer_name, Customers.phone_number, 
        Transactions.weight, Transactions.price, Transactions.finished_at, Transactions.received_at, Transactions.transaction_id 
        FROM Orders 
        INNER JOIN Transactions ON Orders.transaction_id = Transactions.transaction_id
        INNER JOIN Customers ON Transactions.customer_id = Customers.customer_id";

$conditions = [];

if (!empty($transaction_id_search)) {
    $conditions[] = "Transactions.transaction_id = '$transaction_id_search'";
}

if ($status_filter != 'all') {
    $conditions[] = "Orders.status = '$status_filter'";
}

// Gabungkan kondisi jika ada filter
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/phosphor-icons/css/phosphor.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>

    <div class="content-wrapper">
        <div class="sidebar">
            <?php include 'partials/sidebar.php'; ?>
        </div>

        <div class="landing-bg">
            <div class="warning-pesanan">
                <button class="bulanini-bt" type="button">Bulan Ini</button>
                <button class="bulanlalu-bt" type="button">Bulan Lalu</button>
                <div class="pengingat-dashboard">
                    <div class="pengingatditerima-dashboard">
                        Pesanan Diterima <i class="ph-info"></i>
                    </div>
                    <div class="pengingatditerima-dashboard-jumlah">
                        <i class="ph-check-circle"></i><?php echo $pesanan_diterima; ?>
                    </div>
                    <div class="pengingatdiproses-dashboard">
                        Pesanan Diproses <i class="ph-info"></i>
                    </div>
                    <div class="pengingatdiproses-dashboard-jumlah">
                        <i class="ph-check-circle"></i><?php echo $pesanan_diproses; ?>
                    </div>
                    <div class="pengingatselesais-dashboard">
                        Pesanan Selesai <i class="ph-info"></i>
                    </div>
                    <div class="pengingatselesais-dashboard-jumlah">
                        <i class="ph-check-circle"></i><?php echo $pesanan_selesai; ?>
                    </div>
                </div>
            </div>
            <div class="searchbar">
                <form method="GET" action="">
                    <i class="ph-magnifying-glass"></i>
                    <input type="search" name="transaction_id" class="searchbar-input" placeholder="ID Transaksi"
                        value="<?php echo $transaction_id_search; ?>">
                </form>
            </div>

            <!-- Form Filter Status Pesanan -->
            <div class="filter">
                <form method="GET" action="">
                    <!-- Include input hidden untuk mempertahankan nilai ID Transaksi di filter -->
                    <input type="hidden" name="transaction_id" value="<?php echo $transaction_id_search; ?>">
                    <label for="statusFilter"></label>
                    <select id="statusFilter" name="status" class="filter-select" onchange="this.form.submit()">
                        <option value="all" <?php if ($status_filter == 'all')
                            echo 'selected'; ?>>Semua Status</option>
                        <option value="diterima" <?php if ($status_filter == 'diterima')
                            echo 'selected'; ?>>Pesanan
                            Diterima</option>
                        <option value="diproses" <?php if ($status_filter == 'diproses')
                            echo 'selected'; ?>>Pesanan
                            Diproses</option>
                        <option value="selesai" <?php if ($status_filter == 'selesai')
                            echo 'selected'; ?>>Pesanan Selesai
                        </option>
                        <option value="diambil" <?php if ($status_filter == 'diambil')
                            echo 'selected'; ?>>Pesanan Diambil
                        </option>
                    </select>
                </form>
            </div>

            <div class="table-container">
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Nama Pelanggan</th>
                            <th>No Telepon</th>
                            <th>Berat (Kg)</th>
                            <th>Harga (Rp)</th>
                            <th>Waktu Selesai</th>
                            <th>Tanggal Diterima</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Cek apakah hasil query ada data atau tidak
                        if ($result->num_rows > 0) {
                            // Looping melalui setiap baris hasil query
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['status'] . "</td>";
                                echo "<td>" . $row['customer_name'] . "</td>";
                                echo "<td>" . $row['phone_number'] . "</td>";
                                echo "<td>" . $row['weight'] . "</td>";
                                echo "<td>" . number_format($row['price'], 0, ',', '.') . "</td>"; // Format harga
                                echo "<td>" . $row['finished_at'] . "</td>";
                                echo "<td>" . $row['received_at'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>Tidak ada data pesanan</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>

</html>
<script src="js/app.js"></script>
