<?php
// Set up the database connection
// TODO - Update credentials for security
$dsn = 'mysql:host=localhost;dbname=scotts_furniture_barn';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

// $dsn = 'mysql:host=3.93.31.85;dbname=scotts_furniture_barn';
// $username = 'phpmyadmin';
// $password = 'Pa$$w0rd';
// $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('./errors/db_error_connect.php');
    exit();
}


function display_db_error($error_message) {
    global $app_path;
    include './errors/db_error.php';
    exit;
}
