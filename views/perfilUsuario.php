
<?php 

include('layout/headerJugador.php'); 

// Traer usuario desde el controlador.

$usuario = $vars['perfilUsuario'];




?>



<!-- Aqui empieza la pagina -->
<link href="assets/css/profile.css" rel="stylesheet">
<div class="row">
  <div id="contact-us" class="parallax">
    <div class="container">
      <div class="row profile">
        <div class="col-md-4 col-offset-6 centered">
          <div class="profile-sidebar">

            <?php 
            foreach ($usuario as $key) {
              
            ?>

            <!-- SIDEBAR USERPIC -->
            <div class="profile-userpic">
              <!--img src="assets/images/usuarios/<?php //echo $item['fotografia']; ?>"  class="img-responsive" alt=""-->
            </div>
            <!-- END SIDEBAR USERPIC -->

            <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
              <div class="profile-usertitle-name">
                <?php

                  echo $key['nombre']." ".$key['apellido'];
                
                ?>
              </div>

            </div>
            <!-- END SIDEBAR USER TITLE -->
            
            <!-- SIDEBAR BUTTONS -->
            <div class="profile-userbuttons">
              <a href="?controlador=Usuario&accion=modificarPerfil">
                <button type="button" class="btn btn-success btn-sm">Ver información
                  <i class="fa fa-pencil"></i>
                </button>
              </a>
              <!--a href="subirImagen.php?idUsuario=<?php //echo $key->getIdUsuario();?>"-->
                <button type="button" class="btn btn-sm btn-warning btn-sm">Cambiar imagen
                  <i class="fa fa-camera"></i>
                </button>
              </a>
            </div>
            <!-- END SIDEBAR BUTTONS -->
            
            <!-- SIDEBAR MENU -->
            <div class="profile-usermenu">
              <ul class="nav">
                <li >
                  <a href="?controlador=Usuario&accion=perfilUsuario">
                  <i class="fa fa-calendar"></i>
                  Ver calendario de partidos</a>
                </li>
                <li>
                  <a href="../Logica/controlSesion.php?tipo=salir">
                  <i class="fa fa-sign-out"></i>
                  Cerrar sesión </a>
                </li>
              </ul>
            </div>
            <!-- END MENU -->

            <?php
            }
            ?>


          </div>
        </div>

      </div>
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
            <p class="pull-right">Crafted by <a href="http://designscrazed.org/">Allie

            </a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script type="text/javascript" src="assets/js/jquery.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>

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

