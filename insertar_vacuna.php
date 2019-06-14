<?php
	require ('conexion.php');

	$codigoPaciente = $_POST['id'];
	$fecha = $_POST['fecha'];
	$laboratorio = $_POST['laboratorio'];
	$producto = $_POST['vacuna'];
	$lote = $_POST['lote'];
	$costo = $_POST['precio'];
	$caducidad = $_POST['fechaC'];
	$peso = $_POST['peso'];
	$cita = $_POST['cita'];
	$motivoP = $_POST['motivoProxima'];
	$fechaCita = $_POST['fechaCita'];
	$horaCita = $_POST['horaCita'];

	$sql = "INSERT INTO TranRegistroVacuna (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodVacuna, iCodPaciente, sFecha, sVacunaAplicada, sNumeroLote,
 sProximaVacuna,sFechaProgramada, iCodLaboratorio, dPrecioMenudeo, dPrecioCosto, iCodServicio, iCodCuentaCliente, iCodProducto, iCodProductoLote, sFechaCaducidad, dCantidad, vchUnidadMedida, dIVA, dSubtotal, dPorcentajeIVA, bVacunasAnteriores, dPeso, iEnvioCloud, dNoTransaccionCloud)
	VALUES ('$codigoPaciente',$fecha', '$producto', '$lote','$costo','$caducidad', '$peso',
	'$cita', '$motivoP', '$fechaCita')";

?>