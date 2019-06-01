<?php
	require ('conexion.php');

	$codigoPaciente = $_GET['id'];
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

	$sql = "INSERT INTO TranRegistroVacuna (iCodPaciente,dtFecha,sVacunaAplicada,sNumeroLote,
	sProximaVacuna,dtFechaProgramada, iCodLaboratorio, dPrecioMenudeo, dtFechaCaducidad, dPeso)
	VALUES ('$codigoPaciente',$fecha', '$producto', '$lote','$costo','$caducidad', '$peso',
	'$cita', '$motivoP', '$fechaCita')";

?>