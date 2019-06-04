<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />

		<title>Panther :: Buscar Pacientes</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<link rel="stylesheet" href="assets/css/ace-fonts.css" />
		<link rel="stylesheet" href="assets/css/tablas.css" />

  		<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

		<script type="text/javascript" src="peticion.js"></script>


	</head>

	<body class="login-layout">

<?php
    $codigoE = $_GET['id'];
	include('header.php');
	require_once 'conexion.php';
?>

<form class="navbar-form form-search" action="buscar_paciente.php?id=<?php echo $codigoE?>" method="GET">
      <div class="form-group">
        <input type="text" placeholder="Buscar" name="search" id="busqueda">
        <?php echo $codigoE ?>
        <input type="submit" value="Buscar" class="btn-search" />
       </div>
</form>


    <style type="text/css">
    	h1 {
    		color: white;
  			font-family: 'Nunito', sans-serif;	
    	}
    </style>
<h1 align="center">LISTADO DE PACIENTES</h1>
 
 <?php
		if(isset($_GET['search'])){
			require_once 'buscar.php';
		}
	?>

</table>
</body>
</html>