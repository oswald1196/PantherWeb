<?php
$servername = "mysql.server302.com";
$username = "pantherwise";
$password = "PW150312";
$BD = "pantherwise_cloud";

// Create connection
$conn = new mysqli($servername, $username, $password, $BD);
    
// Check connection 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>