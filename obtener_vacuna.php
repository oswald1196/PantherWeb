<?php
    include('conexion.php');

	$iCodMarca = $_POST['iCodMarca'];
    $codigo = json_decode($_POST['id']);

	$consulta = "SELECT iCodProducto, vchDescripcion FROM CatProductos WHERE iCodTipoProducto = 5 AND iCodMarca = '$iCodMarca' AND iCodEmpresa = '$codigo' ORDER BY vchDescripcion ASC";
	$result = mysqli_query($conn,$consulta);
	$html = "<option value='0'>SELECCIONAR VACUNA</option>";
	while($row = $result->fetch_assoc()){
		$html .= "<option value='".$row['iCodProducto']."'>".$row['vchDescripcion']."</option>";
	}
	echo $html;
?>