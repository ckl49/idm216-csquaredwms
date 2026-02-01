<?php

    $env_file = __DIR__ . '/.env.php';
    $env = file_exists($env_file) ? require $env_file : [];


    define('DB_HOST', $env['DB_HOST'] ?? 'localhost');
    define('DB_USER', $env['DB_USER'] ?? 'root');
    define('DB_PASSWORD', $env['DB_PASSWORD'] ?? 'root');
    define('DB_NAME', $env['DB_NAME'] ?? 'idm250');
    define('X_API_KEY', $env['X_API_KEY'] ?? 'null');


    // Create database connection 
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if ($conn->connect_error)
        die("Connection failed: " . $conn->connect_error);

?>

