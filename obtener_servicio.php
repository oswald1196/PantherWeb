<?php
    include('conexion.php');

	$iCodTipoServicio = $_POST['iCodTipoServicio'];
    $codigo = json_decode($_POST['id']);

	$consulta = "SELECT iCodServicio, vchDescripcion FROM CatServicios WHERE iCodLaboratorio = '$iCodTipoServicio' AND iCodEmpresa = '$codigo' ORDER BY vchDescripcion ASC";
	$result = mysqli_query($conn,$consulta);
	$html = "<option value='0'>ELIGE EL SERVICIO</option>";
	while($row = $result->fetch_assoc()){
		$html .= "<option value='".$row['iCodServicio']."'>".$row['vchDescripcion']."</option>";
	}
	echo $html;
?>