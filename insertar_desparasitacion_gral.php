<?php
	require ('conexion.php');

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

	$pacientes = "SELECT * FROM TranAfiliado WHERE iCodEmpresa = '$cEmpresa' AND iCodPaciente = '$codPaciente'";

    $pac = mysqli_query($conn,$pacientes);
    $newPac = mysqli_fetch_assoc($pac);

    $correo = $newPac['vchCorreo'];
    $pais = $newPac['vchPais'];
    $estado = $newPac['vchEstado'];
    $ciudad = $newPac['vchCiudad'];

    echo $correo; echo $pais; echo $estado; echo $ciudad;

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
 	$new = mysqli_query($conn,$sql);	

?>