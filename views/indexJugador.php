<?php

include('layout/headerJugador.php');

// Traer datos usuario.

?>

<!-- Aqui empieza la pagina -->




    <header id="home">

    <div id="home-slider" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        <div class="item active" style="background-image: url(assets/images/slider/1.png)">
          <div class="caption">
            <h1 class="animated fadeInLeftBig">Bienvenido <span><?php echo $nombre?></span></h1>
            <p class="animated fadeInRightBig">Ahora puedes organizar tu partido, comentar recintos, y administrar tu perfil</p>
          </div>
        </div>
        <div class="item" style="background-image: url(assets/images/slider/2.png)">
          <div class="caption">
            <h1 class="animated fadeInLeftBig">¿No encuentras tu <span>cancha</span> favorita?</h1>
            <p class="animated fadeInRightBig">En MatchDay tenemos información de todas</p>
          </div>
        </div>
        <div class="item" style="background-image: url(assets/images/slider/3.png)">
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


<?php
include('layout/footer.php'); 


?>