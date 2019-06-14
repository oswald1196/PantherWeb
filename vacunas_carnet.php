<?php

require 'conexion.php';

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />

		<title>Panther :: Vacunas</title>

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
	include('header.php');
?>

<p id="titulo-pagina">Vacunas</p> 

<div class="forma_principal">
<form class="form_add_cita" action="" method="POST">
    <?php 
    $sql = "SELECT vchNombrePaciente FROM TranAfiliado";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class="cabecera">
      <p id="lblCita"> Vacunas de: <?php echo $row['vchNombrePaciente']; ?> </p>
    </div>
  <div id="contenedor">
  		<div class="limiter">
        <div class="container-table100">
            <div class="wrap-table100">
                <div class="table100">
                    <table>
                    <tbody>

                    <thead>
                        <tr class="table100-head">
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Próxima</th>
                            <th>Peso</th>
                            <th>Teléfono</th>
                            <th>Cita</th>
                            <th>Lote</th>
                            <th>Caducidad</th>
                            <th></th>
                        </tr>
                    </thead>
                <?php
                $query = "SELECT TRV.iCodVacuna, TRV.iCodPaciente, TRV.sFecha, TRV.sVacunaAplicada, TRV.sVacunaProxima, TRV.sFechaProgramada, TRV.iCodServicio, TRV.sFechaCaducidad, TRV.iCodCuentaCliente, TRV.iCodProducto, TRV.iCodProductoLote, TRV.dNoTransaccionCloud, TC.iCodCalendario FROM TranRegistroVacunas AS TRV INNER JOIN TranCalendario TC ON TRV.iCodVacuna=TC.iCodCalendario WHERE TRV.iCodPaciente = '$codigoPaciente' ORDER BY iCodVacuna DESC";
    			$resultado = mysqli_query($conn,$query);
                while($fila = mysqli_fetch_assoc($resultado)){
                	
                        ?>
                <tr class="table100-head" >
                    <td class="column1"> <?php echo $fila['sFecha'] ?> </td>
                    <td class="column2"> <?php echo $fila['sVacunaAplicada'] ?> </td>
                    <td class="column3">".$fila['dtFecNacimiento']."</td>
                    <td class="column4">".$fila['vchNombre']." ".$fila['vchPaterno']." ".$fila['vchMaterno']."</td>
                    <td class="column5">".$fila['vchTelefono']." </td>
                    <td class="column6">".$fila['vchCorreoPaciente']." </td>
                </tr>
            <?php
        }
        ?>

              		</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>";
        <button class="boton" type="submit">Agregar</button>
  			
    </div>
</form>  
</div>  
</body>
</html>

