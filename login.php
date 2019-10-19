<?php

require 'conexion.php';

$sUsuario= $_POST['usuario'];
$sPassword= strtoupper($_POST['pass']);

$sPasswordComplete ="";
            for($i=0; $i < strlen($sPassword);$i++){
               // echo '<br>'. $sPassword[$i];
                $sPasswordCod = codificar_contrasena($sPassword[$i]);
                $sPasswordComplete = $sPasswordComplete . $sPasswordCod ;
                echo "PWD COMPLETO: ".$sPasswordComplete;
            }

function codificar_contrasena($sPassword)
{   
    if ($sPassword == "A"){
        $sPassword = "¡";
    }
    elseif ($sPassword == "B") {
        $sPassword = "!";
    }
    elseif ($sPassword == "C") {
        $sPassword = "#";
    } 
    elseif ($sPassword == "D") {
        $sPassword = "$";
    } 
    elseif ($sPassword == "E") {
        $sPassword = "%";
    } 
    elseif ($sPassword == "F") {
        $sPassword = "&";
    } 
    elseif ($sPassword == "G") {
        $sPassword = "(";
    } 
    elseif ($sPassword == "H") {
        $sPassword = ")";
    } 
    elseif ($sPassword == "I") {
        $sPassword = "*";
    } 
    elseif ($sPassword == "J") {
        $sPassword = "+";
    } 
    elseif ($sPassword == "K") {
        $sPassword = "-";
    } 
    elseif ($sPassword == "L") {
        $sPassword = "/";
    } 
    elseif ($sPassword == "M") {
        $sPassword = "<";
    } 
    elseif ($sPassword == "N") {
        $sPassword = ">";
    } 
    elseif ($sPassword == "O") {
        $sPassword = "¿";
    } 
    elseif ($sPassword == "P") {
        $sPassword = "?";
    } 
    elseif ($sPassword == "Q") {
        $sPassword = "@";
    } 
    elseif ($sPassword == "R") {
        $sPassword = "[";
    } 
    elseif ($sPassword == "S") {
        $sPassword = "]";
    } 
    elseif ($sPassword == "T") {
        $sPassword = "=";
    } 
    elseif ($sPassword == "U") {
        $sPassword = "~";
    } 
    elseif ($sPassword == "V") {
        $sPassword = "_";
    } 
    elseif ($sPassword == "W") {
        $sPassword = "Ç";
    } 
    elseif ($sPassword == "X") {
        $sPassword = "¦";
    } 
    elseif ($sPassword == "Y") {
        $sPassword = "Æ";
    } 
    elseif ($sPassword == "Z") {
        $sPassword = "£";
    }
    elseif ($sPassword == "0") {
        $sPassword = "á";
    } 
    elseif ($sPassword == "1") {
        $sPassword = "é";
    } 
    elseif ($sPassword == "2") {
        $sPassword = "í";
    } 
    elseif ($sPassword == "3") {
        $sPassword = "ó";
    } 
    elseif ($sPassword == "4") {
        $sPassword = "ú";
    } 
    elseif ($sPassword == "5") {
        $sPassword = "ä";
    } 
    elseif ($sPassword == "6") {
        $sPassword = "ë";
    } 
    elseif ($sPassword == "7") {
        $sPassword = "ï";
    } 
    elseif ($sPassword == "8") {
        $sPassword = "ö";
    } 
    elseif ($sPassword == "9") {
        $sPassword = "ü";
    }
    return $sPassword;

}

$sql = "SELECT iCodMedico, vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, vchCorreoMedico, vchPassword FROM CatMedico WHERE vchCorreoMedico = '$sUsuario' AND vchPassword = '$sPasswordComplete'";

echo $sql;        
$result = mysqli_query($conn,$sql);
	    
if($row = mysqli_fetch_array($result)) {

    	if ($row['vchPassword'] == $sPasswordComplete){
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



