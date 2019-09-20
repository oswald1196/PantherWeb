<?php
	require ('conexion.php');

	$id = $_REQUEST['idEst'];

	$sql = "DELETE FROM TranAgendaEstetica WHERE iCodTranAgendaEstetica = '$id'";

	$resultado = mysqli_query($conn,$sql);
?>

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

  <title>Panther :: Estética</title>

  <meta name="description" content="User login page" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/font-awesome.min.css" />

  <link rel="stylesheet" href="assets/css/ace-fonts.css" />
  <link rel="stylesheet" href="assets/css/panel_estetica.css" />

  <link rel="stylesheet" href="assets/css/ace.min.css" />
  <link rel="stylesheet" href="dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

</head>

<body>

    <?php
    $codigo = base64_decode($_GET['id']);
    $codigoPaciente = base64_decode($_GET['codigo']);
    $cMedico = base64_decode($_GET['cm']);

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
        <button class="botonAEst"> <a href="agenda_estetica_agregar.php?id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>"> Agregar <img id="imgAdd" src="https://img.icons8.com/office/24/000000/plus-math.png"> </a> </button> 

        <table id="tbl_estetica">
            <tbody>

                <thead id="tbl_headerE">
                    <tr>
                        <th id="c_fechaE">Fecha</th>
                        <th id="c_motivoE">Descripción</th>
                        <th id="c_horaE">Hora</th>
                        <th id="c_precio">Precio</th>
                        <th id="c_notas">Notas</th>
                        <th id="c_borrar"></th>
                        <th id="c_estado">Estado</th>
                        <th id="c_estatus">Terminar</th>
                    </tr>
                </thead>
                <?php

                $query = "SELECT DISTINCT TA.iCodTranAgendaEstetica, TA.iCodAgenda, TA.iCodPaciente, TA.iCodServicio, TA.dtFecha, TA.dtHoraIni, TA.dtHoraFin, TA.dPrecio, IF(TA.iCodEstatus = 1, 'PENDIENTE', 'TERMINADA') As vchEstatus, TA.iCodEstatus, TA.vchDescripcion, TA.vchObservaciones FROM TranAgendaEstetica TA INNER JOIN CatServicios CS ON TA.iCodServicio = CS.iCodServicio WHERE iCodPaciente = '$codigoPaciente' ORDER BY dtFecha DESC";


                $resultado = mysqli_query($conn,$query);
                while($fila = mysqli_fetch_assoc($resultado)){
                    
                    ?>
                    <tr>
                        <td class="columnades"> <?php echo date("Y-m-d",strtotime($fila['dtFecha'])); ?></td>
                        <td class="columnades"> <?php echo $fila['vchDescripcion'] ?></td>
                        <td class="columnades"> <?php echo $fila['dtHoraIni'] ?></td>
                        <td class="columnades"> <?php echo $fila['dPrecio'] ?></td>
                        <td class="columnaf"> <?php echo $fila['vchObservaciones'] ?> </td>
                        <td class="columnad"> <a href="eliminar_estetica.php?idEst=<?php echo $fila['iCodTranAgendaEstetica']?>&id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>" onclick="return alert_eliminarEstetica();"> <img id="imgTrash" src="https://img.icons8.com/ultraviolet/30/000000/delete.png"> </a> </td>
                        <td class="columnah" id="fila_estatus"> <?php echo $fila['vchEstatus'] ?></td>
                        <td class="columnai"> <a onclick="obtener_estatus();" href="terminar_estetica.php?idEst=<?php echo $fila['iCodTranAgendaEstetica']?>&id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>"> <img id="imgEstatus" src="https://img.icons8.com/ultraviolet/30/000000/checkmark.png"> </button> </a> </td>
                    </tr>
                    <?php
                }
                ?>

                <script type="text/javascript">
                    function alert_eliminarEstetica(){
                        var respuesta = confirm("Estás seguro de eliminar el servicio de estética?");
                        if (respuesta == true) {
                            return true;
                        } else {
                            return false;
                        }
                    }

                    function obtener_estatus(){ 
                        var status = document.getElementById("fila_estatus").innerHTML;
                        alert(status);
                        if (status == "TERMINADA"){
                            Swal.fire({
                                type:'error',
                                title:'ERROR',
                                text:'EL SERVICIO YA FUE TERMINADO'
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



