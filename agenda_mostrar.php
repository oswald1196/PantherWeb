<?php

require 'conexion.php';

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Panther :: Agenda</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />

		<link rel="stylesheet" href="assets/css/ace-fonts.css" />

		<link rel="stylesheet" href="assets/css/ace.min.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="assets/css/estilos.css" />
	</head>

	<body class="login-layout">

<?php
	include('header.php');

?>

<form class="navbar-form">
      <div class="form-group">
        <input type="text" placeholder="&#xe003" name="search">
      </div>
    </form> 
 <h1 class="page-header" align="center" color="white">AGENDA</h1>
    <table width="70%" class="table-bordered table-responsive" align="center" color="white">

	<tr align="center">
        <td>Fecha</td>
        <td>Hora</td>
        <td>Nombre Propietario</td>
        <td>Telefono</td>
        <td>Correo</td>
    </tr>

<?php

$sql = "SELECT * FROM TranCalendario WHERE iCodEmpresa = 2";

$result = mysqli_query($conn,$sql); 

while($row=mysqli_fetch_array($result)){
 ?>
	<tr align="center">
        <td height="40px"><?php echo $row['dtFecha'] ?> </td>
        <td><?php echo $row['vchHora'] ?> </td>
        <td><?php echo $row['vchTipoMotivo'] ?> </td>
    </tr>
<?php
	}
?>
    
</body>
</html>