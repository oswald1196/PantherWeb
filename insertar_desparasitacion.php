<?php
	require ('conexion.php');

	$correo = $_POST['correo'];
	$pais = $_POST['pais'];
	$estado = $_POST['estado'];
	$ciudad = $_POST['ciudad'];
	$cEmpresa = $_POST['empresa'];
	$codPaciente = $_POST['paciente'];
	$fecha = $_POST['fecha'];
	$producto = $_POST['vacuna'];
	$laboratorio = $_POST['laboratorio'];
	$lote = $_POST['lote'];
	$costo = $_POST['precio'];
	$caducidad = $_POST['fechaC'];
	$peso = $_POST['peso'];
	$cita = $_POST['cita'];
	$motivoP = $_POST['motivoProxima'];
	$fechaCita = $_POST['fechaCita'];
	$horaCita = $_POST['horaCita'];

	$sql = "INSERT INTO TranHecto (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodDesparacitacion, iCodPaciente, sFecha, sProductoAplicado, sFechaProxima, sObservaciones, iCodLaboratorio, dPrecioMenudeo, dPrecioCosto, iCodServicio, iCodCuentaCliente, iCodProducto, iCodProductoLote, sNumeroLote, sFechaCaducidad, dCantidad, vchUnidadMedida, dIVA, dSubtotal, dPorcentajeIVA, iEnvioCloud, dNoTransaccionCloud)
	VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$codPaciente', '$fecha', '$producto', '$lote', '$motivoP', '$fechaCita', '$laboratorio', '$costo', '0', '0', '0', '0' '$caducidad', '0', 'PZA.', '0', '0', '0', '0', '$peso', '0', '0')";

?>