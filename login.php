<?php

session_start();
$sUsuario= $_POST['usuario'];
$sPassword= $_POST['pass'];

require 'conexion.php';

$sql = "SELECT * FROM CatMedico WHERE vchCorreoMedico = '$sUsuario' AND vchPassword = '$sPassword'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	
    	while($row = $result->fetch_assoc()) {
    	$vchUsuario = $row["vchCorreoMedico"];
    	$vchPassword = $row['vchPassword'];
    	if ($vchUsuario && $vchPassword){
              $_SESSION["autenticado"]= "SI";
    		header('Location: header.php');
    	}
        else{
            header('Location: index.php');
        }
    
    }
    
    }

?>

