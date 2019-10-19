<?php
require ('conexion.php');

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
$service = $_POST['codigoServicio'];
$medico = $_POST['medico'];

/************ STOCK ****************/
$stock = "SELECT * FROM RelProductos WHERE iCodProductoLote = '$lote' AND iCodEmpresa = '$cEmpresa'";
$res = mysqli_query($conn,$stock);
$success = mysqli_fetch_assoc($res);

$cantidadActual = $success['dStockActual'];
$codlote = $success['iCodProductoLote'];

$cantidadTotal = $cantidadActual - $cantidad;

$newStock = "UPDATE RelProductos SET dStockActual = '$cantidadTotal' WHERE iCodProductoLote = '$lote'";

/************ FIN STOCK ***********/
if (isset($_POST['pCita']) == "on"){
	$chkCita = "true";
} else {
	$chkCita = "false";
} 

if (isset($_POST['anterior']) == "on"){
	$anterior = "true";
	$dAnterior = '1';
} else {
	$anterior = "false";
	$dAnterior = '0';
} 

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
$iCodProp = $newPac['iCodPropietario'];

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

$sql = "INSERT INTO TranDesparacitacion (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodDesparacitacion, iCodPaciente, sFecha, sProductoAplicado, sFechaProxima, sObservaciones, iCodLaboratorio, dPrecioMenudeo, dPrecioCosto, iCodServicio, iCodCuentaCliente, iCodProducto, iCodProductoLote, sNumeroLote, sFechaCaducidad, dCantidad, vchUnidadMedida, vchServicio, dIVA, dSubtotal, dPorcentajeIVA, bDesparasitacionesAnteriores, dPeso, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$codPaciente', '$fecha', '$nombreDesp', '$fechaCita', '$motivoP', '0', '$precioVenta', '$precioCosto', '$iCodServicio', '0', '$codigoDesp', '$lote', '$nombreLote', '$caducidad', '$cantidad', 'PZA.', '$motivoP', '0', '0', '0', '$dAnterior', '$peso', '2', '0')";

$consultaServ = "SELECT vchDescripcion FROM CatServicios WHERE iCodEmpresa = '$cEmpresa' AND iCodServicio = '$service'";
$eject = mysqli_query($conn,$consultaServ);
$servicioNombre = mysqli_fetch_assoc($eject);

$nService = $servicioNombre['vchDescripcion'];

$insertCuentaDG = "INSERT INTO TranCuentasClientes (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodCuentaCliente, iCodTipoServicio, iCodPaciente, dtFecha, vchServicio, dPrecioCosto, dPrecioMenudeo, dDescuento, bEstatus, iCodPropietario, iCodCorteCuentaCliente, iCuentaLiquidada, dIVA, dSubtotal, dPorcentajeIVA, iCodCorteDia, iCodProducto, dCantidad, dCantidadUnidad, bExistenciaCero, iNumFolioFactura, iFactura, iCodHospitalizacion, dtFechaSalida, bSalida, dPrecioAntesPromocion, dPorcentajePromocion, vchCodigoPromocion, iCodProductoLote, iEnvioCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$iCodServicio', '$codPaciente', '$fecha', '$nService', '$precioCosto', '$precioVenta', '0', '0', '$iCodProp', '0', '0', '0', '0', '0', '0', '$codigoDesp', '1', '0', '', '0', '0', '0', '$fecha', '', '0', '0', '.', '$lote', '2')";

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

$nuevaCitaDespG = "INSERT INTO TranCalendario (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodCalendario, iCodPaciente, dtFecha, vchTipoMotivo, vchHora, iCodEstado, iCodServicio, vchServicio, dtFechaFin, bCitaRecurrente, iFrecuencia, iNumFrecuencia, iDiaSemana, dtFechaFinRecurrente, iCodCita, iCodComentario, iCalendario, iEstatusServicio, iCodPropietario, iCodMedico, vchNombreMedico, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$codPaciente', '$fecha', '$motivoP', '$horaIni', '1', '1', '$servicio', '$fecha', '', '0', '0', '0', '1899-12-30', '0', '0', '0', '0', '$iCodProp', '$medico', '$nombreMed', '0', '0')";

echo $nuevaCitaDespG;

if ($anterior == "false" and $chkCita == "true"){
	
	$nuevaDesp = mysqli_query($conn,$sql);
	$nuevaCuentaD = mysqli_query($conn,$insertCuentaDG);
	$nuevaCitaD = mysqli_query($conn,$nuevaCitaDespG);
	$stockRel = mysqli_query($conn,$newStock);

	$stockXProd = "SELECT SUM(dStockActual) AS StockActual FROM RelProductos WHERE iCodProducto = '$codigoDesp' AND iCodEmpresa = '$cEmpresa'";

	$resultado = mysqli_query($conn,$stockXProd);
	$exito = mysqli_fetch_assoc($resultado);

	$stockRes = $exito['StockActual'];

	$newStockRes = "UPDATE CatProductos SET dStockActual = '$stockRes' WHERE iCodProducto = '$codigoDesp' AND iCodEmpresa = '$cEmpresa'";

	$stockCat = mysqli_query($conn,$newStockRes);
	
}

/*Vacuna al carnet sin cita*/

	elseif ($anterior == "true" and $chkCita == "false") {

	$nuevaDesp = mysqli_query($conn,$sql);
	}
	/*Fin vacuna al carnet sin cita*/

	/*Vacuna al carnet con cita*/

	elseif($anterior == "true" and $chkCita == "true"){

	$nuevaDesp = mysqli_query($conn,$sql);	
	$nuevaCitaD = mysqli_query($conn,$nuevaCitaDespG);
	}
	/*FIN Vacuna a la cuenta sin cita*/
	else {

	$nuevaDesp = mysqli_query($conn,$sql);	
	$nuevaCuentaD = mysqli_query($conn,$insertCuentaDG);
	$stockRel = mysqli_query($conn,$newStock);

	$stockXProd = "SELECT SUM(dStockActual) AS StockActual FROM RelProductos WHERE iCodProducto = '$codigoDesp' AND iCodEmpresa = '$cEmpresa'";

	$resultado = mysqli_query($conn,$stockXProd);
	$exito = mysqli_fetch_assoc($resultado);

	$stockRes = $exito['StockActual'];

	$newStockRes = "UPDATE CatProductos SET dStockActual = '$stockRes' WHERE iCodProducto = '$codigoDesp' AND iCodEmpresa = '$cEmpresa'";

	$stockCat = mysqli_query($conn,$newStockRes);
		}
?>