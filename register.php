<?php
// backend/simpan_user.php - Registrasi user baru
session_start();
require_once 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $telepon = trim($_POST['telepon']);
    $alamat = trim($_POST['alamat']);
    $password = $_POST['password'];
    
    // Validasi input
    if (empty($username) || empty($email) || empty($nama_lengkap) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Semua field wajib diisi']);
        exit;
    }
    
    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Format email tidak valid']);
        exit;
    }
}
?>