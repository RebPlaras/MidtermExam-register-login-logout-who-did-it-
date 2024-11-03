<?php

// database parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "business";

try {
    // establish connection with the server using PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully"; 
} catch (PDOException $e) {
    // error message if connection fails
    die("Connection failed: " . $e->getMessage());
}
?>
