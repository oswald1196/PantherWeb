<?php
include('conexion.php');

	$iCodServicio = $_POST['iCodServicio'];
    $codigo = json_decode($_POST['id']);

    $consulta = "SELECT dPrecioMenudeo FROM CatServicios WHERE iCodServicio = '$iCodServicio' AND iCodEmpresa = '$codigo'";
	$result = mysqli_query($conn,$consulta);
	$html = "";

	while($row = $result->fetch_assoc()){

	//$html .= ".$row['dPrecioMenudeo'].";
	$html .= "".$row['dPrecioMenudeo']."";

	}
	echo $html;
?>