
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
    <div class="page-header">
          <h2> Lo sentimos, no se han encontrado resultados <i class="fa fa-frown-o" aria-hidden="true"></i>  </h2>
      </div>

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

<?php
include('layout/footer.php'); 

} else {        // SI ESTA EL NICKNAME EN LA BASE DE DATOS
?>


<link href="assets/css/profile.css" rel="stylesheet">
<div class="row">
  <div id="contact-us" class="parallax">
  	<div class="container">
      <div class="page-header">
          <h2> Resultados </h2>
      </div>
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

<?php
include('layout/footer.php'); 
}
?>
