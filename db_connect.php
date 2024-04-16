<?php
// Database connection
$servername = "localhost";
$username = "pirate001";
$password = "killuagon12";
$database = "deliveryfood"; // Your database name
$table = "regtable"; // Your table name

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>