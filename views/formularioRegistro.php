<?php 
include('layout/header.php');
?>


<!-- Aqui empieza la pagina -->

<div id="contact-us" class="parallax">
  <div class="container">
    <div class="row">
      <div class="heading text-center">
        <h2>Únete a MatchDay</h2>
        <p>En MatchDay, podrás agendar tus partidos, comentar tus canchas favoritas y agendar un tercer tiempo con tus amigos.</p>
        <h4>Paso 1: Completa el siguiente formulario</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-sm-offset-3 centered">
        <form  method="post" action="index.php?controlador=Usuario&accion=registrarUsuario" class="design-form col-sm-offset-3 centered" >
          <div class="row">
            <div class="col-sm-6 centered">
              <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" name="nombre" class="form-control" placeholder="Nombre" required="required">
                    </div>
                  </div>    
                

                  <div class="col-sm-6">
                    <div class="form-group">
                      <input type="text" name="apellido" class="form-control" placeholder="Apellido" required="required">
                    </div>
                  </div>
                </div>
                </div>

                <div class="row">
                  <div class="col-sm-6 col-sm-offset-3 centered">
                    <div class="form-group">
                      <input type="text" name="nickname" class="form-control" placeholder="Nickname" required="required">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6 col-sm-offset-3 centered">
                    <div class="form-group">
                      <input type="date" id="fechaNacimiento" name="fechaNacimiento" class="form-control" placeholder="Fecha de nacimiento" required="required">
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-sm-6 col-sm-offset-3 centered">
                    <div class="form-group">
                      <input type="mail" name="mail" class="form-control" placeholder="Email" required="required">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6 col-sm-offset-3 centered">
                    <div class="form-group">
                      <input type="text" name="telefono" class="form-control" placeholder="Telefono" >
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6 col-sm-offset-3 centered">
                    <div class="form-group">
                      <input type="password" name="password" class="form-control" placeholder="Password" >
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Selecciona género:&nbsp;</label>
                        <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-default">
                            <input type="radio" name="sexo" value="M" /> Masculino
                          </label>
                          <label class="btn btn-default">
                              <input type="radio" name="sexo" value="F" /> Femenino
                          </label>
                        </div>
                    </div>
                  </div>
                </div>
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



  

  <script src="js/fileinput.min.js" type="text/javascript"></script>

</body>
</html>