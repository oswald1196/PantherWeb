<?php

require 'conexion.php';

$sUsuario= $_POST['usuario'];
$sPassword= $_POST['pass'];

$sql = "SELECT iCodMedico, vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, vchCorreoMedico, vchPassword FROM CatMedico WHERE vchCorreoMedico = '$sUsuario' AND vchPassword = '$sPassword'";

$result = mysqli_query($conn,$sql);
	    
    	if($row = mysqli_fetch_array($result)) {

    	if ($row['vchPassword'] == $sPassword){
            session_start();
            $_SESSION["autenticado"]= "SI";
            $codigoM = $row['iCodMedico'];
            $iCodEmpresa = $row['iCodEmpresa'];
            $correo = $row['vchCorreo'];
            $pais = $row['vchPais'];
            $estado = $row['vchEstado'];
            $ciudad = $row['vchCiudad'];
            $recibe = $row['iRecibido'];
            $envia = $row['iEnviado'];

    		header("Location: home.php?id=".base64_encode($iCodEmpresa)."&cm=".base64_encode($codigoM));    	
        }
        else{
            header('Location: index.html');
        } 
    } else {
            header('Location: index.html');

    } 

?>

