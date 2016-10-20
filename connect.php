<?php
$servername = "localhost";
$serverusername = "root";
$serverpassword = "root";

// Create connection
$conn = new mysqli($servername, $serverusername, $serverpassword);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
