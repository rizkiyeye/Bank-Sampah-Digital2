<?php
session_start();
include 'koneksi.php';
$user_id = $_SESSION['user_id'];

$sql = "SELECT SUM(s.berat * h.harga_per_kg) AS total_saldo
        FROM sampah s
        JOIN harga_sampah h ON s.jenis = h.jenis
        WHERE s.user_id = $user_id";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_saldo = $row['total_saldo'] ?? 0;

echo json_encode(['saldo' => $total_saldo]);
?>
