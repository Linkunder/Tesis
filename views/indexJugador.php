<?php

include('headerJugador.php');

include_once('../TO/Usuario.php');
include_once('../Logica/controlUsuarios.php');

$control = controlUsuarios::obtenerInstancia();
$usuario = $control->leerUsuario($idUsuario);

foreach ($usuario as $key) {
  $nombre = $key->getNombre();
}



?>

<!-- Aqui empieza la pagina -->




  <?php if($_SESSION['estado'] == "penalizado"){?>
  <div class="container">
    <div class="alert alert-danger fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Importante!</strong> Por comportamiento inadecuado tu cuenta ha sido restringida. 
      No podras comentar o agendar partidos por un plazo de X .
    </div>
  </div>
  <?php } ?>

<?php
if(isset($_GET["accion"])){
  $accion = $_GET["accion"];  
  ?>
  <div class="alert alert-success alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <?php
    if ($accion == "notificar"){ ?>
   <strong>Listo! </strong>Se ha notificado a los usuarios de MatchDay tu partido.
   <?php } 
    if ($accion == "solicitud"){ ?>
   <strong>Listo! </strong>Se ha enviado un correo al capitán del partido para notificar tu solicitud.
   <?php } 
   ?>
 </div>
<?php
}
?>

    <header id="home">

    <div id="home-slider" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        <div class="item active" style="background-image: url(images/slider/1.png)">
          <div class="caption">
            <h1 class="animated fadeInLeftBig">Bienvenido <span><?php echo $nombre." ".$user?></span></h1>
            <p class="animated fadeInRightBig">Ahora puedes organizar tu partido, comentar recintos, y administrar tu perfil</p>
          </div>
        </div>
        <div class="item" style="background-image: url(images/slider/2.png)">
          <div class="caption">
            <h1 class="animated fadeInLeftBig">¿No encuentras tu <span>cancha</span> favorita?</h1>
            <p class="animated fadeInRightBig">En MatchDay tenemos información de todas</p>
          </div>
        </div>
        <div class="item" style="background-image: url(images/slider/3.png)">
          <div class="caption">
            <h1 class="animated fadeInLeftBig">Organiza un <span>Tercer Tiempo</span></h1>
            <p class="animated fadeInRightBig">¿Celebrar el triunfo? ¿Olvidar la derrota? 
              <br/>Da igual el motivo! En MatchDay te recomendamos los mejores lugares</p>
          </div>
        </div>
      </div>
      <a class="left-control" href="#home-slider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
      <a class="right-control" href="#home-slider" data-slide="next"><i class="fa fa-angle-right"></i></a>
    </div><!--/#home-slider-->

  </header><!--/#home-->



  <!-- /Aqui empieza la pagina -->



  <footer id="footer">
    <div class="footer-top wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
      <div class="container text-center">
        <div class="footer-logo">
          <a href="index.html"><img class="img-responsive" src="images/logo.png" alt=""></a>
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
            <p class="pull-right">Crafted by <a href="http://designscrazed.org/">Allie</a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>

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