<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "bank-sampah-digital2";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$jenis = $_POST['jenis'];
$berat = $_POST['berat'];

$sql = "INSERT INTO sampah (jenis, berat, tanggal) VALUES ('$jenis', $berat, NOW())";

if ($conn->query($sql)) {
  echo "Data berhasil disimpan!";
} else {
  echo "Gagal menyimpan data: " . $conn->error;
}

// Setelah berhasil simpan ke tabel sampah
$pesan = "Berhasil menyetor sampah jenis $jenis seberat $berat kg";
$tanggal = date('Y-m-d H:i:s');

$conn->query("INSERT INTO notifikasi (user_id, pesan, tanggal, status)
              VALUES ($user_id, '$pesan', '$tanggal', 'belum')");


$conn->close();
?>