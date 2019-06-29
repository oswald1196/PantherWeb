<?php
	require ('conexion.php');

	$id = $_REQUEST['id'];

	$sql = "DELETE FROM TranDesparacitacion WHERE iCodTranDesparacitacion = '$id'";

	$resultado = mysqli_query($conn,$sql);