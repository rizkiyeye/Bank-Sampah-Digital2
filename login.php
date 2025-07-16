<?php
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$result = $conn->query("SELECT * FROM user WHERE username = '$username'");

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        echo "Login berhasil!";
        // Tambah: set session, redirect, dll
    } else {
        echo "Password salah";
    }
} else {
    echo "User tidak ditemukan";
}
?>
