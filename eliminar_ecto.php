<?php
	require ('conexion.php');

	$id = $_REQUEST['id'];

	$sql = "DELETE FROM TranHecto WHERE iCodTranHecto = '$id'";

	$resultado = mysqli_query($conn,$sql);