<?php
require_once 'config.php';

requireLogin();

header('Content-Type: application/json');

try {
    $stmt = $conn->prepare("SELECT * FROM pickup_requests WHERE user_id = :user_id ORDER BY pickup_date DESC, pickup_time DESC");
    $stmt->execute([':user_id' => getCurrentUserId()]);
    $pickups = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'data' => $pickups
    ]);
    
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to fetch pickup history: ' . $e->getMessage()
    ]);
}
?>