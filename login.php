<?php

session_start();
$sUsuario= $_POST['usuario'];
$sPassword= $_POST['pass'];

require 'conexion.php';

$sql = "SELECT * FROM CatMedico WHERE vchCorreoMedico = '$sUsuario' AND vchPassword = '$sPassword'";

$result = mysqli_query($conn,$sql);

if (mysqli_num_rows($result) > 0) {
	
    	while($row = mysqli_fetch_assoc($result)) {
    	$vchUsuario = $row['vchCorreoMedico'];
    	$vchPassword = $row['vchPassword'];
    	if ($vchUsuario && $vchPassword){
              $_SESSION["autenticado"]= "SI";
    		header('Location: home.php');
    	}
        else{
            header('Location: index.php');
        }
    
    }
    
    }

?>

