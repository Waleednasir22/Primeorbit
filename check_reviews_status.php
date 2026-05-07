<?php
require_once 'config/db.php';
$stmt = $pdo->query("SHOW COLUMNS FROM reviews LIKE 'status'");
$col = $stmt->fetch();
print_r($col);
?>
