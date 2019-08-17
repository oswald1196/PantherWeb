<?php
include('conexion.php');

	$codigoProd = $_POST['iCodProductoLote'];
    $codigo = json_decode($_POST['id']);

    $consulta = "SELECT dStockActual FROM RelProductos WHERE iCodProductoLote = '$codigoProd' AND iCodEmpresa = '$codigo'";
	$result = mysqli_query($conn,$consulta);
	$html = "";

	while($row = $result->fetch_assoc()){

	$html .= "".$row['dStockActual']."";

	}
	echo $html;
?>