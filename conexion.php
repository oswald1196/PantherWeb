<?php

// Create connection
$conn = new mysqli("mysql.server302.com", "pantherwise", "PW150312", "pantherwise_cloud");
    
// Check connection 
if (mysqli_connect_errno()) {
    echo "Este sitio está presentando problemas";
} 
$conn->set_charset("utf8");

?>