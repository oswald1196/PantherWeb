<?php
include('conexion.php');

	$codigoEst = $_POST['codigoEstilista'];
	$matrizI = $_POST['MatrizI'];
	$fechaEst = $_POST['Fecha'];
    $codigo = json_decode($_POST['id']);

	$html = "";
    $existe = "";
    $fecha = "$fechaEst";
    $newDate = date("Y-m-d 00:00:00", strtotime($fecha));

    $consulta = "SELECT * FROM TranAgendaEstetica WHERE iCodMatrizIni = '$matrizI' AND dtFecha LIKE '$newDate' AND iCodEstilista  = '$codigoEst' AND iCodEmpresa = '$codigo'";

	$result = mysqli_query($conn,$consulta);
	$resultado = mysqli_num_rows($result);

	if($resultado >= 1){
		$existe = '1';
	}
	else {
		$existe = '0';
	}

	$html .= " ".$existe." ";

	echo $html;
?>