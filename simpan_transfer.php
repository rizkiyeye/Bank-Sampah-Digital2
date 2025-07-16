<?php
include "koneksi.php";

$bank     = $_POST['bank'];
$rekening = $_POST['rekening'];
$nama     = $_POST['nama'];
$jumlah   = $_POST['jumlah'];
$waktu    = $_POST['waktu']; // waktu_transfer
$pesan    = $_POST['pesan'];

$sql = "INSERT INTO transfer (bank, rekening, nama, jumlah, waktu_transfer, pesan)
        VALUES ('$bank', '$rekening', '$nama', '$jumlah', '$waktu', '$pesan')";

if ($conn->query($sql) === TRUE) {
    echo "Transfer berhasil disimpan!";
} else {
    echo "Error: " . $conn->error;
}
?>
