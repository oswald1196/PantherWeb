<?php
	require ('conexion.php');

	$correo = $_POST['correo'];
	$pais = $_POST['pais'];
	$estado = $_POST['estado'];
	$ciudad = $_POST['ciudad'];
	$cEmpresa = $_POST['empresa'];
	$vchMotivo = $_POST['nuevoMotivo'];

	$consulta = "INSERT INTO CatMotivos (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodMotivo, vchMotivo, vchDescripcion, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '$vchMotivo', '.', '4','0')";

	echo $consulta;