<?php
include('conexion.php');

	$nombrePaciente = $_POST['nombrePaciente'];
	$especie = $_POST['especie'];
	$raza = $_POST['raza'];
	$telefono = $_POST['telefono'];
    $codigo = json_decode($_POST['id']);

    $getRaza = "SELECT vchRaza FROM CatRazas WHERE iCodRaza = '$raza'";
	
	$consulRaza = mysqli_query($conn,$getRaza);
    $row = mysqli_fetch_assoc($consulRaza);

    $nombreRaza = $row['vchRaza'];
	$html = "";
    $existe = "";

    $consulta = "SELECT * FROM TranAfiliado WHERE vchNombrePaciente = '$nombrePaciente' AND iCodEspecie = '$especie' AND vchRaza = '$nombreRaza' AND vchTelefono = '$telefono' AND iCodEmpresa = '$codigo'";

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