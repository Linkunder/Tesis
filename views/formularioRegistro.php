<?php 
include('layout/header.php');
?>
<link rel="stylesheet" href="assets/css/style-f.css">

<!--DATEPICKER-->



<!-- Aqui empieza la pagina -->

<div id="contact-us" class="parallax">
  <div class="container">
    <div class="row">
      <div class="page-header">
          <h2> Únete a MatchDay </h2>
      </div>
      <p>En MatchDay, podrás agendar tus partidos, comentar tus canchas favoritas y agendar un tercer tiempo con tus amigos.</p>
    </div>

    <div class="row">
      <div class="col-sm-6 col-sm-offset-3 form-box">
        <form role="form" action="?controlador=Usuario&accion=registrarUsuario" method="post" class="registration-form" enctype="multipart/form-data">
          <fieldset>
            <div class="form-top">
              <div class="form-top-left">
                <h3>Paso 1 / 3</h3>
                <p>Ingresa tu información personal:</p>
              </div>
              <div class="form-top-right">
                <i class="fa fa-user"></i>
              </div>
            </div>
            <div class="form-bottom">
              <div class="form-group">
                <label class="sr-only" for="form-first-name">Nombre</label>
                <input type="text" name="nombre" placeholder="Ingresa tu nombre" class="form-first-name form-control" >
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-last-name">Apellido</label>
                <input type="text" name="apellido" placeholder="Ingresa tu apellido" class="form-last-name form-control" >
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-last-name">Fecha de nacimiento</label>
                <input type="date" name="fechaNacimiento" class="datepicker form-control">
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-last-name">Teléfono</label>
                <input type="text" name="telefono" placeholder="Ingresa tu teléfono" class="form-last-name form-control" >
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-about-yourself">Selecciona tu sexo</label>
                <select class="form-last-name form-control" name="sexo" required>
                        <option selected disabled>Selecciona sexo</option>
                        <option id="text-black" value="M">Masculino</option>
                        <option id="text-black" value="F">Femenino</option>
                      </select>  
              </div>
              <button type="button" class="btn btn-primary btn-next">Siguiente <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-top">
              <div class="form-top-left">
                <h3>Paso 2 / 3</h3>
                <p>Ingresa los datos de tu cuenta:</p>
              </div>
              <div class="form-top-right">
                <i class="fa fa-key"></i>
              </div>
            </div>
            <div class="form-bottom">
              <div class="form-group">
                <label class="sr-only" for="form-email">Mail</label>
                <input type="text" name="mail" placeholder="Ingresa tu mail" class="form-email form-control" >
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-password">Password</label>
                <input type="password" name="password" placeholder="Ingresa tu password" class="form-password form-control" >
              </div>
              <div class="form-group">
                <label class="sr-only" for="form-first-name">Nickname</label>
                <input type="text" name="nickname" placeholder="Elige un nickname" class="form-first-name form-control" >
              </div>
              <button type="button" class="btn btn-warning btn-previous"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Atrás</button>
              <button type="button" class="btn btn-primary btn-next">Siguiente <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
            </div>
          </fieldset>
          <fieldset>
            <div class="form-top">
              <div class="form-top-left">
                <h3>Paso 3 / 3</h3>
                <p>Selecciona una foto de perfil:</p>
              </div>
              <div class="form-top-right">
                <i class="fa fa-camera"></i>
              </div>
            </div>
            <div class="form-bottom">
              <div class="form-group">
                <label class="sr-only" for="imagen"></label>
                <input type="file" id="imagen" name="imagen" required="required"  class="file" multiple data-min-file-count="1">
              </div>
              <button type="button" class="btn btn-warning btn-previous"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Atrás</button>
              <button type="submit" class="btn btn-primary">Finalizar <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </div>
          </fieldset>
        </form>
      </div>
    </div>

      
 </div>
</div>
         

<!-- /Aqui termina la pagina -->

<script>
  document.getElementById("sexo").setAttibute("required","true");
</script>



  <footer id="footer">
    <div class="footer-top wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
      <div class="container text-center">
        <div class="footer-logo">
          <a href="?controlador=Index&accion=inicio"><img class="img-responsive" src="assets/images/logo.png" alt=""></a>
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



  
  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery.inview.min.js"></script>
  <script src="assets/js/wow.min.js"></script>
  <script src="assets/js/mousescroll.js"></script>
  <script src="assets/js/smoothscroll.js"></script>
  <script src="assets/js/jquery.countTo.js"></script>
  <script src="assets/js/lightbox.min.js"></script>


</body>
</html>





<script src="assets/js/fileinput.min.js"></script>
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/jquery.backstretch.min.js"></script>
<script src="assets/js/retina-1.1.0.min.js"></script>
<script src="assets/js/scripts.js"></script>

