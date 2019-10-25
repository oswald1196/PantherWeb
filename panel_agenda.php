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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
  <link rel="stylesheet" href="dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

</head>

<body class="carga">

  <?php
  $codigo = base64_decode($_GET['id']);
  $cMedico = base64_decode($_GET['cm']);
  $codigoPaciente = base64_decode($_GET['codigo']);
  $fecha_actual = date("Y-m-d");
  date_default_timezone_set("UTC");

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
      <input type="hidden" name="" id="fechaActual" value="<?php echo " ".$fecha_actual?>">

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
              <td class="columnad" > <a onclick="alert_eliminarCita(this.href); return false;" class="boton" href="eliminar_cita.php?idD=<?php echo $fila['iCodTranCalendario']?>&id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>"> <img src="https://img.icons8.com/ultraviolet/30/000000/delete.png"> </a> </td>
            </tr>
            <?php
          }
          ?>

          <script type="text/javascript">

            function alert_eliminarCita(url) {

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
                title: 'Estás seguro de eliminar esta cita?',
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

        </tbody>
      </table>
    </div>


  </div>
</body>
</html>

