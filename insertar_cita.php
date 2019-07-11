<?php
	require ('conexion.php');

	$correo = $_POST['correo'];
	$pais = $_POST['pais'];
	$estado = $_POST['estado'];
	$ciudad = $_POST['ciudad'];
	$cEmpresa = $_POST['empresa'];
	$codPaciente = $_POST['paciente'];
	$fecha = $_POST['fechaAgenda'];
	$horaIni = $_POST['horaInicio'];
	$codMotivo = $_POST['codigoMotivo'];
	$codPropietario = $_POST['propietario'];
	$nombrePaciente = $_POST['nombrePac'];
	$raza = $_POST['raza'];
	$nombrePropietario = $_POST['nombreProp'];
	$telefono = $_POST['telefono'];
    
    $consulta = "SELECT * FROM CatMotivos WHERE iCodEmpresa = '$cEmpresa' AND iCodMotivo = '$codMotivo'";
    $resultado = mysqli_query($conn,$consulta);
    $fila = mysqli_fetch_assoc($resultado);

    $sMotivo = $fila['vchMotivo'];

	$consulta = "SELECT CONCAT(vchNombrePaciente, '-', vchRaza, '-', vchNombre, '-', vchTelefono) AS vchServicio FROM TranAfiliado WHERE iCodEmpresa = '$cEmpresa' AND iCodPaciente = '$codPaciente'";

	$resultado = mysqli_query($conn,$consulta);
    $fila = mysqli_fetch_assoc($resultado);

    $servicio = $fila['vchServicio'];

	$sql = "INSERT INTO TranCalendario (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodCalendario, iCodPaciente, dtFecha, vchTipoMotivo, vchHora, iCodEstado, iCodServicio, vchServicio, dtFechaFin, bCitaRecurrente, iFrecuencia, iNumFrecuencia, iDiaSemana, dtFechaFinRecurrente, iCodCita, iCodComentario, iCalendario, iEstatusServicio, iCodPropietario, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$codPaciente', '$fecha', '$sMotivo', '$horaIni', '1', '$codMotivo', '$servicio', '$fecha', '', '0', '0', '0', '1899-12-30', '0', '0', '0', '0', '$codPropietario', '0', '0')";

	/*echo $sql;
	$resultado = mysqli_query($conn,$sql);
	header('Location: panel_agenda.php?id=($codigoE)&($codigoPaciente)?>');*/

?>