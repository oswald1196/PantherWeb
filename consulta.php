<?php
require 'conexion.php';

$tabla = "";
$query = "SELECT * FROM TranAfiliado WHERE iCodEmpresa = 2";

if(isset($POST['afiliado']))
{
	$q=$conn->mysqli_real_scape_string($POST['afiliado']);
	$query = "SELECT * FROM TranAfiliado WHERE
		vchRaza LIKE '%".$q."%' OR
		vchNombrePaciente LIKE '%".$q."%' OR
		vchNombre LIKE '%".$q."%' OR
		vchPaterno LIKE '%".$q."%' OR
		vchMaterno LIKE '%".$q."%' OR
		vchTelefono LIKE '%".$q."%' OR
		vchCorreoPaciente LIKE '%".$q."%' OR
		dtFecNacimiento LIKE '%".$q."%'";
}

$buscarMascotas = mysqli_query($conn,$query);

if (mysqli_num_rows($buscarMascotas) > 0)
{
	$tabla.=
    '<table width="70%" class="table table-dark table-striped table-responsive w-auto">
	<tr align="center">
        <td height="40px">Raza</td>
        <td>Nombre</td>
        <td>Nombre Propietario</td>
        <td>Telefono</td>
        <td>Correo</td>
        <td>F. Nacimiento</td>
    </tr>';

    while ($row = mysqli_fetch_array($buscarMascotas)) {
	$tabla.=
	'<tr class="success" align="center">
        <td height="100px">'.$row['vchRaza'].' </td>
        <td> '.$row['vchNombrePaciente'].' </td>
        <td> '.$row['vchNombre']." ".$row['vchPaterno'] ." ".$row['vchMaterno'].' </td>
        <td> '.$row['vchTelefono'].' </td>
        <td> '.$row['vchCorreoPaciente'].' </td>
        <td> '.$row['dtFecNacimiento'].' </td>

    </tr>';
    }

    $tabla.='<table>';

}
else {
	$tabla = "No se encontraron criterios de búsqueda";
}

echo $tabla;
?>