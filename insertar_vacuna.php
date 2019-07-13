<?php
	require ('conexion.php');

	$correo = $_POST['correo'];
	$pais = $_POST['pais'];
	$estado = $_POST['estado'];
	$ciudad = $_POST['ciudad'];
	$cEmpresa = $_POST['empresa'];
	$codPaciente = $_POST['paciente'];
	$fecha = $_POST['fechaVacuna'];
	$producto = $_POST['vacuna'];
	$laboratorio = $_POST['laboratorio'];
	$lote = $_POST['lote'];
	$costo = $_POST['precio'];
	$caducidad = $_POST['fechaC'];
	$peso = $_POST['peso'];

	if($peso == ""){
		$peso = "0";
	}

	if (isset($_POST['motivoProxima']) == ""){
		$motivoP = "-";
	} 
	else {
		$motivoP = $_POST['motivoProxima'];
	}

	if (isset($_POST['fechaCita']) == ""){
		$fechaCita = "01-01-1900";
	} 
	else {
		$fechaCita = $_POST['fechaCita'];
	}

	$query = "SELECT vchDescripcion, dPrecioCosto, iCodTipoProducto FROM CatProductos WHERE iCodProducto = '$producto' AND iCodEmpresa = '$cEmpresa'";

	$resultado = mysqli_query($conn,$query);
	$row = mysqli_fetch_assoc($resultado);

	$nombreVacuna = $row['vchDescripcion'];
	$precioCosto = $row['dPrecioCosto'];
	$iCodServicio = $row['iCodTipoProducto'];

	$nombreLote = "SELECT vchLote FROM RelProductos WHERE iCodProductoLote = '$lote' AND iCodEmpresa = '$cEmpresa'";

	$result = mysqli_query($conn,$nombreLote);
	$row = mysqli_fetch_assoc($result);

	$vchLote = $row['vchLote'];

	$sql = "INSERT INTO TranRegistroVacunas (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodVacuna, iCodPaciente, sFecha, sVacunaAplicada, sNumeroLote, sProximaVacuna, sFechaProgramada, iCodLaboratorio, dPrecioMenudeo, dPrecioCosto, iCodServicio, iCodCuentaCliente, iCodProducto, iCodProductoLote, sFechaCaducidad, dCantidad, vchUnidadMedida, dIVA, dSubtotal, dPorcentajeIVA, bVacunasAnteriores, dPeso, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$codPaciente', '$fecha', '$nombreVacuna', '$vchLote', '$motivoP', '$fechaCita', '$laboratorio', '$costo', '$precioCosto', '$iCodServicio', '0', '$producto', '$lote', '$caducidad', '0', 'PZA.', '0', '0', '0', '0', '$peso', '2', '0')";

	$new = mysqli_query($conn,$sql)
?>