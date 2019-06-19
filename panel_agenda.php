<?php

require 'conexion.php';

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />

		<title>Panther :: Agenda</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<link rel="stylesheet" href="assets/css/ace-fonts.css" />
		<link rel="stylesheet" href="assets/css/paneles_cita.css" />

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


<div class="contenedor_p">

    <?php 
    $sql = "SELECT vchNombrePaciente FROM TranAfiliado WHERE iCodPaciente = '$codigoPaciente'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class="header_title">
    	
      <p id="lblCita"> Citas de: <?php echo $row['vchNombrePaciente']; ?> </p>
    </div>
  <div id="contenedor">
      	 <button id="botonACita"> <a href="agenda_agregar.php?id=<?php echo base64_encode($codigoE)?>&co=<?php echo base64_encode($correo)?>&p=<?php echo base64_encode($pais)?>&e=<?php echo base64_encode($estado)?>&c=<?php echo base64_encode($ciudad)?>&codigo=<?php echo base64_encode($codigoPaciente) ?>"> Agregar <img src="https://img.icons8.com/office/24/000000/plus-math.png"> </a> </button> 

                    <table id="tbl_citas">
                    <tbody>

                    <thead id="thead_cita">
                        <tr id="tbl_header">
                            <th id="c_motivo">Descripción</th>
                            <th id="c_fechaC">Fecha</th>
                            <th id="c_horaC">Hora</th>
                            <th id="c_del"></th>
                        </tr>
                    </thead>
                <?php

                $query = "SELECT TC.iCalendario, TC.iCodPaciente, TA.Imagen, TA.vchNombrePaciente, TA.vchRaza, TA.vchNombre, TA.vchPaterno, TA.vchMaterno, TA.vchTelefono, TC.dtFecha, TC.vchTipoMotivo, TC.vchHora, TC.iCodEstado, TC.iCodServicio FROM (TranCalendario TC LEFT JOIN TranAfiliado TA ON TA.iCodPaciente = TC.iCodPaciente) WHERE TC.iCodPaciente = '$codigoPaciente' ORDER BY TC.dtFecha DESC";
              

    			$resultado = mysqli_query($conn,$query);
                while($fila = mysqli_fetch_assoc($resultado)){
                	
                        ?>
                <tr>
                    <td class="columnades"> <?php echo $fila['vchTipoMotivo'] ?></td>
                    <td class="columnaf"> <?php echo $fila['dtFecha'] ?> </td>
                    <td class="columnah"> <?php echo $fila['vchHora'] ?></td>
                    <td class="columnad"> <img src="https://img.icons8.com/ultraviolet/30/000000/delete.png"> </td>
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

