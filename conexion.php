<?php

// Create connection
$conn = new mysqli("192.168.100.150", "root", "mysql", "pantherwise_cloud");
    
// Check connection 
if (mysqli_connect_errno()) {
    echo "Este sitio está presentando problemas";
} 
$conn->set_charset("utf8");

?>