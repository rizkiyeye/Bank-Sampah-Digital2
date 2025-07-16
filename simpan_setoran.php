<?php
include "koneksi.php";

$jenis  = $_POST['jenis'];
$berat  = $_POST['berat'];
$harga  = $_POST['harga'];
$total  = $berat * $harga;
$user_id = 1; // sementara hardcoded

$sql = "INSERT INTO setoran (user_id, jenis_sampah, berat, harga_per_kg, total)
        VALUES ('$user_id', '$jenis', '$berat', '$harga', '$total')";

if ($conn->query($sql) === TRUE) {
    echo "✅ Setoran berhasil disimpan";
} else {
    echo "❌ Gagal menyimpan: " . $conn->error;
}
?>
