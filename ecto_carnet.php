<?php

require 'conexion.php';

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />

		<title>Panther :: Desparasitaciones</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<link rel="stylesheet" href="assets/css/ace-fonts.css" />
		<link rel="stylesheet" href="assets/css/preventivos_carnet.css" />

		<link rel="stylesheet" href="assets/css/ace.min.css" />

	</head>

	<body>

<?php
	$codigoE = base64_decode($_GET['id']);
	$codigoPaciente = base64_decode($_GET['codigo']);
	$correo = base64_decode($_GET['co']);
	$pais = base64_decode($_GET['p']);
	$estado = base64_decode($_GET['e']);
	$ciudad = base64_decode($_GET['c']);

	include('header.php');
?>


<div class="forma_principal">

    <?php 
    $sql = "SELECT vchNombrePaciente FROM TranAfiliado WHERE iCodPaciente = '$codigoPaciente'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class="cabecera">
    	
      <p id="lblCita"> Ectoparásitos de: <?php echo $row['vchNombrePaciente']; ?> </p>
    </div>
  <div id="contenedor">
      	 <button class="botonAddVacuna"> <a href="desparasitacion.php?id=<?php echo base64_encode($codigoE)?>&co=<?php echo base64_encode($correo)?>&p=<?php echo base64_encode($pais)?>&e=<?php echo base64_encode($estado)?>&c=<?php echo base64_encode($ciudad)?>&codigo=<?php echo base64_encode($codigoPaciente) ?>"> Agregar <img src="https://img.icons8.com/office/24/000000/plus-math.png"> </a> </button> 

                    <table id="carnet_vacuna">
                    <tbody>

                    <thead>
                        <tr id="cabecera_tabla">
                            <th id="c_fecha">Fecha</th>
                            <th id="c_descripcion">Descripción</th>
                            <th id="c_proxima">Próxima</th>
                            <th id="c_cita">Cita</th>
                            <th id="c_lote">Lote</th>
                            <th id="c_cad">Caducidad</th>
                            <th></th>
                        </tr>
                    </thead>
                <?php
                //$query = "SELECT DISTINCT TRV.iCodVacuna, TRV.iCodPaciente, TRV.sFecha, TRV.sVacunaAplicada, TRV.sProximaVacuna, TRV.sFechaProgramada, TRV.iCodServicio, TRV.iCodProductoLote, TRV.dPeso, TRV.sFechaCaducidad, TRV.iCodCuentaCliente, TRV.iCodProducto, TRV.iCodProductoLote, TRV.dNoTransaccionCloud, TC.iCodCalendario FROM TranRegistroVacunas AS TRV INNER JOIN TranCalendario TC ON TRV.iCodVacuna=TC.iCodCalendario WHERE TRV.iCodPaciente = '$codigoPaciente' ORDER BY iCodVacuna DESC";

                $query = "SELECT DISTINCT TE.sProductoAplicado, CL.vchDescripcion, TE.sNumeroLote, TE.sFecha, TE.sFechaCaducidad, TE.sObservaciones, TE.sFechaProxima FROM TranHecto TE INNER JOIN CatLaboratorios CL On CL.iCodLaboratorio = TE.iCodLaboratorio WHERE iCodPaciente = '$codigoPaciente' ORDER BY iCodHecto DESC";

    			$resultado = mysqli_query($conn,$query);
                while($fila = mysqli_fetch_assoc($resultado)){
                	
                        ?>
                <tr>
                    <td class="columna1"> <?php echo $fila['sFecha'] ?></td>
                    <td class="columna2"> <?php echo $fila['sProductoAplicado'] ?> </td>
                    <td class="columna3"> <?php echo $fila['sObservaciones'] ?></td>
                    <td class="columna5"> <?php echo $fila['sFechaProxima'] ?></td>
                    <td class="columna6"> <?php echo $fila['sNumeroLote'] ?> </td>
                    <td class="columna7"> <?php echo $fila['sFechaCaducidad'] ?> </td>
                    <td class="columna8"> <img src="https://img.icons8.com/ultraviolet/30/000000/delete.png"> </td>
                </tr>
            <?php
      			}
        ?>

              		</tbody>
                    </table>
                </div>
  			
    </div>
</body>
</html>

