<?php
$host = "localhost";
$user = "root";
$pass = ""; // set your MySQL password if any
$db = "travel_guide";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
