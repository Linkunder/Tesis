<!DOCTYPE html>
<html lang="es">
<?php

// Obtener datos del usuario de la sesión.
if (!isset($_SESSION['login_user_name'])){
  session_start();
}

if (isset($_SESSION['login_user_id'])){
  $idUsuario= $_SESSION['login_user_id'];
}

if (isset($_SESSION['login_user_name'])){
  $nombre= $_SESSION['login_user_name'];
}

if (isset($_SESSION['login_user_email'])){
  $mail= $_SESSION['login_user_email'];
}



//$idUsuario= $_SESSION['login_user_id'];
//$nombre= $_SESSION['login_user_name'];
//$mail= $_SESSION['login_user_email'];

?>


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>MatchDay | A jugar!</title>
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/animate.min.css" rel="stylesheet"> 
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/css/lightbox.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
  <link id="css-preset" href="assets/css/presets/preset1.css" rel="stylesheet">
  <link href="assets/css/responsive.css" rel="stylesheet">

  <!--link rel="stylesheet" type="text/css" href="css/bootstrap.css" /-->
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-responsive.css" />
  <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
  <link rel="stylesheet" type="text/css" href="assets/css/pluton.css" />
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.cslider.css" />
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.bxslider.css" />
  <link rel="stylesheet" type="text/css" href="assets/css/animate.css" />
  <!--CARUSEL
  <link rel="stylesheet" type="text/css" href="css/demo.css" />
  <link rel="stylesheet" type="text/css" href="css/elastislide.css" />
  <link rel="stylesheet" type="text/css" href="css/custom.css" />
  <script src="js/modernizr.custom.17475.js"></script>
  -->

    <!--Para subir la imagen-->
  <link href="assets/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
  <![endif]-->
  
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="assets/images/soccer.ico">


</head><!--/head-->

    <?php
        $full_name = $_SERVER['PHP_SELF'];
        $name_array = explode('/',$full_name);
        $count = count($name_array);
        $page_name = $name_array[$count-1];
    ?>

<body>

  <!-- Inicio Header -->

  <header id="home">
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
            <h1><img class="img-responsive" src="assets/images/logo.png" alt="logo"></h1>
          </a>                    
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">                 
            <li class="<?php echo ($page_name=='inicioJugador')?'active':'';?>"><a href="?controlador=Index&accion=indexJugador">Inicio</a></li>
            <li class="<?php echo ($page_name=='recintos')?'active':'';?>"><a id="myLink" href="#" onclick="partido();return false;">Jugar</a></li> <!--Jugar = 1 para entrar a buscar recintos en el mismo reutilizando-->
            <ul class="nav pull-left">
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $nombre?> <i class="fa fa-user"></i>
                <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="?controlador=Usuario&accion=perfilUsuario">Perfil   </a></li><div class="drop-divider"></div>
                  <li><a href="?controlador=Contacto&accion=listaContactos">Contactos </a></li><div class="drop-divider"></div>
                  <li><a href="?controlador=Equipo&accion=listaEquipos">Equipos </a></li><div class="drop-divider"></div>
                  <li><a href="?controlador=Recinto&accion=notificarRecinto">Notificar recinto </a></li><div class="drop-divider"></div>
                  <li><a href="?controlador=Sesion&accion=logout">Cerrar Sesion <i class="fa fa-sign-out"></i></a></li>
                   
                </ul>
              </li>
            </ul>
            <ul class="nav pull-left">
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Partidos <i class="fa fa-flag" aria-hidden="true"></i>
                <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <?php

                  /*
                  include_once('../TO/Partido.php');
                  include_once('../Logica/controlPartidos.php');

                  $controlPartido = controlPartidos::obtenerInstancia();
                  $partidosCapitan = $controlPartido->contarPartidosCapitan($idUsuario);
                  */

                  ?>
                  <li><a href="partidosPendientes.php">Partidos pendientes: <?php //echo $partidosCapitan?></a></li>
                  <div class="drop-divider"></div>
                  
                  
                  <?php
                  /*
                  include_once('../TO/Partido.php');
                  include_once('../Logica/controlPartidos.php');

                  $controlPartido = controlPartidos::obtenerInstancia();
                  $partidosDisponibles = $controlPartido->contarPartidosDisponibles();
                  */


                  ?>
                  <li><a href="partidosDisponibles.php">Partidos MatchDay: <?php// echo $partidosDisponibles?></a></li>
                  
                  <li><a href="partidosGestionados.php">Partidos Agendados</a></li>

                  
                </ul>
              </li>
            </ul>
          </ul>
        </div>
      </div>
    </div><!--/#main-nav-->


  </div>
  <form action="?controlador=Recinto&accion=busquedaRecintos" method=post name="formulario1"> 
    <input type="hidden" name="jugar" value="1"> 
    <input type="hidden" name="tipo" value="1"> 
</form>
  <form action="?controlador=Recinto&accion=busquedaRecintos" method=post name="formulario2"> 
    <input type="hidden" name="jugar" value="0"> 
    <input type="hidden" name="tipo" value="1"> 
</form>

  <script>
  
   
      function partido(){
          document.formulario1.submit()
      }
      function cancha(){
        document.formulario2.submit()
      }
    
    

  </script>
  </header><!-- /Fin Header -->