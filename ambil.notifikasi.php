<?php
session_start();
include "koneksi.php";

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM notifikasi WHERE user_id = $user_id ORDER BY tanggal DESC";
$result = $conn->query($sql);

$notif = [];
while ($row = $result->fetch_assoc()) {
  $notif[] = $row;
}

echo json_encode($notif);
?>
