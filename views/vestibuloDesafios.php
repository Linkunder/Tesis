
<?php

include('layout/headerJugador.php');



?>



<link href="assets/css/profile.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/slider.css">





<div id="contact-us" class="parallax">
  <div class="container">
    <br>
    <ol class="breadcrumb transparent">
      <li class="breadcrumb-item"><a href="?controlador=Index&accion=indexJugador"> <i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="breadcrumb-item"><a href="?controlador=Desafio&accion=listaDesafios"> <i class="fa fa-futbol-o" aria-hidden="true"></i> Desafios</a></li>
      <li class="breadcrumb-item active">Vestibulo de desafíos<li>
    </ol>

      <div class="page-header">
        <h2> Vestibulo de desafios <i class="fa fa-futbol-o" aria-hidden="true"></i> </h2>
      </div>

      <?php

      if ($vars['nroDesafios'] != 0 ){

        ?>

        <p class="centered"><?php echo $nombre?>, estos son los desafíos Matchday que puedes responder.</p>


      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr id="color-encabezado">
                  <th>Desafio</th>
                  <th>Equipo</th>
                  <th>Fecha</th>
                  <th>Tipo de partido</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody id="texto-contactos">
                <?php
                $nroDesafios = $vars['nroDesafios'];
                for ($i=1; $i <= $nroDesafios; $i++) {
                  $desafio = $vars['listaDesafiosSistema'.$i];
                foreach ($desafio as $item) {
                  if ($item['estadoDesafio']!=2){
                ?>
                <tr>
                  <td>
                    <?php echo $item['idDesafio']?>
                  </td>
                  <td>
                    <?php echo $item['nombreEquipo']?>
                  </td>
                  <td>
                    <?php echo $item['fechaPartido']?>
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
                    if ($item['estadoDesafio']==0){
                      ?>
                      <span class="label label-warning">Esperando respuestas <i class="fa fa-clock-o" aria-hidden="true"></i></span>
                      <?php
                    }
                    if ($item['estadoDesafio']==1){
                      ?>
                      <span class="label label-success">Con respuestas <i class="fa fa-bell" aria-hidden="true"></i></span>
                      <?php
                    }
                    ?>
                  </td>
                  <td>
                    <a href="?controlador=Encuentro&accion=setEncuentro&idDesafio=<?php echo $item['idDesafio']?>">
                    <button class="btn btn-primary" title="Desafiar" >Desafiar
                      <i class="fa fa-check-circle" aria-hidden="true"></i>
                    </button>
                    </a>
                  </td>
                </tr>
                  <?php
                }
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <br>




        <?php

      } else {

        ?>

        <p class="centered"><?php echo $nombre?>, en estos momentos no hay desafíos disponibles para tu equipo.
          Por favor, inténtalo más tarde.</p>

          <div class="row">
            <div class="col-md-4 col-md-offset-4">
              <table class="table">
                <tr>
                  <th style="border-top:transparent; text-align:center;">
                    <a href="?controlador=Desafio&accion=listaDesafios">
                      <button type="button" class="btn btn-md btn-primary" href="#" data-toggle="modal" data-target="#modal-1">Volver
                        <i class="fa fa-arrow-circle-left"></i>
                      </button>
                    </a>
                  </th>
                </tr>
              </table>
            </div>
          </div>

        <?php




      }
      ?>


      









    </div>
</div>

<?php
include('layout/footer.php'); 

?>




<!-- Modal -->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-duallistbox.css">
<!--script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script-->
<script src="assets/js/jquery.bootstrap-duallistbox-modal.js"></script>







<!--DETALLE DESAFIO   - DESAFIO DE OTROS-->
<div class="modal fade" id="modal-4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">



      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Detalle del desafío</h4>
      </div>

      <div class="modal-body">
          <h5 class="texto-modal-negro">Para aceptar este desafío, haz click en el botón "Desafiar". 
          </h5>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
            <button type="submit" class="btn btn-primary">Desafiar <i class="fa fa-check" aria-hidden="true"></i></button>
      </div>



    </div>
  </div>
</div>



<script src="assets/js/bootstrap-slider.js"></script>
<script type="text/javascript">
  $('#ex2').slider({
    min:15,
    max:60,
    step:1,
    precision:0,
    tooltip:'show',
    handle: 'round'
  });
</script>