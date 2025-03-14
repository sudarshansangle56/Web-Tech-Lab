<?php
$host = "localhost";  // XAMPP default host
$user = "root";       // Default MySQL user in XAMPP
$password = "";       // Default is empty in XAMPP
$database = "student_db";  // Your database name

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
