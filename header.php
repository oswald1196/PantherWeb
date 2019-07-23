
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"> </script>
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/
  JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/menu_principal.css" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script src="assets/js/headroom.min.js"></script>
  <script src="assets/js/menu.js"></script>
  
  <!--Iconos-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Iconos--> 

</head>
  
<body background="assets/img/astronomy-dark-evening-957061.jpg" style="height: auto; width: auto;">
<header id="header">
<nav class="nav_menu">
    <div class="logo">
      <a href="home.php"> <img id="imagen_menu" src="assets/img/3NL-pantherG.png" alt="Logo Panther"> </a> 
      <a href="#" class="btn-menu" id="btn-menu"> <i class="icono fa fa-bars" aria-hidden="true"></i> </a> 
    </div>
    <div class="enlaces" id="enlaces">

      <a href="home.php" href="#"></a>

      <a href="home.php?id=<?php echo base64_encode($codigo)?>">Home</a>

      <a href="altapacientesac.php?id=<?php echo base64_encode($codigo)?>&cm=<?php echo base64_encode($cMedico)?>">Alta de paciente</a>

      <a href="buscar_paciente.php?id=<?php echo base64_encode($codigo)?>">Buscar</a>

      <a href="generales.php?id=<?php echo base64_encode($codigo)?>">Generales</a>    

      <a href="#"><i class="material-icons" style="color: white; font-size: 20px;">person</i> Perfil</a>
      
      <a href="logout.php"><i class="material-icons" style="color: white; font-size: 20px;">exit_to_app</i>Salir</a>    </nav>
</header>
</body>
</html>