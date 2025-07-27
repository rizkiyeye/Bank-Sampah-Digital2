<?php
// Set header first to ensure proper content type
header('Content-Type: application/json');

require_once 'config.php';

// Check request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed'
    ]);
    exit();
}

// Verify user is logged in
requireLogin();

// Get and sanitize form data
$waste_type = filter_input(INPUT_POST, 'waste_type', FILTER_SANITIZE_STRING);
$pickup_date = filter_input(INPUT_POST, 'pickupDate', FILTER_SANITIZE_STRING);
$pickup_time = filter_input(INPUT_POST, 'pickupTime', FILTER_SANITIZE_STRING);
$full_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
$notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_STRING);
$weight = filter_input(INPUT_POST, 'weight', FILTER_SANITIZE_STRING);

// Validate required fields
$errors = [];
$required_fields = [
    'waste_type' => 'Jenis sampah',
    'pickupDate' => 'Tanggal penjemputan',
    'pickupTime' => 'Waktu penjemputan',
    'name' => 'Nama lengkap',
    'phone' => 'Nomor telepon',
    'address' => 'Alamat lengkap',
    'weight' => 'Perkiraan berat'
];

foreach ($required_fields as $field => $name) {
    if (empty($_POST[$field])) {
        $errors[] = "$name harus diisi";
    }
}

// Validate date format
if (!empty($pickup_date) && !DateTime::createFromFormat('Y-m-d', $pickup_date)) {
    $errors[] = "Format tanggal tidak valid";
}

// Return errors if any
if (!empty($errors)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Validasi gagal',
        'errors' => $errors
    ]);
    exit();
}

try {
    // Insert into database
    $stmt = $conn->prepare("INSERT INTO pickup_requests 
        (user_id, waste_type, pickup_date, pickup_time, full_name, phone_number, address, notes, weight_category, status)
        VALUES (:user_id, :waste_type, :pickup_date, :pickup_time, :full_name, :phone, :address, :notes, :weight, 'pending')");
    
    $stmt->execute([
        ':user_id' => getCurrentUserId(),
        ':waste_type' => $waste_type,
        ':pickup_date' => $pickup_date,
        ':pickup_time' => $pickup_time,
        ':full_name' => $full_name,
        ':phone' => $phone,
        ':address' => $address,
        ':notes' => $notes,
        ':weight' => $weight
    ]);
    
    // Get the inserted ID
    $pickup_id = $conn->lastInsertId();
    
    // Return success response
    echo json_encode([
        'success' => true,
        'message' => 'Penjemputan sampah berhasil dijadwalkan!',
        'pickup_id' => $pickup_id
    ]);
    
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Terjadi kesalahan database',
        'error' => $e->getMessage()
    ]);
}
?>