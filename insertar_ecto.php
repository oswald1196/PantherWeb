<?php
	require ('conexion.php');

	$correo = $_POST['correo'];
	$pais = $_POST['pais'];
	$estado = $_POST['estado'];
	$ciudad = $_POST['ciudad'];
	$cEmpresa = $_POST['empresa'];
	$codPaciente = $_POST['paciente'];
	$iCodProp = $_POST['propietario'];
	$fecha = $_POST['fecha'];
	$ecto = $_POST['ecto'];
	$lote = $_POST['lote'];
	$precio = $_POST['precio'];
	$caducidad = $_POST['fechaC'];
	$horaIni = $_POST['horaProx'];

	if (isset($_POST['proxEcto']) == "on"){
		$chkCita = "true";
	} else {
		$chkCita = "false";
	} 

	if (isset($_POST['anterior']) == "on"){
		$anterior = "true";
	} else {
		$anterior = "false";
	} 

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
    $precioCosto = $fila['dPrecioCosto'];
    $codServicio = $fila['iCodTipoProducto'];

    $lotes = "SELECT iCodProductoLote, vchLote FROM RelProductos WHERE iCodProductoLote = '$lote' AND iCodEmpresa = '$cEmpresa'";

	$resultado = mysqli_query($conn,$lotes);
    $filas = mysqli_fetch_assoc($resultado);

    $codigoLote = $filas['iCodProductoLote'];
    $nombreLote = $filas['vchLote'];
    
	$sql = "INSERT INTO TranHecto (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodHecto, iCodPaciente, sFecha, sProductoAplicado, sFechaProxima, sObservaciones, iCodLaboratorio, iCodigoEctoparasitante, dPrecioMenudeo, dPrecioCosto, iCodServicio, iCodCuentaCliente, iCodProducto, iCodProductoLote, sNumeroLote, sFechaCaducidad, dCantidad, vchUnidadMedida, dIVA, dSubtotal, dPorcentajeIVA, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$codPaciente', '$fecha', '$nombreP', '$fechaCitaProx', '$motivoP', '0', '0', '$precio', '$precioCosto', '$codServicio','0', '$ecto', '$codigoLote', '$nombreLote', '$caducidad', '1', 'PZA.', '0', '0', '0', '0', '0')";

	//$new = mysqli_query($conn,$sql);

	$insertCuentaE = "INSERT INTO TranCuentasClientes (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodCuentaCliente, iCodTipoServicio, iCodPaciente, dtFecha, vchServicio, dPrecioCosto, dPrecioMenudeo, dDescuento, bEstatus, iCodPropietario, iCodCorteCuentaCliente, iCuentaLiquidada, dIVA, dSubtotal, dPorcentajeIVA, iCodCorteDia, iCodProducto, dCantidad, dCantidadUnidad, bExistenciaCero, iNumFolioFactura, iFactura, iCodHospitalizacion, dtFechaSalida, bSalida, dPrecioAntesPromocion, dPorcentajePromocion, vchCodigoPromocion, iCodProductoLote, iEnvioCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$codServicio', '$codPaciente', '$fecha', '$nombreP', '$precioCosto', '$precio', '0', '0', '$iCodProp', '0', '0', '0', '0', '0', '0', '$ecto', '1', '0', '', '0', '0', '0', '$fecha', '', '0', '0', '.', '$lote', '2')";

	$consulta = "SELECT CONCAT(vchNombrePaciente, '-', vchRaza, '-', vchNombre, '-', vchTelefono) AS vchServicio FROM TranAfiliado WHERE iCodEmpresa = '$cEmpresa' AND iCodPaciente = '$codPaciente'";

	$resultado = mysqli_query($conn,$consulta);
    $fila = mysqli_fetch_assoc($resultado);

    $servicio = $fila['vchServicio'];

	$nuevaCitaE = "INSERT INTO TranCalendario (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodCalendario, iCodPaciente, dtFecha, vchTipoMotivo, vchHora, iCodEstado, iCodServicio, vchServicio, dtFechaFin, bCitaRecurrente, iFrecuencia, iNumFrecuencia, iDiaSemana, dtFechaFinRecurrente, iCodCita, iCodComentario, iCalendario, iEstatusServicio, iCodPropietario, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$codPaciente', '$fecha', '$motivoP', '$horaIni', '1', '1', '$servicio', '$fecha', '', '0', '0', '0', '1899-12-30', '0', '0', '0', '0', '$iCodProp', '0', '0')";

	if ($anterior == "false" and $chkCita == "true"){
		
		echo "Estas en la opcion 1";

	echo $sql; 
	//$new = mysqli_query($conn,$sql);

	echo $insertCuentaE;

	echo $nuevaCitaE;
	
	}

	/*Vacuna al carnet sin cita*/

	elseif ($anterior == "true" and $chkCita == "false") {
		echo "Estas en la opcion 2";
		echo $sql; 	
	}
	/*Fin vacuna al carnet sin cita*/

	/*Vacuna al carnet con cita*/

	elseif($anterior == "true" and $chkCita == "true"){

	echo "Estas en la opcion 3";
	echo $sql;
	echo $nuevaCitaE;
	}
	/*FIN Vacuna a la cuenta sin cita*/
	else {
			echo "Estas en la opcion 4";
			echo $sql;
			echo $insertCuentaE;
		}
?>