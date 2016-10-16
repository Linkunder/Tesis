
<?php

include('layout/headerJugador.php'); 

// Se obtiene la lista de contactos del usuario.
//if (isset($vars['listaContactos'])){
$contactos = $vars['listaContactos'];
//}
?>

<link href="assets/css/profile.css" rel="stylesheet">
<div class="row">
  <div id="contact-us" class="parallax">
    <div class="container">

      <?php 
      if (count($contactos)==0){ ?>
      <h2>
        No tienes contactos <i class="fa fa-frown-o" aria-hidden="true"></i> 
      </h2>
      <p class="centered">Para agregar un nuevo contacto haz click 
        <button href="#" data-toggle="modal" data-target="#modal-1" type="button" class="btn btn-md btn-primary" action="">aquí <i class="fa fa-plus-circle"></i></button>
        . Para agregar a uno de tus contactos a un equipo, haz click en el botón 
        <button type="button" class="btn btn-md btn-success" action="">Agregar <i class="fa fa-users"></i></button></p>

            </div>
  </div>

</div>





      <?php
      include('layout/footer.php'); 
      } else {
      ?>

      <h2>Mis contactos</h2>
      <p class="centered">Para agregar un nuevo contacto haz click 
        <button href="#" data-toggle="modal" data-target="#modal-1" type="button" class="btn btn-md btn-primary" action="">aquí <i class="fa fa-plus-circle"></i></button>
        . Para agregar a uno de tus contactos a un equipo, haz click en el botón 
        <button type="button" class="btn btn-md btn-success" action="">Agregar <i class="fa fa-users"></i></button></p>
      <div class="table-responsive">
      <table class="table table-striped table-hover">
        <thead>
          <tr id="color-encabezado">
            <th></th>
            <th>Nombre</th>
            <th>Nickname</th>
            <th>Mail</th>
            <th>Equipo(s) en común</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="texto-contactos">
          <?php
          foreach ($contactos as $item) {
          ?>
          <tr>
          <td>
            <div class="profile-userpic">
              <!--img src="assets/images/usuarios/20.jpg" class="img-responsive" alt=""-->
            </div>
          </td>
          <td>
            <?php echo $item['nombre']." ".$item['apellido']?>
          </td>
          <td>
            <?php echo $item['nickname']?>
          </td>
          <td>
            <?php echo $item['mail']?>
          </td>
          <td>
            <?php echo "Pendiente"?>
          </td>
          <td class="centered"><button type="button" class="btn btn-md btn-success" action="">Agregar <i class="fa fa-users"></i></button></td>
        </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
    </div>
  </div>

</div>


<?php
include('layout/footer.php'); 
}

?>
<!-- /Aqui termina la pagina -->





<div class="container">
  <div class="modal fade" id="modal-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Búsqueda de jugadores</h3>
        </div>
        <div class="modal-body">
          <p id="texto-contactos">Para agregar un contacto, búscalo ingresando su nickname.</p>
          <form action="?controlador=Usuario&accion=busquedaJugador" method="POST">
            <input type="text" class="form-control partido" placeholder="Ingresa un nickname..." name="search"/>
              <div class="row">
                <div class="col-md-6 col-md-offset-4">
                  <div class="div-btn-a">
                    <button class="btn-busqueda" type="submit">Buscar</button>  
                  </div>
                </div>
              </div>          
          </form>
          <hr/>

          <?php
          $search = '';
          $cont = 0;
          if (isset($_GET['search'])){
            $search = $_GET['search'];
          }
          if ($search!=''){
            ?>
          
          <h3>Resultados</h3>
          <hr/>
          <?php 
          }
          foreach ($variable as $key => $value) {
            # code...
          }
          ?>

          <div class="col-sm-6">
            <div class="folio-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="300ms">
              <div class="folio-image">
                <!--img class="img-responsive" src="images/usuarios/<?php //echo  $key->getRutaFotografia(); ?>" alt=""-->
              </div>
              <div class="overlay">
                <div class="overlay-content">
                  <div class="overlay-text">
                    <div class="folio-info">
                      <h3>Añadir a <?php //echo $nickname?></h3>
                      <p><?php //echo $nombre?> <?php //echo $apellido?></p>
                    </div>
                    <div class="folio-overview">
                      <!--span class="folio-link"><a class="folio-read-more" href="#" data-single_url="agregarContacto.php?id_contacto=<?php //echo $idUsuario ?>" ><i class="fa fa-plus"></i></a></span-->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>

