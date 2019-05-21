<?php

require 'conexion.php';

$sUsuario= $_POST['usuario'];
$sPassword= $_POST['pass'];

$sql = "SELECT * FROM CatMedico WHERE vchCorreoMedico = '$sUsuario' AND vchPassword = '$sPassword'";

$result = mysqli_query($conn,$sql);
	
    	if($row = mysqli_fetch_array($result)) {
    	if ($row['vchPassword'] == $sPassword){
            session_start();
            $_SESSION["autenticado"]= "SI";

    		header('Location: home.php');            
    	}
        else{
            header('Location: index.html');
        } 
    } else {
            header('Location: index.html');

    } 

?>

