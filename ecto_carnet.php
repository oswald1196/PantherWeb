<?php

require 'conexion.php';

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />

		<title>Panther :: Ectoparásitos</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<link rel="stylesheet" href="assets/css/ace-fonts.css" />
		<link rel="stylesheet" href="assets/css/preventivos_ecto.css" />

		<link rel="stylesheet" href="assets/css/ace.min.css" />

	</head>

	<body>

<?php
	$codigoE = base64_decode($_GET['id']);
	$codigoPaciente = base64_decode($_GET['codigo']);
	include('header.php');
?>


<div class="forma_principalE">

    <?php 
    $sql = "SELECT vchNombrePaciente FROM TranAfiliado WHERE iCodPaciente = '$codigoPaciente'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class="cabeceraE">
    	
      <p id="lblCita"> Ectoparásitos de: <?php echo $row['vchNombrePaciente']; ?> </p>
    </div>
  <div id="contenedor">
      	 <button class="botonAddEcto"> <a href="ectoparasito.php?id=<?php echo base64_encode($codigoE)?>&codigo=<?php echo base64_encode($codigoPaciente) ?>"> Agregar <img id="simbolo_addE" src="https://img.icons8.com/office/24/000000/plus-math.png"> </a> </button> 

                    <table id="carnet_ecto">
                    <tbody>

                    <thead>
                        <tr id="cabecera_tablaE">
                            <th id="c_fechaD">Fecha</th>
                            <th id="c_descripcionD">Descripción</th>
                            <th id="c_proximaD">Próxima</th>
                            <th id="c_citaD">Cita</th>
                            <th id="c_loteD">Lote</th>
                            <th id="c_cadD">Caducidad</th>
                            <th></th>
                        </tr>
                    </thead>
                <?php

                $query = "SELECT DISTINCT TE.iCodTranHecto, TE.sProductoAplicado, CL.vchDescripcion, TE.sNumeroLote, TE.sFecha, TE.sFechaCaducidad, TE.sObservaciones, TE.sFechaProxima FROM TranHecto TE INNER JOIN CatLaboratorios CL On CL.iCodLaboratorio = TE.iCodLaboratorio WHERE iCodPaciente = '$codigoPaciente' ORDER BY iCodHecto DESC";

    			$resultado = mysqli_query($conn,$query);
                while($fila = mysqli_fetch_assoc($resultado)){
                	
                        ?>
                <tr>
                    <td class="columna1E"> <?php echo $fila['sFecha'] ?></td>
                    <td class="columna2E"> <?php echo $fila['sProductoAplicado'] ?> </td>
                    <td class="columna3E"> <?php echo $fila['sObservaciones'] ?></td>
                    <td class="columna5E"> <?php echo $fila['sFechaProxima'] ?></td>
                    <td class="columna6E"> <?php echo $fila['sNumeroLote'] ?> </td>
                    <td class="columna7E"> <?php echo $fila['sFechaCaducidad'] ?> </td>
                    <td class="columna8E"> <a href="eliminar_ecto.php?id=<?php echo $fila['iCodTranHecto'] ?>" onclick="return alert_eliminarEcto();"> <img src="https://img.icons8.com/ultraviolet/30/000000/delete.png"> </td>
                </tr>
            <?php
      			}
        ?>
        <script type="text/javascript">
        function alert_eliminarEcto(){
            var respuesta = confirm("Estás seguro de eliminar el ectoparásito?");
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

