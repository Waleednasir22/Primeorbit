<?php
/**
 * API Endpoint for Consultation Bookings
 * Saves booking to database.
 */

header('Content-Type: application/json');

require_once '../config/db.php';

// Create table if it doesn't exist (safe auto-migration)
$pdo->exec("CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    service VARCHAR(255) NOT NULL,
    preferred_date DATE NOT NULL,
    details TEXT,
    status ENUM('new','contacted','confirmed','closed') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'No data received']);
    exit;
}

// Extract & sanitize fields
$name    = trim($data['name']    ?? '');
$email   = trim($data['email']   ?? '');
$date    = trim($data['date']    ?? '');
$details = trim($data['details'] ?? '');
$service = trim($data['service'] ?? 'General Consultation');

// Validate
if (empty($name) || empty($email) || empty($date) || empty($details)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address']);
    exit;
}

// Save to database
try {
    $stmt = $pdo->prepare(
        "INSERT INTO bookings (name, email, service, preferred_date, details) VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->execute([$name, $email, $service, $date, $details]);
    $bookingId = $pdo->lastInsertId();

    echo json_encode([
        'success'    => true,
        'message'    => 'Booking received successfully',
        'booking_id' => $bookingId
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
