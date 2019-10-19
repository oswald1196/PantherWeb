<?php
require ('conexion.php');

$id = $_REQUEST['idD'];

/********** ELIMINAR REGISTRO DE CALENDARIO **********/
$getDatos = "SELECT * FROM TranRegistroVacunas WHERE iCodTranRegistroVacunas = '$id'";

$result = mysqli_query($conn,$getDatos);
$row = mysqli_fetch_assoc($result);

$motivo = $row['sProximaVacuna'];
$codigo = $row['iCodPaciente'];
$cEmpresa = $row['iCodEmpresa'];
$fecha = $row['sFechaProgramada'];
$codigoProd = $row['iCodProducto'];
$codLote = $row['iCodProductoLote'];

$borrarCita = "DELETE FROM TranCalendario WHERE iCodPaciente = '$codigo' AND vchTipoMotivo = '$motivo' AND dtFecha = '$fecha'";

$borrado = mysqli_query($conn,$borrarCita);

/********** ELIMINAR REGISTRO DE CUENTA *************/ 
$borrarCuenta = "DELETE FROM TranCuentasClientes WHERE iCodProducto = '$codigoProd' AND iCodPaciente = '$codigo'";

$cuentaBorrada = mysqli_query($conn,$borrarCuenta);
/********** ACTUALIZAR STOCKS *************/ 

$getDatosLote = "SELECT * FROM RelProductos WHERE iCodProductoLote = '$codLote' AND iCodEmpresa = '$cEmpresa'";

$resultado = mysqli_query($conn,$getDatosLote);
$filaL = mysqli_fetch_assoc($resultado);

$stockAct = $filaL['dStockActual'];

$newStockActual = $stockAct + 1;

$newStock = "UPDATE RelProductos SET dStockActual = '$newStockActual' WHERE iCodProductoLote = '$codLote' AND iCodEmpresa = '$cEmpresa'";

$actualizarStockLote = mysqli_query($conn,$newStock);

$stockXProd = "SELECT SUM(dStockActual) AS StockActual FROM RelProductos WHERE iCodProducto = '$codigoProd' AND iCodEmpresa = '$cEmpresa'";

$newStockXProd = mysqli_query($conn,$stockXProd);
$exito = mysqli_fetch_assoc($newStockXProd);

$stockRes = $exito['StockActual'];

$newStockRes = "UPDATE CatProductos SET dStockActual = '$stockRes' WHERE iCodProducto = '$codigoProd' AND iCodEmpresa = '$cEmpresa'";
$actualizarStockCat = mysqli_query($conn,$newStockRes);

/********* ELIMINAR REGISTRO DE VACUNA *************/
$sql = "DELETE FROM TranRegistroVacunas WHERE iCodTranRegistroVacunas = '$id'";
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
          <input type="hidden" name="" id="fechaActual" value="<?php echo " ".$fecha_actual?>">

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
                        <td class="columna1" id="fecha"> <?php echo $fila['sFecha'] ?></td>
                        <td class="columna2"> <?php echo $fila['sVacunaAplicada'] ?> </td>
                        <td class="columna3"> <?php echo $fila['sProximaVacuna'] ?></td>
                        <td class="columna4"> <?php echo $fila['dPeso'] ?></td>
                        <td class="columna5"> <?php echo $fila['sFechaProgramada'] ?></td>
                        <td class="columna6"> <?php echo $fila['sNumeroLote'] ?> </td>
                        <td class="columna7"> <?php echo $fila['sFechaCaducidad'] ?> </td>
                        <td class="columna8"> <a onclick="alert_eliminarVacuna(this.href); return false;" class="boton" href="eliminar_vacuna.php?idD=<?php echo $fila['iCodTranRegistroVacunas'] ?>&id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>" > <img id="simbolo_add" src="https://img.icons8.com/ultraviolet/30/000000/delete.png"> </a> </td>
                    </tr>
                    <?php
                }
                ?>
                <script type="text/javascript"> 

                   function alert_eliminarVacuna(url) {

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
                      title: 'Estás seguro de eliminar esta vacuna?',
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

