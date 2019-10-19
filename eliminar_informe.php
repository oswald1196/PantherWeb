<?php
require ('conexion.php');

$id = $_REQUEST['idI'];


$sql = "DELETE FROM TranInformeMedico WHERE iCodTranInformeMedico = '$id'";

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

  <title>Panther :: Informes médicos</title>

  <meta name="description" content="User login page" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/font-awesome.min.css" />

  <link rel="stylesheet" href="assets/css/ace-fonts.css" />
  <link rel="stylesheet" href="assets/css/informe_medico.css" />

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

  <div class="caja_principal">

    <?php 
    $sql = "SELECT vchNombrePaciente FROM TranAfiliado WHERE iCodPaciente = '$codigoPaciente'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);
    ?>
    <div class="titulo_header">
    	
      <p id="lblCita"> Informes médicos de: <?php echo $row['vchNombrePaciente']; ?> </p>
      <input type="hidden" name="" id="fechaActual" value="<?php echo " ".$fecha_actual?>">
    </div>

    <button class="botonAddInformeM"> <a href="consultas.php?id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>"> Agregar <img id="simbolo_addI" src="https://img.icons8.com/office/24/000000/plus-math.png"> </a> </button> 

    <?php

    $query = "SELECT DISTINCT TI.iCodTranInformeMedico, TI.iCodPaciente, TI.iCodInformeMedico, TI.iCodMedico, TI.vchNumInformeMedico, TI.vchProblema,  TI.dtFechaInformeMedico, TI.siAtencion, TI.vchMotivo As sMotivoConsulta, TI.dtFechaSintomatologia, TI.vchNota, TI.iInformeMedico, CONCAT (CM.vchNombre, ' ', CM.vchPaterno, ' ', CM.vchMaterno) As vchMedico, TI.siFrecuenciaCardiaca, TI.dTemperatura, TI.siFrecuenciaRespiratoria, TI.siCodMucosa, TI.sMucosa, TI.iTiempoLlenadoCapilar, TI.dPeso, TI.siPadecimiento, TI.sDiagnosticoPresuntivo, TI.sDiagnosticoDiferencial, TI.sPruebasRequeridas, TI.sResultado, TI.siDiagnostico, TI.vchProblema, TI.iCodServicio, TI.vchServicio, TI.dPrecioMenudeo, TI.dPrecioCosto, TI.iCodCuentaCliente, TI.vchReceta, TI.dMeses, TI.dAltura, TI.sPresionArterial, TI.dPerimetroCefalico, TI.dNoTransaccionCloud, TI.dtFechaInformeMedico FROM TranInformeMedico TI INNER JOIN CatMedico CM ON CM.iCodMedico = TI.iCodMedico WHERE TI.iCodPaciente = '$codigoPaciente' AND CM.iCodEmpresa = '$codigo' ORDER BY dtFechaInformeMedico DESC";

    $resultado = mysqli_query($conn,$query);
    while($fila = mysqli_fetch_assoc($resultado)){
      $codigoInf = $fila['iCodTranInformeMedico'];
      ?>
      <span id="titulo_informe"> Consulta del <?php echo $fila ['dtFechaInformeMedico']?> </span>
      <table id="tabla_informe">

       <tr id="signos">
        <td id="column_date"> <?php echo $fila ['dtFechaInformeMedico']?> </td>
        <td id="column_temp"> Temp. <?php echo $fila ['dTemperatura']?> </td>
        <td id="column_fc"> F.C. <?php echo $fila ['siFrecuenciaCardiaca']?> </td>
        <td id="column_fr"> F.R. <?php echo $fila ['siFrecuenciaRespiratoria']?> </td>
        <td id="column_pa"> P.A. <?php echo $fila ['sPresionArterial']?> </td>
        <td id="column_tllc"> TLLC. <?php echo $fila ['iTiempoLlenadoCapilar']?> </td>
        <td id="column_peso"> Peso. <?php echo $fila ['dPeso']. ' kg'?> </td>
        <td id="column_edit">  <a onclick="alert_editarInforme(this.href); return false;" class="btnEditar" href="modificar_consulta.php?id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente) ?>&ci=<?php echo base64_encode($codigoInf) ?>"> <img id="pencil" src="https://img.icons8.com/ultraviolet/30/000000/pencil-tip.png"> </td>
          <td id="column_delete"> <a onclick="alert_eliminarInforme(this.href); return false;" class="boton" href="eliminar_informe.php?idI=<?php echo $fila['iCodTranInformeMedico'] ?>&id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>" > <img id="trash" src="https://img.icons8.com/ultraviolet/30/000000/delete.png"> </a> </td>
        </tr>
        <tr>
          <td id="column_dat"> </td>
          <td id="column_medico" colspan="8"> <img id="img_medico" src="https://img.icons8.com/ultraviolet/30/000000/doctor-male.png"> <?php echo $fila ['vchMedico']?> </td>
        </tr>
        <tr id="motivo_receta">
          <th id="cabecera_motivo" colspan="2">Motivo consulta</th>
          <th id="cabecera_receta" colspan="7">Receta</th>
        </tr>
        <tr id="motivo_receta_mostrar">
          <td id="column_motivo" colspan="2"> <?php echo $fila ['sMotivoConsulta']?> </td>
          <td id="column_receta" colspan="7"> <?php echo $fila ['vchReceta']?> </td>
        </tr>
        <tr id="examen_med">
          <th id="cabecera_examen" colspan="2">Examen físico</th>
          <th id="cabecera_medicacion" colspan="7">Medicación</th>
        </tr>
        <tr id="examen_med_mostrar">	
          <td id="column_ef" colspan="2"> <?php echo $fila ['vchNota']?> </td>
          <td id="column_med" colspan="7"> <?php echo $fila ['vchProblema']?> </td>
        </tr>

      </table>
      <hr>
      <?php 
    }
    ?>

    <script type="text/javascript">
      function alert_eliminarInforme(url) {

        $(".boton").click(function(){ 
          var fecha = "";

          $(this).parents("tr").find('#column_date').each(function(){
            fecha = $(this).html();      
            var fecha_actual = document.getElementById("fechaActual").value;
            alert(fecha);
            alert(fecha_actual);
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
                title: 'Estás seguro de eliminar este informe médico?',
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
                    'Se ha borrado el informe médico.',
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
      function alert_editarInforme(url) {
        $(".btnEditar").click(function(){
          var fecha = "";

          $(this).parents("tr").find('#column_date').each(function(){
            fecha = $(this).html();      
            var fecha_actual = document.getElementById("fechaActual").value;

            if (fecha_actual > fecha){
              Swal.fire({
                type:'error',
                title:'ERROR',
                text:'IMPOSIBLE MODIFICAR UN SERVICIO DE DÍAS ANTERIORES'
              });
            }
            else   {
              window.location.href = url;
            }           
          });
        });
      }
    </script>
  </div>
</body>
</html>
