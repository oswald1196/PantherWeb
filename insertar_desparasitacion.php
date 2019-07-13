<?php
	require ('conexion.php');

	$correo = $_POST['correo'];
	$pais = $_POST['pais'];
	$estado = $_POST['estado'];
	$ciudad = $_POST['ciudad'];
	$cEmpresa = $_POST['empresa'];
	$codPaciente = $_POST['paciente'];
	$fecha = $_POST['fecha'];
	$codigoDesp = $_POST['codigoDesp'];
	$lote = $_POST['codLote'];
	$precioVenta = $_POST['precio'];
	$caducidad = $_POST['fechaC'];
	$peso = $_POST['peso'];
	$cantidad = $_POST['cantidad'];

	if (isset($_POST['motivoCita']) == ""){
		$motivoP = "-";
	} 
	else {
		$motivoP = $_POST['motivoCita'];
	}

	if (isset($_POST['fechaCita']) == ""){
		$fechaCita = "01-01-1900";
	} 
	else {
		$fechaCita = $_POST['fechaCita'];
	}


	if($cantidad == ""){
		$cantidad = "0";
	}

	if($peso == ""){
		$peso = "0";
	}

	$query = "SELECT vchDescripcion, dPrecioCosto, iCodTipoProducto FROM CatProductos WHERE iCodProducto = '$codigoDesp' AND iCodEmpresa = '$cEmpresa'";

	$resultado = mysqli_query($conn,$query);
	$row = mysqli_fetch_assoc($resultado);

	$nombreDesp = $row['vchDescripcion'];
	$precioCosto = $row['dPrecioCosto'];
	$iCodServicio = $row['iCodTipoProducto'];

	$consulta = "SELECT vchLote FROM RelProductos WHERE iCodProductoLote = '$lote' AND iCodEmpresa = '$cEmpresa'";

	$result = mysqli_query($conn,$consulta);
	$fila = mysqli_fetch_assoc($result);

	$nombreLote = $fila['vchLote'];

	$sql = "INSERT INTO TranDesparacitacion (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodDesparacitacion, iCodPaciente, sFecha, sProductoAplicado, sFechaProxima, sObservaciones, iCodLaboratorio, dPrecioMenudeo, dPrecioCosto, iCodServicio, iCodCuentaCliente, iCodProducto, iCodProductoLote, sNumeroLote, sFechaCaducidad, dCantidad, vchUnidadMedida, vchServicio, dIVA, dSubtotal, dPorcentajeIVA, dPeso, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$codPaciente', '$fecha', '$nombreDesp', '$fechaCita', '$motivoP', '0', '$precioVenta', '$precioCosto', '$iCodServicio', '0', '$codigoDesp', '$lote', '$nombreLote', '$caducidad', '$cantidad', 'PZA.', '$motivoP', '0', '0', '0', '$peso', '2', '0')";
	//echo $sql;
 	$new = mysqli_query($conn,$sql);	

?>