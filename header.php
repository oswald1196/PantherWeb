
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"> </script>
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/menu_principal.css" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  
  <!--Iconos-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Iconos--> 

</head>

<body background="assets/img/fondo-negro-elegante_1152-238.jpg" style="height: auto; width: auto;">
    <header>
      <div class="logo logo_main">  <img id="imagen_menu" src="assets/img/3NL-pantherG.png" alt="Logo Panther">
    </div>
      <div class="menu_bar">
      <a class="bt-menu"> <span class="fas fa-bars"> </span> Menu </a> 
      </div>
          <nav> 
            <ul>
             <li> <a href="home.php?id=<?php echo base64_encode($codigo)?>&cm=<?php echo base64_encode($cMedico)?>">Home</a> </li>

             <li> <a href="alta_paciente.php?id=<?php echo base64_encode($codigo)?>&cm=<?php echo base64_encode($cMedico)?>">Alta de paciente</a> </li>

             <li> <a href="buscar_paciente.php?id=<?php echo base64_encode($codigo)?>&cm=<?php echo base64_encode($cMedico)?>">Buscar</a> </li>

             <!--<li> <a href="calendario.php?id=<?php echo base64_encode($codigo)?>&cm=<?php echo base64_encode($cMedico)?>">Agenda</a> </li>-->

             <li> <a href="generales.php?id=<?php echo base64_encode($codigo)?>&cm=<?php echo base64_encode($cMedico)?>">Generales</a> </li>

             <li> <a href="logout.php">Salir</a> </li>

           </ul>

         </nav>
    </header>
<script src="http://code.jquery.com/jquery-latest.js"></script>
  <script src="js/script-menu.js"></script>
 </body>
 </html>