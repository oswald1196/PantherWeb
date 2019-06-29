<?php
	require ('conexion.php');

	$id = $_REQUEST['id'];

	$sql = "DELETE FROM TranRegistroVacunas WHERE iCodTranRegistroVacunas = '$id'";

	$resultado = mysqli_query($conn,$sql);