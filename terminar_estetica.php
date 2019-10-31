<?php
require ('conexion.php');

$id = $_REQUEST['idEst'];

$getDatos = "SELECT * FROM TranAgendaEstetica WHERE iCodTranAgendaEstetica = '$id'";

$result = mysqli_query($conn,$getDatos);
$row = mysqli_fetch_assoc($result);

$correo = $row['vchCorreo'];
$pais = $row['vchPais'];
$estado = $row['vchEstado'];
$ciudad = $row['vchCiudad'];
$cEmpresa = $row['iCodEmpresa'];
$iCodServicio = $row['iCodServicio'];
$codPaciente = $row['iCodPaciente'];
$fecha = $row['dtFecha'];
$nombreServ = $row['vchDescripcion'];
$comision = $row['dPrecioCosto'];
$precio = $row['dPrecio'];
$codProp = $row['iCodPropietario'];

$insertCuentaEst = "INSERT INTO TranCuentasClientes (vchCorreo, vchPais, vchEstado, vchCiudad, iRecibido, iEnviado, iCodEmpresa, iCodCuentaCliente, iCodTipoServicio, iCodPaciente, dtFecha, vchServicio, dPrecioCosto, dPrecioMenudeo, dDescuento, bEstatus, iCodPropietario, iCodCorteCuentaCliente, iCuentaLiquidada, dIVA, dSubtotal, dPorcentajeIVA, iCodCorteDia, iCodProducto, dCantidad, dCantidadUnidad, bExistenciaCero, iNumFolioFactura, iFactura, iCodHospitalizacion, dtFechaSalida, bSalida, dPrecioAntesPromocion, dPorcentajePromocion, vchCodigoPromocion, iCodProductoLote, iEnvioCloud) VALUES ('$correo', '$pais', '$estado', '$ciudad', '1', '4', '$cEmpresa', '0', '$iCodServicio', '$codPaciente', '$fecha', '$nombreServ', '$comision', '$precio', '0', '0', '$codProp', '0', '0', '0', '0', '0', '0', '0', '1', '0', '', '0', '0', '0', '$fecha', '', '0', '0', '.', '0', '2')";

$agregarCuentaEst = mysqli_query($conn,$insertCuentaEst);
$identity = mysqli_insert_id($conn);

$sql = "UPDATE TranAgendaEstetica SET iCodEstatus = 3, iCodServicios = '$identity' WHERE iCodTranAgendaEstetica = '$id'";

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
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


  <div class="contenedor_est">

    <?php 
    $sql = "SELECT vchNombrePaciente FROM TranAfiliado WHERE iCodPaciente = '$codigoPaciente'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class="header_titleE">

      <p id="lblCita"> Estéticas de: <?php echo $row['vchNombrePaciente']; ?> </p>
      <input type="hidden" name="" id="fechaActual" value="<?php echo " ".$fecha_actual?>">

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

          $query = "SELECT DISTINCT TA.iCodTranAgendaEstetica, TA.iCodAgenda, TA.iCodPaciente, TA.iCodServicio, TA.dtFecha, TA.dtHoraIni, TA.dtHoraFin, TA.dPrecio, IF(TA.iCodEstatus = 1, 'PENDIENTE', 'TERMINADA') As vchEstatus, TA.iCodEstatus, TA.vchDescripcion, TA.vchObservaciones FROM TranAgendaEstetica TA INNER JOIN CatServicios CS ON TA.iCodServicio = CS.iCodLaboratorio WHERE iCodPaciente = '$codigoPaciente' ORDER BY dtFecha DESC";


          $resultado = mysqli_query($conn,$query);
          while($fila = mysqli_fetch_assoc($resultado)){

            ?>
            <tr>
              <td class="columnades" id="fecha"> <?php echo date("Y-m-d",strtotime($fila['dtFecha']));?></td>
              <td class="columnades"> <?php echo $fila['vchDescripcion'] ?></td>
              <td class="columnades"> <?php echo $fila['dtHoraIni'] ?></td>
              <td class="columnades"> <?php echo $fila['dPrecio'] ?></td>
              <td class="columnaf"> <?php echo $fila['vchObservaciones'] ?> </td>
              <td class="columnad"> <a onclick="alert_eliminarEstetica(this.href); return false;" class="boton" href="eliminar_estetica.php?idEst=<?php echo $fila['iCodTranAgendaEstetica']?>&id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>"> <img id="imgTrash" src="https://img.icons8.com/ultraviolet/30/000000/delete.png"> </a> </td>
              <td class="columnah" id="status"> <?php echo $fila['vchEstatus'] ?></td>
              <td class="columnai"> <a onclick="alert_terminarEstetica(this.href); return false;" class="btnEstetica" href="terminar_estetica.php?idEst=<?php echo $fila['iCodTranAgendaEstetica']?>&id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>"> <img id="imgEstatus" src="https://img.icons8.com/ultraviolet/30/000000/checkmark.png"> </a> </td>
            </tr>
            <?php
          }
          ?>

          <script type="text/javascript">
            function alert_eliminarEstetica(url) {

              $(".boton").click(function(){ 
                var fecha = "";

                $(this).parents("tr").find('#fecha').each(function(){
                  fecha = $(this).html();      
                  var fecha_actual = document.getElementById("fechaActual").value;
                  if (fecha_actual > fecha){
                    Swal.fire({
                      type:'error',
                      title:'ERROR',
                      text:'IMPOSIBLE BORRAR UN SERVICIO DE DÍAS ANTERIORES'
                    });
                  }
                  else {
                    event.preventDefault();

                    Swal.fire({
                      title: 'Estás seguro de eliminar esta estética?',
                      text: "No podrás recuperar el registro",
                      type: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Si, borrar!',
                      cancelButtonText: 'Cancelar',
                    }).then((result) => {
                      if (result.value) {
                        Swal.fire(
                          'Borrado!',
                          'Se ha borrado la cita.',
                          'success'

                          ) 

                        window.location.href = url;
                      }
                    });
                  }
                  return false;
                });
              });
            }
          </script>

          <script type="text/javascript">
            function alert_terminarEstetica(url) {
              $(".btnEstetica").click(function(){
                var estatus = "";

                $(this).parents("tr").find('#status').each(function(){
                  estatus = $(this).html();      
                  if (estatus == " TERMINADA"){
                    Swal.fire({
                      type:'error',
                      title:'ERROR',
                      text:'EL SERVICIO YA FUE TERMINADO'
                    });
                  }
                  else   {
                    window.location.href = url;

                  }           
                });
              });
            }
          </script>

        </tbody>
      </table>
    </div>

  </div>
</body>
</html>



