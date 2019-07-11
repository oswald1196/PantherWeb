<?php

	require ('conexion.php');

	$correo = $_POST['correo'];
	$pais = $_POST['pais'];
	$estado = $_POST['estado'];
	$ciudad = $_POST['ciudad'];
	$empresa = $_POST['empresa'];
	$nombrePaciente = $_POST['nombrePaciente'];
	$codigoMedico = $_POST['codigoM'];
	$codRaza = $_POST['codigoRaza'];
	$sexo = $_POST['sexo'];
	$fechaNacimiento = $_POST['fechaNac'];
	$notas = $_POST['observaciones'];
	//$esteril = $_POST['castrado'];
	$color = $_POST['iCodColor'];
	$chip = $_POST['chip'];
	$exp = $_POST['expediente'];
	$nombreProp = $_POST['nombreProp'];
	$paternoProp = $_POST['paternoProp'];
	$maternoProp = $_POST['maternoProp'];
	$colonia = $_POST['coloniaProp'];
	$telefono = $_POST['telefonoProp'];
	$direccion = $_POST['direccionProp'];
	$cpProp = $_POST['cpProp'];
	$telDos = $_POST['telefonoDos'];
	$correoP = $_POST['correoProp'];
	$fecha_act = $_POST['fecha_hoy'];

	$consulta = "SELECT vchRaza FROM CatRazas WHERE iCodRaza = '$codRaza'";
	
	$resultado = mysqli_query($conn,$consulta);
    $fila = mysqli_fetch_assoc($resultado);

    $nombreRaza = $fila['vchRaza'];

    $nombreColor = "SELECT vchColor FROM CatColor WHERE iCodColor = '$color'";
	
	$colores = mysqli_query($conn,$nombreColor);
    $res = mysqli_fetch_assoc($colores);

    $vchColor = $res['vchColor'];

    if($notas == ""){
    	$notas = "-";
    }

    if($chip == ""){
    	$chip = ".";
    }


    if($exp == ""){
    	$exp = "-";
    }

	if($maternoProp == ""){
    	$maternoProp = ".";
    }

	if($telDos == ""){
    	$telDos = "-";
    }

	if($correoP == ""){
    	$correoP = ".";
    }

	if($direccion == ""){
    	$direccion = "-";
    }

	if($colonia == ""){
    	$colonia = "-";
    }

    if($cpProp == ""){
    	$cpProp = "-";
    }

    if (isset($_POST['castrado']) == "on"){
		$esteril = "-1";
	} else {
		$esteril = "0";
	} 

	$sql = "INSERT INTO TranAfiliado (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, vchUUID, iTipoDispositivo, iCodEmpresa, iCodPaciente, iCodMedico, chCodPaciente, vchNombrePaciente, vchRaza, vchSexo, vchColor, dtFecNacimiento, iCodEstatus, dtFecha, vchObservaciones, bActivo, bCastrado, dNoExpediente, vchNombre, vchPaterno, vchMaterno, vchDireccion, vchColonia, vchTelefono, vchCiudadAfiliado, vchEstadoAfiliado, vchCP, vchTelefono2, vchCorreoPaciente, iCodPropietario, vchRFC, vchNombre2, vchPaterno2, vchMaterno2, vchCorreo2, iNoPaciente, iCodTranNotas, dtFechaNacUsuario, bSexoMasculino, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '-', '0', '$empresa', '0', '$codigoMedico', '$chip', '$nombrePaciente', '$nombreRaza', '$sexo', '$vchColor', '$fechaNacimiento', '1', '$fecha_act', '$notas', '1', '$esteril', '$exp', '$nombreProp', '$paternoProp', '$maternoProp', '$direccion' '$colonia', '$telefono', '$ciudad', '$estado', '$cpProp', '$telDos', '$correoP', '0', '.', '.', '.', '.', '.', '0', '0', '$fechaNacimiento', '1', '2', '0')";
 
	echo $sql;

	//$result = mysqli_query($conn,$sql);

	

	
?>