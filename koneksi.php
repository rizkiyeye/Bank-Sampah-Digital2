<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "bank-sampah-digital2";

$conn = mysqli_connect($host, $user, $pass, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
