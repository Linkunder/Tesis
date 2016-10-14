<?php 

        include('layout/headerJugador.php');
?>



<!-- Aqui empieza la pagina -->

  
 

    <div id="contact-us" class="parallax">
      <div class="container">
        <div class="row">
          <div class="heading text-center">
            <h2>Notifica un recinto</h2>
            <p>¿Tu recinto favorito no está en MatchDay? ¿Qué esperas? Notificanos tu cancha favorita para que todos los jugadores de MatchDay deseen hacer goles en ella.</p>
            <h4>Paso 1: Completa el siguiente formulario</h4>
          </div>
        </div>
          <div class="row">
            <div class="col-sm-12 col-sm-offset-3 centered">
              <form  method="post" action="?controlador=Recinto&accion=ingresarRecinto" class="design-form col-sm-offset-3 centered" >




                <div class="row">
                  <div class="col-sm-6 col-sm-offset-3 centered">
                    <div class="form-group">
                      <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" >
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6 col-sm-offset-3 centered">
                    <div class="form-group">
                      <input type="text" name="fono" id="fono" class="form-control" placeholder="Telefono" >
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6 col-sm-offset-3 centered">
                    <div class="form-group">
                      <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Dirección" >
                    </div>
                  </div>
                </div>
                <input name="idUsuario" id="idUsuario" class="hide" value="<?php echo $_SESSION['login_user_id'] ?>" class="form-control">

                <div class="row">
                  <div class="col-sm-6 col-sm-offset-3 centered">
                  <button type="submit" class="btn-submit">Siguiente</button>
                </div>
             
                </div>
              </form>   
              </div>
          </div>
      </div>
    </div>   

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

</body>
</html>