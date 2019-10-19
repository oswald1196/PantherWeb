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
	$medico = $_POST['medico'];
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

    //DATOS MEDICO //
    $sqlMedico = "SELECT CONCAT(vchNombre, ' ', vchPaterno) AS vchNombreMedico FROM CatMedico WHERE iCodEmpresa = '$cEmpresa' AND iCodMedico = '$medico'";

	$eject = mysqli_query($conn,$sqlMedico);
    $med = mysqli_fetch_assoc($eject);

    $nombreMed = $med['vchNombreMedico'];

    if ($medico == 0){
        $nombreMed = "-";
    }

	$sql = "INSERT INTO TranCalendario (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodCalendario, iCodPaciente, dtFecha, vchTipoMotivo, vchHora, iCodEstado, iCodServicio, vchServicio, dtFechaFin, bCitaRecurrente, iFrecuencia, iNumFrecuencia, iDiaSemana, dtFechaFinRecurrente, iCodCita, iCodComentario, iCalendario, iEstatusServicio, iCodPropietario, iCodMedico, vchNombreMedico, iEnvioCloud, dNoTransaccionCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$codPaciente', '$fecha', '$sMotivo', '$horaIni', '1', '$codMotivo', '$servicio', '$fecha', '', '0', '0', '0', '1899-12-30', '0', '0', '0', '0', '$codPropietario', '$medico', '$nombreMed', '0', '0')";

	echo $sql;
	$resultado = mysqli_query($conn,$sql);


?>