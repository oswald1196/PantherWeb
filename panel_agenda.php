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

  <title>Panther :: Agenda</title>

  <meta name="description" content="User login page" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/font-awesome.min.css" />

  <link rel="stylesheet" href="assets/css/ace-fonts.css" />
  <link rel="stylesheet" href="assets/css/paneles_cita.css" />

  <link rel="stylesheet" href="assets/css/ace.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
  <link rel="stylesheet" href="dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

</head>

<body>

    <?php
    $codigo = base64_decode($_GET['id']);
    $cMedico = base64_decode($_GET['cm']);
    $codigoPaciente = base64_decode($_GET['codigo']);
    $fecha_actual = date("Y-m-d");
    date_default_timezone_set('America/Bogota');

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
          <input type="text" name="" id="fechaActual" value="<?php echo $fecha_actual?>">

      </div>
      <div id="contenedor">
        <button id="botonACita"> <a href="agenda_agregar.php?id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>"> Agregar <img src="https://img.icons8.com/office/24/000000/plus-math.png"> </a> </button> 

        <table id="tbl_citas">
            <tbody>

                <thead id="tbl_header">
                    <tr >
                        <th id="c_motivo">Descripción</th>
                        <th id="c_fechaC">Fecha</th>
                        <th id="c_horaC">Hora</th>
                        <th id="c_del"></th>
                    </tr>
                </thead>
                <?php

                $query = "SELECT TC.iCodTranCalendario, TC.iCalendario, TC.iCodPaciente, TA.Imagen, TA.vchNombrePaciente, TA.vchRaza, TA.vchNombre, TA.vchPaterno, TA.vchMaterno, TA.vchTelefono, TC.dtFecha, TC.vchTipoMotivo, TC.vchHora, TC.iCodEstado, TC.iCodServicio FROM (TranCalendario TC LEFT JOIN TranAfiliado TA ON TA.iCodPaciente = TC.iCodPaciente) WHERE TC.iCodPaciente = '$codigoPaciente' ORDER BY TC.dtFecha DESC";


                $resultado = mysqli_query($conn,$query);
                while($fila = mysqli_fetch_assoc($resultado)){
                	
                    ?>
                    <tr id="registro">
                        <td class="columnades"> <?php echo $fila['vchTipoMotivo'] ?></td>
                        <td class="columnaf" id="fecha"> <?php echo date("Y-m-d",strtotime($fila['dtFecha'])); ?> </td>
                        <td class="columnah"> <?php echo $fila['vchHora'] ?></td>
                        <td class="columnad"> <a onclick="return alert_fecha();" href="eliminar_cita.php?idD=<?php echo $fila['iCodTranCalendario']?>&id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>" onclick="return alert_eliminarCita();"> <img src="https://img.icons8.com/ultraviolet/30/000000/delete.png"> </a> </td>
                    </tr>
                    <?php
                }
                ?>

                <script type="text/javascript">
                    function alert_eliminarCita(){
                        var respuesta = confirm("Estás seguro de eliminar la cita?");
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
                        if (fecha_tabla < fecha_actual){
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

