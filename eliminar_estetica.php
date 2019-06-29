<?php
	require ('conexion.php');

	$id = $_REQUEST['id'];

	$sql = "DELETE FROM TranAgendaEstetica WHERE iCodTranAgendaEstetica = '$id'";

	$resultado = mysqli_query($conn,$sql);