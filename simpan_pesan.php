<?php
include "koneksi.php";

// Tangkap data dari form kontak
$nama = $_POST['name'];
$email = $_POST['email'];
$telepon = $_POST['phone'];
$subjek = $_POST['subject'];
$pesan = $_POST['message'];

// Query simpan ke tabel pesan_kontak
$sql = "INSERT INTO pesan_kontak (nama, email, telepon, subjek, pesan)
        VALUES ('$nama', '$email', '$telepon', '$subjek', '$pesan')";

if ($conn->query($sql)) {
    echo "Pesan berhasil dikirim!";
} else {
    echo "Gagal mengirim pesan: " . $conn->error;
}
?>
