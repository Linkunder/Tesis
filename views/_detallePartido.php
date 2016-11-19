<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Información del partido</h4>
      </div>

      <?php

      /* Verificar si se viene al detalle para:
        1. Ver el resumen de un partido en el sistema.
        2. Ver el resumen de un partido pendiente y cancelarlo.
        3. Ver el resumen de un partido pendiente y notificarlo a los jugadores del sistema
      */

      foreach ($vars['partido'] as $key ) {
        $idRecinto = $key['idRecinto'];
        $fecha = $key['fecha'];
        $hora = $key['hora'];
        $nombreRecinto = $key['nombre'];
        $fotoRecinto = $key['fotografia'];


      }
      ?>

      <div class="modal-body">

        <div class="container-fluid">
          <div id="slidingDiv1" class="toggleDiv row-fluid single-project">
            <div class="span4">
              <img src="assets/images/recintos/<?php echo $fotoRecinto?> ?>" alt="project 2">
              <button type="button" class="btn btn-primary btn-md center-block col-md-12" href="javascript:void(0);" 
              data-toggle="modal" data-target="#modal"  onclick="carga_ajax('modal','<?php echo $idRecinto;?>' ,'mapaRecinto');">
                ¿Cómo llegar? <i class="fa fa-map-marker" aria-hidden="true"></i>
              </button>
            </div>
            <div class="span8">
              <div class="project-description">
                <div class="project-info">
                  <table>
                    <tr>
                      <th width='25%'><span>Cancha</span></th>
                      <td id="texto-blanco" width='25%'><?php echo $nombreRecinto;?></td>
                    </tr>
                    <tr>
                      <th><span>Organizador</span></th>
                      <td id="texto-blanco"><?php echo $_SESSION['login_user_name']?></td>
                    </tr>
                    <tr>
                      <th><span>Fecha</span></th>
                      <td id="texto-blanco"><?php echo $fecha;?></td>
                    </tr>
                    <tr>
                      <th><span>Hora</span></th>
                      <td id="texto-blanco"><?php echo $hora;?></td>
                    </tr>
                    <tr>
                      <th><span>Tipo</span></th>
                      <td id="texto-blanco"><?php echo "no disponible";?></td>
                    </tr>
                    <tr>
                      <th><span>Cuota</span></th>
                      <td id="texto-blanco"><?php echo "no disponible";?></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

      <br/>

      <div class="modal-footer">
        <?php
        $accion = $vars['accion'];
        if ($accion == 0){  // Solicitud
          ?>
          <form>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">

                </div>
              </div>
            </div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
            <button type="submit" class="btn btn-primary">Enviar solicitud <i class="fa fa-check-circle" aria-hidden="true"></i></button>
         </form>
          <?php
        }
        if ($accion == 1){  // Cancelar
          ?>
          <h5 class="modal-title">¿Estás seguro que deseas cancelar este partido?</h5>
          <form >
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">

                </div>
              </div>
            </div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">No <i class="fa fa-times-circle" aria-hidden="true"></i></button>
            <button type="submit" class="btn btn-primary">Si <i class="fa fa-check-circle" aria-hidden="true"></i></button>
          </form>
          <?php
        }
        if ($accion == 2){  // Notificar
          ?>
          <h5 class="modal-title">Al notificar este partido al sistema, todos los jugadores de MatchDay tendrán acceso
            a la información referente al partido. ¿Estás seguro que deseas notificar el partido?</h5>
          <form >
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">

                </div>
              </div>
            </div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">No, deseo volver a mi lista <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
            <button type="submit" class="btn btn-primary">Si, notificar partido <i class="fa fa-check-circle" aria-hidden="true"></i></button>
          </form>
          <?php
        }
        ?>

      </div>


      
      </div>
  </div>


