<?php
// PHP Database Connection Configuration (Railway & Local XAMPP Compatible)

// Railway provides these variables automatically
$host = getenv('MYSQLHOST') ?: 'localhost';
$db   = getenv('MYSQLDATABASE') ?: 'primeorbit';
$user = getenv('MYSQLUSER') ?: 'root';
$pass = getenv('MYSQLPASSWORD') ?: ''; 
$port = getenv('MYSQLPORT') ?: '3306';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     // Silence error details in production, show in local
     if (getenv('MYSQLHOST')) {
         die("Database Connection Error");
     } else {
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
     }
}
?>


