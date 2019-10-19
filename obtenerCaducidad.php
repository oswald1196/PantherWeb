<?php
include('conexion.php');

	$codigoProd = $_POST['iCodProductoLote'];
    $codigo = json_decode($_POST['id']);

    $consulta = "SELECT dtFechaCaducidad FROM RelProductos WHERE iCodProductoLote = '$codigoProd' AND iCodEmpresa = '$codigo'";
	$result = mysqli_query($conn,$consulta);
	$html = "";

	while($row = $result->fetch_assoc()){

	$html .= "".date("Y-m-d",strtotime($row['dtFechaCaducidad']))."";

	}
	echo $html;
?>