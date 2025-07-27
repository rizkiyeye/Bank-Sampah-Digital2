<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $nama_lengkap = trim($_POST['nama_lengkap'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telepon = trim($_POST['telepon'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');
    
    // Validation
    if (empty($username) || empty($password)) {
        echo "Username dan password harus diisi";
        exit;
    }
    
    if (strlen($password) < 6) {
        echo "Password minimal 6 karakter";
        exit;
    }
    
    try {
        // Check if username already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        
        if ($stmt->rowCount() > 0) {
            echo "Username sudah terdaftar";
            exit;
        }
        
        // Hash password
        $hashedPassword = hashPassword($password);
        
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (username, password, nama_lengkap, email, telepon, alamat) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$username, $hashedPassword, $nama_lengkap, $email, $telepon, $alamat]);
        
        $user_id = $conn->lastInsertId();
        
        // Create welcome notification
        $stmt = $conn->prepare("INSERT INTO notifikasi (user_id, pesan, tipe) VALUES (?, ?, 'success')");
        $stmt->execute([$user_id, "Selamat datang di Bank Sampah Digital! Mulai setorkan sampah Anda dan dapatkan keuntungan."]);
        
        echo "success";
        
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Method not allowed";
}
?>