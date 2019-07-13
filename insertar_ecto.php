<?php
	require ('conexion.php');

	$correo = $_POST['correo'];
	$pais = $_POST['pais'];
	$estado = $_POST['estado'];
	$ciudad = $_POST['ciudad'];
	$cEmpresa = $_POST['empresa'];
	$codPaciente = $_POST['paciente'];
	$fecha = $_POST['fecha'];
	$ecto = $_POST['ecto'];
	$lote = $_POST['lote'];
	$caducidad = $_POST['fechaC'];

	if (isset($_POST['motivoCitaEcto']) == ""){
		$motivoP = "-";
	} 
	else {
		$motivoP = $_POST['motivoCitaEcto'];
	}

	if (isset($_POST['fechaProx']) == ""){
		$fechaCitaProx = "01-01-1900";
	} 
	else {
		$fechaCitaProx = $_POST['fechaProx'];
	}

	$query = "SELECT iCodProducto, vchDescripcion, iCodTipoProducto, dPrecioVenta, dPrecioCosto FROM CatProductos WHERE iCodProducto = '$ecto' AND iCodEmpresa = '$cEmpresa'";

	$result = mysqli_query($conn,$query);
    $fila = mysqli_fetch_assoc($result);

    $codigoP = $fila['iCodProducto'];
    $nombreP = $fila['vchDescripcion'];
    $precio = $fila['dPrecioVenta'];
    $precioCosto = $fila['dPrecioCosto'];
    $codServicio = $fila['iCodTipoProducto'];

    $lotes = "SELECT iCodProductoLote, vchLote FROM RelProductos WHERE iCodProductoLote = '$lote' AND iCodEmpresa = '$cEmpresa'";

	$resultado = mysqli_query($conn,$lotes);
    $filas = mysqli_fetch_assoc($resultado);

    $codigoLote = $filas['iCodProductoLote'];
    $nombreLote = $filas['vchLote'];
    
	$sql = "INSERT INTO TranHecto (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodHecto, iCodPaciente, sFecha, sProductoAplicado, sFechaProxima, sObservaciones, iCodLaboratorio, iCodigoEctoparasitante, dPrecioMenudeo, dPrecioCosto, iCodServicio, iCodCuentaCliente, iCodProducto, iCodProductoLote, sNumeroLote, sFechaCaducidad, dCantidad, vchUnidadMedida, dIVA, dSubtotal, dPorcentajeIVA, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$codPaciente', '$fecha', '$nombreP', '$fechaCitaProx', '$motivoP', '0', '0', '$precio', '$precioCosto', '$codServicio','0', '$ecto', '$codigoLote', '$nombreLote', '$caducidad', '1', 'PZA.', '0', '0', '0', '0', '0')";

	//echo $sql;
	$new = mysqli_query($conn,$sql)
?>