<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['saldo' => 0]);
    exit;
}

$user_id = $_SESSION['user_id'];

// Hitung total saldo: berat * harga_per_kg
$sql = "SELECT SUM(s.berat * h.harga_per_kg) AS total_saldo
        FROM sampah s
        JOIN harga_sampah h ON s.jenis = h.jenis
        WHERE s.user_id = $user_id";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_saldo = $row['total_saldo'] ?? 0;

// Kembalikan sebagai JSON
echo json_encode(['saldo' => $total_saldo]);
?>
