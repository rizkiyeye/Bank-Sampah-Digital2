<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "bank_sampah_digital2";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?> 