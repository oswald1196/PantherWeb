<?php
    include('conexion.php');

	$iCodProducto = $_POST['iCodProducto'];
    $codigo = json_decode($_POST['id']);

	$consulta = "SELECT iCodProductoLote, vchLote FROM RelProductos WHERE iCodProducto = '$iCodProducto' AND iCodEmpresa = '$codigo' ORDER BY vchLote ASC";
	$result = mysqli_query($conn,$consulta);
	$html = "<option value=''>SELECCIONAR LOTE</option>";
	while($row = $result->fetch_assoc()){
		$html .= "<option value='".$row['iCodProductoLote']."'>".$row['vchLote']."</option>";
	}
	echo $html;
?>