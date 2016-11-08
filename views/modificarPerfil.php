<?php 

include('layout/headerJugador.php'); 

// Traer usuario desde el controlador.

if (isset($vars['modificarPerfil']  )){
  $usuario = $vars['modificarPerfil'];
}





?>



<!-- Aqui empieza la pagina -->

<link href="assets/css/profile.css" rel="stylesheet">









  <div id="contact-us" class="parallax">

    <div class="container">
      <br>
    <ol class="breadcrumb transparent">
      <li class="breadcrumb-item"><a href="?controlador=Index&accion=indexJugador"> <i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="breadcrumb-item"><a href="?controlador=Usuario&accion=perfilUsuario"> <i class="fa fa-user" aria-hidden="true"></i> Perfil</a></li>
      <li class="breadcrumb-item active">Modificar perfil</li>
    </ol>

    <div class="page-header">
          <h2> Modificar perfil <i class="fa fa-user" aria-hidden="true"></i> </h2>
        </div>

      <div class="row profile">
        <div class="col-md-4 ">
          <div class="profile-sidebar">
            <?php
            foreach ($usuario as $key) {?>
          <!-- SIDEBAR USERPIC -->
            <div class="profile-userpic">
              <img src="assets/images/usuarios/<?php echo $key['fotografia']?>" class="img-responsive" alt="">
            </div>
            <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
              <div class="profile-usertitle-name">
                <?php
                 echo $key['nombre']." ".$key['apellido'];
                
                ?>
              </div>

            </div>
            <!-- END SIDEBAR USER TITLE -->
          </div>
          <!-- END SIDEBAR USERPIC -->
        </div>
        <div class="col-md-8 ">
          <div class="profile-sidebar col-offset-6 centered">
                  <form role="form" action="?controlador=Usuario&accion=actualizarInformacion" method="post">
                      <table class="table table-form">
                       
                        <tr>
                          <th>Nickname: </th>
                          <th><input class="profile-form-control" name="nickname" id="nickname" value="<?php echo $key['nickname']?>"></th>
                        </tr>
                        <tr>
                          <th>Mail: </th>
                          <th><input class="profile-form-control" name="mail" id="mail" value="<?php echo $key['mail']?>"></th>
                        </tr>
                        <tr>
                          <th>Telefono: </th>
                          <th><input class="profile-form-control" name="telefono" id="telefono" value="<?php echo $key['telefono']?>"></th>
                        </tr>
                        <tr>
                          <th>Fecha de nacimiento: </th> 
                          <th><input class="profile-form-control" readonly="readonly" type="date" name="fechaNacimiento" id="fechaNacimiento" value="<?php echo $key['fechaNacimiento']?>"></th>
                        </tr>
                        <tr>
                          <th>Sexo: </th>
                          <th><input class="profile-form-control"  readonly="readonly" value="<?php echo $key['sexo']?>"></th>
                        </tr>
                      </table>
                        <div class="col-md-4">
                        <button type="submit" class="btn btn-lg btn-primary">Actualizar <i class="fa fa-paper-plane fa-1x"></i></button>
                        </div>
                        <div class="col-md-4">
                        <button type="reset" class="btn btn-lg btn-warning">Reiniciar <i class="fa fa-eraser fa-1x"></i></button>
                        </div>
                    <?php
                    }
                    ?>
                  </form>
                  <div class="col-md-4">
                    <a href="?controlador=Usuario&accion=perfilUsuario"><button class="btn btn-lg btn-danger">Volver <i class="fa fa-arrow-left fa-1x"></i></button></a>
                  </div>
                  <br/><br/>
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