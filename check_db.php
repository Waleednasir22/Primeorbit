<?php
require_once 'config/db.php';
$tables = ['projects', 'case_studies', 'reviews', 'company_stats'];
foreach ($tables as $table) {
    try {
        $stmt = $pdo->query("DESCRIBE $table");
        echo "Table: $table\n";
        while ($row = $stmt->fetch()) {
            print_r($row);
        }
        echo "\n";
    } catch (Exception $e) {
        echo "Table $table not found.\n";
    }
}
?>
