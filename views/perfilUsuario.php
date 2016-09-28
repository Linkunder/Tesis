<?php 

include('layout/header.php'); 

// Se debe traer el ID del jugador que tenga la sesión iniciada.
$idUsuario = 1;

// Traer Usuario ID = 1



?>



<!-- Aqui empieza la pagina -->
<link href="css/profile.css" rel="stylesheet">
<div class="row">
  <div id="contact-us" class="parallax">
    <div class="container">
      <div class="row profile">
        <div class="col-md-4 col-offset-6 centered">
          <div class="profile-sidebar">
           


            <!-- SIDEBAR USERPIC -->
            <div class="profile-userpic">
              <!--img src="images/usuarios/<?php echo $key->getRutaFotografia();?>" class="img-responsive" alt=""-->
            </div>
            <!-- END SIDEBAR USERPIC -->

            <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
              <div class="profile-usertitle-name">
                <?php
                  //echo $key->getNombre()." ".$key->getApellido();
                
                ?>
              </div>

            </div>
            <!-- END SIDEBAR USER TITLE -->
            
            <!-- SIDEBAR BUTTONS -->
            <div class="profile-userbuttons">
              <!--a href="modificarPerfil.php?idUsuario=<?php echo $key->getIdUsuario();?>"-->
                <button type="button" class="btn btn-success btn-sm">Ver información
                  <i class="fa fa-pencil"></i>
                </button>
              </a>
              <!--a href="subirImagen.php?idUsuario=<?php echo $key->getIdUsuario();?>"-->
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
                  <!--a href="verCalendarioJugador.php?idUsuario=<?php echo $key->getIdUsuario();?>"-->
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

  <script type="text/javascript" src="js/jquery.inview.min.js"></script>
  <script type="text/javascript" src="js/wow.min.js"></script>
  <script type="text/javascript" src="js/mousescroll.js"></script>
  <script type="text/javascript" src="js/smoothscroll.js"></script>
  <script type="text/javascript" src="js/jquery.countTo.js"></script>
  <script type="text/javascript" src="js/lightbox.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>

  <script src="js/fileinput.min.js" type="text/javascript"></script>

</body>
</html>