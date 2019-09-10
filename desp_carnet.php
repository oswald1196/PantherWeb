<?php

require 'conexion.php';
session_start();

if ($_SESSION["autenticado"] != "SI") {
  header("Location: index.html");
}
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
	$codigo = base64_decode($_GET['id']);
	$codigoPaciente = base64_decode($_GET['codigo']);
    $cMedico = base64_decode($_GET['cm']);

	include('header.php');
?>

<div class="forma_principalD">

    <?php 
    $sql = "SELECT vchNombrePaciente FROM TranAfiliado WHERE iCodPaciente = '$codigoPaciente'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class="cabeceraD">
    	
      <p id="lblCita"> Desparasitaciones de: <?php echo $row['vchNombrePaciente']; ?> </p>
    </div>
  <div id="contenedorD">
      	 <button class="botonAddVacunaD"> <a href="desparasitacion.php?id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>"> Agregar <img id="simbolo_addD" src="https://img.icons8.com/office/24/000000/plus-math.png"> </a> </button> 

                    <table id="carnet_vacunaD">
                    <tbody>

                    <thead id="cabecera_tablaD">
                        <tr>
                            <th id="c_fechaD">Fecha</th>
                            <th id="c_descripcionD">Descripción</th>
                            <th id="c_proximaD">Próxima</th>
                            <th id="c_pesoD">Peso</th>
                            <th id="c_citaD">Cita</th>
                            <th id="c_loteD">Lote</th>
                            <th id="c_cadD">Caducidad</th>
                            <th id="c_delD"></th>
                        </tr>
                    </thead>
                <?php
                  /*$query = "SELECT DISTINCT TD.iCodTranDesparacitacion, TD.sProductoAplicado, CM.vchMarca, TD.sNumeroLote, TD.sFecha, TD.sFechaCaducidad, TD.sObservaciones, TD.sFechaProxima, TD.dPeso FROM TranDesparacitacion TD INNER JOIN CatMarcas CM On CM.iCodMarca = TD.iCodLaboratorio WHERE iCodPaciente = '$codigoPaciente' ORDER BY iCodDesparacitacion DESC";*/

                  $query = "SELECT iCodTranDesparacitacion, sProductoAplicado, sNumeroLote, sFecha, sFechaCaducidad, sObservaciones, sFechaProxima, dPeso FROM TranDesparacitacion WHERE iCodPaciente = '$codigoPaciente' ORDER BY iCodDesparacitacion DESC";

    			$resultado = mysqli_query($conn,$query);
                while($fila = mysqli_fetch_assoc($resultado)){
                	
                        ?>
                <tr>
                    <td class="columna1D"> <?php echo $fila['sFecha'] ?></td>
                    <td class="columna2D"> <?php echo $fila['sProductoAplicado'] ?> </td>
                    <td class="columna3D"> <?php echo $fila['sObservaciones'] ?></td>
                    <td class="columna4D"> <?php echo $fila['dPeso'] ?></td>
                    <td class="columna5D"> <?php echo $fila['sFechaProxima'] ?></td>
                    <td class="columna6D"> <?php echo $fila['sNumeroLote'] ?> </td>
                    <td class="columna7D"> <?php echo $fila['sFechaCaducidad'] ?> </td>
                    <td class="columna8D"> <a href="eliminar_desp.php?idD=<?php echo $fila['iCodTranDesparacitacion']?>&id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>" onclick="return alert_eliminarDesp();"> <img src="https://img.icons8.com/ultraviolet/30/000000/delete.png"> </a> </td>
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

