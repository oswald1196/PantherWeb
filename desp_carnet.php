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

	include('header.php');
?>

<div class="forma_principal">

    <?php 
    $sql = "SELECT vchNombrePaciente FROM TranAfiliado WHERE iCodPaciente = '$codigoPaciente'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class="cabecera">
    	
      <p id="lblCita"> Desparasitaciones de: <?php echo $row['vchNombrePaciente']; ?> </p>
    </div>
  <div id="contenedor">
      	 <button class="botonAddVacuna"> <a href="desparasitacion.php?id=<?php echo base64_encode($codigoE)?>&codigo=<?php echo base64_encode($codigoPaciente) ?>"> Agregar <img src="https://img.icons8.com/office/24/000000/plus-math.png"> </a> </button> 

                    <table id="carnet_vacuna">
                    <tbody>

                    <thead id="contenedor_cabecera">
                        <tr id="cabecera_tabla">
                            <th id="c_fecha">Fecha</th>
                            <th id="c_descripcion">Descripción</th>
                            <th id="c_proxima">Próxima</th>
                            <th id="c_peso">Peso</th>
                            <th id="c_cita">Cita</th>
                            <th id="c_lote">Lote</th>
                            <th id="c_cad">Caducidad</th>
                            <th></th>
                        </tr>
                    </thead>
                <?php
                  $query = "SELECT DISTINCT TD.iCodTranDesparacitacion, TD.sProductoAplicado, CL.vchDescripcion, TD.sNumeroLote, TD.sFecha, TD.sFechaCaducidad, TD.sObservaciones, TD.sFechaProxima, TD.dPeso FROM TranDesparacitacion TD INNER JOIN CatLaboratorios CL On CL.iCodLaboratorio = TD.iCodLaboratorio WHERE iCodPaciente = '$codigoPaciente' ORDER BY iCodDesparacitacion DESC";

    			$resultado = mysqli_query($conn,$query);
                while($fila = mysqli_fetch_assoc($resultado)){
                	
                        ?>
                <tr>
                    <td class="columna1"> <?php echo $fila['sFecha'] ?></td>
                    <td class="columna2"> <?php echo $fila['sProductoAplicado'] ?> </td>
                    <td class="columna3"> <?php echo $fila['sObservaciones'] ?></td>
                    <td class="columna4"> <?php echo $fila['dPeso'] ?></td>
                    <td class="columna5"> <?php echo $fila['sFechaProxima'] ?></td>
                    <td class="columna6"> <?php echo $fila['sNumeroLote'] ?> </td>
                    <td class="columna7"> <?php echo $fila['sFechaCaducidad'] ?> </td>
                    <td class="columna8"> <a href="eliminar_desp.php?id=<?php echo $fila['iCodTranDesparacitacion'] ?>" onclick="return alert_eliminarDesp();"> <img src="https://img.icons8.com/ultraviolet/30/000000/delete.png"> </a> </td>
                </tr>
            <?php
      			}
        ?>

        <script type="text/javascript">
        function alert_eliminarDesp(){
            var respuesta = confirm("Estás seguro de eliminar la desparasitacion?");
            if (respuesta == true) {
                return true;
            } else {
                return false;
            }
        }
          
        </script>


              		</tbody>
                    </table>
                </div>
  			
    </div>
</body>
</html>

