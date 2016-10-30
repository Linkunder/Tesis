
<?php

include('layout/headerJugador.php');
$equipos = $vars['listaEquipos'];
$desafios = $vars['listaDesafios'];





?>



<link href="assets/css/profile.css" rel="stylesheet">



<div id="contact-us" class="parallax">
  <div class="container">
    <br>
    <ol class="breadcrumb transparent">
      <li class="breadcrumb-item"><a href="?controlador=Index&accion=indexJugador"> <i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="breadcrumb-item active">Desafios</li>
    </ol>

    <?php
    if (count($desafios)==0){          // CASO 1: NO TENER DESAFIOS
      ?>
      <div class="page-header">
        <h2> Desafios <i class="fa fa-futbol-o" aria-hidden="true"></i> </h2>
      </div>

      <p class="centered">No has realizado desafíos en MatchDay. Puedes crear un nuevo desafío o
              visitar el vestíbulo de desafíos de MatchDay, para enfrentarte a otros equipos.
      </p>

      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <table class="table">
            <tr>
              <th style="border-top:transparent; text-align:center;">
                <button type="button" class="btn btn-md btn-primary" href="#" data-toggle="modal" data-target="#modal-1" >Enviar desafío 
                  <i class="fa fa-plus-circle"></i>
                </button>
              </th>
              <th style="border-top:transparent; text-align:center;">
                <button type="button" class="btn btn-md btn-primary" href="#" data-toggle="modal" data-target="#modal-2" >Visitar vestíbulo
                  <i class="fa fa-info-circle" aria-hidden="true"></i>
                </button>
              </th>
            </tr>
          </table>
        </div>
      </div>
      <br>



</div>
</div>
      <?php
      include('layout/footer.php'); 




      } else {    // CASO 2: TENER EQUIPOS COMO CAPITAN
        ?>
        <div class="page-header">
          <h2> Desafíos <i class="fa fa-futbol-o" aria-hidden="true"></i> </h2>
        </div>
      
            <p class="centered">A continuación puedes ver los desafíos enviados por tus equipos en MatchDay. Además puedes crear un nuevo desafío o
              visitar el vestíbulo de desafíos de MatchDay, para enfrentarte a otros equipos.
            </p>


            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                  <table class="table">
                    <tr>
                      <th style="border-top:transparent; text-align:center;">
                          <button type="button" class="btn btn-md btn-primary" href="#" data-toggle="modal" data-target="#modal-1" >Enviar desafío 
                          <i class="fa fa-plus-circle"></i>
                          </button>
                      </th>
                      <th style="border-top:transparent; text-align:center;">
                          <button type="button" class="btn btn-md btn-primary" href="#" data-toggle="modal" data-target="#modal-2" >Ver vestíbulo
                          <i class="fa fa-info-circle" aria-hidden="true"></i>
                          </button>
                      </th>
                    </tr>
                  </table>
              </div>
            </div>



            <br>





        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr id="color-encabezado">
                    <th>Equipo</th>
                    <th>Fecha</th>
                    <th>Tipo de partido</th>
                    <th>Estado</th>
                  </tr>
                </thead>
                <tbody id="texto-contactos">
                  <?php
                  foreach ($desafios as $item) {
                  ?>
                  <tr>
                  <td>
                    <?php echo $item['nombre']?>
                  </td>
                  <td>
                    <?php echo $item['fecha']?>
                  </td>
                  <td>
                    <?php 
                    $tipo = $item['tipoPartido'];
                    if ($tipo==0){
                      echo "Fútbol";
                    }
                    if ($tipo==1){
                      echo "Futbolito";
                    }
                    if ($tipo==2){
                      echo "Baby-Fútbol";
                    }
                    ?>
                  </td>
                  <td>
                    <?php 
                    if ($item['estado']==0){
                      ?>
                      <span class="label label-warning">Esperando respuestas <i class="fa fa-clock-o" aria-hidden="true"></i></span>
                      <?php
                    }
                    if ($item['estado']==1){
                      ?>
                      <span class="label label-success">Con respuestas <i class="fa fa-bell" aria-hidden="true"></i></span>
                      <?php
                    }
                    if ($item['estado']==2){
                      ?>
                      <span class="label label-danger">Tiempo límite <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
                      <?php
                    }
                    ?>
                  </td>
                  <td>
                    <button class="btn btn-primary" title="Ver detalle" href="#" data-toggle="modal" data-target="#modal-3">
                      <i class="fa fa-search-plus" aria-hidden="true"></i>
                    </button>
                  </td>
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
</div>

      <?php
      
      include('layout/footer.php'); 
    }
      ?>
     

<!-- Script Graficos -->


<!-- Modal -->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-duallistbox.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="assets/js/jquery.bootstrap-duallistbox-modal.js"></script>

<div class="modal fade" id="modal-1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <?php
      if (count($equipos)==0){        // 1. No hay equipos para el desafio
      ?>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Atención <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h4>
        </div>
        <div class="modal-body">
          <form id="demoform" action="?controlador=Equipo&accion=listaEquipos" method="post">
          <h5 class="texto-modal-negro"><?php echo $nombre?>, para desafiar a otros equipos, debes ser capitán de al menos un equipo. 
            Te recomendamos acceder a la sección de equipos e intentarlo nuevamente.
          </h5>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Ir a Equipos <i class="fa fa-users" aria-hidden="true"></i></button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar <i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
      </form>
      <?php
      } else {                        //  2.  Hay equipos para el desafio.
      ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Crea tu desafío</h4>
      </div>
      <div class="modal-body">
        <h5 class="texto-modal-negro">Ingresa los siguientes datos para realizar el desafío MatchDay</h5><br>
        <form id="demoform" action="?controlador=Desafio&accion=crearDesafio" method="post">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="texto-modal-negro" for="tipoPartido">Tipo de partido: </label>
                  <select class="form-control" name="tipoPartido" required>
                    <option selected disabled>Selecciona un tipo de partido</option>
                    <option  value="0" class="texto-modal-negro">Fútbol</option>
                    <option  value="1" class="texto-modal-negro">Futbolito</option>
                    <option  value="2" class="texto-modal-negro">Baby-Fútbol</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="texto-modal-negro" for="fecha">Fecha del partido: </label>
                  <input type="date" name="fecha" class="form-last-name form-control" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="texto-modal-negro" for="equipo">Equipo desafiante: </label>
                  <select class="form-control" name="equipo" required>
                        <option selected disabled>Selecciona uno de tus equipos</option>
                        <?php
                        foreach($equipos as $item){
                        ?>
                        <option  value="<?php echo $item['idEquipo']?>" class="texto-modal-negro">
                            <?php echo $item['idEquipo'].": ".$item['nombre']?>
                        </option>
                        <?php
                        }
                        ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="texto-modal-negro" for="comentario">Comentario adicional: </label>
                  <textarea id="texto-input-black" class="form-control" rows="2" maxlength="200" name="comentario"></textarea>
                </div>
              </div>
            </div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar <i class="fa fa-times" aria-hidden="true"></i></button>
          <button type="submit" class="btn btn-primary">Aceptar <i class="fa fa-check" aria-hidden="true"></i></button>
        </div>
        </form>

      </div>
      <?php
      }
      ?>
    </div>
  </div>
</div>



<!-- VESTIBULO DE DESAFIOS -->
<?php
  $desafiosSistema = $vars['listaDesafiosSistema'];
?>


<div class="modal fade" id="modal-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <?php
      if (count($desafiosSistema) == 0){
      ?>
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Atención <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h4>
      </div>
      <div class="modal-body">
          <h5 class="texto-modal-negro"><?php echo $nombre?>, ahora no hay desafios disponibles en MatchDay, intentalo en unos momentos más.
          </h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar <i class="fa fa-accept" aria-hidden="true"></i></button>
      </div>
      <?php   
      } else {
        ?>




      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Desafíos MatchDay</h4>
      </div>
      <div class="modal-body">
          <h5 class="texto-modal-negro"><?php echo $nombre?>, elige uno de los desafios para ver mayores detalles.
          </h5>

          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr id="color-encabezado">
                  <th>Equipo</th>
                  <th>Edad promedio</th>
                  <th>Puntuacion</th>
                  <th>Dia del partido</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="texto-contactos">
                <?php
                foreach ($desafiosSistema as $item) {
                  ?>
                  <tr>
                    <td>
                      <?php echo $item['nombreEquipo']?>
                    </td>
                    <td>
                      <?php echo $item['edadPromedio']?>
                    </td>
                    <td>
                      <?php echo $item['puntuacion']?>
                    </td>
                    <td>
                      <?php echo $item['fecha']?>
                    </td>
                    <td class="centered">
                      <button class="btn btn-primary" title="Ver detalle" href="#" data-toggle="modal" data-target="#modal-4">
                      <i class="fa fa-search-plus" aria-hidden="true"></i>
                    </button>
                    </td>
                  </tr>
                    <?php
                    }
                    ?>
              </tbody>
            </table>
          </div>

          <?php
          foreach ($desafiosSistema as $key) {
           ?>

           <?php
          }
          ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
      </div>

        <?php
      }
      ?>


    </div>
  </div>
</div>







<!--DETALLE DESAFIO-->
<div class="modal fade" id="modal-4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">



      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Desafíos MatchDay</h4>
      </div>
      <div class="modal-body">
          <h5 class="texto-modal-negro"><?php echo $nombre?>, elige uno de los desafios para ver mayores detalles.
          </h5>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
      </div>



    </div>
  </div>
</div>



