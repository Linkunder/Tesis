
<?php

include('layout/headerJugador.php');


$equipos = $vars['listaEquipos'];
$desafios = $vars['listaDesafios'];

$recintos = $vars['listaRecintos'];





?>


<link href="assets/css/profile.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/slider.css">





<!--  jQuery -->
<script type="text/javascript" src="assets/js/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="assets/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="assets/css/bootstrap-datepicker3.css"/>





<!-- DATATABLE -->
<link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script>

<link href="assets/css/responsive.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="assets/js/dataTables.responsive.min.js"></script>






<!--MODAL IMPLEMENTOS-->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cargando ...</h4>
      </div>
      <div class="modal-body">
        <div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
      </div>
      <div class="modal-footer">
            <h4>Espere por favor ...</h4>
      </div>
    </div>
  </div>
</div>
<!--Modal-->





<!--modal-->
<!--DETALLE DESAFIO  - CREACION -->
<div class="modal fade" id="modal-3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabelDesafio"></h4>
      </div>
      <div class="modal-body">
          <h5 class="texto-modal-negro">Los jugadores de MatchDay están viendo tu desafío.
          </h5>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
        <button type="submit" class="btn btn-primary">Desafiar <i class="fa fa-check" aria-hidden="true"></i></button>
      </div>



    </div>
  </div>
</div> 




<!--/modal-->





<div id="contact-us" class="parallax">
  <div class="container">
    <br>
    <ol class="breadcrumb transparent">
      <li class="breadcrumb-item"><a href="?controlador=Index&accion=indexJugador"> <i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="breadcrumb-item active">Desafios</li>
    </ol>

    <div class="page-header">
      <h2> Desafios <i class="fa fa-futbol-o" aria-hidden="true"></i> </h2>
    </div>



    <?php
    if (count($desafios)==0){          // CASO 1: NO TENER DESAFIOS
      ?>
      
      <p class="centered">No has realizado desafíos en MatchDay. Puedes crear un nuevo desafío o
              visitar el vestíbulo de desafíos de MatchDay, para enfrentarte a otros equipos.
      </p>

      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <table class="table">
            <tr>
              <th style="border-top:transparent; text-align:center;">
                <button type="button" class="btn btn-md btn-primary" href="#" data-toggle="modal" data-target="#modal-1" >Crear desafío 
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

      <?php

      } else {    // CASO 2: TENER EQUIPOS COMO CAPITAN
        ?>

        <p class="centered">A continuación puedes ver los desafíos enviados por tus equipos en MatchDay. Además puedes crear un nuevo desafío o
              visitar el vestíbulo de desafíos de MatchDay, para enfrentarte a otros equipos.
        </p>


            <div class="row">
              <div class="col-md-4 col-md-offset-4">
                  <table class="table">
                    <tr>
                      <th style="border-top:transparent; text-align:center;">
                          <button type="button" class="btn btn-md btn-primary" href="#" data-toggle="modal" data-target="#modal-1" >Crear desafío 
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
  
        <div class="panel-group">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <a data-toggle="collapse" href="#misDesafios">
                <h4 class="panel-title">
                  Mis desafios
                </h4>
              </a>
            </div>
          </div>
        </div>


        <!-- TABLA DE MIS DESAFIOS -->
        <div class="row collapse" id="misDesafios">
          <div class="col-md-8 col-md-offset-2">
            <!--div class="table-responsive"-->
              <table id="example" class="table table-striped table-hover display responsive nowrap"  cellspacing="0" width="100%">
                <thead id ="position-table">
                  <tr id="color-encabezado">
                    <th id="encabezado-especial">Desafio</th>
                    <th id="encabezado-especial">Equipo</th>
                    <th id="encabezado-especial">Fecha</th>
                    <th id="encabezado-especial">Tipo de partido</th>
                    <th id="encabezado-especial">Estado</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="texto-contactos" class="center">
                  <?php
                  foreach ($desafios as $item) {
                  ?>
                  <tr>
                    <td>
                      <?php 
                      
                      echo $item['idDesafio']?>
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
                    if ($item['estadoDesafio']==2){
                      ?>
                      <span class="label label-primary">Encuentro aceptado <i class="fa fa-check-circle" aria-hidden="true"></i></span>
                      <?php
                    }
                    ?>
                  </td>
                  <?php 

                    $idDesafio = $item['idDesafio'];
                    $idEquipo = $item['idEquipo'];
                    ?>
                  <input type="text" id="id_desafio" value="<?php echo $idDesafio?>" hidden/>
                  <!--td>
                    <a href="#" class="btn btn-danger fa fa-trash-o" onclick="setValue2(<?php echo $idDesafio;?>)" data-placement="right" data-toggle="tooltip" title="Cancelar desafío"></a>
                  </td-->
                  <td>


                    <!--a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#modal-3" onclick="carga_ajax('<?php echo $idDesafio?>','modal-3','views/detalleDesafio.php');">Con Ajax <i class="fa fa-search-plus" aria-hidden="true"></i></a-->

                    <!--a class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#modal-3" onClick="carga_ajax('1','modal-3','ajax_1.php');">
                      <i class="fa fa-search-plus" aria-hidden="true"></i>
                    </a-->

                    <!--button class="btn btn-primary" title="Ver detalle" href="#" data-toggle="modal" data-target="#modal-3">
                      <i class="fa fa-search-plus" aria-hidden="true"></i>
                    </button-->


                    

                    <?php
                    if ($item['estadoDesafio']==2){
                      ?>
                      <button type="button" class="btn btn-primary fa fa-search-plus" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  onclick="carga_ajax('modal','<?php echo $idDesafio?>','desafio');"></button>


                      <?php
                    } 

                    if ($item['estadoDesafio']==1){
                      ?>
                      <button type="button" class="btn btn-primary fa fa-search-plus" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  onclick="carga_ajax('modal','<?php echo $idDesafio?>','respuestas');"></button>
                      <?php
                    }
                    


                    if ($item['estadoDesafio']==0){
                      ?>
                      <button type="button" class="btn btn-primary fa fa-search-plus" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  onclick="carga_ajax('modal','<?php echo $idDesafio?>','respuestas');"></button>
                      <?php
                    }
                    ?>


                    <script>
                      $(document).ready(function(){
                          $('[data-toggle="tooltip"]').tooltip(); 
                      });
                    </script>


                  </td>
                </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            <!--/div-->
          </div>
        </div>
        <!-- /TABLA DE MIS DESAFIOS -->


        
        <script type="text/javascript">
          $(document).ready(function() {
            $('#example').DataTable({
              responsive: true
            });
        } );
        </script>












<?php
}
?>




        <?php
        $solicitudes = $vars['listaSolicitudes'];
        if (count($solicitudes) == 0 ){
          ?>


          <?php
        } else {
          ?>
          <br/>






        <div class="panel-group">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <a data-toggle="collapse" href="#misRespuestas">
                <h4 class="panel-title">
                  Mis respuestas
                </h4>
              </a>
            </div>
          </div>
        </div>





      <!-- TABLA DE MIS SOLICITUDES -->

          


          <div class="row collapse" id="misRespuestas">
            <p class="centered">En esta sección, puedes ver las solicitudes que has realizado en el vestíbulo de partidos de MatchDay.</p>
          <div class="col-md-8 col-md-offset-2">
            <!--div class="table-responsive"-->


              <table id="example2" class="table table-striped table-hover display responsive nowrap" cellspacing="0" width="100%">
                <thead id ="position-table">
                  <tr id="color-encabezado">
                    <!--th id="encabezado-especial">Enc</th>
                    <th id="encabezado-especial">Des</th-->
                    <th id="encabezado-especial">Tu Equipo</th>
                    <th id="encabezado-especial">Rival</th>
                    <th id="encabezado-especial">Tipo de partido</th>
                    <th id="encabezado-especial">Fecha</th>
                    <th id="encabezado-especial">Estado</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="texto-contactos" class="center">
                  <?php
                  foreach ($solicitudes as $item) {
                    $idEncuentro = $item['idEncuentro'];
                  ?>
                  <tr>
                    <!--td>
                      <?php echo $item['idEncuentro']?>
                    </td>
                    <td>
                      <?php echo $item['idDesafio']?>
                    </td-->
                  <td>
                    <?php echo $item['equipo1']?>
                  </td>
                  <td>
                    <?php echo $item['equipo2']?>
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
                    <?php echo $item['fechaPartido']?>
                  </td>
                  <td>
                    <?php
                    if ($item['estadoSolicitud']==1){
                    ?>
                      <span class="label label-warning">Esperando respuesta <i class="fa fa-clock-o" aria-hidden="true"></i></span>
                    <?php
                    }
                     if ($item['estadoSolicitud']==2){
                      ?>
                      <span class="label label-primary">Encuentro aceptado <i class="fa fa-check-circle" aria-hidden="true"></i></span>
                    <?php
                    }

                    ?>




                  </td>
                    <td>
                      <button type="button" class="btn btn-primary fa fa-search-plus" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  onclick="carga_ajax('modal','<?php echo $idEncuentro?>','encuentro');"></button>
                    </td>


                </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            <!--/div-->
          </div>
        </div>

        <!-- / TABLA DE MIS DESAFIOS -->


        <script type="text/javascript">
          $(document).ready(function() {
            $('#example2').DataTable({
              responsive: true
            });
        } );
        </script>



          <?php
        }
        ?>

        <br/>




        <?php
        $historialDesafios = $vars['historialDesafios'];
        if ( !empty($historialDesafios) ){
          ?>


        <div class="panel-group">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <a data-toggle="collapse" href="#historialDesafios">
                <h4 class="panel-title">
                  Historial de desafios
                </h4>
              </a>
            </div>
          </div>
        </div>


        <div class="row collapse" id="historialDesafios">
          <p class="centered">En esta sección, puedes ver el historial de desafíos realizados por tus equipos en MatchDay</p>
          <div class="col-md-8 col-md-offset-2">
            <!--div class="table-responsive"-->
              <table id="example3" class="table table-striped table-hover display responsive nowrap" cellspacing="0" width="100%">
                <thead id ="position-table">
                  <tr id="color-encabezado">
                    <!--th id="encabezado-especial">Enc</th>
                    <th id="encabezado-especial">Des</th-->
                    <th id="encabezado-especial">Tu Equipo</th>
                    <th id="encabezado-especial">Rival</th>
                    <th id="encabezado-especial">Tipo de partido</th>
                    <th id="encabezado-especial">Fecha</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="texto-contactos" class="center">
                  <?php
                  foreach ($historialDesafios as $item) {
                    //$idEncuentro = $item['idEncuentro'];
                  ?>
                  <tr>
                    <!--td>
                      <?php echo $item['idEncuentro']?>
                    </td>
                    <td>
                      <?php echo $item['idDesafio']?>
                    </td-->
                  <td>
                    <?php echo $item['equipo1']?>
                  </td>
                  <td>
                    <?php echo $item['equipo2']?>
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
                    <?php echo $item['fechaPartido']?>
                  </td>
                  <td>
                    boton resumen
                  </td>
                  



                </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            <!--/div-->
          </div>
        </div>


        <script type="text/javascript">
          $(document).ready(function() {
            $('#example3').DataTable({
              responsive: true
            });
        } );
        </script>

        <?php
        }
        ?>




  </div>
</div>


<!-- DATEPICKER-->
              <script>
                  $(document).ready(function(){
                    var date_input=$('input[name="date"]'); //our date input has the name "date"
                    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                    var options={
                      format: 'dd-mm-yyyy',
                      container: container,
                      todayHighlight: true,
                      autoclose: true,
                      startDate: "<?php echo "d-m-Y"?>",
                    };
                    date_input.datepicker(options);
                  })
              </script>

      <?php
      include('layout/footer.php'); 

    

    ?>
     

<!-- Script Graficos -->


<!-- Modal -->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-duallistbox.css">
<!--script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script-->
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
              <div class="col-md-12">
                <div class="form-group">
                  <label class="texto-modal-negro" for="equipo">Equipo desafiante: </label>
                  <select class="form-control" name="equipo" required>
                        <option value="" selected disabled>Selecciona uno de tus equipos</option>
                        <?php
                        foreach($equipos as $item){
                        ?>
                        <option  value="<?php echo $item['idEquipo']?>" class="texto-modal-negro">
                            <?php echo $item['nombre']?>
                        </option>
                        <?php
                        }
                        ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="texto-modal-negro" for="recinto">Recinto: </label>
                  


                  <select class="form-control" name="recinto" required>
                    <option value="" selected disabled>Selecciona un recinto</option>
                        <?php
                        foreach($recintos as $item){
                        ?>
                        <option  value="<?php echo $item['idRecinto']?>" class="texto-modal-negro">
                            <?php echo $item['nombre']?>
                        </option>
                        <?php
                        }
                        ?>
                  </select>

                  <!--label class="texto-modal-negro" for="tipoPartido">Tipo de partido: </label>
                  <select class="form-control" name="tipoPartido" required>
                    <option  value="" selected disabled>Selecciona un tipo de partido</option>
                    <option  value="0" class="texto-modal-negro">Fútbol</option>
                    <option  value="1" class="texto-modal-negro">Futbolito</option>
                    <option  value="2" class="texto-modal-negro">Baby-Fútbol</option>
                  </select-->


                </div>
              </div>


              <div class="col-sm-12">
                <div class="form-group">
                  <label class="texto-modal-negro" for="fecha">Fecha del partido: </label>
                  <!--input type="date" name="fecha" class="form-last-name form-control"required step="1" min="<?php echo date("Y-m-d");?>" max="2020-12-31" value="<?php echo date("Y-m-d");?>"-->
                  <input class="form-control" id="date" name="date" placeholder="dd-mm-aaa" type="text"  required/>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="texto-modal-negro" for="comentario">Selecciona un rango de edad: </label>
                      <div class="well">
                        <div class="row">
                          <div class="col-sm-12">
                            <b class="texto-modal-negro">18</b>
                            <input id="ex2" name="edad" type="text" class="span2" value="" data-slider-min="18" data-slider-max="60" data-slider-step="1" data-slider-value="[18,60]"/>
                            <b class="texto-modal-negro">60</b>
                          </div>
                        </div>
                      </div>
                      
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="texto-modal-negro" for="comentario">Comentario adicional: </label>
                  <textarea id="texto-input-black" class="form-control" rows="2" maxlength="200" placeholder="Aqui puedes escribir información adicional (hora, posiciones de jugadores, etc.)" name="comentario" required></textarea>
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

<div class="modal fade" id="modal-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
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
          <h4 class="modal-title" id="myModalLabel">Desafíos MatchDay</h4>
      </div>
      <div class="modal-body">
        <h5 class="texto-modal-negro">Elige uno de tus equipos para aceptar un desafío MatchDay</h5><br>
        <form id="demoform" action="?controlador=Desafio&accion=verVestibuloDesafios" method="post">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="texto-modal-negro" for="equipo">Equipo desafiante: </label>
                  <select class="form-control" name="equipo" required>
                        <option value="" selected disabled>Selecciona uno de tus equipos</option>
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
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="texto-modal-negro" for="comentario">Selecciona un rango de edad: </label>
                      <div class="well">
                        <div class="row">
                          <div class="col-sm-12">
                            <b class="texto-modal-negro">18</b>
                            <input id="ex3" name="edad" type="text" class="span2" value="" data-slider-min="18" data-slider-max="60" data-slider-step="1" data-slider-value="[18,60]"/>
                            <b class="texto-modal-negro">60</b>
                          </div>
                        </div>
                      </div>
                      
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



<?php
$aux = 1;
$nroEncuentros = $vars['nroEncuentros'];
?>




<!-- MODAL PARA VER RESPUESTAS -->
<div class="container">
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <?php $desafioActual = $_GET['idDesafio']; ?>
          <h4 class="modal-title" id="myModalLabelDesafio">
            Detalle desafío
          </h4>
        </div>
        <div class="modal-body">
        <h5 class="texto-modal-negro"><?php echo $nombre?>, a continuación puedes ver el detalle y respuesta(s) de tus desafios.</h5>

        <?php

        if (!isset($vars['listaEncuentros'.$desafioActual])){
          ?>
          <br/>
          <div class="container-fluid">
            <div class="alert alert-danger fade in">
              <strong>Error!</strong> No estás autorizado para acceder a esta información.
            </div>
          </div>
          <?php
        } else {

        $encuentroActual = $vars['listaEncuentros'.$desafioActual];

        if ($encuentroActual != 0){

          foreach ($encuentroActual as $item) { ?>


          <div class="panel-group">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <?php
                   if ($item['estado'] != 2){
                    ?>
                    <a data-toggle="collapse" href="#collapse<?php echo $item['idEncuentro']?>">
                      <h4 class="panel-title">
                        Propuesta N°<?php echo $aux.": Equipo ".$item['nombreEquipo']?>
                      </h4>
                    </a>
                    </div>
                    <div id="collapse<?php echo $item['idEncuentro']?>" class="panel-collapse collapse">
                    <?php
                   } else {
                    ?>
                    <h4 class="panel-title">
                      Rival: <?php echo $item['nombreEquipo']?>
                    </h4>
                    </div>
                    <div id="collapse<?php echo $item['idEncuentro']?>">
                    <?php
                   }
                  ?>
                  
                
                  <br>
                  <div class="container">
                    <div class="col-sm-12">
                      <!-- MOSTRAR JUGADORES -->

                      <div class="row">
                        
                        <div class="col-md-3">
                          <br>
                          <div class="profile-userpic">
                          <img class="img-responsive" style="width: 100px; height: 100px;" src="assets/images/usuarios/<?php echo $item['fotografia']?>">
                          <div class="profile-usertitle">
                            <div class="profile-usertitle-name">
                              <?php echo "Capitán: ".$item['nombreCap']." ".$item['apellidoCap']; ?>
                            </div>
                          </div>
                          <br>
                        </div>
                        </div>
                        <div class="col-md-6">


                          <br/>
                          <div class="row">
                            <label>Equipo: </label><?php echo " ".$item['nombreEquipo']?>
                            <br>
                            <label>Puntuación: </label><?php echo " ".$item['puntuacion']?>
                            <br>
                            <label>Promedio de edad: </label><?php echo " ".$item['edadPromedio']." años"?>
                            <br>
                          </div>


                          <div class="row">
                            <br/>

                            <?php

                            if ($item['estado'] == 2){
                              ?>

                          <div class="row">
                            <table class="table">
                              <tr>
                                <th style="border-top:transparent; text-align:center;">
                                  <form action="?controlador=Partido&accion=agendarDesafio" method="post">
                                    <input type="text" name="desafio" value="<?php echo $item['idDesafio']?>" hidden/>
                                    <input type="text" name="encuentro" value="<?php echo $item['idEncuentro']?>" hidden/>
                                    <input type="text" name="equipo" value="<?php echo $item['idEquipo']?>" hidden/>
                                  <button type="submit" class="btn btn-md btn-primary">Agendar partido
                                    <i class="fa fa-futbol-o" aria-hidden="true"></i>
                                  </button>
                                  </form>
                                </th>
                              </tr>
                            </table>
                          </div>

                              <?php
                            } else {
                              ?>

                              <table class="table">
                              <tr>
                                <th style="border-top:transparent; text-align:center;">
                                  <form action="?controlador=Encuentro&accion=cancelarEncuentro" method="post">
                                    <input type="text" name="desafio" value="<?php echo $item['idDesafio']?>" hidden/>
                                    <input type="text" name="equipo" value="<?php echo $item['idEquipo']?>" hidden/>
                                  <button type="submit" class="btn btn-md btn-danger">Rechazar solicitud 
                                    <i class="fa fa-times"></i>
                                  </button>
                                </form>
                                </th>
                                <th style="border-top:transparent; text-align:center;">
                                  <form action="?controlador=Encuentro&accion=aceptarEncuentro" method="post">
                                    <input type="text" name="desafio" value="<?php echo $item['idDesafio']?>" hidden/>
                                    <input type="text" name="equipo" value="<?php echo $item['idEquipo']?>" hidden/>
                                  <button type="submit" class="btn btn-md btn-primary">Aceptar solicitud
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                  </button>
                                  </form>
                                </th>
                              </tr>
                            </table>
                              <?php
                            }

                            ?>
                            
                              
                            
                            
                          </div>
                        </div>


                      </div>
                    </div>                    
                  </div>
                  
                </div>
              </div>
            </div>
            







          <?php
          $aux++;
          }
        } else {
          ?>
          <br/>
          <div class="container-fluid">
            <div class="alert alert-warning fade in">
              <strong>Atención!</strong> Este desafío no ha sido respondido aún por los usuarios de MatchDay. Vuelve a intentarlo próximamente.
            </div>
          </div>
          <?php
        }

        ?>

        <?php
        } 
        ?>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
        </div>
      </div>

      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>


<!-- /MODAL PARA VER RESPUESTAS -->







<!--MODAL PARA CANCELAR DESAFIO-->
<div class="container">
  <div class="modal fade" id="myModal2">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <?php $desafioActual = $_GET['idDesafio']; ?>
          <h4 class="modal-title" id="myModalLabelDesafio">
            Cancelar desafio <?php echo $desafioActual?>
          </h4>
        </div>
        <div class="modal-body">
        <h5 class="texto-modal-negro"><?php echo $nombre?>, ¿estás seguro que quieres cancelar este desafío?</h5>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar <i class="fa fa-times" aria-hidden="true"></i></button>
        </div>
      </div>

      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>

<!-- FIN MODAL -->











<script type="text/javascript">
var idDesafio="0";
function setValue(id){
  idDesafio= id;
  document.getElementById("id_desafio").value = idDesafio;
  window.location.href="?controlador=Desafio&accion=listaDesafios&idDesafio="+id;
}




window.onload = function() {
    function getParameterByName(name) {
      name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
      var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
      results = regex.exec(location.search);
      return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }
    var a = getParameterByName('idDesafio');
    var b = getParameterByName('idDesafio2');

    if(a == ""){

    }else{
      document.getElementById("id_desafio").value = a;
      $('#myModal').modal();
    }




};

</script>

























<script src="assets/js/funciones/funciones.js"></script>

<script src="assets/js/bootstrap-slider.js"></script>
<script type="text/javascript">
  $('#ex2').slider({
    min:18,
    max:60,
    step:1,
    precision:0,
    tooltip:'show',
    handle: 'round'
  });

  $('#ex3').slider({
    min:18,
    max:60,
    step:1,
    precision:0,
    tooltip:'show',
    handle: 'round'
  });
</script>


        <script>
            /*
            $('#modalImplementos').on('show.bs.modal', function(){
                alert("Hola");
                //$('#modalImplementos').load('?controlador=Recinto&accion=implementosRecinto');
                $('#modalImplementos').load('?controlador=Recinto&accion=implementosRecinto');
                 
            })
            */
            function carga_ajax(div, id,tipo){
              if (tipo == 'encuentro'){
                     $.post(
                    '?controlador=Encuentro&accion=detalleEncuentro&idEncuentro='+id,
                    function(resp){
                        $("#"+div+"").html(resp);
                    }
                    ); 
              }
              if (tipo == 'desafio'){
                $.post(
                    '?controlador=Desafio&accion=agendarPartido&idDesafio='+id,
                    function(resp){
                        $("#"+div+"").html(resp);
                    }
                    ); 
              }
              if (tipo == 'respuestas'){
                 $.post(
                    '?controlador=Desafio&accion=verRespuestas&idDesafio='+id,
                    function(resp){
                        $("#"+div+"").html(resp);
                    }
                    ); 
              }
            }

            
        </script>