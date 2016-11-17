<?php 

        include('layout/headerJugador.php');
?>
<link rel="stylesheet" href="assets/css/style-f.css">


<!--  jQuery -->
<script type="text/javascript" src="assets/js/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="assets/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="assets/css/bootstrap-datepicker3.css"/>



<script type="text/javascript" src="assets/js/cropbox.js"></script>

<script type="text/javascript" src="assets/js/cropbox-min.js"></script>




<!-- Aqui empieza la pagina -->
<div id="contact-us" class="parallax">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3 form-box">
        <form role="form" action="?controlador=Recinto&accion=ingresarRecinto" method="post" class="registration-form" >
          <fieldset>
            <div class="form-top">
              <div class="form-top-left">
            <h2>Notifica un recinto</h2>
            <p>¿Tu recinto favorito no está en MatchDay? ¿Qué esperas? Notificanos tu cancha favorita para que todos los jugadores de MatchDay deseen hacer goles en ella.</p>
              </div>
              <div class="form-top-right">
                <i class="fa fa-futbol-o" aria-hidden="true"> </i>
              </div>
            </div>
            <div class="form-bottom">
              <div class="form-group">
                <label class="sr-only" for="form-first-name">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" >
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-last-name">Telefono</label>
                      <input type="text" name="fono" id="fono" class="form-control" placeholder="Telefono" >
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-last-name">Dirección</label>
                <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Dirección" >
              </div>
              <div class="form-group">
                  <input name="idUsuario" id="idUsuario" class="hide" value="<?php echo $_SESSION['login_user_id'] ?>" class="form-control">
              </div>
              <button type="submit" class="btn btn-primary">Notificar <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
  </div>
 <!-- Prueba -->

   
<!-- /Aqui termina la pagina -->



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
  <script type="text/javascript" src="assets/js/fileinput.min.js"></script>






<script src="assets/js/jquery.backstretch.min.js"></script>
<script src="assets/js/retina-1.1.0.min.js"></script>
<script src="assets/js/scripts.js"></script>



</body>
</html>