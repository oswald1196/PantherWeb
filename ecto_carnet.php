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

  <title>Panther :: Ectoparásitos</title>

  <meta name="description" content="User login page" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/font-awesome.min.css" />

  <link rel="stylesheet" href="assets/css/ace-fonts.css" />
  <link rel="stylesheet" href="assets/css/preventivos_ecto.css" />

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


    <div class="forma_principalE">

        <?php 
        $sql = "SELECT vchNombrePaciente FROM TranAfiliado WHERE iCodPaciente = '$codigoPaciente'";
        $query = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($query);
        ?>
        <div class="cabeceraE">

          <p id="lblCita"> Ectoparásitos de: <?php echo $row['vchNombrePaciente']; ?> </p>
          <input type="text" name="" id="fechaActual" value="<?php echo $fecha_actual?>">

      </div>
      <div id="contenedor">
        <button class="botonAddEcto"> <a href="ectoparasito.php?id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>"> Agregar <img id="simbolo_addE" src="https://img.icons8.com/office/24/000000/plus-math.png"> </a> </button> 

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

                $query = "SELECT iCodTranHecto, sProductoAplicado, sNumeroLote, sFecha, sFechaCaducidad, sObservaciones, sFechaProxima FROM TranHecto WHERE iCodPaciente = '$codigoPaciente' ORDER BY iCodHecto DESC";

                $resultado = mysqli_query($conn,$query);
                while($fila = mysqli_fetch_assoc($resultado)){
                	
                    ?>
                    <tr>
                        <td class="columna1E" id="fecha"> <?php echo date("Y-m-d",strtotime($fila['sFecha'])); ?></td>
                        <td class="columna2E"> <?php echo $fila['sProductoAplicado'] ?> </td>
                        <td class="columna3E"> <?php echo $fila['sObservaciones'] ?></td>
                        <td class="columna5E"> <?php echo date("Y-m-d",strtotime($fila['sFechaProxima'])); ?></td>
                        <td class="columna6E"> <?php echo $fila['sNumeroLote'] ?> </td>
                        <td class="columna7E"> <?php echo date("Y-m-d",strtotime($fila['sFechaCaducidad'])); ?> </td>
                        <td class="columna8E"> <a onclick=" return alert_fecha();" href="eliminar_ecto.php?idD=<?php echo $fila['iCodTranHecto'] ?>&id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>" onclick="return alert_eliminarEcto();"> <img src="https://img.icons8.com/ultraviolet/30/000000/delete.png"> </td>
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

