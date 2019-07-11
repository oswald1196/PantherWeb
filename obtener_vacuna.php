<?php
    include('conexion.php');

	$iCodMarca = $_POST['iCodMarca'];
    $codigo = json_decode($_POST['id']);

	$consulta = "SELECT iCodProducto, vchDescripcion, dPrecioVenta FROM CatProductos WHERE iCodTipoProducto = 5 AND iCodMarca = '$iCodMarca' AND iCodEmpresa = '$codigo' ORDER BY vchDescripcion ASC";
	$result = mysqli_query($conn,$consulta);
	$html = "<option value=''>SELECCIONAR VACUNA</option>";
	while($row = $result->fetch_assoc()){
		$html .= "<option value='".$row['iCodProducto']."'>".$row['vchDescripcion']."</option>";
	}
	echo $html;

	/*$query = "SELECT dPrecioVenta FROM CatProductos WHERE iCodTipoProducto = 5 AND iCodMarca = '$iCodMarca' AND iCodEmpresa = '$codigo' ORDER BY vchDescripcion ASC";
	$resultado = mysqli_query($conn,$query);

	while($fila = $result->fetch_assoc()){
			$vPrecio .= "<input value='".$fila['dPrecioVenta']."'>";
			echo $vPrecio;*/
?>