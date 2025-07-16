<?php
header('Content-Type: text/plain');
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("HARUS POST");
}

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

if (!$username || !$password) {
    die("Username atau Password kosong");
}

$password_hashed = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password) VALUES ('$username', '$password_hashed')";
if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "error: " . mysqli_error($conn);
}
?>
