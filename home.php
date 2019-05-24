<?php
session_start();
//echo $_SESSION["autenticado"];

if ($_SESSION["autenticado"] != "SI") {
 	header("Location: index.php");
}

$codigo = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Panther :: Inicio</title>

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

<h1> Hola </h1>
 </body>
</html>