<?php
    include('conexion.php');

	$iCodEspecie = $_POST['iCodEspecie'];
    $codigo = json_decode($_POST['id']);

	$consulta = "SELECT iCodRaza, vchRaza FROM CatRazas WHERE iCodEspecie = '$iCodEspecie' AND iCodEmpresa = '$codigo' ORDER BY vchRaza ASC";
	$result = mysqli_query($conn,$consulta);
	$html = "<option value='0'>SELECCIONAR RAZA</option>";
	while($row = $result->fetch_assoc()){
		$html .= "<option value='".$row['iCodRaza']."'>".$row['vchRaza']."</option>";
	}
	echo $html;
?>