
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
  
  <!--Iconos-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Iconos--> 

</head>
  
<body background="assets/img/astronomy-dark-evening-957061.jpg" style="height: auto; width: auto;">
  
<nav class="navbar navbar" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">

    <a href="home.php" class="navbar-brand">  
    <img src="assets/img/3NL-pantherG.png" width="125px" height="40px" alt="">
    </a> 

      <a href="home.php" class="navbar-brand" href="#"></a>
    </div>

    <ul class="nav navbar-nav">
      <li class="active"> <a href="home.php?id=<?php echo base64_encode($codigo)?>">Home</a></li>
      
      <li class="altap"><a href="altapacientesac.php?id=<?php echo base64_encode($codigo)?>&cm=<?php echo base64_encode($cMedico)?>">Alta de paciente</a></li>

      <li><a href="buscar_paciente.php?id=<?php echo base64_encode($codigo)?>">Buscar</a></li>
    </ul>


    <ul class="nav navbar-nav navbar-right">
      

      <li><a href="#"><i class="material-icons" style="color: white; font-size: 13px;">person</i> Perfil</a></li>

      <!--:->
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>
      <!-:-->
      
      <li><a href="logout.php"><i class="material-icons" style="color: white; font-size: 13px;">exit_to_app</i>Salir</a></li>   

    </ul>
  </div>
</nav>

</body>
</html>