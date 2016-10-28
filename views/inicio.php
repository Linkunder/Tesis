<?php include('layout/header.php'); 


/* Se llega a esta pantalla:

1. Inicio de sesión fallida (jugador y admin).
2. Cerrar sesión.

*/


?>







<!-- Aqui empieza la pagina -->
<div id="contact-us-inicio" class="parallax">

<?php

if (isset($vars['error_login'])){
  $inicio_sesion = $vars['error_login'];
  if ($inicio_sesion){
    ?>
    <div class="container">
      <div class="alert alert-danger fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error!</strong> No has podido iniciar sesión, vuelve a intentarlo.
      </div>
    </div>
    <?php
  }
}


if (isset($vars['cerrar_sesion'])){
  $logout = $vars['cerrar_sesion'];
  if ($logout){
    ?>
    <div class="container">
      <div class="alert alert-danger fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Listo!</strong> Te has desconectado del sistema.
      </div>
    </div>
    <?php
  }
}

?>


  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <br/>
      <div class="jumbotron my-back">
        <h2 id="text-black">
          Bienvenido a MatchDay
        </h2> 
        <p id="black-center">
         En MatchDay, podrás organizar tus encuentros deportivos de una manera única e inigualable. Tendrás acceso a información de las canchas repartidas 
         por distintos sectores de Chillán. Además, existen muchas funcionalidades para hacer de un partido una experiencia inolvidable. 
         ¿Qué esperas? ¡Únete a MatchDay!
        </p>
        <h2><a class="btn btn-primary btn-large" href="?controlador=Usuario&accion=formularioRegistro">Regístrarse</a></h2>
      </div>
    </div>
      <br/> <br/> <br/> 
    </div>
  </div>
</div>




<!-- /Aqui termina la pagina -->



  <footer id="footer">
    <div class="footer-top wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
      <div class="container text-center">
        <div class="footer-logo">
          <a href="index.html"><img class="img-responsive" src="assets/images/logo.png" alt=""></a>
        </div>
        <div class="social-icons">
          <ul>
            <li><a class="envelope" href="#"><i class="fa fa-envelope"></i></a></li>
            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li> 
            <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
            <li><a class="tumblr" href="#"><i class="fa fa-tumblr-square"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <p>&copy; 2016 Oxygen Theme.</p>
          </div>
          <div class="col-sm-6">
            <p class="pull-right">Crafted by <a href="http://designscrazed.org/">S&M</a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script type="text/javascript" src="assets/js/jquery.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script type="text/javascript" src="assets/js/jquery.inview.min.js"></script>
  <script type="text/javascript" src="assets/js/wow.min.js"></script>
  <script type="text/javascript" src="assets/js/mousescroll.js"></script>
  <script type="text/javascript" src="assets/js/smoothscroll.js"></script>
  <script type="text/javascript" src="assets/js/jquery.countTo.js"></script>
  <script type="text/javascript" src="assets/js/lightbox.min.js"></script>
  <script type="text/javascript" src="assets/js/main.js"></script>

  <script src="assets/js/fileinput.min.js" type="text/javascript"></script>

</body>
</html>