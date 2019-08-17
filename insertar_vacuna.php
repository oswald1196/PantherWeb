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
$iCodProp = $_POST['iCodProp'];
$laboratorio = $_POST['laboratorio'];
$lote = $_POST['lote'];
$costo = $_POST['precio'];
$caducidad = $_POST['fechaC'];
$horaIni = $_POST['horaCita'];
$peso = $_POST['peso'];
$cantidad = $_POST['cantidad'];

/*VALIDACIONES, CAMPOS VACIOS, CONSULTAS SIMPLES, ETC */
if (isset($_POST['chkCita']) == "on"){
	$chkCita = "true";
} else {
	$chkCita = "false";
} 

if (isset($_POST['chkAnteriores']) == "on"){
	$anterior = "true";
	$bAnterior = '1';
} else {
	$anterior = "false";
	$bAnterior = '0';
} 

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

$sql = "INSERT INTO TranRegistroVacunas (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodVacuna, iCodPaciente, sFecha, sVacunaAplicada, sNumeroLote, sProximaVacuna, sFechaProgramada, iCodLaboratorio, dPrecioMenudeo, dPrecioCosto, iCodServicio, iCodCuentaCliente, iCodProducto, iCodProductoLote, sFechaCaducidad, dCantidad, vchUnidadMedida, dIVA, dSubtotal, dPorcentajeIVA, bVacunasAnteriores, dPeso, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$codPaciente', '$fecha', '$nombreVacuna', '$vchLote', '$motivoP', '$fechaCita', '$laboratorio', '$costo', '$precioCosto', '$iCodServicio', '0', '$producto', '$lote', '$caducidad', '$cantidad', 'PZA.', '0', '0', '0', '$bAnterior', '$peso', '2', '0')";

/*STOCKS*/

$stock = "SELECT * FROM RelProductos WHERE iCodProductoLote = '$lote' AND iCodEmpresa = '$cEmpresa'";
$res = mysqli_query($conn,$stock);
$success = mysqli_fetch_assoc($res);

$cantidadActual = $success['dStockActual'];
$codlote = $success['iCodProductoLote'];

$cantidadTotal = $cantidadActual - $cantidad;

$newStock = "UPDATE RelProductos SET dStockActual = '$cantidadTotal' WHERE iCodProductoLote = '$lote'";

/************** FIN STOCKS *****************/

$insertCuenta = "INSERT INTO TranCuentasClientes (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodCuentaCliente, iCodTipoServicio, iCodPaciente, dtFecha, vchServicio, dPrecioCosto, dPrecioMenudeo, dDescuento, bEstatus, iCodPropietario, iCodCorteCuentaCliente, iCuentaLiquidada, dIVA, dSubtotal, dPorcentajeIVA, iCodCorteDia, iCodProducto, dCantidad, dCantidadUnidad, bExistenciaCero, iNumFolioFactura, iFactura, iCodHospitalizacion, dtFechaSalida, bSalida, dPrecioAntesPromocion, dPorcentajePromocion, vchCodigoPromocion, iCodProductoLote, iEnvioCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$iCodServicio', '$codPaciente', '$fecha', '$nombreVacuna', '$precioCosto', '$costo', '0', '0', '$iCodProp', '0', '0', '0','0','0','0', '$producto', '1', '0', '', '0','0', '0', '$fecha', '', '0', '0', '.', '$lote', '2')";

$consulta = "SELECT CONCAT(vchNombrePaciente, '-', vchRaza, '-', vchNombre, '-', vchTelefono) AS vchServicio FROM TranAfiliado WHERE iCodEmpresa = '$cEmpresa' AND iCodPaciente = '$codPaciente'";

$resultado = mysqli_query($conn,$consulta);
$fila = mysqli_fetch_assoc($resultado);

$servicio = $fila['vchServicio'];

$nuevaCita = "INSERT INTO TranCalendario (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodCalendario, iCodPaciente, dtFecha, vchTipoMotivo, vchHora, iCodEstado, iCodServicio, vchServicio, dtFechaFin, bCitaRecurrente, iFrecuencia, iNumFrecuencia, iDiaSemana, dtFechaFinRecurrente, iCodCita, iCodComentario, iCalendario, iEstatusServicio, iCodPropietario, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$codPaciente', '$fecha', '$motivoP', '$horaIni', '1', '1', '$servicio', '$fecha', '', '0', '0', '0', '1899-12-30', '0', '0', '0', '0', '$iCodProp', '0', '0')";

/*FIN VALIDACIONES, CAMPOS VACIOS, CONSULTAS SIMPLES, ETC */

/*Vacuna a carnet, a la cuenta y cita aplicada*/

if ($anterior == "false" and $chkCita == "true"){
	
	$nuevaVac = mysqli_query($conn,$sql);

	$cuentaVac = mysqli_query($conn,$insertCuenta);

	$citaVac = mysqli_query($conn,$nuevaCita);

	$actualizarStockLote = mysqli_query($conn,$newStock);

	$stockXProd = "SELECT SUM(dStockActual) AS StockActual FROM RelProductos WHERE iCodProducto = '$producto' AND iCodEmpresa = '$cEmpresa'";

	$newStockXProd = mysqli_query($conn,$stockXProd);
	$exito = mysqli_fetch_assoc($newStockXProd);

	$stockRes = $exito['StockActual'];

	$newStockRes = "UPDATE CatProductos SET dStockActual = '$stockRes' WHERE iCodProducto = '$producto' AND iCodEmpresa = '$cEmpresa'";
	
	$actualizarStockCat = mysqli_query($conn,$newStockRes);
}

/*Vacuna al carnet sin cita*/

elseif ($anterior == "true" and $chkCita == "false") {

	$nuevaVac = mysqli_query($conn,$sql);

}
/*Fin vacuna al carnet sin cita*/

/*Vacuna al carnet con cita*/

elseif($anterior == "true" and $chkCita == "true"){

	$nuevaVac = mysqli_query($conn,$sql);
	$citaVac = mysqli_query($conn,$nuevaCita);

}
/*FIN Vacuna al carnet con cita*/
else {
	$nuevaVac = mysqli_query($conn,$sql);
	$cuentaVac = mysqli_query($conn,$insertCuenta);
	$actualizarStockLote = mysqli_query($conn,$newStock);

	$stockXProd = "SELECT SUM(dStockActual) AS StockActual FROM RelProductos WHERE iCodProducto = '$producto' AND iCodEmpresa = '$cEmpresa'";

	$newStockXProd = mysqli_query($conn,$stockXProd);
	$exito = mysqli_fetch_assoc($newStockXProd);

	$stockRes = $exito['StockActual'];

	$newStockRes = "UPDATE CatProductos SET dStockActual = '$stockRes' WHERE iCodProducto = '$producto' AND iCodEmpresa = '$cEmpresa'";

	$actualizarStockCat = mysqli_query($conn,$newStockRes);
}
?>