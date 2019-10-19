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
$cantidad = $_POST['cantidad'];
$medico = $_POST['medico'];

if (isset($_POST['proxEcto']) == "on"){
	$chkCita = "true";
} else {
	$chkCita = "false";
} 

if (isset($_POST['anterior']) == "on"){
	$anterior = "true";
	$eAnterior = '1';
} else {
	$anterior = "false";
	$eAnterior = '0';
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

/*************** STOCKS **************/
$stock = "SELECT * FROM RelProductos WHERE iCodProductoLote = '$lote' AND iCodEmpresa = '$cEmpresa'";
$res = mysqli_query($conn,$stock);
$success = mysqli_fetch_assoc($res);

$cantidadActual = $success['dStockActual'];
$codlote = $success['iCodProductoLote'];

$cantidadTotal = $cantidadActual - $cantidad;

$newStock = "UPDATE RelProductos SET dStockActual = '$cantidadTotal' WHERE iCodProductoLote = '$lote'";

/*************** FIN STOCKS **************/

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

$sql = "INSERT INTO TranHecto (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodHecto, iCodPaciente, sFecha, sProductoAplicado, sFechaProxima, sObservaciones, iCodLaboratorio, iCodigoEctoparasitante, dPrecioMenudeo, dPrecioCosto, iCodServicio, iCodCuentaCliente, iCodProducto, iCodProductoLote, sNumeroLote, sFechaCaducidad, dCantidad, vchUnidadMedida, dIVA, dSubtotal, dPorcentajeIVA, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$codPaciente', '$fecha', '$nombreP', '$fechaCitaProx', '$motivoP', '0', '0', '$precio', '$precioCosto', '$codServicio','0', '$ecto', '$codigoLote', '$nombreLote', '$caducidad', '$cantidad', 'PZA.', '0', '0', '0', '0', '0')";

$insertCuentaE = "INSERT INTO TranCuentasClientes (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodCuentaCliente, iCodTipoServicio, iCodPaciente, dtFecha, vchServicio, dPrecioCosto, dPrecioMenudeo, dDescuento, bEstatus, iCodPropietario, iCodCorteCuentaCliente, iCuentaLiquidada, dIVA, dSubtotal, dPorcentajeIVA, iCodCorteDia, iCodProducto, dCantidad, dCantidadUnidad, bExistenciaCero, iNumFolioFactura, iFactura, iCodHospitalizacion, dtFechaSalida, bSalida, dPrecioAntesPromocion, dPorcentajePromocion, vchCodigoPromocion, iCodProductoLote, iEnvioCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$codServicio', '$codPaciente', '$fecha', '$nombreP', '$precioCosto', '$precio', '0', '0', '$iCodProp', '0', '0', '0', '0', '0', '0', '$ecto', '1', '0', '', '0', '0', '0', '$fecha', '', '0', '0', '.', '$lote', '2')";

$consulta = "SELECT CONCAT(vchNombrePaciente, '-', vchRaza, '-', vchNombre, '-', vchTelefono) AS vchServicio FROM TranAfiliado WHERE iCodEmpresa = '$cEmpresa' AND iCodPaciente = '$codPaciente'";

$resultado = mysqli_query($conn,$consulta);
$fila = mysqli_fetch_assoc($resultado);

$servicio = $fila['vchServicio'];

$sqlMedico = "SELECT CONCAT(vchNombre, ' ', vchPaterno) AS vchNombreMedico FROM CatMedico WHERE iCodEmpresa = '$cEmpresa' AND iCodMedico = '$medico'";

    $eject = mysqli_query($conn,$sqlMedico);
    $med = mysqli_fetch_assoc($eject);

    $nombreMed = $med['vchNombreMedico'];

    if ($medico == 0){
        $nombreMed = "-";
    }

$nuevaCitaE = "INSERT INTO TranCalendario (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodCalendario, iCodPaciente, dtFecha, vchTipoMotivo, vchHora, iCodEstado, iCodServicio, vchServicio, dtFechaFin, bCitaRecurrente, iFrecuencia, iNumFrecuencia, iDiaSemana, dtFechaFinRecurrente, iCodCita, iCodComentario, iCalendario, iEstatusServicio, iCodPropietario, iCodMedico, vchNombreMedico, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$codPaciente', '$fecha', '$motivoP', '$horaIni', '1', '1', '$servicio', '$fecha', '', '0', '0', '0', '1899-12-30', '0', '0', '0', '0', '$iCodProp', '$medico', '$nombreMed', '0', '0')";

if ($anterior == "false" and $chkCita == "true"){
	
	$nuevoEcto = mysqli_query($conn,$sql);
	$cuentaEcto = mysqli_query($conn,$insertCuentaE);
	$citaEcto = mysqli_query($conn,$nuevaCitaE);
	$actualizarStockLote = mysqli_query($conn,$newStock);

	$stockXProd = "SELECT SUM(dStockActual) AS StockActual FROM RelProductos WHERE iCodProducto = '$ecto' AND iCodEmpresa = '$cEmpresa'";

	$resultado = mysqli_query($conn,$stockXProd);
	$exito = mysqli_fetch_assoc($resultado);

	$stockRes = $exito['StockActual'];

	$newStockRes = "UPDATE CatProductos SET dStockActual = '$stockRes' WHERE iCodProducto = '$ecto' AND iCodEmpresa = '$cEmpresa'";

	$actualizarStockCat = mysqli_query($conn,$newStockRes);

}

/*Vacuna al carnet sin cita*/

elseif ($anterior == "true" and $chkCita == "false") {
	$nuevoEcto = mysqli_query($conn,$sql);
}
/*Fin vacuna al carnet sin cita*/

/*Vacuna al carnet con cita*/

elseif($anterior == "true" and $chkCita == "true"){
	$nuevoEcto = mysqli_query($conn,$sql);
	$citaEcto = mysqli_query($conn,$nuevaCitaE);
}
/*FIN Vacuna a la cuenta sin cita*/
else {
	$nuevoEcto = mysqli_query($conn,$sql);
	$cuentaEcto = mysqli_query($conn,$insertCuentaE);
	$actualizarStockLote = mysqli_query($conn,$newStock);
	$stockXProd = "SELECT SUM(dStockActual) AS StockActual FROM RelProductos WHERE iCodProducto = '$ecto' AND iCodEmpresa = '$cEmpresa'";

	$resultado = mysqli_query($conn,$stockXProd);
	$exito = mysqli_fetch_assoc($resultado);

	$stockRes = $exito['StockActual'];	

	$newStockRes = "UPDATE CatProductos SET dStockActual = '$stockRes' WHERE iCodProducto = '$ecto' AND iCodEmpresa = '$cEmpresa'";
	$actualizarStockLote = mysqli_query($conn,$newStockRes);

}
?>