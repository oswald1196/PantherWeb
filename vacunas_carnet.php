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

		<title>Panther :: Vacunas</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<link rel="stylesheet" href="assets/css/ace-fonts.css" />
		<link rel="stylesheet" href="assets/css/preventivos_carnet.css" />

		<link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

	</head>

	<body>

<?php
	$codigo = base64_decode($_GET['id']);
	$codigoPaciente = base64_decode($_GET['codigo']);
    $cMedico = base64_decode($_GET['cm']);
    $fecha_actual = date("Y-m-d");
    date_default_timezone_set('America/Bogota');

	include('header.php');
?>


<div class="forma_principal">

    <?php 
    $sql = "SELECT vchNombrePaciente FROM TranAfiliado WHERE iCodPaciente = '$codigoPaciente'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class="cabecera">
    	
      <p id="lblCita"> Vacunas de: <?php echo $row['vchNombrePaciente']; ?> </p>
      <input type="text" name="" id="fechaActual" value="<?php echo $fecha_actual?>">

    </div>
  <div id="contenedor">
      	 <button class="botonAddVacuna"> <a href="vacuna.php?id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>"> Agregar <img id="simbolo_add" src="https://img.icons8.com/office/24/000000/plus-math.png"> </a> </button> 

                    <table id="carnet_vacuna">
                    <tbody>

                    <thead>
                        <tr id="cabecera_tabla">
                            <th id="c_fecha">Fecha</th>
                            <th id="c_descripcion">Descripción</th>
                            <th id="c_proxima">Próxima</th>
                            <th id="c_peso">Peso</th>
                            <th id="c_cita">Cita</th>
                            <th id="c_lote">Lote</th>
                            <th id="c_cad">Caducidad</th>
                            <th id="c_del"></th>
                        </tr>
                    </thead>
                <?php

                $query = "SELECT DISTINCT TRV.iCodTranRegistroVacunas, TRV.sVacunaAplicada, CM.vchMarca, TRV.sNumeroLote, TRV.sFecha, TRV.sFechaCaducidad, TRV.sProximaVacuna, TRV.sFechaProgramada, TRV.dPeso FROM TranRegistroVacunas TRV INNER JOIN CatMarcas CM On CM.iCodMarca = TRV.iCodLaboratorio WHERE iCodPaciente = '$codigoPaciente' AND CM.iCodEmpresa = '$codigo' ORDER BY iCodVacuna DESC";
    			$resultado = mysqli_query($conn,$query);
                while($fila = mysqli_fetch_assoc($resultado)){
                	
                        ?>
                <tr>
                    <td class="columna1" id="fecha"> <?php echo date("Y-m-d",strtotime($fila['sFecha'])); ?></td>
                    <td class="columna2"> <?php echo $fila['sVacunaAplicada'] ?> </td>
                    <td class="columna3"> <?php echo $fila['sProximaVacuna'] ?></td>
                    <td class="columna4"> <?php echo $fila['dPeso'] ?></td>
                    <td class="columna5"> <?php echo date("Y-m-d",strtotime($fila['sFechaProgramada'])); ?></td>
                    <td class="columna6"> <?php echo $fila['sNumeroLote'] ?> </td>
                    <td class="columna7"> <?php echo date("Y-m-d",strtotime($fila['sFechaCaducidad']));?> </td>
                    <td class="columna8"> <a onclick=" return alert_fecha();" href="eliminar_vacuna.php?idD=<?php echo $fila['iCodTranRegistroVacunas'] ?>&id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>" onclick="return alert_eliminarVacuna();"> <img id="simbolo_add" src="https://img.icons8.com/ultraviolet/30/000000/delete.png"> </a> </td>
                </tr>
            <?php
      			}
        ?>
        <script type="text/javascript">
        function alert_eliminarVacuna(){
            var respuesta = confirm("Estás seguro de eliminar la vacuna?");
            if (respuesta == true) {
                return true;
            } else {
                return false;
            }
        }

        function alert_fecha(){
                    var fecha_tabla = document.getElementById("fecha").innerHTML;
                    alert(fecha_tabla);
                    var fecha_actual = document.getElementById("fechaActual").value;
                    alert(fecha_actual);
                        if (fecha_actual > fecha_tabla){
                            Swal.fire({
                                type:'error',
                                title:'ERROR',
                                text:'IMPOSIBLE BORRAR UN SERVICIO DE DÍAS ANTERIORES'
                            });
                            return false;
                        }
                        return true;
                    }
          
        </script>

              		</tbody>
                    </table>
                </div>
  			
    </div>
</body>
</html>

