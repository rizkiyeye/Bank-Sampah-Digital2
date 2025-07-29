<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "bank_sampah2");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Update status jika ada request
if (isset($_GET['confirm_id'])) {
    $id = intval($_GET['confirm_id']);
    $conn->query("UPDATE pickup_requests SET status = 'confirmed' WHERE id = $id");
}

// Ambil semua pickup pending
$result = $conn->query("SELECT * FROM pickup_requests WHERE status = 'pending'");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Konfirmasi Penjemputan Sampah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    :root {
        --primary: #4CAF50;
        --primary-hover: #45a049;
        --secondary: #f0f7f0;
        --danger: #f44336;
        --warning: #ff9800;
        --info: #2196F3;
        --dark: #333;
        --light: #f5f5f5;
        --gray: #ddd;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background-color: #f9f9f9;
        color: var(--dark);
        padding: 20px;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    header {
        background-color: var(--primary);
        color: white;
        padding: 20px;
        text-align: center;
    }

    h1 {
        font-size: 24px;
        margin-bottom: 5px;
    }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background-color: white;
        border-bottom: 1px solid var(--gray);
    }

    .admin-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .admin-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--secondary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-weight: bold;
    }

    .logout-btn {
        background-color: var(--danger);
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .logout-btn:hover {
        background-color: #e53935;
    }

    .dashboard-title {
        padding: 20px;
        border-bottom: 1px solid var(--gray);
    }

    .dashboard-title h2 {
        color: var(--primary);
        margin-bottom: 10px;
    }

    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
        padding: 20px;
    }

    .stat-card {
        background-color: white;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        text-align: center;
        transition: transform 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-card i {
        font-size: 30px;
        margin-bottom: 10px;
    }

    .stat-card h3 {
        font-size: 14px;
        color: #666;
        margin-bottom: 10px;
    }

    .stat-card .count {
        font-size: 24px;
        font-weight: bold;
    }

    .pending-card {
        border-top: 4px solid var(--warning);
    }

    .pending-card i {
        color: var(--warning);
    }

    .confirmed-card {
        border-top: 4px solid var(--info);
    }

    .confirmed-card i {
        color: var(--info);
    }

    .completed-card {
        border-top: 4px solid var(--primary);
    }

    .completed-card i {
        color: var(--primary);
    }

    .cancelled-card {
        border-top: 4px solid var(--danger);
    }

    .cancelled-card i {
        color: var(--danger);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    th,
    td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid var(--gray);
    }

    th {
        background-color: var(--secondary);
        color: var(--primary);
        font-weight: 600;
    }

    tr:hover {
        background-color: rgba(76, 175, 80, 0.05);
    }

    .status {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-pending {
        background-color: #fff8e1;
        color: #ff8f00;
    }

    .status-confirmed {
        background-color: #e1f5fe;
        color: #0288d1;
    }

    .btn {
        padding: 6px 12px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-confirm {
        background-color: var(--info);
        color: white;
    }

    .btn-confirm:hover {
        background-color: #1976d2;
    }

    .waste-icon {
        font-size: 20px;
        margin-right: 5px;
    }

    .organic {
        color: #8bc34a;
    }

    .inorganic {
        color: #ffc107;
    }

    .b3 {
        color: #f44336;
    }

    .electronic {
        color: #2196f3;
    }

    .no-data {
        text-align: center;
        padding: 40px;
        color: #666;
    }

    .no-data i {
        font-size: 50px;
        margin-bottom: 20px;
        color: var(--gray);
    }

    @media (max-width: 768px) {
        .stats-cards {
            grid-template-columns: 1fr 1fr;
        }

        table {
            display: block;
            overflow-x: auto;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-trash-alt"></i> Admin Bank Sampah</h1>
            <p>Manajemen Penjemputan Sampah</p>
        </header>

        <div class="admin-header">
            <div class="admin-info">
                <div class="admin-avatar">A</div>
                <div>
                    <div>Admin</div>
                    <small>Administrator</small>
                </div>
            </div>
            <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </div>

        <div class="dashboard-title">
            <h2><i class="fas fa-calendar-check"></i> Konfirmasi Penjemputan</h2>
            <p>Daftar permintaan penjemputan sampah yang menunggu konfirmasi</p>
        </div>

        <div class="stats-cards">
            <div class="stat-card pending-card">
                <i class="fas fa-clock"></i>
                <h3>Menunggu Konfirmasi</h3>
                <div class="count">
                    <?php 
                        $count = $conn->query("SELECT COUNT(*) FROM pickup_requests WHERE status = 'pending'")->fetch_row()[0];
                        echo $count;
                    ?>
                </div>
            </div>

            <div class="stat-card confirmed-card">
                <i class="fas fa-check-circle"></i>
                <h3>Terkonfirmasi</h3>
                <div class="count">
                    <?php 
                        $count = $conn->query("SELECT COUNT(*) FROM pickup_requests WHERE status = 'confirmed'")->fetch_row()[0];
                        echo $count;
                    ?>
                </div>
            </div>

            <div class="stat-card completed-card">
                <i class="fas fa-check-double"></i>
                <h3>Selesai</h3>
                <div class="count">
                    <?php 
                        $count = $conn->query("SELECT COUNT(*) FROM pickup_requests WHERE status = 'completed'")->fetch_row()[0];
                        echo $count;
                    ?>
                </div>
            </div>

            <div class="stat-card cancelled-card">
                <i class="fas fa-times-circle"></i>
                <h3>Dibatalkan</h3>
                <div class="count">
                    <?php 
                        $count = $conn->query("SELECT COUNT(*) FROM pickup_requests WHERE status = 'cancelled'")->fetch_row()[0];
                        echo $count;
                    ?>
                </div>
            </div>
        </div>

        <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jenis Sampah</th>
                    <th>Tanggal & Waktu</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>#<?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['full_name']) ?></td>
                    <td>
                        <?php 
                                    $icon = '';
                                    $class = '';
                                    switch($row['waste_type']) {
                                        case 'organik':
                                            $icon = 'fas fa-leaf';
                                            $class = 'organic';
                                            break;
                                        case 'anorganik':
                                            $icon = 'fas fa-recycle';
                                            $class = 'inorganic';
                                            break;
                                        case 'b3':
                                            $icon = 'fas fa-biohazard';
                                            $class = 'b3';
                                            break;
                                        case 'elektronik':
                                            $icon = 'fas fa-laptop';
                                            $class = 'electronic';
                                            break;
                                    }
                                ?>
                        <i class="waste-icon <?= $icon ?> <?= $class ?>"></i>
                        <?= ucfirst($row['waste_type']) ?>
                    </td>
                    <td>
                        <?= date('d M Y', strtotime($row['pickup_date'])) ?>
                        <br>
                        <small><?= $row['pickup_time'] ?></small>
                    </td>
                    <td>
                        <span class="status status-pending">
                            <i class="fas fa-clock"></i> Menunggu
                        </span>
                    </td>
                    <td>
                        <a href="?confirm_id=<?= $row['id'] ?>" class="btn btn-confirm"
                            onclick="return confirm('Konfirmasi penjemputan ini?')">
                            <i class="fas fa-check"></i> Konfirmasi
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="no-data">
            <i class="fas fa-check-circle"></i>
            <h3>Tidak ada permintaan penjemputan yang menunggu</h3>
            <p>Semua permintaan penjemputan telah diproses</p>
        </div>
        <?php endif; ?>
    </div>
    <?php while ($row = $result->fetch_assoc()) : ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['full_name'] ?></td>
        <td><?= $row['waste_type'] ?></td>
        <td><?= $row['pickup_date'] ?> <?= $row['pickup_time'] ?></td>
        <td><?= $row['status'] ?></td>
        <td><a href="?confirm_id=<?= $row['id'] ?>"
                onclick="return confirm('Yakin konfirmasi penjemputan ini?')">Konfirmasi</a></td>
    </tr>
    <?php endwhile; ?>
    </table>