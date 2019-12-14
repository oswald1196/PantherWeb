<?php
require ('conexion.php');

$id = $_REQUEST['idD'];

/********** ELIMINAR REGISTRO DE CALENDARIO **********/
$getDatos = "SELECT * FROM TranHecto WHERE iCodTranHecto = '$id'";

$result = mysqli_query($conn,$getDatos);
$row = mysqli_fetch_assoc($result);

$motivo = $row['sObservaciones'];
$codigo = $row['iCodPaciente'];
$cEmpresa = $row['iCodEmpresa'];
$fecha = $row['sFechaProxima'];
$codigoProd = $row['iCodProducto'];
$codLote = $row['iCodProductoLote'];
$codCuenta = $row['iCodCuentaCliente'];

$borrarCita = "DELETE FROM TranCalendario WHERE iCodPaciente = '$codigo' AND vchTipoMotivo = '$motivo' AND dtFecha = '$fecha'";

$borrado = mysqli_query($conn,$borrarCita);

/********** ELIMINAR REGISTRO DE CUENTA *************/ 
$borrarCuenta = "DELETE FROM TranCuentasClientes WHERE iCodTranCuentasClientes = '$codCuenta'";
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

/********* ELIMINAR REGISTRO DE ECTO *************/
$sql = "DELETE FROM TranHecto WHERE iCodTranHecto = '$id'";

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
			<input type="hidden" name="" id="fechaActual" value="<?php echo " ".$fecha_actual?>">

		</div>
		<div id="contenedor">
			<button class="botonAddEcto"> <a id="enlace_est" href="ectoparasito.php?id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>"> Agregar <i class="fas fa-plus-square"></i>&nbsp;&nbsp; </a> </button> 

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
							<td class="columna8E"> <a onclick="alert_eliminarEcto(this.href); return false;" class="boton" href="eliminar_ecto.php?idD=<?php echo $fila['iCodTranHecto'] ?>&id=<?php echo base64_encode($codigo)?>&codigo=<?php echo base64_encode($codigoPaciente)?>&cm=<?php echo base64_encode($cMedico)?>" > <img src="assets/img/bote.png"> </td>
							</tr>
							<?php
						}
						?>
						<script type="text/javascript">
							function alert_eliminarEcto(url) {

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
												title: 'Estás seguro de eliminar este ectoparásito?',
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
														'Se ha borrado el ectoparásito.',
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

