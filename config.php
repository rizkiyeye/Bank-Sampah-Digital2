<?php
// Konfigurasi Database
define('DB_HOST', 'localhost');
define('DB_NAME', 'bank_sampah2');
define('DB_USER', 'root'); 
define('DB_PASS', ''); // Sesuaikan dengan password MySQL Anda

// Inisialisasi koneksi database
try {
    $conn = new PDO(
        "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4",
        DB_USER, 
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch(PDOException $e) {
    header('Content-Type: application/json');
    http_response_code(500);
    die(json_encode([
        'success' => false,
        'message' => 'Koneksi database gagal',
        'error' => $e->getMessage(),
        'details' => 'Pastikan konfigurasi database sudah benar'
    ]));
}

// Pengaturan Session
session_set_cookie_params([
    'lifetime' => 86400, // 1 hari
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => isset($_SERVER['HTTPS']),
    'httponly' => true,
    'samesite' => 'Strict'
]);

if (session_status() === PHP_SESSION_NONE) {
    session_name('BANK_SAMPAH_AUTH');
    session_start();
}

/**
 * Fungsi untuk memeriksa login user
 */
function requireLogin() {
    if (!isset($_SESSION['user_id'])) {
        header('Content-Type: application/json');
        http_response_code(401);
        die(json_encode([
            'success' => false,
            'message' => 'Akses ditolak. Silakan login terlebih dahulu.'
        ]));
    }
}

/**
 * Mendapatkan ID user yang sedang login
 */
function getCurrentUserId() {
    return $_SESSION['user_id'] ?? 0;
}

/**
 * Mendapatkan data user yang sedang login
 */
function getCurrentUser() {
    global $conn;
    
    if (!isset($_SESSION['user_id'])) {
        return null;
    }
    
    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        return $stmt->fetch();
    } catch(PDOException $e) {
        error_log("Error getCurrentUser: " . $e->getMessage());
        return null;
    }
}

/**
 * Fungsi sanitasi input
 */
function sanitize_input($data) {
    return htmlspecialchars(strip_tags(trim($data ?? '')));
}

/**
 * Validasi format tanggal
 */
function validateDate($date, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}