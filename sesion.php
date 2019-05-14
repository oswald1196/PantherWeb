<?php
session_start();
//echo $_SESSION["autenticado"];

if ($_SESSION["autenticado"] != "SI") {
 	header("Location: index.html");

}

?>



 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Panther :: Soporte</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet"> 
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/lightbox.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <link id="css-preset" href="css/presets/preset1.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">

<link href="assets/css/styles.css" rel="stylesheet"/>
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
  <![endif]-->
  
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="images/favicon.ico">
</head><!--/head-->

<body background="pantherv15_fondo.jpg">

  <!--.preloader-->
<div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
  <!--/.preloader-->

    </div><!--/#home-slider-->
    <div class="main-nav">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">
            <h1><img class="img-responsive" src="images/Logos/3NL-pantherS.png" alt="logo"></h1>
          </a>                    
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">                 
            <li class="scroll active"><a href="http://www.panther-one.com">Home</a></li>
            <!--:v->
            <li class="scroll"><a href="#services">Productos</a></li>
            <!-:v--> 
            <li class="scroll"><a href="http://www.panther-one.com">Acerca de</a></li>   
            <li class="scroll"><a href="http://www.panther-one.com">Demo</a></li>                  
            <li class="scroll"><a href="http://www.panther-one.com">Videos de capacitación</a></li>
            <li class="scroll"><a href="http://www.panther-one.com">Muro de la motivación</a></li>
            <li class="scroll"><a href="http://www.panther-one.com/Contáctanos.html">Contáctanos</a></li>  
             <li class="scroll"><a href="cerrar_Sesion.php">Salir</a></li>       
          </ul>
        </div>
      </div>
    </div><!--/#main-nav-->
  </header><!--/#home-->

  <div class="filemanager">
    <!--:v->
    <div class="breadcrumbs">

      <span class="folderName">Soporte</span>  

    </div>
    <!-:v-->

    <FONT FACE="times new roman">
    <h2 style="position: relative; left:18px; color: white;">Soporte</h2>
    </FONT>
    
    <ul class="data animated" style="">
       <li class="folders">
           <a class="folders" href="Producto.php" title="Producto">
             <span class="icon folder full"></span>
             <span class="name">Producto</span>
             <span class="details">2 items</span>
           </a>
       </li>
       <li class="folders">
           <a class="folders" href="Saas.php" title="Saas">
             <span class="icon folder full"></span>
             <span class="name">Saas</span>
             <span class="details">2 items</span>
           </a>
       </li>
       <!--Por si se ocupa(para copiar y pegar)->
       <li class="folders">
          <a class="files" href="files/Instalar_red_producto.msi" title="Instalar_red_producto.msi">
            <span class="icon file f-mkv">.msi</span>
            <span class="name">Instalar_red_producto.msi</span>
            <span class="details">31.4 MB</span>
       </li>
       <!-Por si se ocupa(para copiar y pegar)-->
       <li class="folders">
          <a class="files" href="LogoPantherEnvio.png" title="LogoPantherEnvio.png">
            <span class="icon file f-mkv">.png</span>
            <span class="name">LogoPantherEnvio.png</span>
            <span class="details"></span>
       </li>
    </ul>

    <div class="nothingfound">
      <div class="nofiles"></div>
      <span>No files here.</span>
    </div>

  </div>


  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="assets/js/script.js"></script>
  
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script type="text/javascript" src="js/jquery.inview.min.js"></script>
  <script type="text/javascript" src="js/wow.min.js"></script>
  <script type="text/javascript" src="js/mousescroll.js"></script>
  <script type="text/javascript" src="js/smoothscroll.js"></script>
  <script type="text/javascript" src="js/jquery.countTo.js"></script>
  <script type="text/javascript" src="js/lightbox.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>

</body>
</html>