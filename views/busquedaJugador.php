
<?php

include('layout/headerJugador.php');
if (isset($vars['usuarios'])){
  $resultados = $vars['usuarios'];
}





if (count($resultados)==0){   // NO SE HAN ENCONTRADO RESULTADOS
?>


<link href="assets/css/profile.css" rel="stylesheet">
<div class="row">
  <div id="contact-us" class="parallax">
  	<div class="container">
    <h2>Lo sentimos, no se han encontrado resultados <i class="fa fa-frown-o"></i></h2>
    <h4>Recuerda que en MatchDay, debes tener el nickname tu amigo para añadirlo a tu lista, verifícalo e intenta nuevamente.</h4>
    <div class="row">
    	<div class="col-md-4">
    	</div>
    	<div class="col-md-4">
    		<a href="?controlador=Contacto&accion=listaContactos"><button type="submit" class="btn-submit">Volver</button></a>

    	</div>
    	<div class="col-md-4">
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
            <p class="pull-right">Crafted by <a href="http://designscrazed.org/">Allie</a></p>
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




<?php
} else {        // SI ESTA EL NICKNAME EN LA BASE DE DATOS
?>


<link href="assets/css/profile.css" rel="stylesheet">
<div class="row">
  <div id="contact-us" class="parallax">
  	<div class="container">
      <h2>Resultados</h2>
      	<?php
        if (isset($vars['contacto'])){
          $respuesta = $vars['contacto'];
          $aux = 1;
        } else {
          $respuesta = $vars['excepcion'];
          $aux= 0;
        }
        
        foreach ($resultados as $item) {


          if ($aux == 1){
          if (!$respuesta){           

        ?>


      <p class="centered"> Para agregar a <?php echo $item['nickname']?> a tu lista, haz click en el botón 
        <button type="button" class="btn btn-md btn-success" action="">Agregar <i class="fa fa-plus-circle"></i></button></p>

        <div class="row profile">
        <div class="col-md-4 col-offset-6 centered">
          <div class="profile-sidebar">

            <!-- SIDEBAR USERPIC -->
            <div class="profile-userpic">
              <img src="assets/images/usuarios/<?php echo $item['fotografia']; ?>" class="img-responsive" alt="">
            </div>
            <!-- END SIDEBAR USERPIC -->

            <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
              <div class="profile-usertitle-name">
                <?php

                  echo $item['nombre']." ".$item['apellido'];
                
                ?>
              </div>

            </div>
            <!-- END SIDEBAR USER TITLE -->
            
            <!-- SIDEBAR BUTTONS -->
            <div class="profile-userbuttons">
              <a href="?controlador=Contacto&accion=listaContactos&jugador=<?php echo $item['idUsuario']?>">
                <button type="button" class="btn btn-success btn-sm">Agregar 
                  <i class="fa fa-plus-circle"></i>
                </button>
              </a>
              <a href="?controlador=Contacto&accion=listaContactos">
                <button type="button" class="btn btn-sm btn-primary btn-sm">Volver
                  <i class="fa fa-arrow-circle-left"></i>
                </button>
              </a>
            </div>
            <!-- END SIDEBAR BUTTONS -->
            

            <!-- END MENU -->

          <?php

        } else {          // YA ESTA EN LA LISTA DE CONTACTOS


          ?>


      <p class="centered"> <?php echo $nombre.", ya tienes a ".$item['nickname']?> en tu lista de contactos.</p>

        <div class="row profile">
        <div class="col-md-4 col-offset-6 centered">
          <div class="profile-sidebar">

            <!-- SIDEBAR USERPIC -->
            <div class="profile-userpic">
              <img src="assets/images/usuarios/<?php echo $item['fotografia']; ?>" class="img-responsive" alt="">
            </div>
            <!-- END SIDEBAR USERPIC -->

            <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
              <div class="profile-usertitle-name">
                <?php

                  echo $item['nombre']." ".$item['apellido'];
                
                ?>
              </div>

            </div>
            <!-- END SIDEBAR USER TITLE -->
            
            <!-- SIDEBAR BUTTONS -->
            <div class="profile-userbuttons">
              
              <a href="?controlador=Contacto&accion=listaContactos">
                <button type="button" class="btn btn-sm btn-primary btn-sm">Volver
                  <i class="fa fa-arrow-circle-left"></i>
                </button>
              </a>
            </div>
            <!-- END SIDEBAR BUTTONS -->
            

            <!-- END MENU -->


        <?php
        




          }


} else {


?>



      <p class="centered"> <?php echo $nombre?>, no te puedes agregar a tu mismo. Sin embargo, esto ven tus amigos cuando te agregan a su lista.</p>


        <div class="row profile">
        <div class="col-md-4 col-offset-6 centered">
          <div class="profile-sidebar">

            <!-- SIDEBAR USERPIC -->
            <div class="profile-userpic">
              <img src="assets/images/usuarios/<?php echo $item['fotografia']; ?>" class="img-responsive" alt="">
            </div>
            <!-- END SIDEBAR USERPIC -->

            <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
              <div class="profile-usertitle-name">
                <?php

                  echo $item['nombre']." ".$item['apellido'];
                
                ?>
              </div>

            </div>
            <!-- END SIDEBAR USER TITLE -->
            
            <!-- SIDEBAR BUTTONS -->
            <div class="profile-userbuttons">
              
              <a href="?controlador=Contacto&accion=listaContactos">
                <button type="button" class="btn btn-sm btn-primary btn-sm">Volver
                  <i class="fa fa-arrow-circle-left"></i>
                </button>
              </a>
            </div>


<?php


}



          }
            ?>


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
            <p class="pull-right">Crafted by <a href="http://designscrazed.org/">Allie</a></p>
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



<?php
}
?>
