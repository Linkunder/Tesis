<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Información del partido</h4>
      </div>

      <?php

      foreach ($vars['partido'] as $key ) {
        $idRecinto = $key['idRecinto'];
        $fecha = $key['fecha'];
        $hora = $key['hora'];

      }
      ?>

      <div class="modal-body">

        <div class="container-fluid">
          <div id="slidingDiv1" class="toggleDiv row-fluid single-project">
            <div class="span4">
              <img src="assets/images/recintos/1.jpg ?>" alt="project 2">
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
                      <td id="texto-blanco" width='25%'><?php echo $idRecinto;?></td>
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


        <form >
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">

                </div>
              </div>
            </div>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
            <button type="submit" class="btn btn-primary">Enviar solicitud <i class="fa fa-check-circle" aria-hidden="true"></i></button>
        </form>
      </div>


      
      </div>
  </div>


