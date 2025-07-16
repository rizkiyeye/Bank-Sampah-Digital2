<?php
include "koneksi.php";

// Tangkap data dari form
$jenis = $_POST['jenis'];
$tanggal = $_POST['pickupDate'];
$waktu = $_POST['pickupTime'];
$nama = $_POST['name'];
$telepon = $_POST['phone'];
$alamat = $_POST['address'];
$catatan = $_POST['notes'];
$berat = $_POST['weight'];

// Simpan ke database
$sql = "INSERT INTO penjemputan (jenis, tanggal, waktu, nama, telepon, alamat, catatan, berat)
        VALUES ('$jenis', '$tanggal', '$waktu', '$nama', '$telepon', '$alamat', '$catatan', '$berat')";

if ($conn->query($sql)) {
    echo "Penjemputan berhasil dijadwalkan!";
} else {
    echo "Gagal menyimpan data: " . $conn->error;
}
?>