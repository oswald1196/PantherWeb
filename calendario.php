<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Panther :: Inicio</title>

	<meta name="description" content="User login page" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
	<link  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" >

	<script src="assets/js/jquery.min.js"></script>
	<script src="js/moment.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="js/script.js"></script>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<!--FULL CALENDAR-->
	<link rel="stylesheet" href="css/fullcalendar.min.css">
	<script src="js/fullcalendar.min.js"></script>
	<script src="js/es.js"></script>
</head>

<body>
	<?php
//Codigo Empresa
	$codigo = base64_decode($_GET['id']);
	$cMedico = base64_decode($_GET['cm']);

  //Codigo Paciente
	include ('conexion.php');
	?>

	<!-- add calander in this div -->
	<h1> Agenda de citas </h1>
	<div class="container">
		<div class="row">
			<div class="col"> </div>
			<div class="col-7"> <div id="calendario"> </div> </div>
			<div class="col"> </div>
		</div>
	</div>

	<!-- Modal  to Add Event -->
	<div id="createEventModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h4 class="modal-title">Agregar cita</h4>
				</div>
				<div class="modal-body">
					<div class="control-group">
						<label id="lblPacientesV">Paciente</label>
						<select id="selectPacienteV" name="paciente">
							<option value="">Elige paciente</option>
							<?php 
							$sql = "SELECT * FROM TranAfiliado WHERE iCodEmpresa = '$codigo' ORDER BY vchNombrePaciente";
							$query = mysqli_query($conn,$sql);
							while ($pacientes = mysqli_fetch_array($query)) {
								?>
								<option value ="<?php echo $pacientes['iCodPaciente'];?>"> <?php echo $pacientes['vchNombrePaciente']." -- ".$pacientes['vchNombre']." ".$pacientes['vchPaterno']." ".$pacientes['vchMaterno'] ?></option>
								<?php
							}
							?>
						</select>  
					</div>	
					<div class="control-group">
						<label class="control-label" for="inputPatient">Motivo:</label>
						<div class="field desc">
							<input class="form-control" id="title" name="title" placeholder="" type="text" value="">
						</div>
					</div>
					
					<input type="hidden" id="startTime"/>
					<input type="hidden" id="endTime"/>
					
					
					
					<div class="control-group">
						<label class="control-label" for="when">Fecha:</label>
						<div class="controls controls-row" id="when" style="margin-top:5px;">
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
					<button type="submit" class="btn btn-primary" id="submitButton">Guardar</button>
				</div>
			</div>

		</div>
	</div>

	<!-- Modal to Event Details -->
	<div id="calendarModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h4 class="modal-title">Detalle de cita</h4>
				</div>
				<div id="modalBody" class="modal-body">
					<h4 id="modalTitle" class="modal-title"></h4>
					<div id="modalWhen" style="margin-top:5px;"></div>
				</div>
				<input type="hidden" id="eventID"/>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
					<button type="submit" class="btn btn-danger" id="deleteButton">Borrar</button>
				</div>
			</div>
		</div>
	</div>

</body>
<!--Modal-->



