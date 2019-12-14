<?php

	require ('conexion.php');

	$correo = $_POST['correo'];
	$pais = $_POST['pais'];
	$estado = $_POST['estado'];
	$ciudad = $_POST['ciudad'];
	$empresa = $_POST['empresa'];
	$nombrePaciente = strtoupper($_POST['nombrePaciente']);
	$codigoMedico = $_POST['codigoM'];
	$codRaza = $_POST['codigoRaza'];
	$sexo = $_POST['sexo'];
	$especie = $_POST['codigoEspecie'];
	$fechaNacimiento = $_POST['fechaNac'];
	$notas = $_POST['observaciones'];
	$color = $_POST['iCodColor'];
	$chip = $_POST['chip'];
	$nombreImagen = $_FILES['imagen']['name'];
	$tipoImagen = $_FILES['imagen']['type'];
	$tamanoImagen = $_FILES['imagen']['size'];
	$exp = $_POST['expediente'];
	$nombreProp = strtoupper($_POST['nombreProp']);
	$paternoProp = strtoupper($_POST['paternoProp']);
	$maternoProp = strtoupper($_POST['maternoProp']);
	$colonia = $_POST['coloniaProp'];
	$telefono = $_POST['telefonoProp'];
	$direccion = $_POST['direccionProp'];
	$cpProp = $_POST['cpProp'];
	$telDos = $_POST['telefonoDos'];
	$correoP = $_POST['correoProp'];
	$fecha_act = $_POST['fecha_hoy'];

	echo "Nombre de imagen: ". $nombreImagen;

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
    	$exp = "0";
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

	$carpeta_destino = "uploads/";

	move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta_destino.$nombreImagen);

	$archivo_objetivo = fopen($carpeta_destino . $nombreImagen, "r");

	$contenido = fread($archivo_objetivo, $tamanoImagen);

	$contenido = addslashes($contenido);

	fclose($archivo_objetivo);

	$sql = "INSERT INTO TranAfiliado (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, vchUUID, iTipoDispositivo, iCodEmpresa, iCodPaciente, iCodMedico, chCodPaciente, vchNombrePaciente, vchRaza, vchSexo, vchColor, dtFecNacimiento, iCodEstatus, dtFecha, Imagen, Longitud, iCodEspecie, vchObservaciones, bActivo, bCastrado, dNoExpediente, vchNombre, vchPaterno, vchMaterno, vchDireccion, vchColonia, vchTelefono, vchCiudadAfiliado, vchEstadoAfiliado, vchCP, vchTelefono2, vchCorreoPaciente, iCodPropietario, vchRFC, vchNombre2, vchPaterno2, vchMaterno2, vchCorreo2, iNoPaciente, iCodTranNotas, dtFechaNacUsuario, bSexoMasculino, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '-', '0', '$empresa', '0', '$codigoMedico', '$chip', '$nombrePaciente', '$nombreRaza', '$sexo', '$vchColor', '$fechaNacimiento', '1', '$fecha_act', '$contenido', '$tamanoImagen', '$especie', '$notas', '1', '$esteril', '$exp', '$nombreProp', '$paternoProp', '$maternoProp', '$direccion', '$colonia', '$telefono', '$ciudad', '$estado', '$cpProp', '$telDos', '$correoP', '0', '.', '.', '.', '.', '.', '0', '0', '$fechaNacimiento', '1', '2', '0')";
 
	echo $sql;

	$result = mysqli_query($conn,$sql);

?>