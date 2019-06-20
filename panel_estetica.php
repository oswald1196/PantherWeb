<?php

require 'conexion.php';

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />

		<title>Panther :: Estética</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<link rel="stylesheet" href="assets/css/ace-fonts.css" />
		<link rel="stylesheet" href="assets/css/panel_estetica.css" />

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


<div class="contenedor_est">

    <?php 
    $sql = "SELECT vchNombrePaciente FROM TranAfiliado WHERE iCodPaciente = '$codigoPaciente'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class="header_titleE">
    	
      <p id="lblCita"> Estéticas de: <?php echo $row['vchNombrePaciente']; ?> </p>
    </div>
  <div id="contenedor_citas">
      	 <button class="botonAEst"> <a href="agenda_agregar.php?id=<?php echo base64_encode($codigoE)?>&co=<?php echo base64_encode($correo)?>&p=<?php echo base64_encode($pais)?>&e=<?php echo base64_encode($estado)?>&c=<?php echo base64_encode($ciudad)?>&codigo=<?php echo base64_encode($codigoPaciente) ?>"> Agregar <img src="https://img.icons8.com/office/24/000000/plus-math.png"> </a> </button> 

                    <table id="tbl_estetica">
                    <tbody>

                    <thead id="thead_estetica">
                        <tr id="tbl_headerE">
                            <th id="c_fechaE">Fecha</th>
                            <th id="c_motivoE">Descripción</th>
                            <th id="c_horaE">Hora</th>
                            <th id="c_precio">Precio</th>
                            <th id="c_notas">Notas</th>
                            <th id="c_borrar"></th>
                            <th id="c_estado">Estado</th>
                        </tr>
                    </thead>
                <?php

                $query = "SELECT TA.iCodAgenda, TA.iCodPaciente, TA.iCodServicio, TA.dtFecha, TA.dtHoraIni, TA.dtHoraFin, TA.dPrecio, IF(TA.iCodEstatus = 1, 'PENDIENTE', 'TERMINADA') As vchEstatus, TA.iCodEstatus, TA.vchDescripcion, TA.vchObservaciones FROM TranAgendaEstetica TA INNER JOIN CatServicios CS ON TA.iCodServicio = CS.iCodServicio WHERE iCodPaciente = '$codigoPaciente' ORDER BY dtFecha DESC";
              

    			$resultado = mysqli_query($conn,$query);
                while($fila = mysqli_fetch_assoc($resultado)){
                	
                        ?>
                <tr>
                    <td class="columnades"> <?php echo $fila['dtFecha'] ?></td>
                    <td class="columnades"> <?php echo $fila['vchDescripcion'] ?></td>
                    <td class="columnades"> <?php echo $fila['dtHoraIni'] ?></td>
                    <td class="columnades"> <?php echo $fila['dPrecio'] ?></td>
                    <td class="columnaf"> <?php echo $fila['vchObservaciones'] ?> </td>
                    <td class="columnad"> <img src="https://img.icons8.com/ultraviolet/30/000000/delete.png"> </td>
                    <td class="columnah"> <?php echo $fila['vchEstatus'] ?></td>
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

