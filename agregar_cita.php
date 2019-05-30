<?php 
	include('conexion.php');

	$codigoPaciente = $_GET['id'];
	$fecha = $_POST['fecha'];
	$horaIni = $_POST['horaInicio'];
	$motivo = $_POST['motivo'];

	$sql = "INSERT into TranCalendario (iCodPaciente,dtFecha,vchHora,vchTipoMotivo)
	values ('$codigoPaciente',$fecha','$horaIni')";
?>