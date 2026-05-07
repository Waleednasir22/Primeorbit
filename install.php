<?php
/**
 * PrimeOrbit Database Auto-Installer
 * This script runs the SQL schema on the current database connection.
 */

require_once 'config/db.php';

echo "<h2>PrimeOrbit Database Installer</h2>";

try {
    // Read the SQL file
    $sqlFile = 'config/database_schema.sql';
    if (!file_exists($sqlFile)) {
        die("Error: config/database_schema.sql not found!");
    }

    $sql = file_get_contents($sqlFile);

    // Remove CREATE DATABASE and USE statements to avoid conflicts with Railway's predefined DB
    $sql = preg_replace('/CREATE DATABASE IF NOT EXISTS.*;/i', '', $sql);
    $sql = preg_replace('/USE .*;/i', '', $sql);

    // Execute the SQL
    $pdo->exec($sql);

    echo "<div style='color: green; font-weight: bold;'>Success! All tables created and default settings inserted.</div>";
    echo "<p>You can now <a href='index.php'>go to Homepage</a> or <a href='admin/'>Login to Admin</a> (admin / admin123).</p>";
    
    echo "<p style='color: red;'><b>IMPORTANT:</b> Delete this file (install.php) after installation for security!</p>";

} catch (PDOException $e) {
    echo "<div style='color: red; font-weight: bold;'>Installation Failed:</div>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
?>
