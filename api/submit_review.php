<?php
header('Content-Type: application/json');
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author = $_POST['author'] ?? '';
    $company = $_POST['company'] ?? '';
    $role = $_POST['role'] ?? '';
    $rating = (int)($_POST['rating'] ?? 5);
    $feedback_text = $_POST['feedback_text'] ?? '';

    if (empty($author) || empty($feedback_text) || empty($company) || empty($role)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO reviews (author, company, role, rating, feedback_text, status) VALUES (?, ?, ?, ?, ?, 'pending')");
        $stmt->execute([$author, $company, $role, $rating, $feedback_text]);
        
        echo json_encode(['status' => 'success', 'message' => 'Review submitted for approval.']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
