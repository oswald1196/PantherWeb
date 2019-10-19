<?php
session_start();
//echo $_SESSION["autenticado"];

if ($_SESSION["autenticado"] != "SI") {
	header("Location: index.html");
}

$codigo = base64_decode($_GET['id']);
$cMedico = base64_decode($_GET['cm']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Panther :: Inicio</title>

	<meta name="description" content="User login page" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

	<link rel="stylesheet" href="assets/css/estilos.css" />

      <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">

	<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

	<script type="text/javascript" src="js/galeria.js"></script>
</head>

<body class="login-layout">

	<?php
	include('header.php');
	include('conexion.php');
	?>

	<?php
	$sql = "SELECT vchNombre FROM CatMedico WHERE iCodEmpresa = '$codigo' AND iCodMedico = '$cMedico'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
	?>
	<p class="saludo"> HOLA <?php echo $row['vchNombre']?> </p>

	<!--SLIDER-->
	<div id="slider">
		<div class="gallery">
			<div><img src="assets/img/1NL-pantherG.png" title="Logo 1 Panther"></div>
			<div><img src="assets/img/pg-100.png" title="Logo 2 Panther"></div>
			<div><img src="assets/img/rsz_3panther15_logo.png" title="Logo 3 Panther"></div>
		</div>
	</div>

</body>

</html>