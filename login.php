<?php

require 'conexion.php';

$sUsuario= $_POST['usuario'];
$sPassword= $_POST['pass'];

$sql = "SELECT iCodEmpresa, vchCorreoMedico, vchPassword FROM CatMedico WHERE vchCorreoMedico = '$sUsuario' AND vchPassword = '$sPassword'";

$result = mysqli_query($conn,$sql);
	    
    	if($row = mysqli_fetch_array($result)) {

    	if ($row['vchPassword'] == $sPassword){
            session_start();
            $_SESSION["autenticado"]= "SI";
            $iCodEmpresa = $row['iCodEmpresa'];

    		header("Location: home.php?id=$iCodEmpresa");            
    	}
        else{
            header('Location: index.html');
        } 
    } else {
            header('Location: index.html');

    } 

?>

