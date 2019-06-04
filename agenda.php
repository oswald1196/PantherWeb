<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Agenda </title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<!--<script src="assets/js/jquery.min.js"></script>-->
	<script src="assets/js/moment.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<!--FULL CALENDAR-->
	<link rel="stylesheet" href="assets/css/fullcalendar.min.css">
	<script src="assets/js/fullcalendar.min.js"></script>
	<script src="assets/js/es.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

</head>

<body>
	<h1> Agenda de citas </h1>
	<div class="container">
		<div class="row">
			<div class="col"> </div>
			<div class="col-7"> <div id="calendario"> </div> </div>
			<div class="col"> </div>
		</div>
	</div>

	<script>
		$(document).ready(function(){
			$('#calendario').fullCalendar({
				header:{
					left:'today,prev,next',

					center:'title',
					right:'month,basicWeek, basicDay, agendaWeek, agendaDay'
				},
				//Formulario de eventos
				dayClick:function(date,jsEvent,view){
					$('#txtFecha').val(date.format());
					$("#modalEventos").modal();
				},
				events:[
				{
					title:'Evento 1',
					motivo: 'Hola que tal',
					start:'2019-05-21',
					color: "yellow"
				}],
				eventClick:function(calEvent,jsEvent,view){
						$('#tituloEvento').html(calEvent.title);
						$('#descripcionEvento').html(calEvent.motivo);

						$("#modalEventos").modal();


				}
			});
		});
	</script>

<!-- Modal (agregar, modificar, eliminar-->

<div class="modal fade" id="modalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloEvento"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div id="descripcionEvento">
        Fecha : <input type="text" id="txtFecha" name="txtFecha"/> <br/>
        Motivo : <input type="text" id="txtMotivo"> <br/>
        Hora inicio : <input type="text" id="txthoraIni"> <br/>
        Paciente : <select id="selectMascota" name="sMascota"> <option value=0>Seleccione paciente</option> 
        <?php
        include('conexion.php'); 

        $consulta = "SELECT vchNombrePaciente, vchNombre, vchPaterno FROM TranAfiliado WHERE iCodEmpresa = 106";
        $result = mysqli_query($conn,$consulta);
        while ($mascota = mysqli_fetch_assoc($result)) {
          echo '<option>'.$mascota['vchNombrePaciente'].'-'.$mascota['vchNombre'].' '.$mascota['vchPaterno'].'</option>';
                  }
        ?>
      </select> <br/>
        Descripción : <textarea type="text" id="txtDescripcion" name="txtDescripcion" rows="3"> </textarea>  <br/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btnAgregar" data-dismiss="modal">Agregar</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal">Modificar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Borrar</button>
        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>

</div>

<script>
	$('#btnAgregar').click(function(){

	});
</script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>