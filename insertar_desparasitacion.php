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
$horaIni = $_POST['hora'];
$peso = $_POST['peso'];
$cantidad = $_POST['cantidad'];
$iCodProp = $_POST['propietario'];

if (isset($_POST['citaP']) == "on"){
	$chkCita = "true";
} else {
	$chkCita = "false";
} 

if (isset($_POST['anterior']) == "on"){
	$anterior = "true";
	$dAnterior = "1";
} else {
	$anterior = "false";
	$dAnterior = "0";
} 

echo $anterior . " " . $chkCita;

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
	$cantidad = "1";
}

if($peso == ""){
	$peso = "0";
}

/************** STOCKS ******************/
$stock = "SELECT * FROM RelProductos WHERE iCodProductoLote = '$lote' AND iCodEmpresa = '$cEmpresa'";
$res = mysqli_query($conn,$stock);
$success = mysqli_fetch_assoc($res);

$cantidadActual = $success['dStockActual'];
$codlote = $success['iCodProductoLote'];

$cantidadTotal = $cantidadActual - $cantidad;

$newStock = "UPDATE RelProductos SET dStockActual = '$cantidadTotal' WHERE iCodProductoLote = '$lote'";

/************** FIN STOCKS ******************/

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

$sql = "INSERT INTO TranDesparacitacion (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodDesparacitacion, iCodPaciente, sFecha, sProductoAplicado, sFechaProxima, sObservaciones, iCodLaboratorio, dPrecioMenudeo, dPrecioCosto, iCodServicio, iCodCuentaCliente, iCodProducto, iCodProductoLote, sNumeroLote, sFechaCaducidad, dCantidad, vchUnidadMedida, vchServicio, dIVA, dSubtotal, dPorcentajeIVA, bDesparasitacionesAnteriores, dPeso, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$codPaciente', '$fecha', '$nombreDesp', '$fechaCita', '$motivoP', '', '$precioVenta', '$precioCosto', '$iCodServicio', '0', '$codigoDesp', '$lote', '$nombreLote', '$caducidad', '$cantidad', 'PZA.', '$motivoP', '0', '0', '0', '$dAnterior', '$peso', '2', '0')";

echo $sql;

 	//$new = mysqli_query($conn,$sql);	

$insertCuentaD = "INSERT INTO TranCuentasClientes (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodCuentaCliente, iCodTipoServicio, iCodPaciente, dtFecha, vchServicio, dPrecioCosto, dPrecioMenudeo, dDescuento, bEstatus, iCodPropietario, iCodCorteCuentaCliente, iCuentaLiquidada, dIVA, dSubtotal, dPorcentajeIVA, iCodCorteDia, iCodProducto, dCantidad, dCantidadUnidad, bExistenciaCero, iNumFolioFactura, iFactura, iCodHospitalizacion, dtFechaSalida, bSalida, dPrecioAntesPromocion, dPorcentajePromocion, vchCodigoPromocion, iCodProductoLote, iEnvioCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$iCodServicio', '$codPaciente', '$fecha', '$nombreDesp', '$precioCosto', '$precioVenta', '0', '0', '$iCodProp', '0', '0', '0', '0', '0', '0', '$codigoDesp', '1', '0', '', '0', '0', '0', '$fecha', '', '0', '0', '.', '$lote', '2')";

$consulta = "SELECT CONCAT(vchNombrePaciente, '-', vchRaza, '-', vchNombre, '-', vchTelefono) AS vchServicio FROM TranAfiliado WHERE iCodEmpresa = '$cEmpresa' AND iCodPaciente = '$codPaciente'";

$resultado = mysqli_query($conn,$consulta);
$fila = mysqli_fetch_assoc($resultado);

$servicio = $fila['vchServicio'];

$nuevaCitaDesp = "INSERT INTO TranCalendario (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodCalendario, iCodPaciente, dtFecha, vchTipoMotivo, vchHora, iCodEstado, iCodServicio, vchServicio, dtFechaFin, bCitaRecurrente, iFrecuencia, iNumFrecuencia, iDiaSemana, dtFechaFinRecurrente, iCodCita, iCodComentario, iCalendario, iEstatusServicio, iCodPropietario, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$codPaciente', '$fechaCita', '$motivoP', '$horaIni', '1', '1', '$servicio', '$fechaCita', '', '0', '0', '0', '1899-12-30', '0', '0', '0', '0', '$iCodProp', '0', '0')";

if ($anterior == "false" and $chkCita == "true"){

	$newDesp = mysqli_query($conn,$sql);

	$newCuenta = mysqli_query($conn,$insertCuentaD);
	$newCitaDesp = mysqli_query($conn,$nuevaCitaDesp);
	$stockLote = mysqli_query($conn,$newStock);

	$stockXProd = "SELECT SUM(dStockActual) AS StockActual FROM RelProductos WHERE iCodProducto = '$codigoDesp' AND iCodEmpresa = '$cEmpresa'";

	$resultado = mysqli_query($conn,$stockXProd);
	$exito = mysqli_fetch_assoc($resultado);

	$stockRes = $exito['StockActual'];

	$newStockRes = "UPDATE CatProductos SET dStockActual = '$stockRes' WHERE iCodProducto = '$codigoDesp' AND iCodEmpresa = '$cEmpresa'";

	$stockLoteCat = mysqli_query($conn,$newStockRes);

}

/*Vacuna al carnet sin cita*/

elseif ($anterior == "true" and $chkCita == "false") {
	$newDesp = mysqli_query($conn,$sql);

}
/*Fin vacuna al carnet sin cita*/

/*Vacuna al carnet con cita*/

elseif($anterior == "true" and $chkCita == "true"){
	$newDesp = mysqli_query($conn,$sql);
	$newCitaDesp = mysqli_query($conn,$nuevaCitaDesp);
}
/*FIN Vacuna a la cuenta sin cita*/
else {
	$newDesp = mysqli_query($conn,$sql);
	$newCuenta = mysqli_query($conn,$insertCuentaD);
	$stockLote = mysqli_query($conn,$newStock);

	$stockXProd = "SELECT SUM(dStockActual) AS StockActual FROM RelProductos WHERE iCodProducto = '$codigoDesp' AND iCodEmpresa = '$cEmpresa'";

	$resultado = mysqli_query($conn,$stockXProd);
	$exito = mysqli_fetch_assoc($resultado);

	$stockRes = $exito['StockActual'];

	$newStockRes = "UPDATE CatProductos SET dStockActual = '$stockRes' WHERE iCodProducto = '$codigoDesp' AND iCodEmpresa = '$cEmpresa'";

	$stockLoteCat = mysqli_query($conn,$newStockRes);
}	
?>	