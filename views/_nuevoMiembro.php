<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">¡Encuentro acordado!</h4>
      </div>
      <?php
      $desafio = $vars['desafio'];
      foreach ($desafio as $item) {
        $idCapitan = $item['idCapitan'];
        $idDesafio = $item['idDesafio'];
        ?>
      <div class="modal-body">
        <h4 class="modal-title"><?php echo $item['nombreEquipo']?> v/s <?php echo $vars['nombreEquipo2']?></h4>
        <br/>
        <!--h6 class="texto-modal-negro">Si aceptas este desafío, el partido se llevará a cabo en la 
          cancha "<?php echo $item['nombreRecinto']?>". A continuación puedes ver toda la información relativa al desafío.</h6-->
        <div class="container-fluid">
          <div class="row">

            <div class="col-xs-12 col-sm-4">
              <h6 class="texto-modal-negro">Cancha: <?php echo $item['nombreRecinto']?></h6>
              <img style="-webkit-border-radius: 21px; -moz-border-radius: 21px; border-radius: 21px;" 
              src="assets/images/recintos/<?php echo $item['fotoRecinto'];?>"  class="img-responsive" alt="">
            </div>
            <div class="col-xs-12 col-sm-8">
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th width='25%'>Fecha</th>
                    <td width='75%'><?php echo $item['fechaPartido']?></td>
                  </tr>
                  <tr>
                    <th>Tipo de partido</th>
                    <td><?php 
                    $tipoPartido = $item['tipoPartido'];
                    if ($tipoPartido == 0){
                      echo "Fútbol";
                    }
                    if ($tipoPartido == 1){
                      echo "Futbolito";
                    }
                    if ($tipoPartido == 2){
                      echo "Baby-fútbol";
                    }
                    ?></td>
                  </tr>
                  <tr>
                    <th>Tu comentario</th>
                    <td><?php echo $item['comentario']?></td>
                  </tr>
                  <tr>
                    <th>Comentario del rival:</th>
                    <td><?php echo $vars['respuestaRival']?></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>

      </div>
      <?php
      }
      ?>
      <br/>

      <div class="modal-footer">
         <h6 class="texto-modal-negro">Para agendar el partido, completa los siguientes campos. A veces los comentarios de los 
          rivales son de vital importancia para agendar el partido.</h6>
         <form id="demoform" action="?controlador=Partido&accion=agendarDesafio" method="post">
          <input type="text" name="idUsuario" value="<?php echo $idCapitan?>" hidden/>
          <input type="text" name="desafio" value="<?php echo $idDesafio?>" hidden/>
          <input type="text" name="rival" value="<?php echo $vars['idRival']?>" hidden />
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="texto-modal-negro" for="hora">Selecciona la hora : </label>
                   <input type="time" name="hora" placeholder="Hora" class="form-control partido" id="equipo" required="required" min="09:00:00" max="23:00:00">
                </div>
              </div>
            </div>

          </div>

        <button type="button" class="btn btn-danger" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
        <button type="submit" class="btn btn-primary">Aceptar <i class="fa fa-check" aria-hidden="true"></i></button>
        </form>
      </div>


      
    </div>
  </div>