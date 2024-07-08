<?php

$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'boutique_db';

try {
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
    $conn = new PDO($dsn, $db_username, $db_password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection errors
    die("Connection failed: " . $e->getMessage());
}

?>
