<?php
	require ('conexion.php');

	$correo = $_POST['correo'];
	$pais = $_POST['pais'];
	$estado = $_POST['estado'];
	$ciudad = $_POST['ciudad'];
	$cEmpresa = $_POST['empresa'];
	$codPaciente = $_POST['paciente'];
	$codEspecie = $_POST['especie'];
	$raza = $_POST['raza'];
	$codProp = $_POST['propietario'];
	$iCodServicio = $_POST['codigoServicio'];
	$fecha = $_POST['fechaEst'];
	$horaInicio = $_POST['horaInicio'];
	$horaFin = $_POST['horaFin'];
	$notas = $_POST['notas'];
	$estilista = $_POST['estilista'];
	$precio = $_POST['precioServicio'];

	//Obtener codigo de raza
	$consulta = "SELECT iCodRaza FROM CatRazas WHERE vchRaza = '$raza' AND iCodEmpresa = '$cEmpresa'";
	
	$resultado = mysqli_query($conn,$consulta);
    $fila = mysqli_fetch_assoc($resultado);

    $codigoRaza = $fila['iCodRaza'];

	//Obtener codigo de estilista
    $query = "SELECT vchNombre FROM CatEstilistas WHERE iCodEmpresa = '$cEmpresa' AND iCodEstilista = '$estilista'";

    $result = mysqli_query($conn,$query);
    $fila = mysqli_fetch_assoc($result);

    $nombreEst = $fila['vchNombre'];

	//$sql = "INSERT INTO TranAgendaEstetica (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodAgenda, iCodPaciente, iCodEspecie, iCodRaza, iCodPropietario, iCodServicio, dtFecha, dtHoraIni, dtHoraFin, vchObservaciones, iCodMatrizIni, iCodMatrizFin, iCodEstatus, iCodEstilista, vchNombre, iCodServicioPago, vchDescripcion, dPrecio, dPrecioCosto, iCodServicios, iCodUrgencias, iEstatusServicio, dIVA, dSubtotal, dPorcentajeIVA, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$codPaciente', '$codEspecie', '$codigoRaza', '$codProp', '$iCodServicio', '$fecha', '$horaInicio', '$horaFin', '$notas', '0', '0', '1', '$estilista', '$nombreEst', '$producto', '0', '$precio', '0', '0', '0', '0', '0', '0', '0', '0')";

?>