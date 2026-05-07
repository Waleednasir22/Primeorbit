<?php
require_once 'config/db.php';

try {
    // 1. Add status column to reviews table
    $stmt = $pdo->query("SHOW COLUMNS FROM reviews LIKE 'status'");
    if (!$stmt->fetch()) {
        $pdo->exec("ALTER TABLE reviews ADD COLUMN status VARCHAR(20) DEFAULT 'pending' AFTER rating");
        $pdo->exec("UPDATE reviews SET status = 'approved'");
        echo "Database updated: Added 'status' column to reviews table.\n";
    } else {
        echo "Database update skipped: 'status' column already exists.\n";
    }

    // 2. Add author_image column to reviews table
    $stmt = $pdo->query("SHOW COLUMNS FROM reviews LIKE 'author_image'");
    if (!$stmt->fetch()) {
        $pdo->exec("ALTER TABLE reviews ADD COLUMN author_image VARCHAR(255) DEFAULT NULL AFTER company");
        echo "Database updated: Added 'author_image' column to reviews table.\n";
    } else {
        echo "Database update skipped: 'author_image' column already exists.\n";
    }
} catch (Exception $e) {
    echo "Error updating database: " . $e->getMessage() . "\n";
}
?>

