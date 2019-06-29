<?php
	require ('conexion.php');

	$id = $_REQUEST['idE'];

	$sql = "DELETE FROM TranInformeMedico WHERE iCodTranInformeMedico = '$id'";

	$resultado = mysqli_query($conn,$sql);