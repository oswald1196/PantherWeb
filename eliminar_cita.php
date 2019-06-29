<?php
	require ('conexion.php');

	$id = $_REQUEST['id'];

	$sql = "DELETE FROM TranCalendario WHERE iCodTranCalendario = '$id'";

	$resultado = mysqli_query($conn,$sql);