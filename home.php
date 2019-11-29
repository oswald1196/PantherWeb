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
	
	<!--<script type="text/javascript" src="js/galeria.js"></script>-->
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
	<div id="principal">
		<div id="slides">
			<img src="assets/img/1524913221_572475_1524913364_noticia_normal.jpg" title="Logo 1 Panther">
			<img src="assets/img/1527497974_415003_1527501170_noticia_normal.jpg" title="Logo 2 Panther">
			<img src="assets/img/mascotas-se-comportan-como-humanos.jpg" title="Logo 3 Panther"> 
		</div>
	</div>

	<script type="text/javascript">
		
	</script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="assets/js/jquery.slides.js"></script>
	<script src="assets/js/jquery.slides.js"></script>

	<script type="text/javascript">
		$(function(){
			$("#slides").slidesjs({
				play: {
				active:true,
				effect:"slide",
				interval: 3000,
				auto:true,
				swap:true,
				pauseOnHover: false,
				restartDelay: 2500
				}
			});
		});
	</script>

</body>

</html>